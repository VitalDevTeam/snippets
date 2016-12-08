jQuery('.ginput_container label').each(function(i,e) {
    var fielddesc = jQuery('<div>').append(jQuery(e).clone()).remove().html();
    jQuery(e).siblings('.ginput_container input:text').before(fielddesc); //moves sub label above input fields
    jQuery(e).siblings('.ginput_container select').before(fielddesc); //moves sub label above select fields (e.g. country drop-down)
    jQuery(e).siblings('.ginput_container .gfield_radio input').after(fielddesc); //keep label above radio buttons
    jQuery(e).siblings('.ginput_container .gfield_checkbox input').after(fielddesc); //keep label above checkboxes
    jQuery(e).remove();
});