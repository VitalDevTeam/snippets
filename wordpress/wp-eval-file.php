<?php
/**
 * WP-CLI EVAL FILE
 *
 * Command: wp eval-file wpcli.php {run}
 *
 * Usage: If the 'run' argument is passed, this script will
 * process the RUN block. Otherwise it will process the DRY RUN.
 *
 * https://github.com/wp-cli/wp-cli/wiki/API
 */

$run = false;

/**
 * Check for run argument
 */
if (!empty($args) && isset($args[0])) {
    if ($args[0] === 'run') {
        $run = true;
    }
}

/**
 * Our process
 */
$query = new WP_Query(array(
    'post_type'        => 'post',
    'posts_per_page'   => -1
));

if ($query->have_posts()):

    while ($query->have_posts()): $query->the_post();

        $title = get_the_title();

        // DRY RUN
        if ($run === false):

            $message = "Post title: $title";
            WP_CLI::line(WP_CLI::colorize("%RDry Run:%n $message"));

        // RUN
        else:

            WP_CLI::success("Post title set to: $title");

        endif;

    endwhile;

endif;
?>