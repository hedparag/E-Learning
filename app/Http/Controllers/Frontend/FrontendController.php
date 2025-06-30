<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index(): View
    {
        return view('frontend.pages.home.index');
    }

    function about(): View
    {
        return view('frontend.pages.about');
    }

    public function dashboardRedirect(): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        }

        abort(403, 'Unauthorized');
    }

    function announcements(): View
    {
        $now = Carbon::now();
        $data = Announcement::where('target_type', 'all')
            ->where('is_active', 'true')
            ->whereDate('start_date', '<=', $now)
            ->where(function ($query) use ($now) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', $now);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(4);
        return view('frontend.pages.announcements', compact('data'));
    }

    public function teachers(): View
    {
        // return view('frontend.pages.teachers');

        $teachers = User::where('role', 'teacher')->get();
        return view('frontend.pages.teachers', compact('teachers'));
    }

    function contact(): View
    {
        return view('frontend.pages.contact');
    }
}
