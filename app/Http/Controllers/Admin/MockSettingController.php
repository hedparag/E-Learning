<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MockSettings;
use Illuminate\Http\Request;

class MockSettingController extends Controller
{
    public function index()
    {
        $data=MockSettings::firstOrFail();
        return view('Admin.Mock.index',compact('data'));
    }
    public function store(Request $req)
    {
    //dd($req->all());
        $validatedData = $req->validate([
            'min_question' => ['required', 'integer','min:0'],
            'max_question' => ['required', 'integer','min:0'],
            'total_marks' => ['required', 'integer','min:0'],
            'duration' => ['required', 'integer','min:0'],
            'instructions' => ['required', 'string'],
            'question_type' => ['required', 'in:MCQ,True/False,Fill in the blanks']

        ]);
        MockSettings::updateOrCreate(
            [
                'id' => 1
            ],
            $validatedData
        );
        return redirect()->back();
    }
}
