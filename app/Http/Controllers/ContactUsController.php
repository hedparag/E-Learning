<?php

namespace App\Http\Controllers;

use App\Mail\contactReplyMail;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
   public function index(){
    $data=ContactUs::whereNull('reply')->get();
    return view('Admin.contact.index',compact('data'));
   }
   public function mail(Request $request,string $id):Response{
    $request->validate([
        'reply'=>['required','string','max:1000']
    ]);
    $mail=ContactUs::findOrFail($id);
   $mail->reply=$request->reply;
   $mail->save();
   $addr= $mail->email;
   $name=$mail->name;
   if(config('mail_queue.is_queue')){
    Mail::to($addr)->queue(new contactReplyMail($request->reply,$name));
   }
   else{
   Mail::to($addr)->send(new contactReplyMail($request->reply,$name));
   }
   return response(['message'=>'mail sent'],200);


   }
}
