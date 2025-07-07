import $ from 'jquery';
window.$ = $;
window.jquery = $;
const csrfToken = $('meta[name="csrf-token"]').attr('content');
const baseUrl = $('meta[name="base-url"]').attr('content');
const subjectUrl = baseUrl + '/teacher/get-common-subjects';
const update_url = baseUrl + '/teacher/course/update';
const chapterUrl = baseUrl + '/teacher/course/chapter';
const lessonUrl = baseUrl + '/teacher/course/chapter/lesson';
const chapterEditUrl = baseUrl + '/teacher/course/chapter/edit';
var notyf = new Notyf({
    duration: 6000,
    dismissible: true
});
$(function () {
    //let questionIndex = 0;
    let questionIndex = $('.question-block').length;
    const minQuestions = window.minQuestions ?? 10;
    const maxQuestions = window.maxQuestions ?? 50;
   // window.questionIndex = $('.question-block').length;
   window.questionIndex = questionIndex;
updateSubmitState();

    function loadSubjects(classId,subject) {
        if (classId !== '') {
            $.ajax({
                url: subjectUrl,
                method: 'GET',
                data: { class_id: classId, subject_id:subject },
                success: function (response) {
                    console.log(subject);
                    $('.holder').html(response.html);
                },
                error: function () {
                    $('.holder').html('<p class="text-danger">Failed to load subjects.</p>');
                }
            });
        } else {
            $('.holder').html('');
        }
    }

    $('.delete-item').on('click', function (e) {

        e.preventDefault();
        let id = $(this).data('id');
        let url = $(this).attr('href');

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'DELETE',
                    url: url,
                    data: {
                        _token: csrfToken,

                    },
                    beforeSend: function () {

                    },
                    success: function (data) {
                        window.location.reload();

                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
                    }
                });




            }
        });
    });
    $('.payout').on('change', function () {
        let value = $(this).val();
        console.log(value);
        if (value == 'paypal') {
            $('.payout_info').attr('placeholder', 'paypal holder name:,paypal account number:');
        }
        else if (value == 'razorpay') {
            $('.payout_info').attr('placeholder', 'razorpay holder name:, razorpay account number:');
        }

        else if (value == 'scipe') {
            $('.payout_info').attr('placeholder', 'scipe holder name: , scipe account number:');
        }
    });


    $('.logout').on('click', function (e) {
        e.preventDefault();
        $('.logoutForm').trigger("submit");
    });

    $(document).on('change', '.storage', function () {
        let value = $(this).val();
        $('.source').val(' ');
        if (value == 'upload') {
            $('.upload_source').removeClass('d-none');
            $('.external_source').addClass('d-none');
        }
        else {
            $('.upload_source').addClass('d-none');
            $('.external_source').removeClass('d-none');
        }
    });
    $('.targetSubject').on('change', function () {
        let classId = $(this).val();
        console.log(classId);
        if (classId !== '') {
            $.ajax({
                url: subjectUrl,
                method: 'GET',
                data: { class_id: classId },
                success: function (response) {
                    $('.holder').html(response.html);
                },
                error: function () {
                    $('.holder').html('<p class="text-danger">Failed to load subjects.</p>');
                }
            });
        } else {
            $('.holder').html('');
        }
    });
    if ($('.targetSubject.chooseClass').length) {
        let classId = $('.targetSubject.chooseClass').val();
       let subject = $('.targetSubject.chooseClass').data('id');
        loadSubjects(classId,subject);
    }
    $('.basic-info-submit').on('submit', function (e) {
        e.preventDefault();


        let formData = new FormData(this);

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status == 'success') {
                    window.location.href = data.redirect;
                }
            },
            /* error: function (xhr, status, error) {
                 console.log(xhr);

                 if (xhr.responseJSON && xhr.responseJSON.errors) {
                     let errors = xhr.responseJSON.errors;
                     $.each(errors, function (key, messages) {

                         notyf.error(messages[0]);
                     });
                 }
             }*/
            error: function (xhr, status, error) {
                // Log everything for debugging
                console.log(xhr);

                // Validation errors
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        notyf.error(messages[0]);
                    });
                }
                // Server-side exceptions (like DB errors)
                else if (xhr.responseJSON && xhr.responseJSON.message) {
                    notyf.error(xhr.responseJSON.message);
                }
                // Fallback generic error
                else {
                    notyf.error("An unexpected error occurred.");
                }
            }
        });
    });
    $('.course-update').on('submit', function (e) {
        e.preventDefault();


        let formData = new FormData(this);

        $.ajax({
            method: "POST",
            url: update_url,
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status == 'success') {
                    window.location.href = data.redirect;
                }
            },
            /*error: function (xhr, status, error) {
                console.log(xhr);

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, messages) {

                        notyf.error(messages[0]);
                    });
                }
            }*/
            error: function (xhr, status, error) {
                // Log everything for debugging
                console.log(xhr);

                // Validation errors
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        notyf.error(messages[0]);
                    });
                }
                // Server-side exceptions (like DB errors)
                else if (xhr.responseJSON && xhr.responseJSON.message) {
                    notyf.error(xhr.responseJSON.message);
                }
                // Fallback generic error
                else {
                    notyf.error("An unexpected error occurred.");
                }
            }
        });
    });

    $(document).on('click', '.AddChapter', function (e) {
        e.preventDefault();

        // Debug check
        console.log('Modal function exists:', typeof $.fn.modal === 'function');

        // Initialize modal properly
        $('#dynamic-modal').modal('show');

        // Load content via AJAX if needed
        $.get('/your-ajax-url', function (data) {
            $('.dynamic-modal-content').html(data);
        });
    });

    $('.customModal').on('click', function () {
        let courseId = $(this).data('course-id');
        console.log('hello');
        $.ajax({
            method: 'GET',
            url: chapterUrl,
            data: {
                'courseId': courseId
            },
            beforeSend: function () {

            },
            success: function (data) {
                $('.ModelBody').html(data);
            },
            error: function (xhr, status, error) {


            }
        });

    });
    $('.customLessonModal').on('click', function () {
        let courseId = $(this).data('course-id');
        let chapterId = $(this).data('chapter-id');
         $('.ModalTitle').text('Add Lesson');
        console.log(lessonUrl);
        $.ajax({
            method: 'GET',
            url: lessonUrl,
            data: {
                'courseId': courseId,
                'chapterId': chapterId
            },
            beforeSend: function () {

            },
            success: function (data) {

                $('.ModelBody').html(data);
            },
            error: function (xhr, status, error) {


            }
        });

    });

    $(document).on('click', '.ChapterEditModal', function () {
        let courseId = $(this).data('course-id');
        let chapterId = $(this).data('chapter-id');
        let editId = $(this).data('edit-id');
        console.log(chapterEditUrl);
        $.ajax({
            method: 'GET',
            url: chapterUrl,
            data: {
                'courseId': courseId,
                'chapterId': chapterId,
                'editId': editId
            },
            beforeSend: function () {

            },
            success: function (data) {
                $('.ModelBody').html(data);
            },
            error: function (xhr, status, error) {


            }
        });

    });
    $('.lessonEditModal').on('click', function () {
        let courseId = $(this).data('course-id');
        let chapterId = $(this).data('chapter-id');
        let editId = $(this).data('edit-id');
        let lessonId = $(this).data('lesson-id');
           $('.ModalTitle').text('Edit Lesson');
        console.log(chapterEditUrl);
        $.ajax({
            method: 'GET',
            url: lessonUrl,
            data: {
                'courseId': courseId,
                'chapterId': chapterId,
                'editId': editId,
                'lessonId': lessonId
            },
            beforeSend: function () {

            },
            success: function (data) {
                $('.ModelBody').html(data);
            },
            error: function (xhr, status, error) {


            }
        });
    });
    $('.courseTab').on('click', function () {
        let step = $(this).data('step');
        $('.course-form').find('input[name=next_step]').val(step);
        $('.course-form').trigger('submit');
    });
  /*  $('#addQuestionBtn').on('click',function () {
        if (questionIndex >= maxQuestions) {
            alert(`Maximum ${maxQuestions} questions allowed.`);
            return;
        }

        const letters = ['A', 'B', 'C', 'D'];
        let html = `
            <div class="card mb-4 shadow-sm question-block" data-index="${questionIndex}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Question ${questionIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-btn">Remove</button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Question Text</label>
                        <textarea name="questions[${questionIndex}][text]" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Options</label>
        `;

        letters.forEach(letter => {
            html += `
                <div class="input-group mb-2">
                    <span class="input-group-text">${letter}</span>
                    <input type="text" name="questions[${questionIndex}][options][${letter}]" class="form-control" required placeholder="Option ${letter}">
                </div>
            `;
        });

        html += `
                    <label>Select Correct Answer</label>
                    <select name="questions[${questionIndex}][correct_answer]" class="form-select" required>
                        <option value="">-- Select --</option>
        `;

        letters.forEach(letter => {
            html += `<option value="${letter}">${letter}</option>`;
        });

        html += `
                    </select>
                </div>
            </div>
        </div>`;

        $('#questionContainer').append(html);
        questionIndex++;
        updateSubmitState();
    });

    // Remove question block
    $(document).on('click', '.remove-btn', function () {
        $(this).closest('.question-block').remove();
        updateQuestionNumbers();
        updateSubmitState();
    });

    function updateQuestionNumbers() {
        questionIndex = 0;
        $('.question-block').each(function () {
            $(this).attr('data-index', questionIndex);
            $(this).find('.card-header strong').text('Question ' + (questionIndex + 1));

            $(this).find('textarea').attr('name', `questions[${questionIndex}][text]`);
            $(this).find('select').attr('name', `questions[${questionIndex}][correct_answer]`);

            const letters = ['A', 'B', 'C', 'D'];
            letters.forEach(letter => {
                $(this).find(`input[name$="[${letter}]"]`).attr('name', `questions[${questionIndex}][options][${letter}]`);
            });

            questionIndex++;
        });
    }

    function updateSubmitState() {
        const totalQuestions = $('.question-block').length;
        $('#submitBtn').prop('disabled', totalQuestions < minQuestions);
    }*/

