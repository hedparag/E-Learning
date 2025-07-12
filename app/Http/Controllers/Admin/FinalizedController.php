<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinalStudent;
use App\Models\MockTest;
use App\Models\MockTestAttempt;
use App\Models\ReportCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class FinalizedController extends Controller
{
    public function index()
    {
        $data = MockTestAttempt::all();
        //previous
        //$test = User::with(['test', 'finalStudent'])->get();
        // dd($test);
        // dd($test);
        $test = User::has('test')
            ->with(['test', 'finalStudent'])
            ->get();

        return view('Admin.marks.index', compact('data', 'test'));
    }
    public function getDetailedResult(Request $request): string
    {
        $id = $request->id;
        $student = $id;
        //dd($id);
        $u = User::where('id', $id)->first();
        $classId = $u->hasClass->id;
        // dd($classId);
        $total = MockTest::where('class_id', $classId)->count();
        $data = MockTestAttempt::where('student_id', $id)->get();

        $finalize = $u->finalStudent?->is_finalized ?? false;
        $given = $data->pluck('mock_test_id')->unique()->count();

        //$given = "2";
        return view('Admin.marks.detailedMarks', compact('data', 'total', 'given', 'student', 'classId', 'finalize'))->render();
    }
    public function report(Request $request): Response
    {
        $final = new FinalStudent();
        $final->class_id = $request->classId;
        $final->student_id = $request->student;
        $final->is_finalized = true;
        $final->save();
        return response(['success' => 'Student marks has been finalized'], 200);
    }
    public function generateReport(Request $req): string
    {
        $student = $req->student;
        $class = $req->classId;

        $data = MockTestAttempt::where('student_id', $student)->get();
        $details = User::findOrFail($student);

        $failedCount = 0;
        $totalObtained = 0;
        $totalFullMarks = 0;

        // Clean existing records
        ReportCard::where('student_id', $student)->where('class_id', $class)->delete();

        $subjectRecords = [];

        foreach ($data as $d) {
            $percentage = round(($d->score / $d->total_marks) * 100);
            $grade = match (true) {
                $percentage >= 90 => 'A+',
                $percentage >= 80 => 'A',
                $percentage >= 70 => 'B',
                $percentage >= 60 => 'C',
                $percentage >= 50 => 'D',
                default => 'F',
            };

            if ($grade === 'F') {
                $failedCount++;
            }

            $totalObtained += $d->score;
            $totalFullMarks += $d->total_marks;

            $subjectRecords[] = [
                'student_id'     => $student,
                'class_id'       => $class,
                'name'           => $details->name,
                'roll_number'    => $details->id,
                'subject'        => $d->mockTest->subject->id,
                'total_marks'    => $d->total_marks,
                'obtained_marks' => $d->score,
                'percentage'     => $percentage,
                'grade'          => $grade,
                'overall_grade'  => '-',
                'result_status'  => '-',
                'issued_at'      => now(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        // Final evaluation
        $overallPercentage = $totalFullMarks > 0 ? round(($totalObtained / $totalFullMarks) * 100) : 0;
        $overallGrade = match (true) {
            $overallPercentage >= 90 => 'A+',
            $overallPercentage >= 80 => 'A',
            $overallPercentage >= 70 => 'B',
            $overallPercentage >= 60 => 'C',
            $overallPercentage >= 50 => 'D',
            default => 'F',
        };
        $overallResultStatus = $failedCount == 0 ? 'Pass' : 'Fail';

        // Insert all with final values
        foreach ($subjectRecords as &$record) {
            $record['overall_grade'] = $overallGrade;
            $record['result_status'] = $overallResultStatus;
        }

        ReportCard::insert($subjectRecords); // Bulk insert

        // Pass saved data to view
        $data = ReportCard::where('student_id', $student)
            ->where('class_id', $class)
            ->get();

        //deleteing data from mocktest_attempts and is_finalized
        MockTestAttempt::where('student_id', $student)->delete();
        FinalStudent::where('student_id', $student)
            ->where('class_id', $class)
            ->delete();


        return view('Admin.marks.reportCardModal', compact('data', 'details'))->render();
    }

    public function reportView(Request $request)
    {
        $path = public_path('default-files/26798875_15266.jpg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $signaturePath = public_path('default-files/signAdmin.png');
        $signatureType = pathinfo($signaturePath, PATHINFO_EXTENSION);
        $signatureData = file_get_contents($signaturePath);
        $signatureBase64 = 'data:image/' . $signatureType . ';base64,' . base64_encode($signatureData);

        $student = $request->id;
        $class = $request->class;
        $details = User::findOrFail($student);
        //dd($req->all());
        //$data = MockTestAttempt::where('student_id', $student)->get();
        //$details = User::findOrFail($student);
        /* foreach($data as $d){
        $d->mockTest->subject->
    }*/
        //return view('Admin.marks.reportCard', compact('data', 'details'))->render();
        $data = ReportCard::where('student_id', $student)
            ->where('class_id', $class)
            ->get();
        $pdf = Pdf::loadView('Admin.marks.reportCard', compact('data', 'base64', 'signatureBase64', 'details'))
            ->setPaper('a4', 'portrait');
        return $pdf->download('result.pdf');
    }
}
