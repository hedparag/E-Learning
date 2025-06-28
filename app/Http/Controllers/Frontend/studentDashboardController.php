<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PayoutInformation;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class studentDashboardController extends Controller
{
    use FileUpload;
    function index(): View
    {
        return view('Frontend.student-dashboard.index');
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

      public function editProfile(): \Illuminate\View\View
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

    public function courses()
    {
        return view('frontend.student-dashboard.enrolled-courses.index');
    }

    public function announcements()
    {
        return view('frontend.student-dashboard.announcements.index');
    }
}
