<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TeacherRequestApprovedMail;
use App\Mail\TeacherRequestRejectedMail;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InstructorRequestController extends Controller
{
    function index(): View
    {
        $data = User::where(['approved_status' => 'pending', 'role' => 'student'])->paginate(10);
        return view('admin.instructorRequest', compact('data'));
    }
    function download(User $user)
    {
        return response()->download(public_path($user->document));
    }
    function update(Request $req, User $user)
    {

       //dd($user);
        $req->validate([
            'status' => ['required', 'in:pending,approved,rejected']
        ]);
       //dd($req->all());
        $user->approved_status = $req->status;
        if ($req->status == 'approved') {

            $user->role = 'teacher';
            $user->save();
            if (config('mail_queue.is_queue')) {
                Mail::to($user->email)->queue(new TeacherRequestApprovedMail());
            } else {
                Mail::to($user->email)->send(new TeacherRequestApprovedMail());
            }
        } else if ($req->status == 'rejected') {
        $user->save();
            if (config('mail_queue.is_queue')) {
                Mail::to($user->email)->queue(new TeacherRequestRejectedMail());
            } else {
                Mail::to($user->email)->send(new TeacherRequestRejectedMail());
            }
        } else {
            return abort(404);
        }
        return redirect()->route('student.dashboard');
    }
}
