function reinit_cycle() {
    var width = $(window).width(); // Checking size again after window resize
    if ( width < 500 ) {
        $('#carousel-slideshow').cycle('destroy');
        reinitCycle(1);
    } else if ( width > 500 && width < 768 ) {
        $('#carousel-slideshow').cycle('destroy');
        reinitCycle(2);
    } else {
        $('#carousel-slideshow').cycle('destroy');
        reinitCycle(3);
    }
}

function reinitCycle(visibleSlides) {
    $('#carousel-slideshow').cycle({
        speed: 1000,
        timeout:6000,
        carouselFluid : false,
        carouselVisible : visibleSlides,
        allowWrap:false,
        fx : 'carousel',
        slides :'> div',
        pager:"#typical-pager",
        next:"#next",
        prev:"#previous"
    })
}