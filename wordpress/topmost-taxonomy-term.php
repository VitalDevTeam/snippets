<?php
/**
 * Get the topmost taxonomy term
 * @param  [integer] $term_id  Term ID
 * @param  [string] $taxonomy  Term's taxonomy
 * @return [integer]           Term's topmost parent term ID
 */
function get_term_top_most_parent($term_id, $taxonomy){
    // start from the current term
    $parent  = get_term_by( 'id', $term_id, $taxonomy);
    // climb up the hierarchy until we reach a term with parent = '0'
    while ($parent->parent != '0'){
        $term_id = $parent->parent;

        $parent  = get_term_by( 'id', $term_id, $taxonomy);
    }
    return $parent->term_id;
}