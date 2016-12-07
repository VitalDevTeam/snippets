/**
 * OPTIMIZED SCROLL LISTENER
 * Less resource-heavy than a traditional window.scroll
 * https://developer.mozilla.org/en-US/docs/Web/Events/scroll
 */
(function() {
    var throttle = function(type, name, obj) {
        var obj = obj || window;
        var running = false;
        var func = function() {
            if (running) { return; }
            running = true;
            requestAnimationFrame(function() {
                obj.dispatchEvent(new CustomEvent(name));
                running = false;
            });
        };
        obj.addEventListener(type, func);
    };
    throttle ('scroll', 'optimizedScroll');
})();

// Event handler example
// (If target element reaches top of the viewport)
window.addEventListener('optimizedScroll', function() {

    var y     = window.scrollY,
        el    = document.getElementById('target-element'),
        elPos = el.offsetTop;

    if (elPos < y) {
        // Do this...
    }

});