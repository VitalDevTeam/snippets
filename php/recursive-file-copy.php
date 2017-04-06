<?php
/** Use to copy an entire folder of files at once */
function recurse_copy($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst);

    while(false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            $srcf = sprintf('%s/%s', $src, $file);
            $dstf = sprintf('%s/%s', $dst, $file);

            if (is_dir($srcf)) {
                recurse_copy($srcf, $dstf);
            }
            else {
                copy($srcf, $dstf);
            }
        }
    }
    closedir($dir);
}
?>