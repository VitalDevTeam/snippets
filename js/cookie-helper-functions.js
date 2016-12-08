/**
 * Create cookie
 * http://www.quirksmode.org/js/cookies.html
 *
 * @param  {string} name  Cookie name
 * @param  {string} value Cookie value
 * @param  {integer} days  Cookie length
 */
function createCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = '; expires=' + date.toGMTString();
    } else {
        expires = '';
    }
    document.cookie = name + '=' + value + expires + '; path=/';
}

/**
 * Read cookie value
 * http://www.quirksmode.org/js/cookies.html
 *
 * @param  {string} name Cookie name
 */
function readCookie(name) {
    var nameEQ = name + '=';
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1,c.length);
        }
        if (c.indexOf(nameEQ) === 0) {
            return c.substring(nameEQ.length,c.length);
        }
    }
    return null;
}

/**
 * Delete cookie
 * http://www.quirksmode.org/js/cookies.html
 *
 * @param  {string} name Cookie name
 */
function deleteCookie(name) {
    createCookie(name, '', -1);
}
