<?php
$style_classes = array('first', 'second', 'third', 'etc');
$styles_count = count($style_classes);
$style_index = 0;

if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="<?php $k = $style_index % $styles_count; echo "$style_classes[$k]"; $style_index++; ?>">
        <!-- etc -->
    </div>
<?php endwhile; endif; ?>