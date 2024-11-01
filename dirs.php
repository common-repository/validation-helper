<?php
//directories
$root = dirname(dirname(dirname(dirname(__FILE__))));
if (file_exists($root . '/wp-load.php')) {
	require_once($root . '/wp-load.php'); // WP 2.6
} else {
	require_once($root . '/wp-config.php'); // Before 2.6
}

if (!defined('WP_CONTENT_DIR')) {
	define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
}
if (!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
}
if (!defined('VH_PLUGIN_DIR')) {
	define('VH_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');
}

if (!defined('VH_PLUGIN_NAME')) {
	define('VH_PLUGIN_NAME', plugin_basename(dirname(__FILE__)));
}

if (!defined('VH_PLUGIN_URL')) {
	define('VH_PLUGIN_URL', WP_CONTENT_URL . '/plugins/' . VH_PLUGIN_NAME);
}


?>
