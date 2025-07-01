<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AddSubject;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Traits\FileUpload;

class RegisteredUserController extends Controller

{
    use FileUpload;
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $subjects=AddSubject::where('is_active','true')->get();
        return view('auth.register',compact('subjects'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type' => ['required', 'in:student,teacher'],

        ]);


        if ($request->type == 'student') {
             $request->validate([
                'class' => ['required', 'exists:student_classes,id']
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'student_classes_id'=>$request->class,
                'approved_status' => 'approved',

            ]);
            event(new Registered($user));

            Auth::login($user);

            return redirect(route('student.dashboard', false));
        } elseif ($request->type == 'teacher') {



            $request->validate([
                'document' => ['required', 'file', 'max:12000', 'mimes:png,jpg,pdf,docx,doc'],
                'subject_ids'=>['required','array','min:1']
            ]);
            // dd($request->all());
            $filePath = $this->uploadFile($request->file('document'));

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'approved_status' => 'pending',
                'document' => $filePath,
                'subject_ids' => $request->subject_ids,
            ]);
            event(new Registered($user));

            Auth::login($user);
            return redirect(route('student.dashboard', false));
        } else {
            return abort(404);
        }
    }
}