/*$('#addQuestionBtn').on('click', function () {
    if (questionIndex >= maxQuestions) {
        alert(`Maximum ${maxQuestions} questions allowed.`);
        return;
    }

    const letters = ['A', 'B', 'C', 'D'];
    let html = `
        <div class="card mb-4 shadow-sm question-block" data-index="${questionIndex}">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Question ${questionIndex + 1}</strong>
                <button type="button" class="btn btn-sm btn-danger remove-btn">Remove</button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Question Text</label>
                    <textarea name="questions[${questionIndex}][text]" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Options</label>
    `;

    letters.forEach(letter => {
        html += `
            <div class="input-group mb-2">
                <span class="input-group-text">${letter}</span>
                <input type="text" name="questions[${questionIndex}][options][${letter}]" class="form-control" required placeholder="Option ${letter}">
            </div>
        `;
    });

    html += `
                <div class="mt-3">
                    <label>Correct Answer(s)</label><br/>
    `;

    letters.forEach(letter => {
        html += `
            <div class="form-check form-check-inline me-3">
                <input class="form-check-input" type="checkbox" name="questions[${questionIndex}][correct_answers][]" value="${letter}" id="correct-${questionIndex}-${letter}">
                <label class="form-check-label" for="correct-${questionIndex}-${letter}">${letter}</label>
            </div>
        `;
    });

    html += `
                </div>
            </div>
        </div>
    `;

    $('#questionContainer').append(html);
    questionIndex++;
    updateSubmitState();
});

// Remove question block
$(document).on('click', '.remove-btn', function () {
    $(this).closest('.question-block').remove();
    updateQuestionNumbers();
    updateSubmitState();
});

// Update numbering and name attributes
function updateQuestionNumbers() {
    questionIndex = 0;
    $('.question-block').each(function () {
        $(this).attr('data-index', questionIndex);
        $(this).find('.card-header strong').text('Question ' + (questionIndex + 1));

        // Update question text
        $(this).find('textarea').attr('name', `questions[${questionIndex}][text]`);

        // Update option names and correct checkboxes
        const letters = ['A', 'B', 'C', 'D'];
        letters.forEach(letter => {
            $(this).find(`input[type="text"][placeholder="Option ${letter}"]`)
                .attr('name', `questions[${questionIndex}][options][${letter}]`);

            const checkbox = $(this).find(`input[type="checkbox"][value="${letter}"]`);
            checkbox.attr('name', `questions[${questionIndex}][correct_answers][]`);
            checkbox.attr('id', `correct-${questionIndex}-${letter}`);
            checkbox.siblings('label').attr('for', `correct-${questionIndex}-${letter}`);
        });

        questionIndex++;
    });
}

// Enable or disable submit based on min question count
function updateSubmitState() {
    const totalQuestions = $('.question-block').length;
    $('#submitBtn').prop('disabled', totalQuestions < minQuestions);
}*/
  $('#addQuestionBtn').on('click', function () {
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

    $(document).on('click', '.remove-btn', function () {
        $(this).closest('.question-block').remove();
        updateQuestionNumbers();
        updateSubmitState();
    });

    function updateQuestionNumbers() {
        window.questionIndex = 0;
        $('.question-block').each(function () {
            $(this).attr('data-index', window.questionIndex);
            $(this).find('.card-header strong').text('Question ' + (window.questionIndex + 1));
            $(this).find('textarea').attr('name', `questions[${window.questionIndex}][text]`);

            const letters = ['A', 'B', 'C', 'D'];
            letters.forEach(letter => {
                $(this).find(`input[type="text"][placeholder="Option ${letter}"]`)
                    .attr('name', `questions[${window.questionIndex}][options][${letter}]`);

                const checkbox = $(this).find(`input[type="checkbox"][value="${letter}"]`);
                checkbox.attr('name', `questions[${window.questionIndex}][correct_answers][]`);
                checkbox.attr('id', `correct-${window.questionIndex}-${letter}`);
                checkbox.siblings('label').attr('for', `correct-${window.questionIndex}-${letter}`);
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


