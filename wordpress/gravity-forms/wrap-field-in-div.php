<?php
/**
 * GRAVITY FORMS SECTION SPLITTING
 *
 * Usage:
 * Opening section field can have any number of CSS classes, but must have
 * at least one. Class(es) are applied to the opening wrapper div. Closing
 * section field must not have any classes set. This closes the wrapper div.
 */
function gform_section_splits($content, $field, $value, $lead_id, $form_id) {
    if ( !IS_ADMIN ) {
        if ( $field['type'] == 'section' ) {
            // Check for CSS classes
            $field_class = explode(' ', $field['cssClass']);
            // If this section has no classes set
            if ( empty($field['cssClass']) ) {
                return '</li></div>';
            // Otherwise, open section
            } else {
                return '</li><div class="' . $field['cssClass'] . '">';
            }
        }
    }
    return $content;
}
add_filter('gform_field_content', 'gform_section_splits', 10, 5);