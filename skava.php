<?php
/**
 * @package Skava
 * @version 1.0
 */
/*
Plugin Name: Skava
Plugin URI: http://williamwilkerson.me
Description: This is a collection of class libraries useful for wordpress
Author: William Wilkerson
Version: 1.0
Author URI: https://usterix.com
Text Domain: skava
*/
/**
 * Skava
 *
 * This library exist as a way to abstract out common wordpress functions and make them more oject oriented.
 *
 * Thrid Party Libs used.
 * --TGM Plugin Activation by Thomas Griffin (thomasgriffinmedia.com)
 *
 * Classes available for use
 * -Assets Base Class
 * --Style Registration Class
 * --Script Registration Class
 * -Category Class
 * -Content Class
 * -Customizer Class
 * -Menu Class
 * -Page Class
 * -Post Class (Incomplete) as of 11-7-14
 * -Provision Class
 * -Sidebar Class
 *
 * @author  William Wilkerson <william@usterix.com>
 *
 * @since   1.0
 *
 */
require_once 'lib/class-tgm-plugin-activation.php';
define("MYPLUGIN_DIR", plugin_dir_path(__FILE__));
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}
