<?php
$description = get_field('descripton');
if( strpos($description, '<!--more-->') >= 1 ) {
        $more_position = 11 + strpos($description, '<!--more-->');
        $before_more = substr($description, 0, $more_position);
        $after_more = substr($description, $more_position); ?>
<div class="excerpt">
    <?php echo $before_more; ?>
</div>
<div class="read-more">
    <?php echo $after_more; ?>
</div>
<?php } else {
    the_field('description');
} ?>