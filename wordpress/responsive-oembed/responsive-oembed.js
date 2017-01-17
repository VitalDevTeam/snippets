jQuery(document).ready(function ($) {

    /**
    * Responsive oembeds.
    * Works with responsive_oembed() in functions.php
    */
    $('.embed-responsive').each(function() {
        var ar = $(this).attr('data-aspectratio');
        if (typeof ar !== typeof undefined && ar !== false ) {
            $(this).css('padding-bottom', (1 / ar) * 100 + '%');
        }
    });

});
