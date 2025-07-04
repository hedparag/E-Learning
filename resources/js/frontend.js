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
});

