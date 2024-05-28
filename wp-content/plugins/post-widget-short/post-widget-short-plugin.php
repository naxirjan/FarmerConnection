<?php
    
    /*
    Plugin Name: Post-Type-Widgets-Shortcodes
    Plugin URI: http://www.google.com
    Description:This plugin will create widgets and their shortcodes for the custom post types. Drag & Drop the widget or put shortcode anywhere you want to shoe the posts for the custom post types.
    Version:1.0
    Author:Nazir Ahmed
    */




    require_once('archive-widget.php');
    require_once('comment-widget.php');
    require_once('tag-widget.php');
    require_once('search-widget.php');
    //require_once('posttype-shortcodes.php');


    function register_the_widgets()
    {
        register_widget("Archive_Widgets_Class");
        register_widget("Comment_Widgets_Class");
        register_widget("Tag_Widgets_Class");
        register_widget("Search_Widgets_Class");
    }

    /*function show_custom_widget() {   
    the_widget('Archive_Widgets_Class'); 
    }
    add_shortcode("sc_archive_widget",'show_custom_widget');
    */



    add_action('widgets_init','register_the_widgets');
    

?>