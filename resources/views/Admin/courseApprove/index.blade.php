@extends('Admin.layouts.Master')

@section('content')
<div class="app-main" id="main">
    <div class="container-fluid">
        <!-- Class Selector -->
        <div class="form-group col-md-4 mb-4">
            @if(!empty($classes))
                <label for="inputState" class="form-label fw-bold"> Select Class</label>
                <select name="class" id="inputState" class="form-control classList shadow-sm border-primary">
                    <option value="">-- Choose a class --</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            @endif
        </div>

        <!-- Filtered Courses -->
        <div class="container-fluid myContainer d-none">
            <div class="row mb-3">
                <div class="col-12">
                    <h2 class="text-primary fw-bold">
                      Filtered Courses by Class
                    </h2>
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Title</th>
                                            <th>Teacher</th>
                                            <th>Category</th>
                                            <th>Class</th>
                                            <th>Total Chapters</th>
                                            <th>Total Lessons</th>
                                            <th>Course Preview</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tableBody">
                                        {{-- Data will be injected here dynamically --}}
                                    </tbody>
                                </table>
                                <div class="text-center d-none loaderSpinner">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-2">Fetching courses...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
