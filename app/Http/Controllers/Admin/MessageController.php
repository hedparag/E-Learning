<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChapterComment;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $data=ChapterComment::where('status','pending')->paginate(7);
   return view('Admin.message.index',compact('data'));
    }
    public function store(Request $request,string $id){
       // dd($id);
       $request->validate([
'status'=>['required','in:,approved,rejected']
       ]);
       $data=ChapterComment::findOrFail($id);
       $data->status=$request->status;
       $data->save();
       return redirect()->back();
    }
}
