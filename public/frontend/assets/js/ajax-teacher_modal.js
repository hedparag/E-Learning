$(document).ready(function () {
    $('.teacher-modal-trigger').on('click', function (e) {
        e.preventDefault();

        var teacherId = $(this).data('id');

        $.ajax({
            url: '/teacher-details/' + teacherId,
            type: 'GET',
            success: function (response) {
                $('#teacherModalContent').html(response);
                $('#teacherDetailModal').modal('show');
            },
            error: function () {
                $('#teacherModalContent').html('<p class="text-danger">Something went wrong.</p>');
                $('#teacherDetailModal').modal('show');
            }
        });
    });
});
