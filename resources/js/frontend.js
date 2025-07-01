import $ from 'jquery';
window.$=$;
window.jquery=$;
const csrfToken = $('meta[name="csrf-token"]').attr('content');
const baseUrl = $('meta[name="base-url"]').attr('content');
const subjectUrl=baseUrl+'/teacher/get-common-subjects'
$(function(){
   $('.payout').on('change',function(){
let value=$(this).val();
console.log(value);
if(value=='paypal'){
    $('.payout_info').attr('placeholder','paypal holder name:,paypal account number:');
}
else if(value=='razorpay'){
    $('.payout_info').attr('placeholder','razorpay holder name:, razorpay account number:');
}

else if(value=='scipe'){
    $('.payout_info').attr('placeholder','scipe holder name: , scipe account number:');
}
   });


   $('.logout').on('click',function(e){
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





})
