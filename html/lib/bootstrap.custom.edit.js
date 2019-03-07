/** BOOTSTRAP STUFF */

// $('#nav-top').affix({
//     offset: { top: 300 }
// });
// 
// /** unaffix, remove placeholder, not needed */
// $('#nav-top').on('affixed-top.bs.affix', function() {
//     $('#nav-placeholder').hide();
// });
// 
// /* affix, show placeholder to maintain layout */
// $('#nav-top').on('affixed.bs.affix', function() {
//     $('#nav-placeholder').show();
// });

/** OTHER UI THINGS */

/** Nav Scrolling */

$(".nav-btn a").on('click', function () {

    var section_id, top_of_target, speed = 1500;
    
    section_id = $(this).attr("href");
    top_of_target = $(section_id).offset().top - 83;

    $('html, body').animate({
        scrollTop: top_of_target
    }, speed);
    
    event.preventDefault();
    
});

/** carousel */

$('.carousel').carousel();