 <div class="col-12 col-lg-6">
     <div class="card card-statistics">
         <div class="card-header">
             <div class="card-heading">
                 <h4 class="card-title">Accordion Border Radius</h4>
             </div>
         </div>
         <div class="card-body">
             <div class="accordion" id="accordionborderradius">
                 @foreach ($course->chapters as $chapter)
                     <div class="mb-2 acd-group">
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
                                     <a href="#" class="text-info ChapterEditModal" title="Edit Chapter"
                                         data-toggle="modal" data-target="#loginModal"
                                         data-chapter-id="{{ $chapter->id }}" data-course-id="{{ $course->id }}"
                                         data-edit-id="1"><i class="fa fa-edit"></i></a>
                                     <a href="#" class="text-success customLessonModal" title="Add Lesson"
                                         data-toggle="modal" data-target="#loginModal"
                                         data-course-id="{{ $course->id }}" data-chapter-id="{{ $chapter->id }}"><i
                                             class="fa fa-plus-circle"></i></a>
                                     <a href="{{ route('teacher.chapter.destroy', $chapter->id) }}"
                                         class="text-danger delete-item" title="Delete Chapter"
                                         data-id="{{ $chapter->id }}"><i class="fa fa-trash"></i></a>
                                 </div>
                             </div>
                         </div>
                         <div id="collapse-{{ $chapter->id }}" aria-labelledby="headingOne" class="collapse show"
                             data-parent="#accordionborderradius">
                             <div class="card-body">

                                 <ul class="list-group">
                                     @foreach ($chapter->lessons as $lesson)
                                         <li
                                             class="list-group-item d-flex justify-content-between align-items-center mb-2">
                                             Lesson {{ $chapter->order }}.{{ $lesson->order }} - {{ $lesson->title }}
                                             <span>
                                                 <a href="#" class="text-info mr-2 lessonEditModal" title="Edit"
                                                     data-toggle="modal" data-target="#loginModal"
                                                     data-course-id="{{ $course->id }}"
                                                     data-chapter-id="{{ $chapter->id }}"
                                                     data-lesson-id="{{ $lesson->id }}" data-edit-id="1"><i
                                                         class="fa fa-edit"></i></a>
                                                 <a href="{{ route('teacher.lesson.destroy', $lesson->id) }}"
                                                     class="text-danger delete-item" title="Delete"
                                                     data-id="{{ $lesson->id }}"><i class="fa fa-trash"></i></a>
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
 </div>





{{-- actual accordian code --}}

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
