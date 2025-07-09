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

class studentDashboardController extends Controller
{
  use FileUpload;

  function index(): View
  {
    // dd('hello');
    return view('Frontend.student-dashboard.index');
    //return view('Frontend.layouts.master');
  }

  function becomeInstructor(string $id): View
  {
    return view('student.becomeTeacher', compact('id'));
  }

  function store(Request $req, string $id): RedirectResponse
  {
    //dd($req->all());
    $req->validate([
      'document' => ['required', 'file', 'max:3000'],
      'payout' => ['required', 'in:scipe,paypal,razorpay'],
      'payout_info' => ['required', 'string', 'max:1000'],
      'policy' => ['required'],
      'bio' => ['nullable', 'string', 'max:2000']
    ]);
    $filePath = $this->uploadFile($req->file('document'));
    $data = User::findOrFail($id);
    $data->document = $filePath;
    $data->bio = $req->bio;
    $data->approved_status = 'pending';
    $data->save();
    PayoutInformation::updateOrCreate(
      ['teacher_id' => $id],
      [
        'payoutGateway' => $req->payout,
        'payoutInformation' => $req->payout_info
      ]
    );
    return redirect()->back()->with('success', 'Profile updated successfully!');
  }


  public function profile(Request $request)
  {
    $user = Auth::user(); // get the logged in student

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

  public function courses(Request $request)
  {
    $user = Auth::user();
    $classId = $user->student_classes_id;

    $courses = Course::where('class_id', $classId)->get();

    /*if ($request->ajax()) {
        return view('frontend.student-dashboard.enrolled-courses.index', compact('courses'));
    }*/
    return view('frontend.student-dashboard.enrolled-courses.index', compact('courses'));

    // return view('frontend.student-dashboard.index');
  }

  public function courseChapters($id)
  {
    $course = Course::findOrFail($id);
    $chapters = Chapter::with('lessons') // eager load lessons
      ->where('course_id', $id)
      ->where('status', 'active')
      ->orderBy('order')
      ->get();

    return view('frontend.student-dashboard.enrolled-courses.chapters', compact('course', 'chapters'));
  }


  public function remarks(Request $request)
  {
    return view('frontend.student-dashboard.remarks.index');
  }

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



  public function showMcqForm($course_id)
  {
    $course = Course::findOrFail($course_id);

    // Check if there is an active test
    $mockTest = MockTest::where('course_id', $course_id)
      ->where('status', 'active')
      ->first();

    if (!$mockTest) {
      return redirect()->back()->with('error', 'No active test found for this course.');
    }

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
          'type' => 'single', // placeholder for now
          'options' => $options->map(fn($opt) => $opt->option_text)->toArray(),
        ]
        : null;
    })->filter(); // Remove null entries

    if ($questions->isEmpty()) {
      return redirect()->back()->with('error', 'No valid questions with options found.');
    }

    return view('Frontend.student-dashboard.questions.mcq', compact('course', 'questions'));
  }


  public function submitMcqForm(Request $request, $course_id)
  {
    $answers = $request->input('answers', []);
    $user = Auth::user();

    // Get the active test for this course
    $mockTest = MockTest::where('course_id', $course_id)->where('status', 'active')->first();
    if (!$mockTest) {
      return back()->with('error', 'No active test found for this course.');
    }

    $questions = MockQuestion::where('mock_test_id', $mockTest->id)->get();
    $score = 0;

    foreach ($questions as $question) {
      $submitted = $answers[$question->id] ?? null;

      $correctOptions = MockQuestionOption::where('mock_question_id', $question->id)
        ->where('correct_option', true)
        ->pluck('option_text')
        ->sort()
        ->values()
        ->toArray();

      if (!$submitted) {
        continue;
      }

      $submittedArray = is_array($submitted)
        ? collect($submitted)->sort()->values()->toArray()
        : [$submitted];

      if ($submittedArray === $correctOptions) {
        $score++;
      }
    }

    // Save attempt
    MockTestAttempt::create([
      'student_id'   => $user->id,
      'mock_test_id' => $mockTest->id,
      'score'        => $score,
      'total_marks'  => $questions->count(),
      'attempt_date' => now()->toDateString(),
      'remarks'      => 'Submitted via MCQ form',
    ]);

    return back()->with('success', 'Your responses have been submitted! You scored ' . $score . '/' . $questions->count());
  }
}
