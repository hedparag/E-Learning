@extends('Frontend.teacher-dashboard.courses.create')
@section('tab_content')
   <div class="tab-pane fade active show" id="contact-09" role="tabpanel" aria-labelledby="contact-09-tab">
        <form method="POST" class="course-update course-form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $course->id }}">
        <input type="hidden" name="editMode" value="{{ $editMode }}">
        <input type="hidden" name="current_step" value="4">
        <input type="hidden" name="next_step" value="5">

           <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Description</label>
                    <textarea name="reviewer" class="form-control">{!! $course->msg_for_reviewer !!}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputAddress2">Status</label>
                    <select id="inputState" class="form-control" name="status">
                        <option selected>Select Status</option>
                        <option value="draft" @selected($course->status == 'draft')>Draft</option>
                        <option value="active" @selected($course->status == 'active')>Active</option>
                        <option value="archived" @selected($course->status == 'archived')>Archived</option>

                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
