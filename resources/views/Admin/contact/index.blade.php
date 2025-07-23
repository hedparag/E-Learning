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
                            <h1>All Messages</h1>
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
                                            <th>Phone</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Reply</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data ?? [] as $d)
                                            <tr>
                                                <td>{{ $d?->name }}</td>
                                                <td>{!! $d?->email !!}</td>
                                                <td>{{ $d?->phone }}</td>
                                                <td>{{ $d?->subject }}</td>
                                                <td>{{ $d?->message }}</td>
                                                <td>
                                                    <form action="{{ route('admin.contactMail', $d?->id) }}" class="contactSubmit">
                                                        @csrf
                                                        <input type="text" name="reply">
                                                        {{-- onclick="$(this).closest('form').submit();" --}}
                                                        <button type="submit" class="btn btn-primary btn-sm replyBtn"
                                                            >Send</button>
                                                    </form>
                                                </td>






                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan='5'>No data found</td>
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
