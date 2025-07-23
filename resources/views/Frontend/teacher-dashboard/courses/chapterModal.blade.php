 <form action="{{ @$editMode !=1 ? route('teacher.chapter.store') :route('teacher.chapter.update') }}" method="POST">
     @csrf

     <input type="hidden" name="course_id" value="{{ @$id ?? '' }}">
<input type="hidden" name="chapter_id" value="{{ @$chapter?->id }}">

     <div class="form-row">
         <div class="form-group col-md-12">
             <label for="inputEmail4">Chapter Title</label>
             <input type="text" class="form-control" id="inputEmail4" name="title" value="{{ @$chapter?->title }}">
         </div>
     </div>
     <div class="form-row">
         <div class="form-group col-md-6">
             <label for="inputPassword4">Description</label>
             <textarea name="desc" class="form-control">{!! @$chapter?->desc !!}</textarea>
         </div>
         <div class="form-group col-md-6">
             <label for="inputPassword4">Duration</label>
             <input type="text" class="form-control" id="inputEmail4" name="duration" value="{{ @$chapter?->duration }}">
         </div>
     </div>
     <button type="submit" class="btn btn-primary">{{ $editMode != 1 ? 'Create' : 'Update' }}</button>
 </form>
