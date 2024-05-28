<?php
/*
Plugin Name: Best Slider 
Plugin URI: https://wordpress.org/
Description: Used by millions, This will install best slider inside your theme.
Version: 1.0
Author: Nazir Ahmed Mallah
Author URI: https://wordpress.org/
License: GPLv2 or later
*/
ob_start();
//About Us Widget
require_once("slider-widget.php");


//Plugin Admin Pages
require_once("slider-admin-pages.php");




function register_slider_widget()
{
    register_widget("Slider__Widget_Class");
    
}


     function js_scripts()
    {
        wp_enqueue_script("media-upload");
        wp_enqueue_media();
        wp_enqueue_script("upload-script",plugin_dir_url(__FILE__)."/js/upload-script.js",array("jquery"));
        wp_enqueue_script("slider-color-script",plugin_dir_url(__FILE__)."/js/jscolor.js",array("jquery"));
     }


            if(is_admin())
            {
                add_action("admin_init","add_slider_options_settings");
                add_action("admin_menu","add_slider_admin_pages");

            }

            add_action("widgets_init","register_slider_widget");
            add_action("admin_enqueue_scripts","js_scripts");
ob_clean();
?>