<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddSubject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AddSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AddSubject::all();
        return view('Admin.subject.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'subject' => ['required', 'string'],
            'status' => ['nullable', 'boolean'],
            'desc' => ['nullable', 'string', 'max:1000'],

        ]);
        $sub = new AddSubject();
        $sub->name = $request->subject;
        $sub->description = $request->desc;
        $sub->slug = \Str::slug($request->subject);
        $sub->is_active = $request->status ?? 'false';
        $sub->save();
        return redirect()->route('admin.subject.index');
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
         $data = AddSubject::findOrFail($id);
         return view('Admin.subject.update',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $request->validate([
            'subject' => ['required', 'string'],
            'status' => ['nullable', 'boolean'],
            'desc' => ['nullable', 'string', 'max:1000'],

        ]);
        $sub = AddSubject::findOrFail($id);
        $sub->name = $request->subject;
        $sub->description = $request->desc;
        $sub->slug = \Str::slug($request->subject);
        $sub->is_active = $request->status ?? 'false';
        $sub->save();
        return redirect()->route('admin.subject.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function categoryView(string $id){
        $data=AddSubject::findOrFail($id);
        return view('Admin.subject.child',compact('data'));
    }
    public function category(Request $request,string $id){
        $request->validate([
            'subject' => ['required', 'string'],
            'status' => ['nullable', 'boolean'],
            'desc' => ['nullable', 'string', 'max:1000'],

        ]);
        $sub = new AddSubject();
        $sub->name = $request->subject;
        $sub->description = $request->desc;
        $sub->slug = \Str::slug($request->subject);
        $sub->parent_id=$id;
        $sub->is_active = $request->status ?? 'false';

        $sub->save();
        return redirect()->route('admin.subject.index');

    }
}
