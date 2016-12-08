<?php
$pagelist = get_pages('sort_column=menu_order&amp;sort_order=asc&amp;child_of='.$post->post_parent);
$pages = array();
foreach ($pagelist as $page) {
       $pages[] += $page->ID;
}
$current = array_search($post->ID, $pages);
$prevID = $pages[$current-1];
$nextID = $pages[$current+1];
if (!empty($prevID)) { ?>
       <a href="<?php echo get_permalink($prevID); ?>" title="<?php echo get_the_title($prevID); ?>">Previous</a>
<?php } if (!empty($nextID)) { ?>
       <a href="<?php echo get_permalink($nextID); ?>" title="<?php echo get_the_title($nextID); ?>">Next</a>
<?php } ?>