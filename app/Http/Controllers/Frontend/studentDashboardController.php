<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\StudentMarksMail;
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
use App\Models\MockSettings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class studentDashboardController extends Controller
{
    use FileUpload;

    function index(): View
    {
        $count = 0;
        $count = ChapterComment::where(['status' => 'approved', 'student_id' => Auth::guard('web')->user()->id, 'viewed' => false])
            ->whereNotNull('reply')
            ->count();
        return view('Frontend.student-dashboard.index', compact('count'));
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
            ->where('status', 'draft') //have to modify to active
            ->orderBy('order')
            ->get();
        //  dd($chapters);

        return view('frontend.student-dashboard.enrolled-courses.chapters', compact('course', 'chapters'));
    }


    public function remarks(Request $request)
    {
        return view('frontend.student-dashboard.remarks.index');
    }

    public function announcements(Request $request)
    {
       // dd(Auth::user()->hasClass->name);
       /* $announcements = Announcement::where('is_active', true)
            ->where(function ($query) {
                $query->where('target_type', 'all')
                    ->orWhere('created_by_id', auth()->id());
            })
            ->orderBy('start_date', 'desc')
            ->get();*/
     /*  $announcements = Announcement::where(function ($query) {
    $query->where(function ($q) {
        $q->whereIn('target_type', ['all', 'student'])
          ->where('end_date', '>=', Carbon::now());
    })
    ->orWhere(function ($q) {
        $q->where('target_type', 'class')
          ->where('target_id', Auth::guard('web')->user()->hasClass->id)
          ->where('end_date', '>=', Carbon::now());
    });
})
->orderBy('start_date', 'desc')
->get();*/
$announcements = Announcement::where(function ($query) {
        $query->whereIn('target_type', ['all', 'student'])
              ->orWhere(function ($q) {
                  $q->where('target_type', 'class')
                    ->where('target_id', Auth::guard('web')->user()->hasClass?->id);
              });
    })
    ->where('end_date', '>=', Carbon::now())->where('is_active',true)
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
                    'type' => 'single', // placeholder for now
                    'options' => $options->map(fn($opt) => $opt->option_text)->toArray(),
                ]
                : null;
        })->filter(); // Remove null entries

        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'No valid questions with options found.');
        }
        $durationMinutes = $questions->count() * 2;

        return view('Frontend.student-dashboard.enrolled-courses.mock-test.mcq', compact('course', 'questions', 'durationMinutes'));
    }


    public function submitMcqForm(Request $request, $course_id)
    {

        // dd($request->all());
        $rules = MockSettings::first();
        $answers = $request->input('answers', []);
        $user = Auth::user();
        $course = Course::findOrFail($course_id);

        // Get the active test for this course
        $mockTest = MockTest::where('course_id', $course_id)->where('status', 'active')->first();
        /* if (!$mockTest) {
      return back()->with('error', 'No active test found for this course.');
    }*/

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
                $score = $score + $rules->total_marks;
            }
        }
        $total_marks = ($questions->count()) * ($rules->total_marks);

        // Save attempt
        MockTestAttempt::create([
            'student_id'   => $user->id,
            'mock_test_id' => $mockTest->id,
            'score'        => $score,
            'total_marks'  => $total_marks,
            'attempt_date' => now()->toDateString(),
            'remarks'      => 'Submitted via MCQ form',
        ]);
        $result = 1;
        if (config('mail_queue.is_queue')) {
            Mail::to($user->email)->queue(new StudentMarksMail($course->title, $total_marks, $score, $user->name));
        } else {
            Mail::to($user->email)->send(new StudentMarksMail($course->title, $total_marks, $score, $user->name));
        }

        notyf()->success("We have mailed you your score");

        // return redirect()->route('student.enrolled-courses.index')->with('success', 'Your responses have been submitted! You scored ' . $score . '/' . $questions->count());
        return redirect()->route('student.enrolled-courses.index');
    }

    public function submitChapterComment(Request $request, string $id)
    {

        $course = Course::findOrFail($id);


        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1200',
        ]);
        // dd($request->all());
        $comment = new ChapterComment();
        $comment->subject = $request->subject;
        $comment->message = $request->message;
        $comment->student_id = Auth::guard('web')->user()->id;
        $comment->teacher_id = $course->teacher->id;
        $comment->course_id = $id; //its course id
        $comment->asked_at = now()->toDateTimeString();
        $comment->save();

        return response(['message' => 'your message has been sent'], 200);
        // dd($request->all());

        // $chapter = Chapter::findOrFail($chapter_id);
        /* $user = Auth::user();

    // Find teacher based on course_id of the chapter
    $subject = AddSubject::where('id', $chapter->course_id)->first();
    $teacherId = $subject ? $subject->created_by : null;

    if (!$teacherId) {
      return back()->with('error', 'Teacher not found for this subject.');
    }

    ChapterComment::create([
      'student_id' => $user->id,
      'teacher_id' => $teacherId,
      'chapter_id' => $chapter_id,
      'subject' => $request->subject,
      'message' => $request->message,
    ]);

    return back()->with('success', 'Your message has been sent to the teacher!');*/
    }
    public function viewReply()
    {
        $doubts = ChapterComment::where(['status' => 'approved', 'student_id' => Auth::guard('web')->user()->id])
            ->whereNotNull('reply')
            ->get();

        // Mark all unread replies as seen
        ChapterComment::where([
            'status' => 'approved',
            'student_id' => Auth::guard('web')->user()->id,
            'viewed' => false,
        ])
            ->whereNotNull('reply')
            ->update(['viewed' => true]);

        return view('Frontend.student-dashboard.doubts', compact('doubts'));
    }
}
