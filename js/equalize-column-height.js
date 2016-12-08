/**
 * Equalize heights of columns
 * @param  jQuery object  Elements you want to equalize
 */
function equalizeColumnHeight(el) {
	var maxHeight = 0;
	el.each(function() {
	   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	el.height(maxHeight);
}