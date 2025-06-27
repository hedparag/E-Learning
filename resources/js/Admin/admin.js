
import $ from 'jquery';
window.$=window.jQuery=$;
const base_url = $('meta[name="base_url"]').attr('content');
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');
// base_url + '/admin/class/:id'.replace(':id',id)
$(function(){
    $('#delete-item').on('click',function(e) {

        e.preventDefault();
        let id=$(this).data('id');
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
                method:'DELETE',
                url:url,
                data:{
                    _token:csrf_token,

                },
                beforeSend: function(){

                },
                success:function(data){
                    window.location.reload();

                },
                error:function(xhr,status,error){
console.log(xhr);
                }
            });




        }
    });
});
});
