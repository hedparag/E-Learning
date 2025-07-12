<div class="row">
    <div class="col-md-12">


        <div class="table-responsive">
            <table class="table table-primary mb-0">
                <thead>
                    <tr>
                        <th scope="col">Course Name</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Teacher Name</th>
                        <th scope="col">Total Marks</th>
                        <th scope="col">Obtained Marks</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($data as $d)
                        <tr>
                            <td>{{ $d->mockTest->course->title }}</td>
                            <td>{{ $d->mockTest->subject->name }}</td>
                            <td>{{ $d->mockTest->teacher->name }}</td>
                            <td>{{ $d->total_marks }}</td>
                            <td>{{ $d->score }}</td>
                        </tr>
                    @empty
                        <tr>No record found</tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-5">
            @if ($finalize)
                <a href="{{ route('admin.generateReportCard') }}" data-id="{{ $student }}"
                    data-classid="{{ $classId }}" class="btn btn-success ReportButton"> Generate Report
                    Card</a>
            @else
                <button type="button" data-id="{{ $student }}" data-classid="{{ $classId }}"
                    class="btn btn-success resultButton" {{ $total > $given ? 'disabled' : '' }}>
                    Finalize
                </button>

                <a href="{{ route('admin.generateReportCard') }}" data-id="{{ $student }}"
                    data-classid="{{ $classId }}" class="btn btn-success ReportButton d-none"> Generate Report
                    Card</a>
            @endif

        </div>



    </div>
</div>
