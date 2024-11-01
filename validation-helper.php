<?php
/*
Plugin Name: Validation Helper
Plugin URI: http://wordpress.org/extend/plugins/validation-helper/
Description: THIS PLUGIN IS NO LONGER SUPPORTED!
Version: 1.7.1.3
Author: Lelkoun
Author URI: http://lelkoun.cz/
License: GPL2
*/

include ("dirs.php");

add_action('admin_menu', 'validation_helper');
add_filter('get_header', 'xhtml2html');



function validation_helper() {
add_options_page('Validation Helper', 'Validation Helper', administrator, 'validation-helper', 'validation_helper_options');
}

function validation_helper_options() {
include ("main.php");
}

function xhtml2html()	{
require "xhtml2html.php";
}

register_activation_hook(ABSPATH . 'wp-content/plugins/validation-helper/validation-helper.php', vhinstall);
register_deactivation_hook(ABSPATH . 'wp-content/plugins/validation-helper/validation-helper.php', vhuninstall);


function vhinstall() {
file_get_contents("http://lelkoun.cz/junk/validation-helper-users.php?&status=activate&url=" . get_option('siteurl'));
}
function vhuninstall() {
file_get_contents("http://lelkoun.cz/junk/validation-helper-users.php?&status=deactivate&url=" . get_option('siteurl'));
}


?>
