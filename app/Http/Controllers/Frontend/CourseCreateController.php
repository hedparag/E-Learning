<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseCreateController extends Controller
{
    public function edit(Request $req)
    {
        switch ($req->step) {
            case '2':
                $course = Course::findOrFail($req->id);
                return view('Frontend.teacher-dashboard.courses.additional', compact('course'));
                break;
            case '3':
                $course = Course::findOrFail($req->id);
                return view('Frontend.teacher-dashboard.courses.curriculum', compact('course'));
                break;

            default:
                # code...
                break;
        }
    }
    public function update(Request $request)
    {
        switch ($request->current_step) {
            case '2':
                //  dd($request->all());
                $request->validate([
                    'source' => ['required', 'in:upload,youtube,vimeo,external_link'],
                    'qna' => ['nullable'],
                    'duration' => ['required', 'integer'],
                    'capacity' => ['required', 'integer'],

                ]);
                if ($request->source == 'upload') {
                    $request->validate([
                        'file' => ['required', 'url']
                    ]);
                } elseif ($request->source != 'upload') {
                    $request->validate([
                        'url' => ['required', 'url']
                    ]);
                }
                //dd($request->all());
                $course = Course::findOrFail($request->course_id);
                $course->duration = $request->duration;
                $course->capacity = $request->capacity;
                $course->qna = $request->qna ? 1 : 0;
                if ($request->filled('file')) {
                    $course->demo_video_source = $request->file;
                } else if ($request->filled('url')) {
                    $course->demo_video_source = $request->url;
                }
                $course->demo_video_storage = $request->source;
                $course->save();
                return response()->json([
                    'status' => 'success',
                    'message' => 'updation successful.',
                    'redirect' => route('teacher.courses.edit', ['id' => $course->id, 'step' => $request->next_step])
                ]);
                break;

            default:
                # code...
                break;
        }
    }
}
