@extends('Admin.layouts.Master')
@section('content')
    <div class="app-main" id="main">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <div class="card-heading">
                                <h4 class="card-title">Basic rules for Mock Test</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.mock.store') }}" method="POST">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="total_questions">Minimum Questions</label>
                                        <input type="number" name="min_question" class="form-control" value="{{ $data?->min_question }}" required>
                                    </div>
                                     <div class="form-group col-md-3">
                                        <label for="total_questions">Maximum Questions</label>
                                        <input type="number" name="max_question" class="form-control" value="{{ $data?->max_question }}" required>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="total_marks">Total Marks</label>
                                        <input type="number" name="total_marks" class="form-control" value="{{ $data?->total_marks }}" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="duration_minutes">Duration (in minutes)</label>
                                    <input type="number" name="duration" class="form-control" value="{{ $data?->duration }}" required>
                                </div>



                                <div class="form-group">
                                    <label for="question_type">Allowed Question Type</label><br>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="typeMCQ" name="question_type"
                                            value="MCQ" @checked($data?->question_type =="MCQ" ) required>
                                        <label class="form-check-label" for="typeMCQ">MCQ</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="typeTF" name="question_type"
                                            value="True/False" @checked($data?->question_type =="True/False" )>
                                        <label class="form-check-label" for="typeTF">True/False</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="typeFIB" name="question_type"
                                            value="Fill in the Blanks" @checked($data?->question_type =="Fill in the Blanks" )>
                                        <label class="form-check-label" for="typeFIB">Fill in the Blanks</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="instruction">Instructions</label>
                                    <textarea id="summernote" class="summernote form-control" name="instructions">{!! $data?->instructions !!}</textarea>
                                </div>


                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
