<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PayoutInformation;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\AddSubject;
use App\Models\Announcement;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\MockTest;
use App\Models\MockQuestion;
use App\Models\MockQuestionOption;
use App\Models\MockTestAttempt;
use App\Models\ChapterComment;


class studentDashboardController extends Controller
{
  use FileUpload;

  function index(): View
  {
    return view('Frontend.student-dashboard.index');
  }



  // ----- PROFILE ------------------------------------------------------------------------------------------------------
  public function profile(Request $request)
  {
    $user = Auth::user();

    if ($request->ajax()) {
      return view('frontend.student-dashboard.profile.index', compact('user'));
    }

    return view('frontend.student-dashboard.index');
  }

  public function editProfile(): View
  {
    return view('frontend.student-dashboard.profile.update');
  }

  public function updateProfile(Request $request)
  {
    $user = Auth::user();

    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'phone' => 'nullable|string|max:15',
      'gender' => 'nullable|in:male,female',
      'bio' => 'nullable|string',
      'headline' => 'nullable|string|max:255',
      'facebook' => 'nullable|url',
      'linkedin' => 'nullable|url',
      'github' => 'nullable|url',
      'website' => 'nullable|url',
      'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
      $path = $request->file('image')->store('uploads', 'public');
      $user->image = '/storage/' . $path;
    }

    // Update other fields
    $user->update($request->except('image'));

