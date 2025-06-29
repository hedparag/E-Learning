<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index() : View
    {
        return view('frontend.pages.home.index');
    }

    function about() : View
    {
        return view('frontend.pages.about');
    }

    function announcements() : View
    {
        $now=Carbon::now();
       $data = Announcement::where('target_type', 'all')
        ->where('is_active', 'true')
        ->whereDate('start_date', '<=', $now)
        ->where(function ($query) use ($now) {
            $query->whereNull('end_date')
                  ->orWhereDate('end_date', '>=', $now);
        })
        ->orderBy('updated_at', 'desc')
        ->paginate(4);
        return view('frontend.pages.announcements',compact('data'));
    }

    function teachers() : View
    {
        return view('frontend.pages.teachers');
    }

    function contact() : View
    {
        return view('frontend.pages.contact');
    }
}
