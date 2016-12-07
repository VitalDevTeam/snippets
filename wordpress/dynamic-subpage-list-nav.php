<?php
/*  ==========================================================================
     FUNCTIONS.PHP
    ==========================================================================  */

/**
 * Get ID of current page parent
 */
function get_post_top_ancestor_id() {
    global $post;
    if ($post->post_parent) {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }
    return $post->ID;
}


/*  ==========================================================================
     YOUR TEMPLATE OR PART (WITHIN THE LOOP)
    ==========================================================================  */

$current_page = get_the_ID();
$parent       = get_post_top_ancestor_id();
$exclude      = array($current_page);

$pages = new WP_Query(array(
    'post_parent'    => $parent,
    'post__not_in'   => $exclude,
    'post_type'      => 'page',
    'posts_per_page' => -1,
));

$count = $pages->found_posts;

// Add 1 to the count if we're NOT on the parent page and will be
// showing it in our page list
if ($current_page !== $parent) {
	$count++;
}

if ($pages->have_posts()) : ?>

	<ul class="count-<?php echo $count; ?>">

		<?php
		//  The query doesn't return the parent page itself.
		//  If we're NOT currently on the parent page, show it in the nav:
		if ($current_page !== $parent) { ?>

	    	<li>
		        <h3><a href="<?php echo get_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a></h3>
		        <p><?php the_field('custom_field', $parent); ?></p>
	    	</li>

	    <?php }

	    while ($pages->have_posts()) : $pages->the_post(); ?>

	    	<li>
		        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		        <p><?php the_field('custom_field'); ?></p>
	    	</li>

        <?php endwhile; ?>

	</ul>

<?php endif; wp_reset_postdata(); ?>