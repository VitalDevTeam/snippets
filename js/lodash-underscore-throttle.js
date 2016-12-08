var throttle = function(func, wait, options) {
    var context, args, result,
        timeout = null,
        previous = 0;

    if (!options) {
        options = {};
    }

    var later = function() {
        previous = options.leading === false ? 0 : new Date().getTime();
        timeout = null;
        result = func.apply(context, args);
        if (!timeout) {
            context = args = null;
        }
    };
    return function() {
        var now = new Date().getTime();

        if (!previous && options.leading === false) {
            previous = now;
        }

        var remaining = wait - (now - previous);
        context = this;
        args = arguments;
        if (remaining <= 0 || remaining > wait) {
            if (timeout) {
                clearTimeout(timeout);
                timeout = null;
            }
            previous = now;
            result = func.apply(context, args);

            if (!timeout) {
                context = args = null;
            }

        } else if (!timeout && options.trailing !== false) {
            timeout = setTimeout(later, remaining);
        }
        return result;
    };
};

//Usage

// Expensive function you want to throttle:
// In this example we are capturing scroll position and affixing an
// element to the top of the page when conditions are met.
// This doesn't need to fire on every pixel of scroll.  We're going to set it to fire
// every 200ms more than enough to look instant without destroying performance
var onWindowScroll = helpersController.throttle(function() {
    scrollValue = $(doc).scrollTop();
    offset = $(filterBar).offset().top;

    if (scrollValue >= offset) {
        if (filterBar.getAttribute('data-sticky', 'nope')) {
            affix();
        }
    } else {
        if (filterBar.getAttribute('data-sticky', 'yep')) {
            unaffix();
        }
    }
}, 200);

//Bind the event like normal
//jQuery
$(window).on('scroll', onWindowScroll);

//Native
window.addEventListener('scroll', onWindowScroll);
