<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TeacherCourseStatus;
use App\Models\Course;
use App\Models\MockTest;
use App\Models\StudentClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CourseApproveController extends Controller
{
    public function index()
    {
        //$data = Course::all();
        $classes = StudentClass::all();


        return view('Admin.courseApprove.index', compact('classes'));
    }
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'status' => ['required', 'in:approved,rejected']
        ]);

        $course = Course::findOrFail($request->id);
        $subject = $course->subject_id;
        $class = $course->class_id;
        if (Course::where(['is_approved' => 'approved', 'class_id' => $class, 'subject_id' => $subject])->exists()) {
            notyf()->error("already a approved course exists");
        } else {
            $course->is_approved = $request->status;
            $course->save();
           // dd("heloo");
            if ($request->status == 'approved') {
                $mock = MockTest::where(['course_id' => $request->id, 'class_id' => $course->class_id])->firstOrFail();
                $mock->status = 'active';
                $mock->save();
            }

            $title = $course->title;
            $status = $course->is_approved;
            $name = $course->teacher->name;
            $class = $course->class->name;
            $abc = $course->subject->name;
            if (config('mail_queue.is_queue')) {
                Mail::to($course->teacher->email)->queue(new TeacherCourseStatus($name, $status, $class, $abc, $title));
            } else {
                Mail::to($course->teacher->email)->send(new TeacherCourseStatus($name, $status, $class, $abc, $title));
            }
            notyf()->success("Mail sent");
        }


        return redirect()->back();
    }
    public function preview($id)
    {
        $course = Course::with(['teacher', 'subject', 'class', 'chapters.lessons', 'mock.questions.options'])->findOrFail($id);
        //return view('Admin.courseApprove.preview', compact('course'));
        /*  $course = Course::with([
    'teacher',
    'subject',
    'class',
    'chapters.lessons',
    'mock.questions.options'
])->whereHas('teacher')
  ->whereHas('subject')
  ->whereHas('class')
  ->whereHas('chapters', function ($q) {
      $q->whereHas('lessons');
  })
  ->whereHas('mock', function ($q) {
      $q->whereHas('questions', function ($q2) {
          $q2->whereHas('options');
      });
  })
  ->findOrFail($id);*/
        return view('Admin.courseApprove.preview', compact('course'));
    }
    public function fetch(Request $request)
    {
        $data = Course::where('class_id', $request->class)->get();
        return view('Admin.courseApprove.table', compact('data'));
    }
}
