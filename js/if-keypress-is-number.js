/**
 * Check of key pressed is a number
 */
function isNumber(event) {
    if (event) {
      var charCode = (event.which) ? event.which : event.keyCode;
      if (charCode !== 190 && charCode > 31 &&
         (charCode < 48 || charCode > 57) &&
         (charCode < 96 || charCode > 105) &&
         (charCode < 37 || charCode > 40) &&
          charCode !== 110 && charCode !== 8 && charCode !== 46 ) {
              return false;
          }
    }
    return true;
}