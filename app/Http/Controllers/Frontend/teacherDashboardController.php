<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AddSubject;
use App\Models\Announcement;
use App\Models\ClassSubjectModel;
use App\Models\Course;
use App\Models\MockSettings;
use App\Models\StudentClass;
use Illuminate\Contracts\View\View;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Chapter;

class teacherDashboardController extends Controller
{
    use FileUpload;
    function index(): View
    {
        return view('Frontend.teacher-dashboard.index');
    }

    public function profile()
    {
        $user = Auth::user(); // get the logged in teacher
        return view('frontend.teacher-dashboard.profile.index', compact('user'));
    }

    public function editProfile(): \Illuminate\View\View
    {
        return view('frontend.teacher-dashboard.profile.update');
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

        return redirect()->route('teacher.profile.index')->with('success', 'Profile updated successfully.');
    }

    public function courses()
    {
        $count = Course::where(['teacher_id' => Auth::guard('web')->user()->id])->count();
        $courses = Course::where(['teacher_id' => Auth::guard('web')->user()->id])->paginate(6);
        return view('Frontend.teacher-dashboard.courses.index', compact('courses', 'count'));
    }

    public function createCourses()
    {
        $editMode = 0;
        $classes = StudentClass::all();
        return view('frontend.teacher-dashboard.courses.basic-info', compact('classes', 'editMode'));
        //return view('frontend.teacher-dashboard.courses.basic-info', compact('classes'))->with('step', 1);
        //return view('frontend.teacher-dashboard.courses.additional');
        // $course = Course::findOrFail($req->id);
        // $admin=MockSettings::firstOrFail();

        // return view('Frontend.teacher-dashboard.courses.mock', compact('admin'));
    }
    public function editCourse(string $id)
    {
        $editMode = 1;
        $course = Course::findOrFail($id);
        //dd($course);
        $classes = StudentClass::all();
        return view('frontend.teacher-dashboard.courses.basic-info', compact('classes', 'course', 'editMode'));
    }

    public function remarks()
    {
        return view('Frontend.teacher-dashboard.remarks.index');
    }

    public function announcements()
    {
        $announcements = Announcement::where('is_active', true)
            ->where(function ($query) {
                $query->where('target_type', 'all')
                    ->orWhere('created_by_id', auth()->id());
            })
            ->orderBy('start_date', 'desc')
            ->get();

        return view('frontend.teacher-dashboard.announcements.index', compact('announcements'));
    }

    public function createAnnouncements()
    {
        return view('frontend.teacher-dashboard.announcements.create');
    }
    public function getCommonSubjects(Request $request)
    {
        //dd($request->all());
        $classId = $request->class_id;

        if (!$classId || !Auth::check()) {
            return response()->json(['html' => '']);
        }

        $teacher = Auth::user();

        // Decode JSON subject_ids to array
        //$teacherSubjectIds = json_decode($teacher->subject_ids, true) ?? [];
        $teacherSubjectIds = $teacher->subject_ids ?? [];
        // Get class's assigned subject IDs
        $classSubjectIds = ClassSubjectModel::where('class_id', $classId)
            ->pluck('subject_id')
            ->toArray();

        if ($request->filled('subject_id')) {
            $sub = AddSubject::findOrFail($request->subject_id);
            //  dd($sub);
        }

        // Find common subjects
        $commonSubjectIds = array_intersect($teacherSubjectIds, $classSubjectIds);

        if (empty($commonSubjectIds)) {
            return response()->json(['html' => '<div><p class="text-danger">No subject found for your selected class.</p></div>']);
        }

        $subjects = AddSubject::whereIn('id', $commonSubjectIds)->get();


        $html = '<div class="form-group col-md-12">
                <label for="commonSubject">Subject</label>
                <select class="form-control" name="subject_id" id="commonSubject">
                    <option value="">-- Select Subject --</option>';
        foreach ($subjects as $subject) {
            //$html .= '<option value="' . $subject->id . '">' . $subject->name . '</option>';
            //$html .= '<option value="' . $subject->id . '" ' . (isset($sub) && $sub->name == $subject->name ? 'selected' : '') . '>' . $subject->name . '</option>';
            $html .= '<option value="' . $subject->id . '" ' . (isset($sub) && $sub->id == $subject->id ? 'selected' : '') . '>' . $subject->name . '</option>';
        }
        $html .= '</select></div>';

        return response()->json(['html' => $html]);
    }

    function courseStore(Request $req)
    {
        $editMode = $req->editMode; //0
        //dd($req->all());
        //$decodedSubjectIds = json_decode(Auth::user()->subject_ids ?? '[]', true);
        $req->validate([
            'target' => ['required', 'exists:student_classes,id'],
            'title' => ['required', 'string', 'max:100'],
            'desc' => ['nullable', 'string', 'max:1000'],
            'thumbnail' => ['required', 'image', 'max:5000'],
            'subject_id' => ['required', Rule::in(Auth::user()->subject_ids ?? [])]
            // 'subject_id' => ['required', Rule::in(Auth::user()->subject_ids)],
        ]);

        // dd($req->all());
        $filePath = $this->uploadFile($req->file('thumbnail'));
        $course = new Course();
        $course->title = $req->title;
        $course->slug = Str::slug($req->title);
        $course->desc = $req->desc;
        $course->thumbnail = $filePath;
        $course->teacher_id = Auth::user()->id;
        $course->subject_id = $req->subject_id;
        $course->class_id = $req->target;
        $course->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Creation successful.',
            'redirect' => route('teacher.courses.edit', ['id' => $course->id, 'step' => $req->next_step, 'mode' => $editMode])
        ]);
    }
    public function courseStoreUpdate(Request $req)
    {
        $editMode = $req->editMode; //1
        $course = Course::findOrFail($req->courseId);

        $req->validate([
            'target' => ['required', 'exists:student_classes,id'],
            'title' => ['required', 'string', 'max:100'],
            'desc' => ['nullable', 'string', 'max:1000'],
            'thumbnail' => ['nullable', 'image', 'max:5000'],
            'subject_id' => ['required', Rule::in(Auth::user()->subject_ids ?? [])]
        ]);

        // Generate slug only if title is changed OR always for consistency
        $slug = Str::slug($req->title);

        // Only validate uniqueness if the slug has changed
        if ($slug !== $course->slug) {
            $req->merge(['slug' => $slug]);
            $req->validate([
                'slug' => [
                    'required',
                    Rule::unique('courses', 'slug')->ignore($course->id),

                ],
            ]);
            $course->slug = $slug;
        }

        if ($req->filled('thumbnail')) {
            $this->deleteFile($course->thumbnail);
            $filePath = $this->uploadFile($req->file('thumbnail'));
            $course->thumbnail = $filePath;
        }

        $course->title = $req->title;
        $course->desc = $req->desc;
        $course->teacher_id = Auth::id();
        $course->subject_id = $req->subject_id;
        $course->class_id = $req->target;

        $course->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Updation successful.',
            'redirect' => route('teacher.courses.edit', ['id' => $req->courseId, 'step' => $req->next_step, 'mode' => $editMode])
        ]);
    }


    public function courseChapters($courseId)
    {
        $teacherId = Auth::id();     

        $course = Course::where('teacher_id', $teacherId)
            ->findOrFail($courseId);
   
        $chapters = Chapter::with('lessons')
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->whereHas('course', fn($q) => $q->where('teacher_id', $teacherId))
            ->orderBy('order')
            ->get();

        return view(
            'frontend.teacher-dashboard.courses.chapters',
            compact('course', 'chapters')
        );
    }
}
