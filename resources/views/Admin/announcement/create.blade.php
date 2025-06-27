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
                                <h4 class="card-title">Add Announcement</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.announcement.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <div class="card-body">
                                        <input type="text" class="form-control" placeholder="e.g. Math" name="title">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <div class="card-body">
                                        <textarea class="form-control" rows="3" name="desc"></textarea>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Attachment</label>
                                    <div class="card-body">
                                        <input type="file" name="docs" class="form-control">
                                    </div>

                                </div>


 <div class="form-group col-md-6 field2">
                                        <label for="exampleInputEmail1">Start Date</label>
                                        <div class="card-body">
                                            <input type="date" name="start_date" class="form-control">
                                        </div>

                                    </div>


                                <div class="form-row">

                                    <div class="form-group col-md-6 field1">
                                        <label for="inputState">Target Type</label>
                                        <select id="inputState" class="form-control target" name="target">
                                            <option selected="">Select</option>
                                            <option value="all">All</option>
                                            <option value="student">Student</option>
                                            <option value="class">Class</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 field2">
                                        <label for="exampleInputEmail1">End Date</label>
                                        <div class="card-body">
                                            <input type="date" name="end_date" class="form-control">
                                        </div>

                                    </div>
                                    <div class="holder"></div>
                                </div>
                                 <div class="form-check col-md-4">
                                        <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1"
                                            name="status">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Active ?
                                        </label>
                                    </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
