<?php
/**
 * Enqueue our JS file on custom post edit screen
 */
function add_admin_scripts( $hook ) {
    $currentScreen = get_current_screen();
    if ($currentScreen->id === 'widget' ) { // Your post type's slug
        wp_enqueue_script('custom_acf_conditionals', get_template_directory_uri() . '/scripts/site/custom-acf-conditions.js', array('jquery'), null, true);
    }
}

add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );
?>

<script>
/*
 * This is quick and dirty. Could be much more streamlined and dynamic
 * as well as account for required fields
 */
jQuery(document).ready(function ($) {

    var $taxMetabox = $('#taxonomy-type'), // ID of your tax's metabox
        $taxOptions = $taxMetabox.find('input:checkbox');

    function evaluateTerms() {

        // Get all checked boxes
        var checked = $taxMetabox.find('input:checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        // Hide/show field(s)
        if ($.inArray('191', checked) > -1 ) {
            // We'll use the ACF field ID class which never changes, even if field is renamed
            $('.acf-field-560ea9c84a49c').show();
        } else {
            $('.acf-field-560ea9c84a49c').hide();
        }

    }

    // Evaluate on checkbox change
    $taxOptions.change(function(event) {
        evaluateTerms();
    });

    // Evalulate on page load
    $(window).on('load', function() {
        evaluateTerms();
    });

});
</script>