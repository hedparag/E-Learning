<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportCardController extends Controller
{
   public function index(){
    return view('Admin.announcement.create');
   }
}
