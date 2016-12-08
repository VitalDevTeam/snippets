<?php
/**
 * Delete similar-posts transients on post save
 */
function flush_similar_posts($post_id) {
    global $wpdb;
    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '%similar-posts%'");
}
add_action('save_post', 'flush_similar_posts');

/**
 * Get simiar posts based on number of terms in common and cache results in transient
 */
function get_similar_posts($post_id, $limit = 6){
    $ret = array();
    if(!$post_id){
        return $ret;
    }

    $transient_id = "similar-posts-{$post_id}";
    $transient_data = get_transient($transient_id);

    if($transient_data){
        $ret = $transient_data;
    } else {
        global $wpdb;

        $query = $wpdb->prepare("
            SELECT ID, COUNT(*) as relevance
            FROM
            (
                SELECT {$wpdb->posts}.ID
                FROM {$wpdb->term_relationships}
                LEFT JOIN {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_relationships}.term_taxonomy_id
                LEFT JOIN {$wpdb->posts} ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id
                WHERE {$wpdb->terms}.term_id IN (
                    SELECT term_taxonomy_id FROM {$wpdb->term_relationships} WHERE object_id = %d
                ) AND {$wpdb->posts}.ID != %d
            ) as RelatedTerms
            GROUP BY ID
            ORDER BY relevance DESC
            LIMIT %d
        ", $post_id, $post_id, $limit);

        $similar_posts = $wpdb->get_col($query, 0);

        set_transient($transient_id, $similar_posts);
        $ret = $similar_posts;
    }

    return $ret;
}