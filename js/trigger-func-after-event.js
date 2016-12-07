/*
* Fire function AFTER window resize
* triggerOnece is a custom function for firing an event only once
* since adding events to window resize can be a memory hog,
* I use this to fire the function once when window resize has completed
*/

var triggerOnece = (function () {
	var timers = {};

	return function (callback, ms, uniqueId) {
		if (!uniqueId) {
			uniqueId = "Don't call this twice without a uniqueId";
		}

		if (timers[uniqueId]) {
			clearTimeout (timers[uniqueId]);
		}

		timers[uniqueId] = setTimeout(callback, ms);
	};

})();

//Pure Javascript Example:

window.addEventListener('resize', function() {
    //fire onWindowResize 100ms AFTER window has finished resizing
    triggerOnece(onWindowResize, 100, "a unique string - could be anything (have you used 'sneh' lately?)");
});

function onWindowResize() {
	console.log('resize completed');
}


//jQuery Example:
//Hint:  It's the same as the pure js solution but with jQuery $().on for event binding


$(window).on('resize', function() {
    //fire onWindowResize 100ms AFTER window has finished resizing
    triggerOnece(onWindowResize, 100, "a unique string - could be anything (have you used 'doink' lately?)");
});