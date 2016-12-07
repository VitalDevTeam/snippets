<!-- Process form POST or GET requests through WordPress -->

<!-- Form action points to admin-post.php -->
<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="GET">
	<label for="name">Text Field</label>
	<input type="text" name="mytextfield">

	<!-- Hidden field value tells WordPress which action to use -->
    <input type="hidden" name="action" value="custom_search">

	<button type="submit" name="submit" value="submit">Submit</button>
</form>

<?php
// Form handler takes submitted form data, assembles into URL query string,
// and redirects to a results page. This is just one action example. You can
// do anything you want with your form data.
function search_handler() {

    if (isset($_GET['submit'])) {

        $vars = array();

        if (isset($_GET['mytextfield'])) {
			// Sanitize ALL user input!!@
            $vars['mytextfield'] = htmlspecialchars($_GET['mytextfield'], ENT_QUOTES);
        }

        $query = http_build_query($vars);

        wp_redirect($redirect_base . '?' . $query, 302);

    } else {
		die();
	}
}

// Action's first argument is appended with our form's hidden field value.
// Second argument is our PHP function to handle the form request.
add_action('admin_post_nopriv_custom_search', 'search_handler');
add_action('admin_post_custom_search', 'search_handler');
