/** BOOTSTRAP STUFF */

function isBreakpoint( alias ) {
    return $('.device-' + alias).is(':visible');
}  

$(document).ready(function(){
//     if(!isBreakpoint('xs')){
// 
//         $('#nav-top').affix({
//             offset: { top: 300 }
//         });
// 
//         /** unaffix, remove placeholder, not needed */
//         $('#nav-top').on('affixed-top.bs.affix', function() {
//             $('#nav-placeholder').hide();
//         });
// 
//         /* affix, show placeholder to maintain layout */
//         $('#nav-top').on('affixed.bs.affix', function() {
//             $('#nav-placeholder').show();
//         });
// 
//     }else{
//         $("#nav-top").attr('data-spy','');
//         $("#nav-top").attr('id','');
//     }
});
/** Nav Scrolling */

$(".nav-button a").on('click', function () {

    var section_id, top_of_target, speed = 1500;
    
    section_id = $(this).attr("href");
    top_of_target = $(section_id).offset().top - 84;

    $('html, body').animate({
        scrollTop: top_of_target
    }, speed);
    
    event.preventDefault();
    
});