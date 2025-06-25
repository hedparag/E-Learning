<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class addClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=StudentClass::paginate(5);
        return view('Admin.studentClass.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('Admin.studentClass.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            'class'=>['required','unique:student_classes,name']
        ]);
        $class=new StudentClass();
        $class->name=$request->class;
        $class->save();
        return redirect()->route('admin.class.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
