<?php
  $paged = max(get_query_var('page'), 1);
  $query = new WP_Query( array(
      'post_type'        => 'posts',
      'posts_per_page'   => 3,
      'paged'            => $paged
  ));
?>

<?php if ($query->have_posts()) : ?>

    <?php while ($query->have_posts()) : $query->the_post(); ?>

        <!-- run the loop -->

    <?php endwhile; ?>


    <?php if ($query->max_num_pages > 1) {  ?>
        <div class="pagination">
            <div class="prev-posts-link">
                <?php echo get_next_posts_link('Older Entries &rarr;', $query->max_num_pages);?>
            </div>
            <div class="next-posts-link">
                <?php echo get_previous_posts_link('&larr; Newer Entries'); ?>
            </div>
        </div>
    <?php } ?>

<?php endif; ?>