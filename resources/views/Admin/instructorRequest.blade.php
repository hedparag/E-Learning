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
                            <h1>Instructor Requests</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="index.html"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Tables
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Instructor Requests</li>
                                </ol>
                            </nav>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Document</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $d)
                                            <tr>
                                                <td>{{ $d->name }}</td>
                                                <td>
                                                    {{ $d->email }}
                                                </td>



                                                <td>
                                                    <a href="{{ route('admin.document-download', $d->id) }}">
                                                        <div class="icon-wrap col-sm-6 col-md-4 col-xl-2"><i
                                                                class="ti ti-arrow-down"></i><code>Download</code>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($d->approved_status == 'pending')

                                                    <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-warning">Pending</span>

                                                    @elseif($d->approved_status == 'approved')
                                                       <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-success">Approved</span>
                                                    @else
                                                       <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.request-update', $d->id) }}"
                                                        method="POST" class="status-{{ $d->id }}">
                                                        @csrf
                                                        <select name="status"
                                                            onchange="$('.status-{{ $d->id }}').submit();">
                                                            <option value="">--select--</option>
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
