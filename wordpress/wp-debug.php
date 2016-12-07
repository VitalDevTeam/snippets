<?php

/**
* Debugging (Development)
*/

// Enable WordPress debugging (NEVER LEAVE ENABLED ON PRODUCTION SITES!)
define('WP_DEBUG', true);
// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);
// Disable display of errors and warnings
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);
// Save Database Queries for later analysis
// define('SAVEQUERIES', true);
// Use non-minified core styles and scripts
// define('SCRIPT_DEBUG', true);

/**
 * Debugging (Production)
 */
// Disable PHP error reporting
// error_reporting(0);
// @ini_set(‘display_errors’, 0);

?>