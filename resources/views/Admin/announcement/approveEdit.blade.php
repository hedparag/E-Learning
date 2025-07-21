@extends('Admin.layouts.Master')
@section('content')
    <div class="app-main" id="main">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin row -->
            <div class="row">
                <div class="card-title">
                    <h2>Teacher Announcement</h2>
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
                                            <th>Active</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data ?? [] as $d)
                                            <tr>
                                                <td>{{ $d?->title }}</td>
                                                <td>{!! $d?->body !!}</td>
                                                @if ($d?->attachment)
                                                    <td><img src="{{ asset($d?->attachment) }}" alt=""
                                                            style="height:60px;width:100px;"></td>
                                                @endif
                                                <td>
                                                    @if ($d->target_type == 'student')
                                                  {{ $d->target_type}}
                                                  @else
                                                  {{ $d->class->name }}

                                                    @endif
                                                </td>
                                                <td>{{ $d?->start_date }}</td>
                                                <td>{{ $d?->end_date }}</td>
                                                <td class="text-center align-middle">
                                                    <form action="{{ route('admin.announcementApprove', $d?->id) }}" method="POST">
                                                        @csrf
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            id="defaultCheck1" name="status" onclick="$(this).closest('form').trigger('submit');">

                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan='7'class="text-center">No data found</td>
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
