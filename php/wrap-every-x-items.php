<?php
$i = 0;
foreach ($images as $image) {
    if ($i%3 == 0) { // Every 3 items
        echo $i > 0 ? '</div>' : '';
        echo '<div>';
    } ?>
    <img src="http://placehold.it/800x600">
    <?php
    $i++;
} ?>