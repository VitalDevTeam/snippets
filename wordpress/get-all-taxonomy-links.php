<?php
/**
 * Get taxonomies terms links.
 *
 * @see get_object_taxonomies()
 */
function custom_taxonomies_terms_links() {
    // Get post by post ID.
    $post = get_post( $post->ID );

    // Get post type by post.
    $post_type = $post->post_type;

    // Get post type taxonomies.
    $taxonomies = get_object_taxonomies( $post_type, 'objects' );

    $out = array();
    $out[] = '<div class="tag-block">';

    foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

        // Get the terms related to post.
        $terms = get_the_terms( $post->ID, $taxonomy_slug );

        if ( ! empty( $terms ) ) {

            foreach ( $terms as $term ) {
                $out[] = sprintf( '<a class="tag" href="%1$s">%2$s</a>',
                    esc_url( get_term_link( $term->slug, $taxonomy_slug ) ),
                    esc_html( $term->name )
                );
            }

        }
    }

    $out[] = "\n</div>\n";
    return implode( '', $out );
}
?>
