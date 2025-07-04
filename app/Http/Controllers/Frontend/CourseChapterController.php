<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseChapterController extends Controller
{
    public function index(Request $req): string
    {
        $id = $req->courseId;
        if ($req->filled('editId')) {
            $editMode = 1;
            $chapter = Chapter::where(['id' => $req->chapterId, 'course_id' => $req->courseId])->firstOrFail();
            return view('Frontend.teacher-dashboard.courses.chapterModal', compact('chapter', 'editMode', 'id'))->render();
        }
        $editMode = 0;

        return view('Frontend.teacher-dashboard.courses.chapterModal', compact('id', 'editMode'))->render();
    }
    public function store(Request $request)

    {
        $request->validate([
            'duration' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string', 'max:1000']
        ]);
        $order = Chapter::where(['course_id' => $request->course_id])->count();
        //$course=Course::findOrFail($request->course_id);
        $chapter = new Chapter();
        $chapter->duration = $request->duration;
        $chapter->title = $request->title;
        $chapter->desc = $request->desc;
        $chapter->slug = Str::slug($request->title);
        $chapter->order = $order + 1;
        $chapter->course_id = $request->course_id;
        $chapter->created_by = Auth::guard('web')->user()->id;
        $chapter->save();
        return redirect()->back();
    }
    public function edit(Request $req): string
    {
        $editMode = 1;
        $chapter = Chapter::where(['id' => $req->chapterId, 'course_id' => $req->courseId])->firstOrFail();

        return view('Frontend.teacher-dashboard.courses.chapterModal', compact('chapter', 'editMode'))->render();
        // $id = $req->courseId;
        //$editMode = 0;

        //return view('Frontend.teacher-dashboard.courses.chapterModal', compact('id', 'editMode'))->render();
    }
    public function lessonCreate(Request $request): string
    {
        //  dd($request->all());
        if ($request->filled('editId')) {
            $editMode = 1;
            $lessonId = $request->lessonId;
            $courseId = $request->courseId;
            $chapterId = $request->chapterId;
            $lesson = Lesson::where('id', $lessonId)->firstOrFail();
            return view('Frontend.teacher-dashboard.courses.lessonModal', compact('courseId', 'chapterId', 'lesson', 'editMode'))->render();
        }
        $editMode = 0;
        $courseId = $request->courseId;
        $chapterId = $request->chapterId;
        return view('Frontend.teacher-dashboard.courses.lessonModal', compact('courseId', 'chapterId', 'editMode'))->render();
    }
    public function lessonStore(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string', 'max:1000'],
            'source' => ['required', 'in:upload,youtube,vimeo,external_link'],
            'type' => ['required', 'in:audio,video,doc,file'],
            'duration' => ['required', 'integer']
        ]);
        $lesson = new Lesson();
        $order = Lesson::where('chapter_id', $request->chapter_id)->count();
        if ($request->source == 'upload') {
            $request->validate([
                'file' => ['required', 'url']
            ]);
            $lesson->path = $request->file;
        }
        if ($request->source != 'upload') {
            $request->validate([
                'url' => ['required', 'url']
            ]);
            $lesson->path = $request->url;
        }

        $lesson->title = $request->title;
        $lesson->desc = $request->desc;
        $lesson->teacher_id = Auth::guard('web')->user()->id;
        $lesson->course_id = $request->course_id;
        $lesson->chapter_id = $request->chapter_id;
        $lesson->storage = $request->source;
        $lesson->duration = $request->duration;
        $lesson->file_type = $request->type;
        $lesson->order = $order + 1;
        $lesson->save();
        return redirect()->back();
    }
    public function chapterUpdate(Request $request)
    {
        $request->validate([
            'duration' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string', 'max:1000']
        ]);

        //$course=Course::findOrFail($request->course_id);
        $chapter = Chapter::findOrFail($request->chapter_id);
        $chapter->duration = $request->duration;
        $chapter->title = $request->title;
        $chapter->desc = $request->desc;
        $chapter->slug = Str::slug($request->title);
        $chapter->course_id = $request->course_id;
        $chapter->created_by = Auth::guard('web')->user()->id;
        $chapter->save();
        return redirect()->back();
    }
    public function lessonUpdate(Request $request)
    {
   // dd($request->all());
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string', 'max:1000'],
            'source' => ['required', 'in:upload,youtube,vimeo,external_links'],
            'type' => ['required', 'in:audio,video,doc,file'],
            'duration' => ['required', 'integer']
        ]);
        $lesson = Lesson::findOrFail($request->lesson_id);
        if ($request->source == 'upload') {
            $request->validate([
                'file' => ['required', 'url']
            ]);
            $lesson->path = $request->file;
        }
        if ($request->source != 'upload') {
            $request->validate([
                'url' => ['required', 'url']
            ]);
            $lesson->path = $request->url;
        }

        $lesson->title = $request->title;
        $lesson->desc = $request->desc;
        $lesson->teacher_id = Auth::guard('web')->user()->id;
        $lesson->course_id = $request->course_id;
        $lesson->chapter_id = $request->chapter_id;
        $lesson->storage = $request->source;
        $lesson->duration = $request->duration;
        $lesson->file_type = $request->type;
        $lesson->save();
        return redirect()->back();
    }
    public function destroyChapter(string $id){
      $chapter=Chapter::where(['id'=>$id,'created_by'=>Auth::guard('web')->user()->id])->firstOrFail();
      $chapter->delete();
      return response(['message' => 'Deleted successfully'], 200);

    }
    public function destroyLesson(string $id){
       $lesson=Lesson::where(['id'=>$id,'teacher_id'=>Auth::guard('web')->user()->id])->firstOrFail();
      $lesson->delete();
      return response(['message' => 'Deleted successfully'], 200);
    }

}
