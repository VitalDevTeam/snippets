<?php

function my_relationship_result( $title, $post, $field, $post_id ) {

	// load a custom field from this $object and show it in the $result
	$custom_data = get_field('field_name', $post->ID);

	// append to title
	$title .= ' [' . $custom_data .  ']';

	// return
	return $title;
	
}

// filter for every field
add_filter('acf/fields/relationship/result', 'my_relationship_result', 10, 4);

// filter for a specific field based on it's name
//add_filter('acf/fields/relationship/result/name=my_relationship', 'my_relationship_result', 10, 4);
