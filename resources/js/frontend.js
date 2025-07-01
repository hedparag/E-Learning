import $ from 'jquery';
window.$ = $;
window.jquery = $;
const csrfToken = $('meta[name="csrf-token"]').attr('content');
const baseUrl = $('meta[name="base-url"]').attr('content');
const subjectUrl = baseUrl + '/teacher/get-common-subjects';
const update_url=baseUrl+'/teacher/course/update';
var notyf = new Notyf({
    duration: 6000,
    dismissible: true
});
$(function () {
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
        error: function (xhr, status, error) {
            console.log(xhr);

            if (xhr.responseJSON && xhr.responseJSON.errors) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {

                    notyf.error(messages[0]);
                });
            }
        }
    });
});
$('.course-update').on('submit', function (e) {
    e.preventDefault();


    let formData = new FormData(this);

    $.ajax({
        method:"POST",
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
        error: function (xhr, status, error) {
            console.log(xhr);

            if (xhr.responseJSON && xhr.responseJSON.errors) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {

                    notyf.error(messages[0]);
                });
            }
        }
    });
});

$(document).on('click', '.AddChapter', function(e) {
    e.preventDefault();

    // Debug check
    console.log('Modal function exists:', typeof $.fn.modal === 'function');

    // Initialize modal properly
    $('#dynamic-modal').modal('show');

    // Load content via AJAX if needed
    $.get('/your-ajax-url', function(data) {
        $('.dynamic-modal-content').html(data);
    });
});

});

