@extends('Admin.layouts.Master')
@section('content')
    <div class="app-main" id="main">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin row -->
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <!-- begin page title -->
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h1>All Tests Submission</h1>
                        </div>

                    </div>
                    <!-- end page title -->
                </div>
            </div>
            <!-- end row -->
            <!-- begin row -->
            <div class="row">
                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title resultTitle">Detailed Result</h5>
                                        <button type="button" class="close cross" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body resultBody">

                                    </div>

                                </div>
                            </div>
                        </div>
                <div class="col-lg-12">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <div class="datatable-wrapper table-responsive">
                                <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Exams submitted</th>
                                            <th>Total Score</th>
                                            <th>Total Marks</th>
                                            <th>Tests given</th>
                                            <th>Evaluate</th>
                                            <th>Last Submitted</th>
                                            <th>Report Card generated</th>

                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($test as $d)
                                            @if ($d->test->count() != 0)
                                            @php
                                                $class=$d->hasClass->id;
                                                $name=\App\Models\StudentClass::findOrFail($class);
                                                //$total=$name->subjects()->count();
                                                $total=\App\Models\MockTest::where('class_id',$class)->count();
                                                $given = $d->test->pluck('mock_test_id')->unique()->count();
                                                //$given ="2";


                                            @endphp
                                                <tr>
                                                    <td>{{ $d?->name }}</td>
                                                    <td>{{ $d?->hasClass->name }}</td>
                                                    <td>{{ $d->test()->count() }}</td>
                                                    <td>{{ $d->test()->sum('score') }}</td>
                                                    <td>{{ $d->test()->sum('total_marks') }}</td>
                                                    <td>{{ $given }}/{{ $total }}</td>
                                                    <td>
                                                        @if($given < $total)
                                                        <button class="btn btn-round btn-info" disabled>Evaluate</button>
                                                        @else
                                                        <a href="{{route('admin.resultDetails',$d?->id)}}"
                                                                class="btn btn-round btn-success resultModal" data-toggle="modal" data-target="#largeModal" data-id="{{ $d?->id }}">
                                                                Evaluate
                                                            </a>
                                                            @endif

                                                    </td>
                                                    <td>
                                                        {{ $d?->test()->max('attempt_date') }}
                                                    </td>
                                                    <td>
                                                        @if($d?->finalStudent?->is_finalized ?? false)
                                                        <a href="{{ route('admin.reportView',['id'=>$d?->id,'class'=>$d?->student_classes_id]) }}"
                                                                class="btn btn-success btn-sm">
                                                                Download Result
                                                            </a>
                                                            @else
                                                             <button class="btn btn-secondary btn-sm" disabled>
                                                                View Result
                                                            </button>
                                                            @endif

                                                    </td>




                                                </tr>
                                            @endif
                                        @empty
                                            <tr class="text-center">
                                                <td colspan='9'>No data found</td>
                                            </tr>
                                        @endforelse


                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
@endsection
