<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AddSubject;
use App\Models\Announcement;
use App\Models\ClassSubjectModel;
use App\Models\StudentClass;
use Illuminate\Contracts\View\View;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

  public function editProfile(): View
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
    return view('Frontend.teacher-dashboard.courses.index');
  }

  public function createCourses()
  {
     $classes=StudentClass::all();
    return view('frontend.teacher-dashboard.courses.basic-info',compact('classes'));

    //return view('frontend.teacher-dashboard.courses.additional');
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
  public function getCommonSubjects(Request $request){
     $classId = $request->class_id;

    if (!$classId || !Auth::check()) {
        return response()->json(['html' => '']);
    }

    $teacher = Auth::user();

    // Get teacher's assigned subject IDs (stored as JSON array)
    $teacherSubjectIds = $teacher->subject_ids ?? [];

    // Get class's assigned subject IDs using Eloquent
    $classSubjectIds = ClassSubjectModel::where('class_id', $classId)
        ->pluck('subject_id')
        ->toArray();

    // Find common subject IDs
    $commonSubjectIds = array_intersect($teacherSubjectIds, $classSubjectIds);
if(!($commonSubjectIds)){
 return response()->json(['html' => '<div><center>No Subject found for you for the selected class</center></div>']);
}
    // Fetch subject details using Eloquent
    $subjects = AddSubject::whereIn('id', $commonSubjectIds)->get();

    // Generate dropdown HTML
    $html = '<div class="form-group col-md-12">
                <label for="commonSubject">Subject</label>
                <select class="form-control" name="subject_id" id="commonSubject">
                    <option value="">-- Select Subject --</option>';
    foreach ($subjects as $subject) {
        $html .= '<option value="' . $subject->id . '">' . $subject->name . '</option>';
    }
    $html .= '</select></div>';

    return response()->json(['html' => $html]);
  }
}
