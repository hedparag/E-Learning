@extends('Frontend.teacher-dashboard.courses.create')
@section('tab_content')
    <div class="tab-pane fade active show" id="profile-09" role="tabpanel" aria-labelledby="profile-09-tab">
        <form method="POST" class="course-update" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        <input type="hidden" name="current_step" value="2">
        <input type="hidden" name="next_step" value="3">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputAddress2">Demo Video Source</label>
                    <select id="inputState" class="form-control storage" name="source">
                        <option selected>Select Source</option>
                        <option value="upload">Upload</option>
                        <option value="youtube">Youtube</option>
                        <option value="vimeo">Vimeo</option>
                        <option value="external_link">External Link</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <div class="form-group col-md-12 upload_source">
                        <label for="#">Path</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control source" type="text" name="file">
                        </div>

                    </div>
                    <div class="form-group col-md-12 external_source d-none">
                        <label for="inputAddress2">Path</label>
                        <input type="text"name="url" class="source form-control">

                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAddress">Capacity</label>
                    <input type="text" class="form-control" id="inputAddress" name="capacity"
                        placeholder="enter capacity..">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Duration</label>
                    <input type="text" class="form-control" id="inputAddress" name="duration">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="qna" value="1">
                        <label class="form-check-label" for="gridCheck">
                            QNA
                        </label>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
