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
                            <form action="{{ route('admin.subject.update',$data->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject Name</label>
                                    <div class="card-body">
                                        <input type="text" class="form-control" placeholder="e.g. Math" name="subject" value="{{ $data->name }}">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <div class="card-body">
                                        <textarea class="form-control" rows="3" name="desc">{!! $data->description !!}</textarea>
                                    </div>

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="status" @checked($data->is_active =='true')>
                                    <label class="form-check-label" for="defaultCheck1">
                                        Active
                                    </label>
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
