@extends('Frontend.teacher-dashboard.courses.create')
@section('tab_content')
    <form action="" method="POST" class="course-form course-update">
        @csrf
        <input type="hidden" name="id" value="{{ $course->id }}">
        <input type="hidden" name="editMode" value="{{ $editMode }}">
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

        <div class="card-body">
            <div class="accordion" id="accordionborderradius">
                @foreach ($course->chapters as $index => $chapter)
                    <div class="mb-2 acd-group">
                        <div class="card-header border-radius-10 border d-flex justify-content-between align-items-center"
                            style="background-color: #d1c4e9; color: #4a148c;">
                            <button
                                class="btn btn-link btn-block text-left acd-heading {{ $index !== 0 ? 'collapsed' : '' }}"
                                type="button" style="color: #4a148c;" data-toggle="collapse"
                                data-target="#collapse4-{{ $chapter->id }}"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-controls="collapse4-{{ $chapter->id }}">
                                {{ $index + 1 }}. {{ $chapter->title }}
                            </button>

                            <span class="ml-2 d-flex align-items-center" style="gap: 10px;">
                                <a href="#" class="text-dark ChapterEditModal" title="Edit Chapter"
                                    data-toggle="modal" data-target="#loginModal" data-chapter-id="{{ $chapter->id }}"
                                    data-course-id="{{ $course->id }}" data-edit-id="1"><i class="fa fa-edit"></i></a>

                                <a href="#" class="text-dark customLessonModal" title="Add Lesson" data-toggle="modal"
                                    data-target="#loginModal" data-course-id="{{ $course->id }}"
                                    data-chapter-id="{{ $chapter->id }}">
                                    <i class="fa fa-plus-circle"></i>
                                </a>

                                <a href="{{ route('teacher.chapter.destroy', $chapter->id) }}"
                                    class="text-dark delete-item" title="Delete Chapter" data-id="{{ $chapter->id }}"><i
                                        class="fa fa-trash"></i></a>
                            </span>
                        </div>

                        <div id="collapse4-{{ $chapter->id }}" class="collapse {{ $index === 0 ? 'show' : '' }}"
                            aria-labelledby="heading4-{{ $chapter->id }}" data-parent="#accordionborderradius">
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($chapter->lessons as $lesson)
                                        <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                                            Lesson {{ $chapter->order }}.{{ $lesson->order }} - {{ $lesson->title }}
                                            <span>
                                                <a href="#" class="text-info mr-2 lessonEditModal" title="Edit"
                                                    data-toggle="modal" data-target="#loginModal"
                                                    data-course-id="{{ $course->id }}"
                                                    data-chapter-id="{{ $chapter->id }}"
                                                    data-lesson-id="{{ $lesson->id }}" data-edit-id="1">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('teacher.lesson.destroy', $lesson->id) }}"
                                                    class="text-danger delete-item" title="Delete"
                                                    data-id="{{ $lesson->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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





    </div>

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('file');
    </script>
@endsection
