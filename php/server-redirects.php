<?php
if (!function_exists('redirect')) {
	function redirect($url, $status_code = 301) {
		header('Location: ' . $url, true, $status_code);
		exit();
	}
}

if (isset($_ENV['PANTHEON_ENVIRONMENT']) && (php_sapi_name() != 'cli')) {
	$https_set = $_SERVER['HTTPS'] ?? false;
	$site_protocol = ($https_set === 'on') ? 'https://' : 'http://';

	if ($_ENV['PANTHEON_ENVIRONMENT'] === 'live') {
		$site_domain = 'productionsite.com';
	} else {
		$site_domain = $_SERVER['HTTP_HOST'];
	}

	// Force HTTPS
	if ($https_set === 'off') {
		redirect('https://' . $site_domain . $_SERVER['REQUEST_URI']);
	}

	// Force non-www domain and HTTPS
	if (substr($site_domain, 0, 4) === 'www.') {
		$site_domain = str_replace('www.', '', $site_domain);
		redirect('https://' . $site_domain . $_SERVER['REQUEST_URI']);
	}

	// Force www domain and HTTPS
	// if (substr($site_domain, 0, 4) !== 'www.') {
	// 	redirect('https://www.' . $site_domain . $_SERVER['REQUEST_URI']);
	// }

	// Match hostname with OR without www
	if (preg_match('/(www\.)?anotherdomain\.com/', $site_domain) === 1) {
		redirect($site_protocol . $site_domain . $_SERVER['REQUEST_URI']);
	}

	// Match multiple subdomains
	if (in_array($_SERVER['REQUEST_URI'], [
		'sub1.example.com',
		'sub2.example.com',
		'sub3.example.com',
		'sub4.example.com',
	])) {
		redirect($site_protocol . $site_domain . '/new-path-for-all/');
	}

	// Match multiple paths
	if (in_array($_SERVER['REQUEST_URI'], [
		'/old',
		'/another/path',
		'/old-path',
	])) {
		redirect($site_protocol . $site_domain . '/new-path-for-all/');
	}

	// Match one path
	if ($_SERVER['REQUEST_URI'] === '/old') {
		redirect($site_protocol . $site_domain . '/new-path/');
	}

	// Match one path, trailing slash optional
	if (preg_match('/\/requested-path(\/)?/', $_SERVER['REQUEST_URI']) === 1) {
		redirect($site_protocol . $site_domain . '/new-path/');
	}

	// Match entire path directory
	if (preg_match('/\/requested-path(.*)/', $_SERVER['REQUEST_URI']) === 1) {
		redirect($site_protocol . $site_domain . '/new-path/');
	}

	// Match URL parameter specific value
	if (isset($_GET['foo']) && $_GET['foo'] === 'bar') {
		redirect($site_protocol . $site_domain . '/new-path/');
	}

	// Match URL parameter exists
	if (isset($_GET['foo'])) {
		redirect($site_protocol . $site_domain . '/new-path/');
	}

	// Match URL that has any parameter
	if (!empty($_GET)) {
		redirect($site_protocol . $site_domain . '/new-path/');
	}

	// Match one path (loop)
	switch ($_SERVER['REQUEST_URI']) {
		case '/foo/':
			redirect($site_protocol . $site_domain . '/bar/');
			break;

		case '/foo2/':
			redirect($site_protocol . $site_domain . '/bar2/');
			break;

		default:
			break;
	}

	// Redirect match URL to URL (loop)
	$redirect_match = [
		'/\/foo\/(.*)/' => '/bar/',
	];

	foreach ($redirect_match as $pattern => $redirect) {

		if (preg_match($pattern, $_SERVER['REQUEST_URI'], $matches)) {
			if ($matches[1]) {
				$redirect = $redirect . $matches[1];
				$new_request_uri = preg_replace($pattern, $redirect, $_SERVER['REQUEST_URI']);
				$new_url = $site_protocol . $_SERVER['HTTP_HOST'] . $new_request_uri;
				redirect($new_url);
			}
		}
	}

}
