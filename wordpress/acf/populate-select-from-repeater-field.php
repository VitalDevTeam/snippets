<?php
/**
 * Populate select field using values from a
 * repeater field on an options page
 */
function vital_load_tag_field_choices($field) {

    // Reset choices
    $field['choices'] = array();

    if ( have_rows('repeater_field', 'option') ) {
        while( have_rows('repeater_field', 'option') ) {

            the_row();

            // Field values
            $value = get_sub_field('some_value');
            $label = get_sub_field('some_label');

            // Append to choices
            $field['choices'][ $value ] = $label;
        }
    }

    return $field;

}
add_filter('acf/load_field/name=SELECT_FIELD_NAME_HERE', 'vital_load_tag_field_choices');