    return redirect()->route('student.profile.index')->with('success', 'Profile updated successfully.');
  }



  // ----- COURSE -------------------------------------------------------------------------------------------------------
  public function courses(Request $request)
  {
    $user = Auth::user();
    $classId = $user->student_classes_id;
    $courses = Course::where('class_id', $classId)->get();

    return view('frontend.student-dashboard.enrolled-courses.index', compact('courses'));
  }

  public function courseChapters($id)
  {
    $course = Course::findOrFail($id);
    $chapters = Chapter::with('lessons')   // load lessons
      ->where('course_id', $id)
      ->where('status', 'active')
      ->orderBy('order')
      ->get();

    return view('frontend.student-dashboard.enrolled-courses.chapters', compact('course', 'chapters'));
  }

  public function submitChapterComment(Request $request, $chapter_id)
  {
    $request->validate([
      'subject' => 'required|string|max:255',
      'message' => 'required|string',
    ]);

    $chapter = Chapter::findOrFail($chapter_id);
    $user    = Auth::user();

    $teacherId = $chapter->course->teacher_id ?? null;

    if (!$teacherId) {
      return back()->with('error', 'Teacher not found for this subject.');
    }

    ChapterComment::create([
      'student_id'  => $user->id,
      'teacher_id'  => $teacherId,
      'chapter_id'  => $chapter_id,
      'subject'     => $request->subject,
      'message'     => $request->message,
    ]);

    return back()->with('success', 'Your message has been sent to the teacher!');
  }



  // ----- REMARKS ------------------------------------------------------------------------------------------------------
  public function remarks(Request $request)
  {
    return view('frontend.student-dashboard.remarks.index');
  }



  // ----- ANNOUNCEMENTS -------------------------------------------------------------------------------------------------
  public function announcements(Request $request)
  {
    $announcements = Announcement::where('is_active', true)
      ->where(function ($query) {
        $query->where('target_type', 'all')
          ->orWhere('created_by_id', auth()->id());
      })
      ->orderBy('start_date', 'desc')
      ->get();

    return view('frontend.student-dashboard.announcements.index', compact('announcements'));
  }


  public function showAnnouncements($id)
  {
    $announcement = Announcement::findOrFail($id);

    return view('frontend.student-dashboard.announcements.show', compact('announcement'));
  }



  // ----- MOCK TEST ----------------------------------------------------------------------------------------------------
  public function showMcqForm($course_id)
  {
    $course = Course::findOrFail($course_id);

    // Check if there is an active test
    $mockTest = MockTest::where('course_id', $course_id)
      ->where('status', 'pending')
      ->first();


   /* if (!$mockTest) {
      return redirect()->back()->with('error', 'No active test found for this course.');
    }*/

    // Fetch all questions
    $rawQuestions = MockQuestion::where('mock_test_id', $mockTest->id)->get();

    if ($rawQuestions->isEmpty()) {
      return redirect()->back()->with('error', 'No questions found in this test.');
    }

    // Prepare questions with at least one option
    $questions = $rawQuestions->map(function ($question) {
      $options = MockQuestionOption::where('mock_question_id', $question->id)->get();

      return $options->isNotEmpty()
        ? (object)[
          'id' => $question->id,
          'text' => $question->question_text,
          'type' => 'single',
          'options' => $options->map(fn($opt) => $opt->option_text)->toArray(),
        ]
        : null;
    })->filter();   // Remove null entries

    if ($questions->isEmpty()) {
      return redirect()->back()->with('error', 'No valid questions with options found.');
    }

    //dynamic duration
    $durationMinutes = $questions->count() * 2;

    // Pass everything to the view
    return view(
      'Frontend.student-dashboard.enrolled-courses.mock-test.mcq',
      compact('course', 'questions', 'durationMinutes')
    );
  }

  // public function submitMcqForm(Request $request, $course_id)
  // {
  //   $answers = $request->input('answers', []);
  //   $user = Auth::user();

  //   // Get the active test for this course
  //   $mockTest = MockTest::where('course_id', $course_id)->where('status', 'active')->first();
  //   if (!$mockTest) {
  //     return back()->with('error', 'No active test found for this course.');
  //   }

  //   $questions = MockQuestion::where('mock_test_id', $mockTest->id)->get();
  //   $score = 0;

  //   foreach ($questions as $question) {
  //     $submitted = $answers[$question->id] ?? null;

  //     $correctOptions = MockQuestionOption::where('mock_question_id', $question->id)
  //       ->where('correct_option', true)
  //       ->pluck('option_text')
  //       ->sort()
  //       ->values()
  //       ->toArray();

  //     if (!$submitted) {
  //       continue;
  //     }

  //     $submittedArray = is_array($submitted)
  //       ? collect($submitted)->sort()->values()->toArray()
  //       : [$submitted];

  //     if ($submittedArray === $correctOptions) {
  //       $score++;
  //     }
  //   }

  //   // 2 marks per question
  //   $rawCorrect     = $score;
  //   $score          = $rawCorrect * 2;
  //   $totalPossible  = $questions->count() * 2;

  //   // Save attempt
  //   MockTestAttempt::create([
  //     'student_id'   => $user->id,
  //     'mock_test_id' => $mockTest->id,
  //     'score'        => $score,
  //     'total_marks'  => $totalPossible,
  //     'attempt_date' => now()->toDateString(),
  //     'remarks'      => 'Submitted via MCQ form',
  //   ]);

  //   return redirect()->route('student.enrolled-courses.index')->with('success', 'Your responses have been submitted! You scored ' . $score . '/' . $questions->count());
  // }

  public function submitMcqForm(Request $request, $course_id)
  {
    $answers = $request->input('answers', []);
    $user    = Auth::user();

    // Locate the active test
    $mockTest = MockTest::where('course_id', $course_id)
      ->where('status', 'active')
      ->first();

    // Get the active test for this course
    $mockTest = MockTest::where('course_id', $course_id)->where('status', 'active')->first();
   if (!$mockTest) {
      return back()->with('error', 'No active test found for this course.');
    }

    // Pull questions + prepare counters
    $questions = MockQuestion::where('mock_test_id', $mockTest->id)->get();
    $totalPossible = $questions->count() * 2;  // 2 marks each
    $score = 0.0;  // running total

    // Evaluate each question
    foreach ($questions as $question) {

      // 1 - Correct options for this question
      $correctOptions = MockQuestionOption::where('mock_question_id', $question->id)
        ->where('correct_option', true)
        ->pluck('option_text')
        ->sort()->values()->toArray();

      // 2 - Student’s selection
      $submitted = $answers[$question->id] ?? [];   // null
      $submitted = is_array($submitted) ? $submitted : [$submitted];
      $submitted = collect($submitted)->sort()->values()->toArray();

      if (empty($submitted)) {
        continue;   // left blank, so 0 marks
      }

      // 3 - If any wrong option chosen, so 0 marks
      $wrongChosen = array_diff($submitted, $correctOptions);
      if (!empty($wrongChosen)) {
        continue;   // no marks for this question
      }

      // 4 - Otherwise : proportional marks
      $numCorrectChosen = count($submitted);   // how many correct ones they ticked
      $totalCorrect = count($correctOptions);   // how many correct exist

      // Marks = chosen_correct × (2 ÷ total_correct)
      $questionMarks = $numCorrectChosen * (2 / $totalCorrect);
      $score += $questionMarks;
    }

    // Save attempt
    MockTestAttempt::create([
      'student_id' => $user->id,
      'mock_test_id' => $mockTest->id,
      'score' => round($score, 2),   // keeping two decimals
      'total_marks' => $totalPossible,
      'attempt_date' => now()->toDateString(),
      'remarks' => 'Submitted via MCQ/MSQ form',
    ]);

    // Redirect with result
    return redirect()
      ->route('student.enrolled-courses.index')
      ->with(
        'success',
        "Your responses have been submitted! You scored " .
          round($score, 2) . " / {$totalPossible}."
      );
  }
}
