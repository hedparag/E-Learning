<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class teacherDashboardController extends Controller
{
  function index():View{
    return view('Frontend.teacher-dashboard.index');
  }
}
