@extends('Frontend.teacher-dashboard.courses.create')
@section('tab_content')
<div class="curriculam-cont">
    <div class="title d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Learn Basic JavaScript Lecture Started</h6>
        <button class="btn btn-success btn-sm AddChapter">
            <i class="fa fa-plus-circle"></i> Add Chapter
        </button>
    </div>

    <div class="accordion mt-3" id="accordionExample">

        <!-- CHAPTER 1 -->
        <div class="card mb-3">
            <div class="card-header" id="headingOne">
                <div class="d-flex justify-content-between align-items-start">
                    <a href="#" class="d-block text-decoration-none w-100" data-toggle="collapse"
                       data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-folder text-warning mr-2"></i>
                            <span class="lecture mr-2">Lecture 1.1:</span>
                            <span class="head font-weight-bold">What is JavaScript</span>
                        </div>
                    </a>
                    <div class="ml-3 mt-1 d-flex align-items-center" style="gap: 10px;">
                        <a href="#" class="text-info" title="Edit Chapter"><i class="fa fa-edit"></i></a>
                        <a href="#" class="text-success" title="Add Lesson"><i class="fa fa-plus-circle"></i></a>
                        <a href="#" class="text-danger" title="Delete Chapter"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <p>This lecture introduces JavaScript fundamentals.</p>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                            Lesson 1.1.1 - Introduction to Scripting
                            <span>
                                <a href="#" class="text-info mr-2" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                            Lesson 1.1.2 - Role of JavaScript in Web
                            <span>
                                <a href="#" class="text-info mr-2" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CHAPTER 2 -->
        <div class="card mb-3">
            <div class="card-header" id="headingTwo">
                <div class="d-flex justify-content-between align-items-start">
                    <a href="#" class="collapsed d-block text-decoration-none w-100" data-toggle="collapse"
                       data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-folder text-warning mr-2"></i>
                            <span class="lecture mr-2">Lecture 1.2:</span>
                            <span class="head font-weight-bold">JavaScript Syntax Basics</span>
                        </div>
                    </a>
                    <div class="ml-3 mt-1 d-flex align-items-center" style="gap: 10px;">
                        <a href="#" class="text-info" title="Edit Chapter"><i class="fa fa-edit"></i></a>
                        <a href="#" class="text-success" title="Add Lesson"><i class="fa fa-plus-circle"></i></a>
                        <a href="#" class="text-danger" title="Delete Chapter"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>

            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <p>This lecture covers syntax and basic operations.</p>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                            Lesson 1.2.1 - Declaring Variables
                            <span>
                                <a href="#" class="text-info mr-2" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                            Lesson 1.2.2 - Data Types
                            <span>
                                <a href="#" class="text-info mr-2" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
