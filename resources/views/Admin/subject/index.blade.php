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
                            <h1>All Subjects</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                           <a href="{{ route('admin.subject.create') }}" class="btn btn-primary">Add Subject</a>
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
                                            <th>Subject Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data ?? [] as $d)
                                            <tr>
                                                <td>{{ $d?->name }}</td>
                                                <td>{!! $d?->description !!}</td>
                                                 <td>
                                                    @if ($d?->is_active =='true')

                                                    <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-success">Active</span>

                                                    @else
                                                       <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-danger">Inactive</span>

                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="row">
                                                       <div class="col"> <a href="{{ route('admin.subject.edit',$d?->id) }}"><i class="fa fa-edit"></i></a></div>
                                                   <div class="col"><a id="delete-item"  data-id="{{ $d?->id }}" href="{{ route('admin.subject.destroy',$d?->id) }}"> <div class="icon-wrap col-sm-6 col-md-4 col-xl-2"><i
                                                            class="fa fa-remove"></i></div></a></div>
                                                  <div class="col"> <a href="{{ route('admin.category',$d->id) }}"><i class="fa fa-bars"></i></a></div>
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
