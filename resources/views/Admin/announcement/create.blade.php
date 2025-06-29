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
                            <form
                                action="{{ @$edit == 1 ? route('admin.announcement.update', $data->id) : route('admin.announcement.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (@$edit == 1)
                                    @method('PUT')
                                @endif
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <div class="card-body">
                                        <input type="text" class="form-control"
                                            placeholder="e.g. Class X study materials are available" name="title"
                                            value="{{ @$data?->title }}">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <div class="card-body">
                                        <textarea class="form-control" rows="3" name="desc">{{ @$data?->body }}"</textarea>
                                    </div>

                                </div>
                                <div class="form-group">
                                    @if(@$edit == 1 )
                                    <x-image-preview src="{{ asset(@$data?->attachment) }}" />
                                        @endif
                                    <br>
                                    <label for="exampleInputEmail1">Attachment</label>
                                    <div class="card-body">
                                        <input type="file" name="docs" class="form-control">
                                    </div>

                                </div>


                                <div class="form-group col-md-6 field2">
                                    <label for="exampleInputEmail1">Start Date</label>
                                    <div class="card-body">
                                        <input type="date" name="start_date" class="form-control"
                                            value="{{ \Carbon\Carbon::parse(@$data->start_date)->format('Y-m-d') }}">
                                    </div>

                                </div>


                                <div class="form-row">

                                    <div class="form-group col-md-6 field1">
                                        <label for="inputState">Target Type</label>
                                        <select id="inputState" class="form-control target" name="target">
                                            <option selected="">Select</option>
                                            <option value="all" @selected(@$data?->target_type == 'all')>All</option>
                                            <option value="student" @selected(@$data?->target_type == 'student')>Student</option>
                                            <option value="class" @selected(@$data?->target_type == 'class')>Class</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 field2">
                                        <label for="exampleInputEmail1">End Date</label>
                                        <div class="card-body">
                                            <input type="date" name="end_date" class="form-control"
                                                value="{{ \Carbon\Carbon::parse(@$data->end_date)->format('Y-m-d') }}">
                                        </div>

                                    </div>

                                    <div class="row holder">
                                        @if (@$edit == 1 && @$data?->target_type == 'class')
                                            <div class="form-group col-md-12 mt-3">
                                                <label for="classSelect"><strong>Class</strong></label>
                                                <select id="classSelect" name="class" class="form-control form-control-lg"
                                                    style="min-height: 30px; font-size: 16px;">
                                                    <option value="">Select Class</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}"
                                                            {{ $data->target_id == $class->id ? 'selected' : '' }}>
                                                            {{ $class->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1"
                                        name="status" @checked(@$data?->is_active == 'true')>
                                    <label class="form-check-label" for="defaultCheck1">
                                        Active ?
                                    </label>
                                </div>
                                <button type="submit"
                                    class="btn btn-primary">{{ @$edit == 1 ? 'Update' : 'Add' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
