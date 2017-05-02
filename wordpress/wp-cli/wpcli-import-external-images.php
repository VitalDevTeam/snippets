<?php
/**
 * WP-CLI EVAL FILE
 * Imports external images/documents. DON'T just run this as-is. Look for "EDIT ME!" comments
 * below to customize what content this script processes. MAKE A BACKUP BEFORE RUNNING!!@
 */

function is_external_file($file) {

    $allowed = array('jpeg', 'png', 'bmp', 'gif',  'pdf', 'jpg', 'doc', 'docx');

    $ext = pathinfo($file, PATHINFO_EXTENSION);

    if (in_array(strtolower($ext), $allowed)) {
        return true;
    }

    return false;
}

function external_image_get_img_tags($content) {

    $s = get_option('siteurl');
    $result = array();

    preg_match_all('/<img[^>]* src=[\'"]?([^>\'"]+)/', $content, $matches);
    preg_match_all('/<a[^>]* href=[\'"]?([^>\'"]+)/', $content, $matches2);

    $matches[0] = array_merge($matches[0], $matches2[0]);
    $matches[1] = array_merge($matches[1], $matches2[1]);

    for ($i = 0; $i < count($matches[0]); $i++) {
        $uri = $matches[1][$i];
        $path_parts = pathinfo($uri);

        // Exclude images from these domains
        $excludes = array(
            'example.com',
            'example2.com'
        );

        // Check all excluded urls
        if (is_array($excludes)) {
            foreach($excludes as $exclude) {
                $trim = trim($exclude);
                if ($trim != '' && strpos($uri, $trim) != false)
                    $uri = '';
            }
        }

        // Only check FQDNs
        if ($uri != '' && preg_match('/^https?:\/\//', $uri)) {

            // Make sure it's external
            if ($s != substr($uri, 0, strlen($s)) && (!isset($mapped) || $mapped != substr($uri, 0, strlen($mapped)))) {
                $path_parts['extension'] = (isset($path_parts['extension'])) ? strtolower($path_parts['extension']) : false;
                if (in_array($path_parts['extension'], array('gif', 'jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx')))
                    $result[] = $uri;
            }
        }
    }

    $result = array_unique($result);

    return $result;
}

function external_image_sideload($file, $post_id, $desc = '') {

    if (!empty($file) && is_external_file($file)) {
        // Download file to temp location
        $tmp = download_url($file);

        // Set variables for storage
        // fix file filename for query strings
        preg_match('/[^\?]+\.(jpg|jpeg|gif|png|pdf|doc|docx)/i', $file, $matches);
        $file_array['name'] = basename($matches[0]);
        $file_array['tmp_name'] = $tmp;

        // If error storing temporarily, unlink
        if (is_wp_error($tmp)) {
            @unlink($file_array['tmp_name']);
            $file_array['tmp_name'] = '';
            return false;
        }
        $desc = $file_array['name'];
        // do the validation and storage stuff
        $id = media_handle_sideload($file_array, $post_id, $desc);
        // If error storing permanently, unlink
        if (is_wp_error($id)) {
            @unlink($file_array['tmp_name']);
            return false;
        } else {
            $src = wp_get_attachment_url($id);
        }

    }

    if (!empty($src) && is_external_file($src))
        return $src;
    else
        return false;
}

// EDIT ME! Initial WP_Query and loop
$query = new WP_Query(array(
    'post_type'        => 'page',
    'posts_per_page'   => -1
));

if ($query->have_posts()):

    while ($query->have_posts()): $query->the_post();

        if (have_rows('blocks')): while (have_rows('blocks')) : the_row(); // EDIT ME! Flexible content loop

            if (get_row_layout() === 'block_wysiwyg'): // EDIT ME! Layout to search

                $replaced = false;
                $count = 0;
                $post_id = get_the_ID();
                $content = get_sub_field('content'); // EDIT ME! Field to search
                $imgs = external_image_get_img_tags($content);

                for ($i=0; $i < count($imgs); $i++) {

                    if (isset($imgs[$i]) && is_external_file($imgs[$i])) {

                        WP_CLI::log('Old URL:');
                        WP_CLI::log(print_r($imgs[$i]));

                        $new_img = external_image_sideload($imgs[$i], $post_id);

                        if ($new_img && is_external_file($new_img)) {

                            WP_CLI::log('New URL:');
                            WP_CLI::log($new_img);

                            $content = str_replace($imgs[$i], $new_img, $content);
                            $replaced = true;
                            $count++;
                        }
                    }
                }

                if ($replaced) {
                    update_sub_field('content', $content); // EDIT ME! Field to update
        			_fix_attachment_links($post_id);
        			$response = $count;
        		} else {
        			$response = false;
        		}

            endif;

        endwhile; endif;

    endwhile;

    WP_CLI::success('Media import complete.');

endif;
?>
