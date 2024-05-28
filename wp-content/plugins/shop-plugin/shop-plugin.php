<?php
ini_set("display_errors","Off");
	/*
		Plugin Name:Ecommerce
		Plugin URI:http://histpk.org
		Author:Nazir Ahmed
		Author URI:lms.histpk.org
		Version:1.0
        Description:This Will Install E-Commerce Plugin				
	*/
        require_once("shop-postype-texanomy.php");
       require_once("shop-admin-pages.php");

   
       add_action("init","shop_posttype_texonomy");

 
        if(is_admin())
        {
            add_action("admin_menu","add_shop_admin_pages");
            add_action("admin_init","add_shop_option_settings");			
        }


     
 function add_bootstrap(){
       
       
     
     
     /*Bootstrap.CSS*/
         wp_register_style('bootstrap', plugins_url( 'csss/bootstrap.min.css', __FILE__ ));
        $dependencies = array('bootstrap');
        wp_enqueue_style('bootstraps_set_style', get_stylesheet_uri(), $dependencies ); 

         
        /*Bootstrap.JS Lib*/
        $dependencies = array('jquery');
        wp_enqueue_script('bootstrap',  plugins_url('jss/bootstrap.min.js', __FILE__ ), $dependencies, '4.1.3', true );
    
     
  }

        add_action('admin_enqueue_scripts','add_bootstrap');


        /*Create Tables*/				
        function create_tables() {
            global $wpdb;
                $table_cart = $wpdb->prefix . "cart";
                $table_cart_product = $wpdb->prefix . "cart_product";
                $table_user_order = $wpdb->prefix . "user_order";
                $table_city = $wpdb->prefix . "city";
                $table_pay_method = $wpdb->prefix . "pay_method";

                // create the ECPT metabox database table
                if($wpdb->get_var("show tables like '$wpdb->dbname'") != $wpdb->dbname) 
                {
                    $sql1 = "CREATE TABLE " . $table_cart . " (
                     `cart_id` int(11) NOT NULL AUTO_INCREMENT,
                      `user_id` int(11) DEFAULT NULL,
                      `status` tinyint(1) DEFAULT '0',
                      PRIMARY KEY (`cart_id`),
                      KEY `user_id` (`user_id`)
                    );";

                    $sql1 .= "CREATE TABLE " . $table_cart_product . " (
                     `cart_product_id` int(11) NOT NULL AUTO_INCREMENT,
                      `cart_id` int(11) DEFAULT NULL,
                      `product_id` int(11) DEFAULT NULL,
                      `quantity` int(11) DEFAULT NULL,
                      PRIMARY KEY (`cart_product_id`)
                    );";

                    $sql1 .= "CREATE TABLE " . $table_user_order . " (
                      `order_id` int(11) NOT NULL AUTO_INCREMENT,
                      `cart_id` int(11) DEFAULT NULL,
                      `payment_id` int(11) DEFAULT NULL,
                      `city_id` int(11) DEFAULT NULL,
                      `order_date` varchar(30) DEFAULT NULL,
                      `delivery_date` varchar(30) DEFAULT NULL,
                      `shipping_address` varchar(300) DEFAULT NULL,
                      `billing_address` varchar(300) DEFAULT NULL,
                      `status` enum('pending','cancelled','delivered','processed') DEFAULT 'pending',
                      PRIMARY KEY (`order_id`)

                    );";


                    $sql1 .= "CREATE TABLE " . $table_city . " (
                      `city_id` int(11) NOT NULL AUTO_INCREMENT,
                      `city` varchar(50) DEFAULT NULL,
                      PRIMARY KEY (`city_id`)

                    );";


                    $sql1 .= "CREATE TABLE " . $table_pay_method . " (
                     `payment_id` int(11) NOT NULL AUTO_INCREMENT,
                      `method` varchar(50) DEFAULT NULL,
                      PRIMARY KEY (`payment_id`)
                    );";


                    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

                   dbDelta($sql1);

                }

            }
            // run the install scripts upon plugin activation
            register_activation_hook(__FILE__,'create_tables');

        ?>