<?php
// Get all JPGs in the image directory
$files = glob('_img/*.jpg');

foreach ($files as $file) { ?>

	<img src="<?php echo $file; ?>" alt=""><br>

<?php } ?>