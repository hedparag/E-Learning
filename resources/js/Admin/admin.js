
import $ from 'jquery';
window.$ = window.jQuery = $;
const base_url = $('meta[name="base_url"]').attr('content');
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');
let url = base_url + '/admin/data';
let fetch_course=base_url+'/admin/fetchAllCourse';
// base_url + '/admin/class/:id'.replace(':id',id)
var notyf = new Notyf({
    duration: 6000,
    dismissible: true
});
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
                    let $formGroup = $('<div class="form-group col-md-12 mt-3">');
                    $formGroup.append('<label for="inputState">Class</label>');

                    let $select = $('<select>', {
                        id: 'inputState',
                        name: 'class',
                        class: 'form-control form-control-lg',
                        css: {
                            minHeight: '30px !important',
                            fontSize: '16px'
                        }
                    });

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
        else {
            $('.holder').addClass('d-none');
        }
    })
    $('.resultModal').on('click', function () {
        /*console.log("hello");*/
        let url = $(this).attr('href');
        let id = $(this).data('id');
        $.ajax({
            method: 'GET',
            url: url,
            data: {
                'id': id
            },
            beforeSend: function () {

            },
            success: function (data) {
                $('.resultBody').html(data)
            },
            error: function (xhr, status, error) {
                console.log(xhr);
            }
        })

    });
    $(document).on('click', '.resultButton', function () {
        url = base_url + '/admin/finalized'
        let student = $(this).data('id');
        let classId = $(this).data('classid');
        $.ajax({
            method: 'POST',
            url: url,
            data: {
                _token: csrf_token,
                'student': student,
                'classId': classId
            },
            beforeSend: function () {

            },
            success: function (data) {
                if (data.success) {
                    $('.ReportButton').removeClass('d-none');

                    $('.resultButton').addClass('d-none');
                    notyf.success(data.success);

                }

            },
            error: function (xhr, status, error) {
                console.log(xhr);
            }
        })
    });
    $(document).on('click', '.ReportButton', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        let student = $(this).data('id');
        let classId = $(this).data('classid');

        $.ajax({
            method: 'GET',
            url: url,
            data: {
                'student': student,
                'classId': classId
            },
            beforeSend: function () {

            },
            success: function (data) {
                $('.resultBody').empty().html(data);

            },
            error: function (xhr, status, error) {

            }


        })
    });
    $(document).on('click', '.cross', function () {
        window.location.reload();
    });


    $(document).on('click', '.videoView', function () {
        console.log("hi");
        let url=$(this).data('url');
        console.log(url);
        $('.modal-title').text("lesson video");

        $('.videoPlayModal').attr('src', url);
    });

    $('.classList').on('change',function(){
let value=$(this).val();
console.log(value);
$.ajax({
method:'GET',
url:fetch_course,
data:{
   'class':value
},
beforeSend:function(){

},
success:function(data){
    $('.myContainer').removeClass('d-none');
    $('.tableBody').html(data);

},
error:function(xhr,status,error){

}
});
    });




});
