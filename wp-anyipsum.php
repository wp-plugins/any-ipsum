<?php
/*
Plugin Name: Any Ipsum
Description: Roll your own custom lorem ipsum generator
Plugin URI: https://wordpress.org/plugins/any-ipsum/
Version: 1.0.1
Author: Pete Nelson <a href="https://twitter.com/GunGeekATX">(@GunGeekATX)</a> | <a href="options-general.php?page=anyipsum-settings">Settings</a>
Text Domain: any-ipsum
Domain Path: /lang
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// include required files
$includes = array('Generator', 'Settings', 'Core', 'Form', 'API', 'Oembed');
foreach ($includes as $include)
	require_once plugin_dir_path( __FILE__ ) . 'lib/class-WPAnyIpsum' . $include . '.php';

add_action( 'plugins_loaded', 'WPAnyIpsum_LoadTextDomain' );
if (!function_exists('WPAnyIpsum_LoadTextDomain')) {
	function WPAnyIpsum_LoadTextDomain() {
		var_dump (load_plugin_textdomain('any-ipsum', false, basename( plugin_dir_path( __FILE__ ) ) . '/lang/' ) );
	}
}


// load our classes, hook them to WordPress
if (class_exists('WPAnyIpsumCore')) {
	$WPAnyIpsumCore = new WPAnyIpsumCore();
	add_action( 'plugins_loaded', array($WPAnyIpsumCore, 'plugins_loaded') );
}


if (class_exists('WPAnyIpsumSettings')) {
	$WPAnyIpsumSettings = new WPAnyIpsumSettings();
	add_action( 'plugins_loaded', array($WPAnyIpsumSettings, 'plugins_loaded') );

	register_activation_hook( __FILE__, array($WPAnyIpsumSettings, 'activation_hook') );
}


if (class_exists('WPAnyIpsumForm')) {
	$WPAnyIpsumForm = new WPAnyIpsumForm();
	add_action( 'plugins_loaded', array($WPAnyIpsumForm, 'plugins_loaded') );
}


if (class_exists('WPAnyIpsumOEmbed')) {
	$WPAnyIpsumOEmbed = new WPAnyIpsumOEmbed();
	add_action( 'plugins_loaded', array($WPAnyIpsumOEmbed, 'plugins_loaded') );
}


if (class_exists('WPAnyIpsumAPI')) {
	$WPAnyIpsumAPI = new WPAnyIpsumAPI();
	add_action( 'plugins_loaded', array($WPAnyIpsumAPI, 'plugins_loaded') );
}
