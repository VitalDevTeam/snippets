<?php
/**
 *	Simple RSS feed
 *
 *	Retrieves an external feed and parses it. Uses the SimplePie and FeedCache
 * 	functionality for retrieval and parsing and automatic caching.
 *
 *	https://codex.wordpress.org/Function_Reference/fetch_feed
**/

$feed = 'http://example.com/feed';
$rss = fetch_feed($feed);
$maxitems = 0;

if (!is_wp_error($rss)) {

    // Get total number of items, but limit it to 5
    $maxitems = $rss->get_item_quantity(5);

    // Build an array of all the items, starting with the first element
    $rss_items = $rss->get_items(0, $maxitems);

}; ?>

<ul>
    <?php
    if ($maxitems !== 0) :
        foreach ($rss_items as $item) : ?>
            <li>
                <a href="<?php echo esc_url($item->get_permalink()); ?>"><?php echo esc_html($item->get_title()); ?> - <?php echo $item->get_date('F j, Y'); ?></a>
            </li>
        <?php endforeach;
    endif; ?>
</ul>