import $ from 'jquery';
window.$ = window.jQuery = $;
$(function(){
   $('.customAjax').on('click',function(){
    let url=$(this).attr('href');
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
})
