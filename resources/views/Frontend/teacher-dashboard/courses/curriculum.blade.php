@extends('Frontend.teacher-dashboard.courses.create')
@section('tab_content')
<form action="" method="POST" class="course-form course-update">
    @csrf
    <input type="hidden" name="id" value="{{ $course->id }}">
    <input type="hidden" name="current_step" value="3">
    <input type="hidden" name="next_step" value="4">

</form>
    <div class="curriculam-cont">
        <div class="title d-flex justify-content-between align-items-center">
            <h6 class="mb-0">{{ $course->title }}</h6>
            <button class="btn btn-primary customModal" data-toggle="modal" data-target="#loginModal"
                data-course-id="{{ $course->id }}"> <i class="fa fa-plus-circle"></i> Add Chapter</button>
            <!-- <button class="btn btn-success btn-sm AddChapter">
                    <i class="fa fa-plus-circle"></i> Add Chapter
                </button>-->
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title ModalTitle">Create Chapter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ModelBody">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion mt-3" id="accordionExample">
            @foreach ($course->chapters as $chapter)
                <!-- CHAPTER 1 -->
                <div class="card mb-3">
                    <div class="card-header" id="headingOne">
                        <div class="d-flex justify-content-between align-items-start">
                            <a href="#" class="d-block text-decoration-none w-100" data-toggle="collapse"
                                data-target="#collapse-{{ $chapter->id }}" aria-expanded="true"
                                aria-controls="collapseOne">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-folder text-warning mr-2"></i>
                                    <span class="lecture mr-2">Chapter -{{ $chapter->order }}</span>
                                    <span class="head font-weight-bold">{{ $chapter->title }}</span>
                                </div>
                            </a>
                            <div class="ml-3 mt-1 d-flex align-items-center" style="gap: 10px;">
                                <a href="#" class="text-info ChapterEditModal" title="Edit Chapter" data-toggle="modal" data-target="#loginModal" data-chapter-id="{{ $chapter->id }}" data-course-id="{{ $course->id }}" data-edit-id="1"><i class="fa fa-edit"></i></a>
                                <a href="#" class="text-success customLessonModal" title="Add Lesson"
                                    data-toggle="modal" data-target="#loginModal" data-course-id="{{ $course->id }}"
                                    data-chapter-id="{{ $chapter->id }}"><i class="fa fa-plus-circle"></i></a>
                                <a href="{{ route('teacher.chapter.destroy',$chapter->id) }}" class="text-danger delete-item" title="Delete Chapter" data-id="{{ $chapter->id }}"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>

                    <div id="collapse-{{ $chapter->id }}" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">

                            <ul class="list-group">
                                @foreach ($chapter->lessons as $lesson)
                                    <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                                        Lesson {{ $chapter->order }}.{{ $lesson->order }} - {{ $lesson->title }}
                                        <span>
                                            <a href="#" class="text-info mr-2 lessonEditModal" title="Edit"
                                    data-toggle="modal" data-target="#loginModal" data-course-id="{{ $course->id }}"
                                    data-chapter-id="{{ $chapter->id }}" data-lesson-id="{{ $lesson->id }}" data-edit-id="1"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="{{ route('teacher.lesson.destroy',$lesson->id) }}" class="text-danger delete-item" title="Delete" data-id="{{ $lesson->id }}"><i
                                                    class="fa fa-trash"></i></a>
                                        </span>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>
    </div>
@endsection
