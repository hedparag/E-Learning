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
                                <h4 class="card-title">Add Subject</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.subject.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject Name</label>
                                    <div class="card-body">
                                        <input type="text" class="form-control" placeholder="e.g. Math" name="subject">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <div class="card-body">
                                        <textarea class="form-control" rows="3" name="desc"></textarea>
                                    </div>

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="status">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Active
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
