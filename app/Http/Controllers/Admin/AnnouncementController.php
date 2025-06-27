<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Traits\FileUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Announcement::where('is_active', 'true')->get();
        return view('Admin.announcement.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string', 'max:1000'],
            'docs' => ['nullable', 'image', 'max:3000'],
            'target' => ['required', 'in:all,student,class'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'status' => ['nullable', 'boolean'],
            'class' => ['nullable']

        ]);

        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->body = $request->desc;
        if ($request->has('docs')) {
            $path = $this->uploadFile($request->file('docs'));
            $announcement->attachment = $path;
        }

        $announcement->target_type = $request->target;
        if ($request->target == 'class') {
            $announcement->target_id = $request->class;
        }
        $announcement->is_active = $request->status ?? 0;
        $announcement->start_date = $request->start_date;
        $announcement->end_date = $request->end_date;

        if (Auth::guard('admin')->check()) {
            $announcement->creator_type = 'admin';
            $announcement->created_by_id = Auth::guard('admin')->id();
        } elseif (Auth::guard('web')->check() && Auth::guard('web')->user()->role == 'teacher') {
            $announcement->creator_type = 'teacher';
            $announcement->created_by_id = Auth::guard('web')->id();
        } else {
            return abort(401);
        }
        //$announcement->created_by_id=$request->title;
        $announcement->save();
        return redirect()->route('admin.announcement.index');
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
