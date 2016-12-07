<?php
/**
 *
 *	Simple WordPress loop for selecting ACF flexible content fields
 *	1. Name each layout field: block_your_block_name
 *	2. Name each template part file: block-your_block_name.php
 *	The use of the hyphen in the file name is intentional. get_template_part()
 *	can take a prefix in its first argument. This prefix is then used to locate
 *	your file, but like all WP templates it uses the pattern of "prefix-", not
 *	underscore, hence this naming convention.
 *
 */

if (have_rows('global_layouts')):

    while (have_rows('global_layouts')) : the_row();

        // Get layout name
        $layout = get_row_layout();

        // Remove "block_" prefix
        $layout = substr($layout, 6);

        // We can now use get_template_part()'s brains to
        // intelligently choose the right file!
        get_template_part('blocks/block', $layout);

    endwhile;

endif;