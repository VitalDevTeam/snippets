var docWidth = document.documentElement.offsetWidth,
    elements = document.querySelectorAll('*');

[].forEach.call( elements, function(el) {
    if (el.offsetWidth > docWidth) {
        console.log(el);
    }
});