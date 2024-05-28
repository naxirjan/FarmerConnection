<?php
	/*
		Plugin Name:Google Map
		Plugin URI:http://histpk.org
		Author:Nazir Ahmed
		Author URI:lms.histpk.org
		Version:1.0
        Description:This Will Install Google Map				
	*/
        ob_start();

	   require_once("map-widget.php");
       require_once("admin-pages.php");

    function register_map_widget()
	{
		register_widget("Map_Widget_Class");		
	}
	
    //Media Upload
     function scripts()
    {
        wp_enqueue_media(); 
        wp_enqueue_script("media-upload");
        wp_enqueue_script("upload-script",plugin_dir_url(__FILE__)."/js/upload-script.js",array("jquery")); 
     }


    //Making Shortcode
   /* function show_googlemap_widget() { 
   ob_start();
    the_widget('Map_Widget_Class');
    $contents = ob_get_clean();
    echo $contents;
    }
    add_shortcode("sc_google_map_widget",'show_googlemap_widget');
    */

     //add_shortcode("sc_google_map_widget",array('Map_Widget_Class','set_google_map_marker'));



	add_action("widgets_init","register_map_widget");
	add_action("admin_enqueue_scripts","scripts");
    
	if(is_admin())
	{
		add_action("admin_menu","add_admin_pages");
		add_action("admin_init","add_map_option_settings");			
	}
ob_clean();
?>