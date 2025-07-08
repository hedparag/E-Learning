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
                            <h1>All Courses</h1>
                        </div>
                    </div>
                    <!-- end page title -->
                </div>
            </div>
            <!-- end row -->
            <!-- begin row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <div class="datatable-wrapper table-responsive">
                                <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
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
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data ?? [] as $d)
                                            <tr>
                                                <td>{{ $d?->title }}</td>
                                                <td>{{ $d?->teacher->name }}</td>
                                               <td>{{ $d?->subject->name }}</td>
                                               <td>{{ $d?->class->name }}</td>
                                               <td>{{ $d?->chapters()->count() }}</td>
                                               <td>{{ $d?->totalLessons()->count() }}</td>
                                               <td>
    <!-- Preview Button -->
    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal{{ $d->id }}">
        Preview
    </button>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Course Preview - {{ $d->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0" style="height: 600px;">
                    <iframe src="{{ route('admin.course.preview', $d->id) }}"
                        width="100%" height="100%" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</td>

                                                 <td>
                                                    @if ($d?->is_approved =='pending')

                                                    <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-warning">Pending</span>
                                                    @elseif ($d?->is_approved =='approved')
                                                    <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-success">Approved</span>

                                                    @else
                                                       <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-danger">Rejected</span>

                                                    @endif
                                                </td>

                                                <td>
                                                    <form action="{{ route('admin.approveSubmit',$d?->id) }}" method="POST" class="statusFormSubmit-{{ $d?->id }}">
                                                        @csrf
                                                    <select name="status" id="" onchange="$('.statusFormSubmit-{{ $d?->id }}').trigger('submit')">
                                                        <option value="">--Select--</option>
                                                        <option value="approved">Approved</option>
                                                        <option value="rejected">Rejected</option>
                                                    </select>
                                                    </form>
                                                </td>




                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan='6'>No data found</td>
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
