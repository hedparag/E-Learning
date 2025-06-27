
import $ from 'jquery';
window.$ = window.jQuery = $;
const base_url = $('meta[name="base_url"]').attr('content');
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');
let url = base_url + '/admin/data';
// base_url + '/admin/class/:id'.replace(':id',id)
$(function () {
    $('#delete-item').on('click', function (e) {

        e.preventDefault();
        let id = $(this).data('id');
        let url = $(this).attr('href');
        console.log(base_url);
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
                console.log(base_url);
                $.ajax({
                    method: 'DELETE',
                    url: url,
                    data: {
                        _token: csrf_token,

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

    $('.target').on('change', function () {

        let val = $(this).val();
        if (val == 'class') {
            $('.holder').removeClass('d-none');
            $.ajax({
                method: 'GET',
                url: url,

                success: function (data) {
                    // console.log(data);
                    let $formGroup = $('<div class="form-group col-md-4">');
                    $formGroup.append('<label for="inputState">Class</label>');

                    let $select = $('<select id="inputState" class="form-control" name="class">');
                    $select.append('<option value="">Select</option>');


                    $.each(data, function (index, item) {
                        $select.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });


                    $formGroup.append($select);
                    $('.field1').removeClass('.col-md-6');
                    $('.field1').addClass('.col-md-4');
                    $('.field2').removeClass('.col-md-6');
                    $('.field2').addClass('.col-md-4');

                    $('.holder').html($formGroup);
                }
            ,
                error: function (xhr, status, error) {

                }
            });

}
else{
    $('.holder').addClass('d-none');
}
    })
});
