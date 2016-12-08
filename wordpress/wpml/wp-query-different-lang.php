<?php
$other_lang = new WP_Query(array(
    'post_type' => 'post',
    'tax_query' => array(
        array(
            'taxonomy' => 'territory',
            'field' => 'id',
            'terms' => $query['id']
        )
    ),
    'suppress_filters' => true // This argument must be used
    )
);