<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PayoutInformation;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function profile()
    {
        return view('frontend.student-dashboard.profile.index');
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
