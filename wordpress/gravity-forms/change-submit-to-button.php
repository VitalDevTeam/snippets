<?php
/**
 * Change Gravity Forms default submit button to button element
 */
function vtl_gform_submit_button($button, $form) {
    return '<button id="" class="form_button"><span>' . $form['button']['text'] . '<span class="icon-paperplane-fill"></span></span></button>';
}

add_filter('gform_submit_button', 'vtl_gform_submit_button', 10, 2);