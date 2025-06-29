<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
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
    return view('Frontend.teacher-dashboard.courses.index');
  }

  public function createCourses()
  {
    return view('frontend.teacher-dashboard.courses.create');
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
}
