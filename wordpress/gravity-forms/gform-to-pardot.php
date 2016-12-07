<?php
/**
 * Post Gravity Form data to Pardot
 */
function gform_post_to_pardot($entry, $form) {

    $post_url = 'https://go.pardot.com/l/12345/2015-09-18/123abc'; // Pardot URL
    $body = array(
        'email' => rgar($entry, '1'),
    );

    $request = new WP_Http();
    $response = $request->post($post_url, array('body' => $body));

}

// Add function to form ID #2 (or whichever form you need)
add_action('gform_after_submission_2', 'gform_post_to_pardot', 10, 2);