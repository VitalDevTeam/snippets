acf.add_action('append', function($el) {

    // Duplicate repeater rows when adding a new row
    var prevRow = $el.prev('tr'),
        prevRowField1 = prevRow.find('[data-name="field_name"] select').val(),
        prevRowField2 = prevRow.find('[data-name="field_name"] select').val(),
        thisRowField1 = $el.find('[data-name="field_name"] select'),
        thisRowField2 = $el.find('[data-name="field_name"] select');

    thisRowField1.val(prevRowField1);
    thisRowField2.val(prevRowField2);

});