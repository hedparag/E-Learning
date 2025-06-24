import $ from 'jquery';
window.$=$;
window.jquery=$;

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
})
