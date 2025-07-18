<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TeacherCourseStatus;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CourseApproveController extends Controller
{
    public function index()
    {
        $data = Course::all();


        return view('Admin.courseApprove.index', compact('data'));
    }
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'status' => ['required', 'in:approved,rejected']
        ]);
        $course = Course::findOrFail($request->id);
        $course->is_approved = $request->status;
        $course->save();

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
        return redirect()->back();
    }
    public function preview($id)
    {
        $course = Course::with(['teacher', 'subject', 'class', 'chapters.lessons'])->findOrFail($id);

        return view('Admin.courseApprove.preview', compact('course'));
    }
}
