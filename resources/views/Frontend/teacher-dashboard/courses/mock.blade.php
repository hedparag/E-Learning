@extends('Frontend.teacher-dashboard.courses.create')
@section('tab_content')
    <div class="tab-pane fade active show" id="profile-09" role="tabpanel" aria-labelledby="profile-09-tab">
        <div class="container py-5">
            <h3 class="mb-4">Create Mock Test for Course: <strong>{{ @$course?->title }}</strong></h3>

            <!-- Instructions from admin -->

            <div class="alert alert-icon alert-outline-danger" role="alert">
                @if ($admin->instructions)
                    <strong class="text-danger" style="color: #dc3545; font-weight: bold;">{!! $admin->instructions !!}</strong>
            </div>
            @endif
        </div>

        <form class="course-update course-form" method="POST" id="mockTestForm">
            @csrf
            <input type="hidden" name="current_step" value="5">
            <input type="hidden" name="next_step" value="">
            <input type="hidden" name="editMode" value="{{ $editMode }}">
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="adminMock_id" value="{{ $admin->id }}">
            @php
                $minQuestion = $admin->min_question;
                $maxQuestion = $admin->max_question;
            @endphp

            <div id="questionContainer">
                @if ($editMode == 1)
                    @foreach ($mock->questions ?? [] as $index => $question)
                        <div class="card mb-4 shadow-sm question-block" data-index="{{ $index }}">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <strong>Question {{ $index + 1 }}</strong>
                                <button type="button" class="btn btn-sm btn-danger remove-btn">Remove</button>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Question Text</label>
                                    <textarea name="questions[{{ $index }}][text]" class="form-control" required>{{ $question->question_text }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Options</label>
                                    @php $letters = ['A', 'B', 'C', 'D']; @endphp
                                    @foreach ($letters as $letter)
                                        @php
                                            $option = $question->options->where('option_label', $letter)->first();

                                        @endphp
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">{{ $letter }}</span>
                                            <input type="text"
                                                name="questions[{{ $index }}][options][{{ $letter }}]"
                                                class="form-control" value="{{ $option->option_text ?? '' }}"
                                                placeholder="Option {{ $letter }}" required>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-3">
                                    <label>Correct Answer(s)</label><br />
                                    @foreach ($letters as $letter)
                                        @php
                                            $isCorrect = $question->options
                                                ->where('option_label', $letter)
                                                ->where('correct_option', true)
                                                ->first();
                                        @endphp
                                        <div class="form-check form-check-inline me-3">
                                            <input class="form-check-input" type="checkbox"
                                                name="questions[{{ $index }}][correct_answers][]"
                                                value="{{ $letter }}"
                                                id="correct-{{ $index }}-{{ $letter }}"
                                                {{ $isCorrect ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="correct-{{ $index }}-{{ $letter }}">{{ $letter }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="button" id="addQuestionBtn" class="btn btn-secondary">+ Add Question</button>
                {{-- <button type="submit" id="submitBtn" class="btn btn-primary" disabled>Submit Mock Test</button> --}}
                <button type="submit" id="submitBtn" class="btn btn-primary"
                    @if (count($mock->questions ?? []) < $minQuestion) disabled @endif>
                    Submit Mock Test
                </button>
            </div>
        </form>
    </div>

    <script>
        window.minQuestions = {{ $minQuestion }};
        window.maxQuestions = {{ $maxQuestion }};
    </script>
    <script>
        $(function() {
            const minQuestions = window.minQuestions ?? 10;
            const maxQuestions = window.maxQuestions ?? 50;
            // window.questionIndex = $('.question-block').length;
            window.questionIndex = questionIndex;
            updateSubmitState();
            $('#addQuestionBtn').on('click', function() {
                if (window.questionIndex >= window.maxQuestions) {
                    alert(`Maximum ${window.maxQuestions} questions allowed.`);
                    return;
                }

                const letters = ['A', 'B', 'C', 'D'];
                let html = `
            <div class="card mb-4 shadow-sm question-block" data-index="${window.questionIndex}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Question ${window.questionIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-btn">Remove</button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Question Text</label>
                        <textarea name="questions[${window.questionIndex}][text]" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Options</label>`;

                letters.forEach(letter => {
                    html += `
                <div class="input-group mb-2">
                    <span class="input-group-text">${letter}</span>
                    <input type="text" name="questions[${window.questionIndex}][options][${letter}]" class="form-control" required placeholder="Option ${letter}">
                </div>`;
                });

                html += `
                    <div class="mt-3">
                        <label>Correct Answer(s)</label><br/>`;

                letters.forEach(letter => {
                    html += `
                <div class="form-check form-check-inline me-3">
                    <input class="form-check-input" type="checkbox" name="questions[${window.questionIndex}][correct_answers][]" value="${letter}" id="correct-${window.questionIndex}-${letter}">
                    <label class="form-check-label" for="correct-${window.questionIndex}-${letter}">${letter}</label>
                </div>`;
                });

                html += `
                    </div>
                </div>
            </div>`;

                $('#questionContainer').append(html);
                window.questionIndex++;
                updateSubmitState();
            });

            $(document).on('click', '.remove-btn', function() {
                $(this).closest('.question-block').remove();
                updateQuestionNumbers();
                updateSubmitState();
            });

            function updateQuestionNumbers() {
                window.questionIndex = 0;
                $('.question-block').each(function() {
                    $(this).attr('data-index', window.questionIndex);
                    $(this).find('.card-header strong').text('Question ' + (window.questionIndex + 1));
                    $(this).find('textarea').attr('name', `questions[${window.questionIndex}][text]`);

                    const letters = ['A', 'B', 'C', 'D'];
                    letters.forEach(letter => {
                        $(this).find(`input[type="text"][placeholder="Option ${letter}"]`)
                            .attr('name', `questions[${window.questionIndex}][options][${letter}]`);

                        const checkbox = $(this).find(`input[type="checkbox"][value="${letter}"]`);
                        checkbox.attr('name',
                            `questions[${window.questionIndex}][correct_answers][]`);
                        checkbox.attr('id', `correct-${window.questionIndex}-${letter}`);
                        checkbox.siblings('label').attr('for',
                            `correct-${window.questionIndex}-${letter}`);
                    });

                    window.questionIndex++;
                });
            }

            function updateSubmitState() {
                const totalQuestions = $('.question-block').length;
                console.log('Total Questions:', $('.question-block').length);
                console.log('Min Required:', window.minQuestions);

                $('#submitBtn').prop('disabled', totalQuestions < window.minQuestions);
            }
        });
    </script>

@endsection
