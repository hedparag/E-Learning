<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        //dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type' => ['required', 'in:student,teacher']
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
                'approved_status' => 'approved'
            ]);
            event(new Registered($user));

            Auth::login($user);

            return redirect(route('student.dashboard', false));
        } elseif ($request->type == 'teacher') {



            $request->validate([
                'document' => ['required', 'file', 'max:12000', 'mimes:png,jpg,pdf,docx,doc']
            ]);
            $filePath = $this->uploadFile($request->file('document'));

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'approved_status' => 'pending',
                'document' => $filePath
            ]);
            event(new Registered($user));

            Auth::login($user);
            return redirect(route('student.dashboard', false));
        } else {
            return abort(404);
        }
    }
}
