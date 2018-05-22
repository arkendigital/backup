$(".site-scroll-to-top").click(function() {

    $('html, body').animate({
        scrollTop: $("html").offset().top
    }, 1000);

});
