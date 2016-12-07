/*
*   Remove Class - IE8+
*   element.removeClass('selector');
*/
Element.prototype.removeClass = function(selector) {

    if (this.classList) {

        this.classList.remove(selector);

    } else {

        this.className = this.className.replace(new RegExp('(^|\\b)' + selector.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
    }
}

/*
*   Add Class - IE8+
*   element.addClass('selector');
*/
Element.prototype.addClass = function(selector) {

    if (this.classList) {
        this.classList.add(selector);
    } else {
        this.className += ' ' + selector;
    }
}

/*
*   Toggle Class - IE8+
*   element.toggleClass('selector');
*   NOTE: Only works when toggling a selector on or off an element.
*   does not support toggling between 2 classes
*/
Element.prototype.toggleClass = function(selector) {

    if (this.classList) {

        this.classList.toggle(selector);

    } else {

        var classes = this.className.split(' ');
        var existingIndex = classes.indexOf(selector);

        if (existingIndex >= 0) {

            classes.splice(existingIndex, 1);
        }
        else {

            classes.push(selector);
        }

        this.className = classes.join(' ');
    }
}

/*
*   Has Class - IE8+
*   if (element.hasClass('selector')) { do stuff; }
*/
Element.prototype.hasClass = function(selector) {

    if (this.classList) {

        return this.classList.contains(selector);

    } else {

        return new RegExp('(^| )' + selector + '( |$)', 'gi').test(this.className);
    }
}