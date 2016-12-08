<?php
// Adjust rand(0,255) if you want to keep the color lighter or darker. Good to use in a loop to make random marker colors, etc.
$color = '#'.str_pad(dechex(rand(0,255)), 2, 0).str_pad(dechex(rand(0,255)), 2, 0).str_pad(dechex(rand(0,255)), 2, 0);
?>