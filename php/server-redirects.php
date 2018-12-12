<?php
/** Redirects */

if (isset($_ENV['PANTHEON_ENVIRONMENT']) && (php_sapi_name() != 'cli')) {
	$https_set = $_SERVER['HTTPS'] ?? false;
	$site_protocol = ($https_set === 'on') ? 'https://' : 'http://';
	$status_301 = 'HTTP/1.0 301 Moved Permanently';
	$status_302 = 'HTTP/1.0 302 Moved Temporarily';

	if ($_ENV['PANTHEON_ENVIRONMENT'] === 'live') {
		$site_domain = 'productionsite.com';
	} else {
		$site_domain = $_SERVER['HTTP_HOST'];
	}

	// Force HTTPS
	if ($https_set === 'off') {
		header($status_302);
		header('Location: https://' . $site_domain . $_SERVER['REQUEST_URI']);
		exit;
	}

	// Force non-www domain and HTTPS
	if (substr($site_domain, 0, 4) === 'www.') {
		$site_domain = str_replace('www.', '', $site_domain);
		header($status_302);
		header('Location: https://' . $site_domain . $_SERVER['REQUEST_URI']);
		exit;
	}

	// Force www domain and HTTPS
	// if (substr($site_domain, 0, 4) !== 'www.') {
	// 	header($status_302);
	// 	header('Location: https://www.' . $site_domain . $_SERVER['REQUEST_URI']);
	// 	exit;
	// }

	// Match hostname with OR without www
	if (preg_match('/(www\.)?anotherdomain\.com/', $site_domain) === 1) {
		header($status_302);
		header('Location: ' . $site_protocol . $site_domain . $_SERVER['REQUEST_URI']);
		exit();
	}

	// Match multiple subdomains
	if (in_array($_SERVER['REQUEST_URI'], [
		'sub1.example.com',
		'sub2.example.com',
		'sub3.example.com',
		'sub4.example.com',
	])) {
		header($status_302);
		header('Location: ' . $site_protocol . $site_domain . '/new-path-for-all/');
		exit();
	}

	// Match multiple paths
	if (in_array($_SERVER['REQUEST_URI'], [
		'/old',
		'/another/path',
		'/old-path',
	])) {
		header($status_302);
		header('Location: ' . $site_protocol . $site_domain . '/new-path-for-all/');
		exit();
	}

	// Match one path
	if ($_SERVER['REQUEST_URI'] === '/old') {
		header($status_302);
		header('Location: ' . $site_protocol . $site_domain . '/new-path/');
		exit();
	}

	// Match one path, trailing slash optional
	if (preg_match('/\/requested-path(\/)?/', $_SERVER['REQUEST_URI']) === 1) {
		header($status_302);
		header('Location: ' . $site_protocol . $site_domain . '/new-path/');
		exit();
	}

	// Match entire path directory
	if (preg_match('/\/requested-path(.*)/', $_SERVER['REQUEST_URI']) === 1) {
		header($status_302);
		header('Location: ' . $site_protocol . $site_domain . '/new-path/');
		exit();
	}

	// Match URL parameter specific value
	if (isset($_GET['foo']) && $_GET['foo'] === 'bar') {
		header($status_302);
		header('Location: ' . $site_protocol . $site_domain . '/new-path/');
		exit();
	}

	// Match URL parameter exists
	if (isset($_GET['foo'])) {
		header($status_302);
		header('Location: ' . $site_protocol . $site_domain . '/new-path/');
		exit();
	}

	// Match URL that has any parameter
	if (!empty($_GET)) {
		header($status_302);
		header('Location: ' . $site_protocol . $site_domain . '/new-path/');
		exit();
	}

	// Name transaction "redirect" in New Relic for improved reporting (optional)
	if (extension_loaded('newrelic')) {
		newrelic_name_transaction('redirect');
	}
}

/* That's all, stop editing! Happy Pressing. */
