<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class DataController extends Controller
{
    function index(){
      $data= StudentClass::all();
       return response()->json($data);
    }
}
