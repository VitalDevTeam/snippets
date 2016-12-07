var animationController = (function($) {
    var ret = {},
        aniDuration = 250,
        aniEaseOut = 'easeOutQuad',
        aniEaseIn = 'easeInQuad',
        aniEasing = 'easeInOutQuad',
        aniOptionsOut = {
            duration: aniDuration,
            easing: aniEaseOut
        },
        aniOptionsIn = {
            duration: aniDuration,
            easing: aniEaseIn
        },
        aniOptions = {
            duration: aniDuration,
            easing: aniEasing
        };

    ret = {
        aniDuration: aniDuration,
        aniEaseOut: aniEaseOut,
        aniEaseIn: aniEaseIn,
        aniEasing: aniEasing,
        aniOptionsOut: aniOptionsOut,
        aniOptionsIn: aniOptionsIn,
        aniOptions: aniOptions
    };

    return ret;

})(jQuery);
