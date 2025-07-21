import $ from 'jquery';
window.$ = window.jQuery = $;
$(function(){
   $('.customAjax').on('click',function(){
   // e.preventDefault();
    let url=$(this).attr('href');
    console.log(url);
$.ajax({
method:'GET',
url:url,
beforeSend:function(){

},
success:function(data){

},
error:function(xhr,status,error){
    console.log(xhr);
}
});

   });
});
