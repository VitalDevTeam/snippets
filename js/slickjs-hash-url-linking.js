// Source: http://jsfiddle.net/simeydotme/qa3muqrk/

// This simulates a "window.location.search" string for testing
var testurl = "?slick0=2&slick1=4";

$(".slider").each(function(k, v){

    var search = window.location.search || testurl,
        $slider = $(this),
        queries = search.slice(1).split("&"),
        checkQuery, initialSlide = 0;

    for( var query in queries ) {
        checkQuery = queries[query].split("=");
        if( checkQuery[0] === "slick"+k ) {
            initialSlide = parseInt(checkQuery[1],10);
        }
    }

    $slider.slick({
        initialSlide: initialSlide
    });

});