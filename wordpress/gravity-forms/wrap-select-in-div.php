<?php
/**
 * Wrap select inputs in div so we can style them using a techinque like: http://codepen.io/adamwalter/pen/BLojBb
 */
function vital_gform_select_wrap($content, $field, $value, $lead_id, $form_id) {
    if ($field->type === 'select' || $field->type === 'address') {
        $content = str_replace('<select', '<div class="gform_styled_select"><select', $content);
        $content = str_replace('</select>', '</select><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 36.5"><path d="M32 36.5c-1.1 0-2.3-.4-3.2-1.3L1.3 7.7c-1.8-1.8-1.8-4.6 0-6.3C3-.3 5.9-.3 7.6 1.4L32 25.7 56.3 1.3c1.8-1.7 4.6-1.7 6.3 0 1.8 1.7 1.8 4.6 0 6.3L35.2 35.2c-.9.8-2.1 1.3-3.2 1.3z"/></svg></span></div>', $content);
    }
    return $content;
}

if (!is_admin()) {
    add_filter('gform_field_content', 'vital_gform_select_wrap', 10, 5);
}
