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
                            <h1>All Announcements</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <div><a href="{{ route('admin.announcement.approveEdit') }}" class="btn btn-primary">Approve Announcement</a></div>
                        </div>

                        <div class="ml-auto d-flex align-items-center">

                           <div><a href="{{ route('admin.announcement.create') }}" class="btn btn-primary">Post Announcement</a></div>
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
                                            <th>Description</th>
                                            <th>Attachment</th>
                                            <th>Target Type</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data ?? [] as $d)
                                            <tr>
                                                <td>{{ $d?->title }}</td>
                                                <td>{!! $d?->body !!}</td>
                                                @if($d?->attachment)
                                                <td><img src="{{ asset($d?->attachment) }}" alt="" style="height:60px;width:100px;"></td>
                                                @endif
                                                <td><select name="" id="">
                                                    <option value="" @selected($d?->target_type == 'all')>All</option>
                                                     <option value="" @selected($d?->target_type == 'student')>Student</option>
                                                      <option value="" @selected($d?->target_type == 'class')>Class</option>
                                                </select></td>
                                               <td>{{ $d?->start_date }}</td>
                                               <td>{{ $d?->end_date }}</td>
                                                 <td>
                                                    @if ($d?->is_active =='true')

                                                    <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-success">Active</span>

                                                    @else
                                                       <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-danger">Inactive</span>

                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="row">
                                                       <div class="col"> <a href="{{ route('admin.announcement.edit',$d?->id) }}"><i class="fa fa-edit"></i></a></div>
                                                   <div class="col"><a id="delete-item"  data-id="{{ $d?->id }}" href="{{ route('admin.announcement.destroy',$d?->id) }}"> <div class="icon-wrap col-sm-6 col-md-4 col-xl-2"><i
                                                            class="fa fa-remove"></i></div></a></div>

                                                    </div>
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
