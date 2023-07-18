$(document).ready(function(){
    $(".mc-about-text-link").on("click", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top - 80;
        $('body,html').animate({scrollTop: top}, 150);
    });
});

var sidebar = new StickySidebar('#sidebar', {
    containerSelector: '#main-content',
    innerWrapperSelector: '.sidebar__inner',
    topSpacing: 100,
    bottomSpacing: 0
});