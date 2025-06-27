<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        return view('frontend.pages.announcements');
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
