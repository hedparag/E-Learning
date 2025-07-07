@extends('Frontend.teacher-dashboard.courses.create')
@section('tab_content')
    <div class="tab-pane fade active show" id="home-09" role="tabpanel" aria-labelledby="home-09-tab">
        <form action="{{ $editMode == 0 ? route('teacher.course.basic-info') : route('teacher.course.basic-info-update') }}" method="POST" class="basic-info-submit course-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="current_step" value="1">
            <input type="hidden" name="editMode" value="{{ $editMode }}">
            <input type="hidden" name="courseId" value="{{ @$course?->id }}">
            <input type="hidden" name="next_step" value="2">
            <div class="form-row">
                <div class="form-group col-md-12 field1">
                    <label for="inputState">Choose Class</label>
                    <select id="inputState" class="form-control targetSubject {{ $editMode == 1 ? 'chooseClass':'' }}" name="target" @if ($editMode == 1) data-id="{{ $course->subject_id }}" @endif>
                        <option value="" selected disabled>Select</option>
                        @foreach ($classes as $class)
                           <option value="{{ $class->id }}" @selected($editMode == 1 && $class->id == $course->class_id)>
{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row holder">

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputEmail4">Title</label>

                    <input type="text" class="form-control" id="inputEmail4" name="title" value="{{ @$course?->title }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Description</label>
                    <textarea name="desc" class="form-control">{!! @$course?->desc !!}</textarea>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-12">
                   @if(isset($course))
                    <x-image-preview :src="asset(@$course?->thumbnail)"/>
                   @endif
                    <label for="inputAddress">Thumbnail</label>
                    <input type="file" class="form-control" id="inputAddress" name="thumbnail">
                </div>
            </div>



            <button type="submit" class="btn btn-primary">{{ $editMode == 1 ? 'Update' :'Create' }}</button>
        </form>
    </div>
@endsection
