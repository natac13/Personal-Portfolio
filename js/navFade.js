$(window).scroll(function() {
    if($(this).scrollTop() > 300) {
        $('.navbar-fixed-top').addClass('opaque');
        $('.navbar-default .navbar-nav').addClass('opaque');
    } else {
        $('.navbar-fixed-top').removeClass('opaque');
        $('.navbar-default .navbar-nav').removeClass('opaque');

    }
});