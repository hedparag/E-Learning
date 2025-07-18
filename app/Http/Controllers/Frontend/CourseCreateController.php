<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\MockQuestion;
use App\Models\MockQuestionOption;
use App\Models\MockSettings;
use App\Models\MockTest;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseCreateController extends Controller
{
    public function edit(Request $req)
    {
        switch ($req->step) {
            case '1':
                $course = Course::findOrFail($req->id);
                 $editMode=$req->mode;
                $classes = StudentClass::all();
                return view('Frontend.teacher-dashboard.courses.basic-info', compact('course', 'classes','editMode'));
                break;

            case '2':
                $course = Course::findOrFail($req->id);
                $editMode=$req->mode;
                return view('Frontend.teacher-dashboard.courses.additional', compact('course','editMode'));
                break;
            case '3':
                $course = Course::findOrFail($req->id);
                $editMode=$req->mode;
                $count=Course::whereHas('chapters',function($q){
                    $q->whereHas('lessons');
                })->count();
                //dd($count);

                return view('Frontend.teacher-dashboard.courses.curriculum', compact('course','editMode'));
                break;
            case '4':
                $course = Course::findOrFail($req->id);
                $editMode=$req->mode;
                return view('Frontend.teacher-dashboard.courses.finish', compact('course','editMode'));
                break;
            case '5':
                $course = Course::findOrFail($req->id);
                $admin = MockSettings::firstOrFail();
                $editMode=$req->mode;
                $mock=MockTest::where('course_id',$req->id)->first();
                return view('Frontend.teacher-dashboard.courses.mock', compact('course', 'admin','editMode','mock'));
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
                    'file' => ['required', 'string']
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
                    'redirect' => route('teacher.courses.edit', ['id' => $course->id, 'step' => $request->next_step,'mode'=>$request->editMode])
                ]);
                break;
            case '3':
                $id = $request->id;
                return response()->json([
                    'status' => 'success',
                    'message' => 'updation successful.',
                    'redirect' => route('teacher.courses.edit', ['id' => $id, 'step' => $request->next_step,'mode'=>$request->editMode])
                ]);
                break;
            case '4':
                $id = $request->id;
                $request->validate([
                    'reviewer' => ['nullable', 'string', 'max:1000'],
                    'status' => ['required', 'in:draft,active,archived']
                ]);
                $course = Course::findOrFail($request->id);
                $course->msg_for_reviewer = $course->reviewer;
                $course->status = $course->status;
                $course->save();
                return response()->json([
                    'status' => 'success',
                    'message' => 'updation successful.',
                    'redirect' => route('teacher.courses.edit', ['id' => $id, 'step' => $request->next_step,'mode'=>$request->editMode])
                ]);
                break;

                //dd($request->all());
               /* $validated = $request->validate([
                    'course_id' => 'required|exists:courses,id',
                    'questions' => 'required|array|min:2',
                    'questions.*.text' => 'required|string',
                    'questions.*.options' => 'required|array|size:4',
                    /*'questions.*.correct_answer' => 'required|string|in:A,B,C,D',*/
                 /*   'questions.*.correct_answers' => 'required|array|min:1',
                    'questions.*.correct_answers.*' => 'in:A,B,C,D',

                ]);
                $count = 0;
               $admin = MockSettings::findOrFail($request->adminMock_id);
                $marks = $admin->total_marks;
                foreach ($request->questions as $question) {
                    $count++;
                }
                $total_marks = $count * $marks;
                $course = Course::findOrFail($request->course_id);

                $mockTest = new MockTest();


                $mockTest->teacher_id = Auth::guard('web')->user()->id;
                $mockTest->course_id = $request->course_id;
                $mockTest->subject_id = $course->subject_id;
                $mockTest->class_id = $course->class_id;
                $mockTest->question_type = $admin->question_type;
                $mockTest->marks = $total_marks;
                $mockTest->save();
                foreach ($request->questions as $question) {
                    $mockQuestion = new MockQuestion();
                    $mockQuestion->mock_test_id = $mockTest->id;
                    $mockQuestion->question_text = $question['text'];
                    $mockQuestion->save();
                    foreach ($question['options'] as $label => $value) {
                        $mockOptions = new MockQuestionOption();
                        $mockOptions->mock_question_id = $mockQuestion->id;
                        $mockOptions->option_label = $label;
                        $mockOptions->option_text = $value;
                       /* if ($question['correct_answer'] == $label) {
                            $mockOptions->correct_option = true;
                        }*/
                      /*  if (in_array($label, $question['correct_answers'])) {
                        $mockOptions->correct_option = true;
                         }

                        $mockOptions->save();
                    }
                }
                return response()->json([
                    'status' => 'success',
                    'message' => 'updation successful.',
                    'redirect' => route('teacher.courses.index')
                ]);
                break;*/
                case '5':
    $validated = $request->validate([
        'course_id' => 'required|exists:courses,id',
        'questions' => 'required|array|min:10',
        'questions.*.text' => 'required|string',
        'questions.*.options' => 'required|array|size:4',
        'questions.*.correct_answers' => 'required|array|min:1',
        'questions.*.correct_answers.*' => 'in:A,B,C,D',
    ]);

    $course = Course::findOrFail($request->course_id);
    $admin = MockSettings::findOrFail($request->adminMock_id);
    $teacherId = Auth::guard('web')->user()->id;

    // Check if mock test already exists
    $mockTest = MockTest::where('course_id', $course->id)->first();

    if ($mockTest) {
        // Delete existing questions and options
        foreach ($mockTest->questions as $existingQuestion) {
            $existingQuestion->options()->delete();  // Delete options
            $existingQuestion->delete();             // Delete question
        }
    } else {
        // If no previous mock, create new
        $mockTest = new MockTest();
        $mockTest->teacher_id = $teacherId;
        $mockTest->course_id = $course->id;
        $mockTest->subject_id = $course->subject_id;
        $mockTest->class_id = $course->class_id;
        $mockTest->question_type = $admin->question_type;
    }

    // Calculate new total marks
    $totalQuestions = count($request->questions);
    $mockTest->marks = $totalQuestions * $admin->total_marks;
    $mockTest->save();

    // Insert new questions and options
    foreach ($request->questions as $question) {
        $mockQuestion = new MockQuestion();
        $mockQuestion->mock_test_id = $mockTest->id;
        $mockQuestion->question_text = $question['text'];
        $mockQuestion->save();

        foreach ($question['options'] as $label => $value) {
            $option = new MockQuestionOption();
            $option->mock_question_id = $mockQuestion->id;
            $option->option_label = $label;
            $option->option_text = $value;
            $option->correct_option = in_array($label, $question['correct_answers']);
            $option->save();
        }
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Mock Test updated successfully.',
        'redirect' => route('teacher.courses.index')
    ]);
    break;


            default:
                # code...
                break;
        }
    }
}
