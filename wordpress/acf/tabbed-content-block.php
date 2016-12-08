<?php
$count = count(get_sub_field('tabs'));
$block_index = rand(0, 100);

if (have_rows('tabs')): ?>

    <div class="block block-tabbed-section">

        <div id="tabbed-content-<?php echo $block_index; ?>" class="tabbed-content block-wrapper">

            <ul class="tabs tabs-count<?php echo $count; ?> group">

                <?php while (have_rows('tabs')): the_row();

                    $tab_href = create_slug(get_sub_field('tab_heading')); ?>

                    <li class="tab"><a class="tab-link" href="#<?php echo $tab_href; ?>"><?php the_sub_field('tab_heading'); ?></a></li>

                <?php endwhile; ?>

            </ul>

            <?php while (have_rows('tabs')): the_row();

                $tab_id = create_slug(get_sub_field('tab_heading')); ?>

                <div id="<?php echo $tab_id; ?>" class="tab-content"><?php the_sub_field('tab_contents'); ?></div>

            <?php endwhile; ?>

        </div>

    </div>

<?php endif; ?>

<script>
// Responsive Tabs Initialization
 $('[id^="tabbed-content-"]').responsiveTabs({
     startCollapsed: false,
     load: function() {
         $('.tab-content').addClass('entry');
     }
 });

 $(window).on('load', function() {
     var viewportwidth = window.innerWidth;
     if (viewportwidth < 768) {
         $('[id^="tabbed-content-"]').responsiveTabs('deactivate', 0);
     }
 });
</script>