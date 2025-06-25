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
                            <h1>All classes</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                           <a href="{{ route('admin.class.create') }}" class="btn btn-outline-primary">Add Class</a>
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
                                            <th>Class Name</th>
                                            <th>Action</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data ?? [] as $d)
                                            <tr>
                                                <td>{{ $d?->name }}</td>
                                                <td>
                                                    <div class="icon-wrap col-sm-6 col-md-4 col-xl-2"><i
                                                            class="fa fa-remove"></i></div>
                                                </td>




                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan='6'>No data found</td>
                                            </tr>
                                        @endforelse


                                    </tbody>

                                </table>
                                {{ $data->links() }}
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
