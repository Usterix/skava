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
Author URI: http://williamwilkerson.me
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
 * @author  William Wilkerson <william.wilkerson4@gmail.com>
 *
 * @since   1.0
 *
 */
require_once 'lib/class-tgm-plugin-activation.php';
define("MYPLUGIN_DIR", plugin_dir_path(__FILE__));

function skavaAutoLoader($className)
{
    if (substr($className, 0, strlen("Skava\\")) === "Skava\\") {
        $classNameShort = str_replace("\\", "/", substr($className, strlen("Skava\\")));
        $classNameShort = strtolower($classNameShort);
        $path = MYPLUGIN_DIR . "classes/$classNameShort.php";
        require $path;
    }
}
spl_autoload_register('skavaAutoLoader');
