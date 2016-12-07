<?php
/**
 * Customize radio button and checkbox input markup.
 * Hides the input element so we can use the CSS label hack to
 * customize the look of the radio buttons and checkboxes.
 */
function vtl_gform_choice_markup($choice_markup, $choice, $field, $value) {
    if ($field->get_input_type() === 'radio') {
        return str_replace("type='radio'", "type='radio' class='screen-reader-text'", $choice_markup);
    } elseif ($field->get_input_type() === 'checkbox') {
        return str_replace("type='checkbox'", "type='checkbox' class='screen-reader-text'", $choice_markup);
    }

    return $choice_markup;
}
if (!is_admin()) {
    add_filter('gform_field_choice_markup_pre_render', 'vtl_gform_choice_markup', 10, 4);
}

/**
 * Customize radio button and checkbox label markup
 */
function vtl_gform_choice_label_markup($input, $field, $value, $lead_id, $form_id) {

    // Radio button markup
    if ($field->type === 'radio') {
        $markup = '<span class="gform-custom-radio-input"></span>';
    }

    // Checkbox markup
    if ($field->type === 'checkbox') {
        $markup = '<span class="gform-custom-checkbox-input"></span>';
    }

    // Add markup to label
    if ($field->type === 'radio' || $field->type === 'checkbox') {
        $choices = $field->choices;
        for ($i=0; $i < count($choices); $i++) {
            $choices[$i]['text'] .= $markup;
        }
        $field->choices = $choices;
    }
    return $input;
}
if (!is_admin()) {
    add_filter('gform_field_input', 'vtl_gform_choice_label_markup', 10, 5);
}