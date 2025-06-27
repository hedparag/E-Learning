<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddSubject;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class SubjectAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data = StudentClass::with('subjects')->get();
        $subjects=AddSubject::where('is_active','true')->get();
        return view('Admin.subjectAssign.index',compact('data','subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $subjectsPerClass = $request->input('subjects', []);

    foreach ($subjectsPerClass as $classId => $subjectIds) {
        $class = StudentClass::find($classId);

        if ($class) {
            $class->subjects()->sync($subjectIds ?? []);
        }
    }

    return redirect()->back()->with('success', 'Subjects assigned successfully.');
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
