<?php if (have_rows('repeater')): ?>

        <?php while (have_rows('repeater')): the_row();

            $post_object = get_sub_field('post_object'); ?>

            <?php if ($post_object): ?>

                <?php $post = $post_object; setup_postdata($post); ?>

                <?php wp_reset_postdata();  ?>

            <?php endif; ?>

        <?php endwhile; ?>

<?php endif; ?>