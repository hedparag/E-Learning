  <form action="{{ $editMode != 1 ? route('teacher.lesson.store') : route('teacher.lesson.update') }}" method="POST">
      @csrf
      <input type="hidden" name="course_id" value="{{ $courseId }}">
      <input type="hidden" name="chapter_id" value="{{ $chapterId }}">
      <input type="hidden" name="lesson_id" value="{{ @$lesson?->id }}">

      <div class="form-row">
          <div class="form-group col-md-12">
              <label for="inputEmail4">Title</label>
              <input type="text" class="form-control" id="inputEmail4" name="title" value="{{ @$lesson?->title }}">
          </div>
      </div>
      <div class="form-row">
          <div class="form-group col-md-12">
              <label for="inputPassword4">Description</label>
              <textarea name="desc" class="form-control">{!! @$lesson?->desc !!}</textarea>
          </div>
      </div>
      <div class="form-row">
          <div class="form-group col-md-6">
              <label for="inputAddress2">Demo Video Source</label>
              <select id="inputState" class="form-control storage" name="source">
                  <option selected>Select Source</option>
                  <option value="upload" @selected(@$lesson?->storage == 'upload')>Upload</option>
                  <option value="youtube" @selected(@$lesson?->storage == 'youtube')>Youtube</option>
                  <option value="vimeo" @selected(@$lesson?->storage == 'vimeo')>Vimeo</option>
                  <option value="external_links" @selected(@$lesson?->storage == 'external_links')>External Link</option>
              </select>
          </div>

              <div class="form-group col-md-6 upload_source">
                  <label for="#">Path</label>
                  <div class="input-group">
                      <span class="input-group-btn">
                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> Choose
                          </a>
                      </span>
                      <input id="thumbnail" class="form-control source" type="text" name="file"
                          value="{{ @$lesson?->path }}">
                  </div>

              </div>

              <div class="form-group col-md-6 external_source d-none">
                  <label for="inputAddress2">Path</label>
                  <input type="text"name="url" class="source form-control" value="{{ @$lesson?->path }}">

              </div>


      </div>
      <div class="form-row">
          <div class="form-group col-md-6">
              <label for="inputAddress2">File Type</label>
              <select id="inputState" class="form-control" name="type">
                  <option selected>--Select Type--</option>
                  <option value="audio" @selected(@$lesson?->file_type == 'audio')>Audio</option>
                  <option value="video" @selected(@$lesson?->file_type == 'video')>Video</option>
                  <option value="doc" @selected(@$lesson?->file_type == 'doc')>Docs</option>
                  <option value="file" @selected(@$lesson?->file_type == 'file')>File</option>
              </select>
          </div>
          <div class="form-group col-md-6">
              <label for="inputAddress2">Duration</label>
              <input type="text" name="duration" class="form-control" value="{{ @$lesson?->duration }}">

          </div>
      </div>
      <button type="submit" class="btn btn-primary">{{ $editMode == 1 ? 'Update' : 'Create' }}</button>
  </form>
