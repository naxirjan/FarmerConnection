<?php
    session_start();

    global $current_user;
    get_currentuserinfo();
    require_once("require/shop-cart-class.php");
    
    require_once("shopping-cart/dal_cart.php");
    require_once("shopping-cart/dal_cart_product.php");
    require_once('gallery-metabox/gallery.php');

    require_once("require/custom-posts-texanomies-class.php");
    require_once("require/theme-customization-class.php");


    /*Creating Class Objects*/
    $shop_obj       = new Shop_Session_Class();
    $cart           = new Cart_DAL();	
    $cartProduct    = new Cart_Product_DAL(); 


        /*Auto Delete Product By Date*/
                date_default_timezone_set("Asia/Karachi");
                $product_posts = new WP_Query(array(
                "post_type" =>"product",
                ));

                if($product_posts->have_posts())
                {
                    while($product_posts->have_posts()){
                    $product_posts->the_post();
                     $get_all_meta_values = get_post_custom($post->ID);

                    $date =    $get_all_meta_values["auto_remove_date"][0];
                    $date2 = date("Y-m-d"); 
                        if($date==$date2)
                        {
                            wp_delete_post($post->ID,true);
                            die();
                        }   
                    }
                }
        /*Auto Delete Product By Date*/
        

        /*Redirect to login when email or pass is wrong*/
        add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

        function my_front_end_login_fail( $username ) {
           $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
           // if there's a valid referrer, and it's not the default log-in screen
           if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
              wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
              exit;
           }
        }
        /*Redirect to login when email or pass is wrong*/


        /*Checking Account Status*/
        add_filter('wp_authenticate_user', function($user) {
            if ($user->user_status==1) {
                return $user;
            }
            return new WP_Error();
        }, 10, 2);
        /*Checking Account Status*/


        /*Setting Add Cart Functionality On User Login*/
        if(is_user_logged_in())
        {

        $res_products = $shop_obj->getSessionProducts();
        if($res_products && count($res_products) > 0)
        {					

            $result = $cart->getUserCart($current_user->ID);
            $cartID = $result[0]->cart_id;
            $cart_exist = $result[0]->cart_exist;
            if($cart_exist == 1)
            {

            $count = 0;
            foreach ($res_products as $productId => $values)
            {	

                $result = $cartProduct->getCartProduct($cartID,$productId);
                if($result)
                {

                        if($result[0]->quantity <= 0)
                        {
                            $result = $cartProduct->deleteCartProduct($cartID,$productId);
                        }
                        else
                        {
                            $quantity = $result[0]->quantity+$values['quantity']; 
                            $result = $cartProduct->updateCartProduct($cartID,$productId,$quantity);		

                        }	
                }

                else{

                    if($result[0]->quantity > 0)
                    {
                        $result = $cartProduct->addCartProduct($cartID,$productId,$values['quantity']);

                    }

                }

                if($result)
                {
                    echo $id=$productId;
                    $shop_obj->deleteProductSession($productId);
                    $count++;

                }	

            }

            }

            else if($cart_exist==0)
            {
                $result = $cart->addCart($insert_id,$current_user->ID);   
                if($result)
                {
                    $count = 0;
                    foreach ($res_products as $productId => $values)
                    {	
                        $result = $cartProduct->addCartProduct($insert_id,$productId,$values['quantity']);
                        if($result)
                        {
                            $shop_obj->deleteProductSession($productId);
                            $count++;
                        }					
                    } 

                }   
            }

         ?>
        <script type="text/javascript">
            window.location.href="<?php echo home_url();?>/place-order";
        </script>
        <?php       
        }
        }
        /*Setting Add Cart Functionality On User Login*/ 


        /*Add CSS and Bootstrap Libs*/
        function add_css_bootstrap_resources(){



            

            //jQuery Main Lib
            wp_enqueue_script('jquery-lib',get_template_directory_uri().'/js/jquery-3.3.1.js');

            
        


            //CSS File
            wp_enqueue_style('style',get_stylesheet_uri());

            /*Bootstrap.CSS*/
             wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
            $dependencies = array('bootstrap');
            wp_enqueue_style('bootstraps_set_style', get_stylesheet_uri(), $dependencies ); 


            /*Bootstrap.JS Lib*/
            $dependencies = array('jquery');
            wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', $dependencies, '4.1.3', true );
            wp_enqueue_script('bootstrap-popper', get_template_directory_uri().'/js/bootstrap-popper.js');


            
            
            //Upload Image jQuery File
             wp_enqueue_media();
             wp_enqueue_script("media-upload");
            //jQuery Main Lib
             wp_enqueue_script('file-upload',get_template_directory_uri().'/js/file-upload-script.js');

            //jQuery Validation Lib
             wp_enqueue_script('jquery-validate',get_template_directory_uri().'/js/jquery.validate.js');


               /*Datatables*/
            wp_enqueue_style('data-table-css',get_template_directory_uri()."/css/datatables.min.css");
            wp_enqueue_script('lib-1',get_template_directory_uri().'/table-libs/jquery.dataTables.min.js');
            wp_enqueue_script('lib-2',get_template_directory_uri().'/table-libs/dataTables.buttons.min.js');
            wp_enqueue_script('lib-3',get_template_directory_uri().'/table-libs/buttons.flash.min.js');
            wp_enqueue_script('lib-4',get_template_directory_uri().'/table-libs/jszip.min.js');
            wp_enqueue_script('lib-5',get_template_directory_uri().'/table-libs/pdfmake.min.js');
            wp_enqueue_script('lib-6',get_template_directory_uri().'/table-libs/vfs_fonts.js');
            wp_enqueue_script('lib-7',get_template_directory_uri().'/table-libs/buttons.html5.min.js');
            wp_enqueue_script('lib-8',get_template_directory_uri().'/table-libs/buttons.print.min.js');
            
        
            
            


        }
        /*Add CSS and Bootstrap Libs*/

        /*Set Menus, Featured Images, Image Sizes,Post Formats*/
        function setThemeSupport(){

            register_nav_menus(array(
            "header_menu" => __("Header Menu"),
            "footer_menu" => __("Footer Menu"),
            "custom_post_menu" => __("Custom Post Menu"),
            "signup_signin_menu" => __("Signup Signin Menu"),
            ));

            //Allow Featured Image
             add_theme_support("post-thumbnails");
             add_theme_support("custom-header");
             add_theme_support('custom-background');

            add_image_size("custom-thumbnail",220,150,true);
            add_image_size("custom-medium",320,250,false);
            add_image_size("custom-medium-large",420,350,true);
            add_image_size("custom-large",520,450,true);
            add_image_size("custom-full",800,550,array("left","top"));
            
            add_theme_support("post-formats",array("link","quote","aside","audio","video","image","gallery","status","chat"));  

        }
        /*Set Menus, Featured Images, Image Sizes,Post Formats*/


        /*Get Number OF Parent Header Menu Items*/
        function get_parent_page(){ 
            global $post;
            if($post->post_parent){
                $ancestors = get_post_ancestors($post->ID);
                return $ancestors[0];
            }
            return $post->ID;
        }
        /*Get Number OF Parent Header Menu Items*/


        /*Get Number OF Children Header SubMenu Items*/
        function get_page_childrens(){
            global $post;    
            $children_pages = get_pages("child_of=".$post->ID);
            return count($children_pages);
        }
        /*Get Number OF Children Header SubMenu Items*/


        //Set Theme Customization
        /*Setting Theme Customization*/
        function setThemeCustomization($wp_customize)
        {
           //Creating Object
            $theme_customization_obj = new theme_customization_class;

            /*SECTION 1 SITE COLORS*/
            $theme_customization_obj->set_section_site_colors($wp_customize);


            /*SECTION 2 WHO WE ARE*/        
            //Getting All Posts Titles and IDs for dropdown
            $my_posts_list = array("select post");
            $args = array('post_type' => 'my_team');
            $my_posts = get_posts( $args ); 
            foreach($my_posts as $my_post) {
            $my_posts_list[$my_post->ID] = $my_post->post_title;
            }  
           //calling function
            $theme_customization_obj->set_section_who_we_are($wp_customize,$my_posts_list);




            /*SECTION 3 ABOUT FUTURE HISTORY POLICY*/

            //calling function
            $theme_customization_obj->set_section_future_history_policy($wp_customize);




            /*SECTION 4 FEEDBACK /  TESTIMONAIL*/

            //Getting All Posts Titles and IDs for dropdown
            $my_posts_list = array("select post");
            $args = array('post_type' => 'testimonail',"posts_per_page"=>10);
            $my_posts = get_posts( $args ); 
            foreach($my_posts as $my_post) {
            $my_posts_list[$my_post->ID] = $my_post->post_title;
            } 

             //calling function
            $theme_customization_obj->set_section_feedback($wp_customize,$my_posts_list);




            /*SECTION 5 FOOTER AREA*/
             /* Main Section Footer*/

            //calling function
            $theme_customization_obj->set_section_footer_area($wp_customize);



            /*SECTION 6 AGRICULTURE BLOG*/

            /*Get All Custom Texanomies of Branches*/
            $cats = get_categories();
            $categories = array('Select Category');
            foreach($cats as $cat) {
            $categories[$cat->term_id] = $cat->name;
            } 

             //calling function
            $theme_customization_obj->set_section_agriculture_blog($wp_customize,$categories);              
        }
        /*Setting Theme Customization*/


        /*Setting Theme Customization CSS*/
        function setThemeCustomizationCSS()
        {
            ?>

        <style type="text/css">

               /* About Section Colors*/

                #header_background{
                    background-color: <?php echo get_theme_mod("site_header_background_color_setting");?>;
                }


                #btn-auths{
                    background-color: <?php echo get_theme_mod("site_search_button_bg_color_setting");?>;
                    color: <?php echo get_theme_mod("site_search_button_font_color_setting");?>;
                }

                Menus
                a{
                    color:<?php echo get_theme_mod("site_link_color_setting");?>
                }



                #bg-about,#bg-footer
                {
                    background-color: <?php echo get_theme_mod("site_body_bg_color_setting");?>;

                }


                body{

                    background-image: <?php get_background_image;?>;
                }

                #site_header_area span{
                    color: <?php echo get_theme_mod("site_header_text_color_setting");?>;
                }


                 /*About Section Colors*/


            </style>

    <?php
        }
        /*Setting Theme Customization CSS*/



        /*Setting Custom Posat Type*/
        function setCustomPosts()
        {
        //Creating Object    
        $cptt_class_obj = new Custom_Posts_Texanomies_Class; 

        //Calling Custom Post Types    
        $cptt_class_obj->custom_post_types();

        //Calling Custom Texanomies    
        $cptt_class_obj->custom_texanomies(); 


    }
        /*Setting Custom Posat Type*/


         /*Add Widgetds In Header,Footer,Left,Right SideBars*/
        function setWidegets()
        {

        /*Footer Area 1*/
        register_sidebar(array(
        "name"=>__("Footer Area 1","Farmer Connection"),
        "id"=>"footer_area_1", 
            ));

        /*Footer Area 2*/
        register_sidebar(array(
        "name"=>__("Footer Area 2","Farmer Connection"),
        "id"=>"footer_area_2", 
            )); 

          /*Footer Area 3*/
        register_sidebar(array(
        "name"=>__("Footer Area 3","Farmer Connection"),
        "id"=>"footer_area_3", 
            )); 


              /*Footer Area 4*/
        register_sidebar(array(
        "name"=>__("Footer Area 4","Farmer Connection"),
        "id"=>"footer_area_4", 
            )); 





         /*Header Area 1*/
        register_sidebar(array(
        "name"=>__("Header Area 1","Farmer Connection"),
        "id"=>"header_area_1",
         ));



              /*Left Area*/
        register_sidebar(array(
        "name"=>__("Left Area","Farmer Connection"),
        "id"=>"left_area", 
            )); 


        /*Right Area*/
        register_sidebar(array(
        "name"=>__("Right Area","Farmer Connection"),
        "id"=>"right_area", 
        )); 



        /*Plugin Widgets Area*/
        register_sidebar(array(
        "name"=>__("Plugin Portfolio Widget Area","Farmer Connection"),
        "id"=>"plugin_widgets_area", 
        ));     


        //Plugin Slider Area    
        register_sidebar(array(
        "name" =>__("Plugin Slider Widget Area","Farmer Connection"),
        "id"  =>"plugin_slider_area"    
        ));    


        }
        /*Add Widgetds In Header,Footer,Left,Right SideBars*/



        //Setting User Roles & Capabilities
        function set_roles_caps()
        {
   
            /*Datatables*/
            wp_enqueue_style('data-table-css',get_template_directory_uri()."/css/datatables.min.css");
            wp_enqueue_script('lib-1',get_template_directory_uri().'/table-libs/jquery.dataTables.min.js');
            wp_enqueue_script('lib-2',get_template_directory_uri().'/table-libs/dataTables.buttons.min.js');
            wp_enqueue_script('lib-3',get_template_directory_uri().'/table-libs/buttons.flash.min.js');
            wp_enqueue_script('lib-4',get_template_directory_uri().'/table-libs/jszip.min.js');
            wp_enqueue_script('lib-5',get_template_directory_uri().'/table-libs/pdfmake.min.js');
            wp_enqueue_script('lib-6',get_template_directory_uri().'/table-libs/vfs_fonts.js');
            wp_enqueue_script('lib-7',get_template_directory_uri().'/table-libs/buttons.html5.min.js');
            wp_enqueue_script('lib-8',get_template_directory_uri().'/table-libs/buttons.print.min.js');
           
?>
        
    


             <?php
            //Role
            $caps_knowledge = [
            //* Meta capabilities
            'read'                        => true,     
            'publish_knowledges'          => true,    
            'edit_knowledges'             => true,
            'delete_knowledges'           => true,
            'delete_published_knowledges' => true,
            'edit_published_knowledges'   => true,
            'read_knowledges'             => true,
            ];

            add_role('consultant', 'Consultant', $caps_knowledge); 
            //Setting Consultant Caps for knowledge-base
            $consult_role = get_role('consultant');
            $consult_role->add_cap('edit_knowledge'); 
            $consult_role->add_cap('edit_knowledges'); 
            $consult_role->add_cap('publish_knowledges'); 
            $consult_role->add_cap('read_knowledge'); 
            $consult_role->add_cap('delete_knowledge');
            $consult_role->add_cap('edit_published_knowledges');
            $consult_role->add_cap('delete_published_knowledges');
            $consult_role->add_cap("upload_files");

                 //remove_role("consultant");

            //Role
            $caps_academic = [
            //* Meta capabilities
            'read'                        => true,
            ];
            add_role('academic', 'Academic',$caps_academic);
            $academic_role = get_role('academic');    
            $academic_role->add_cap("read");
            
            
            //Role
            $caps_product = [
            //* Meta capabilities
            'read'                      => true,     
            'publish_products'          => true,      
            'edit_products'             => true,
            'delete_products'           => true,
            'delete_published_products' => true,
            'edit_published_products'   => true,
            'read_products'             => true,
            ];
            add_role('farmer', 'Farmer',$caps_product);


           
            //Setting Admin Caps for knowledge-base
            $admin_role = get_role("administrator");
            $admin_role->add_cap('edit_knowledge'); 
            $admin_role->add_cap('edit_knowledges'); 
            $admin_role->add_cap('edit_others_knowledges');
            $admin_role->add_cap('delete_others_knowledges'); 
            $admin_role->add_cap('publish_knowledges'); 
            $admin_role->add_cap('read_knowledge'); 
            $admin_role->add_cap('read_private_knowledges'); 
            $admin_role->add_cap('delete_knowledge');
            $admin_role->add_cap('delete_knowledges');
            $admin_role->add_cap('edit_published_knowledges');
            $admin_role->add_cap('delete_published_knowledges'); 


    }
        //Setting User Roles & Capabilities


        //remove_role('consultant');

        /*Hifing Menu Page From User Side*/
        function remove_cats_menu_page(){
        remove_menu_page('edit-tags.php?taxonomy=category');}
        add_action("admin_menu","remove_cats_menu_page");


        /*Setting Filter And Action Hooks*/
        add_action("wp_enqueue_scripts","add_css_bootstrap_resources");
        add_action("after_setup_theme","setThemeSupport");
        add_action("customize_register","setThemeCustomization");
        add_action("wp_head","setThemeCustomizationCSS");
        add_action("init","setCustomPosts");
        add_action("widgets_init","setWidegets");
        add_filter('widget_text', 'do_shortcode', 11 );
        add_action('admin_init','set_roles_caps');
        /*Setting Filter And Action Hooks*/


        /*Change Welcome text*/
        add_action( 'admin_bar_menu', 'change_welcom_text', 11 );
        function change_welcom_text( $wp_admin_bar ) {
        $user_id = get_current_user_id();
        $current_user = wp_get_current_user();
        $profile_url = get_edit_profile_url( $user_id );

        if ( 0 != $user_id ) {
        /* Add the "My Account" menu */
        $avatar = get_avatar( $user_id, 28 );
        $howdy = sprintf( __('Welcome In Farmer Connection, %1$s'), $current_user->display_name );
        $class = empty( $avatar ) ? '' : 'with-avatar';

        $wp_admin_bar->add_menu( array(
        'id' => 'my-account',
        'parent' => 'top-secondary',
        'title' => $howdy . $avatar,
        'href' => $profile_url,
        'meta' => array(
        'class' => $class,
        ),
        ) );
        }
        }
        /*Change Welcome text*/

        //Allow Custom Post Type For Single View for custom roles
        add_action('pre_get_posts', 'query_post_type');
        function query_post_type($query) {
           //Limit to main query, tag queries and frontend
           if($query->is_main_query() && ( $query->is_category() || $query->is_tag() ) && !is_admin() && $query->is_author() ) {
                $query->set( 'post_type', array('knowledge','consultancy') );
           }
        }
        //Allow Custom Post Type For Single View for custom roles

/*

    function wpa82763_custom_type_in_categories( $query ) {
    if ( $query->is_main_query() && ( $query->is_category() || $query->is_tag() ) ) {
        $query->set( 'post_type', array( 'post', 'resource' ) );
    }
}
add_action( 'pre_get_posts', 'wpa82763_custom_type_in_categories' );
*/



        //Adding Like Functionality For Posts
        function post_like()
        {
            // Check for nonce security
            $nonce = $_POST['nonce'];

            if (!wp_verify_nonce( $nonce, 'ajax-nonce' ) )
                die ( 'Busted!');

            if(isset($_POST['post_like']))
            {
                //Getting Post ID & User ID 
                $post_id = $_POST['post_id'];
                $current_user_id = $_POST['current_user_id'];

                // Get votes count for the current post
                $meta_count = get_post_meta($post_id, "votes_count", true);

                // Check user has already voted ?
                if(!hasAlreadyVoted($post_id,$current_user_id))
                {
                    add_post_meta($post_id, "votes_count", 1);
                    add_post_meta($post_id, "current_user_id", $current_user_id);
                }

                else if(hasAlreadyVoted($post_id,$current_user_id))
                {

                    update_post_meta($post_id, "votes_count", ++$meta_count);
                    update_post_meta($post_id, "current_user_id", $current_user_id);

                }
            }
            exit;
}  
        function hasAlreadyVoted($post_id,$current_user_id)
        {
            // Retrieve Current User ID
            $previous_user_id = get_post_meta($post_id, "current_user_id");

            //Compare User IDs 
            if($previous_user_id[0]!=$current_user_id)
            {
                return false;
            }

            return true;

}
        wp_enqueue_script('like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', true );
        wp_localize_script('like_post', 'ajax_var', array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-nonce')
        ));
        add_action('wp_ajax_nopriv_post-like', 'post_like');
        add_action('wp_ajax_post-like', 'post_like');
        //Adding Like Functionality For Posts


        /*Adding Post Views Functionality For Posts*/
        function post_views()
        {

           if(isset($_POST['post_views']))
            {
                //Getting Post ID & User ID 
                $post_id = $_POST['post_id'];

                // Get votes count for the current post
                 $meta_views = get_post_meta($post_id, "views_count", true);

                //add_post_meta($post_id, "views_count", 1);

                    if(isset($meta_views))
                    {
                         update_post_meta($post_id, "views_count", ++$meta_views);
                    }
                    else{

                         add_post_meta($post_id, "views_count", 1);  
                    }

           }

        }
        wp_enqueue_script('views_post', get_template_directory_uri().'/js/post-views.js', array('jquery'), '1.0', true );
        wp_localize_script('views_post', 'ajax_var', array('url' => admin_url('admin-ajax.php'),'nonce' => wp_create_nonce('ajax-nonce')
        ));
        add_action('wp_ajax_nopriv_post-views', 'post_views');
        add_action('wp_ajax_post-views', 'post_views');
        /*Adding Post Views Functionality For Posts*/


        /*Adding Custom Fields For Product Post Type*/
        //Hook to Call
        add_action('admin_init', 'add_product_custom_fields' );
        //To add metabox
        function add_product_custom_fields() {
            add_meta_box('product_detail_id', 'Product Specification', 'product_detail_fields', 'product', 'normal', 'high');
        }

        
        //Getting & Setting Fields Values and storing in variables
        function product_detail_fields(){
            global $post;
            $get_all_meta_values = get_post_custom($post->ID);
            $price=$get_all_meta_values["price"][0];
            $is_featured  = $get_all_meta_values["is_featured"][0];
            $email  = $get_all_meta_values["email"][0];
            $stock  = $get_all_meta_values["stock"][0];
            $ship_price  = $get_all_meta_values["ship_price"][0];
            $auto_remove_date  = $get_all_meta_values["auto_remove_date"][0];
            $upload_attachment = $get_all_meta_values["upload_attachment"][0];
            ?>
            <style>
                table input{
                    width: 300px;
                }

            </style>


            <table id="table">
                <tr>
                <td> <label><b>Price:</b></label></td>
                <td><input type="number" class="form-control" name="price"  value="<?php echo $price; ?>" /></td>    
                </tr>
                <tr>
                    <td><label><b>Is Featured:</b></label></td>
                    <td><input type="radio" class="form-control" name="is_featured"  value="1" <?php if($is_featured=="1"){echo "checked";}?> />Yes&nbsp;<input type="radio" class="form-control" name="is_featured"  value="0" <?php if($is_featured=="0"){echo "checked";}?> />No</td>
                </tr>
                 <tr>
                    <td><label><b>Stock:</b></label></td>
                    <td> <input type="number" class="form-control" name="stock"  value="<?php echo $stock; ?>" /></td>
                </tr>
                <tr>
                    <td><label><b>Shipping Amount:</b></label></td>
                    <td> <input type="number" class="form-control" name="ship_price"  value="<?php echo $ship_price; ?>" /></td>
                </tr>
                <tr>
                    <td><label><b>Contact Email:</b></label></td>
                    <td> <input type="text" class="form-control" name="email"  value="<?php echo $email; ?>" /></td>
                </tr>
                 <tr>
                    <td><label><b>Auto Remove Date:</b></label></td>
                    <td> <input type="date" class="form-control" name="auto_remove_date"  value="<?php echo $auto_remove_date; ?>" /></td>
                </tr>
            </table>
        <?php
        }
        //Hook to update values 
        add_action('save_post', 'save_product');
        //To update values
        function save_product(){
            global $post;

                /*field names array*/
            $name_values = array("price","is_featured","email","upload_attachment","stock","ship_price","auto_remove_date");

            for($i=0; isset($name_values[$i]); $i++)
            {
                update_post_meta($post->ID, $name_values[$i], $_POST[$name_values[$i]]);

            }
            }
        /*Adding Custom Fields For Product Post Type*/

        
        /*Adding Columns In Admin Dash Side*/
        add_filter( 'manage_product_posts_columns', 'smashing_filter_posts_columns' );
        function smashing_filter_posts_columns( $columns ) {

          $columns['price'] = __( 'Price', 'smashing' );
          $columns['email'] = __( 'Contact Email', 'smashing' );
            $columns['image'] = __( 'Image' );    
          return $columns;
        }
        //Adding Columns Data
        add_action( 'manage_product_posts_custom_column', 'smashing_product_column', 10, 2);
        function smashing_product_column( $column, $post_id ) {

        // Image column
          if ( 'image' === $column ) 
          {
            echo get_the_post_thumbnail( $post_id, array(80, 80) );
          }

        // price column
          if ( 'price' === $column ) 
          {
            $price = get_post_meta( $post_id, 'price', true );

                if ( ! $price ) {
                  _e( 'n/a' );  
                } 
                else 
                {
                  echo $price;
                } 
          }

            // Contact
          if ( 'email' === $column ) 
          {
            $email = get_post_meta( $post_id, 'email', true );

                if ( ! $email ) {
                  _e( 'n/a' );  
                } 
                else 
                {
                  echo $email;
                } 
          }
            }
        /*Adding Columns In Admin Dash Side*/

    
        /*Approve/Disapprove User Accounts*/
        function approve_accounts_admin_page(){
        add_menu_page("Approve Accounts","Approve Accounts","manage_options","approve-accounts-page","approve_accounts_method",get_template_directory_uri()."/images/users.png",20);
        }
        function approve_accounts_method(){
                ?>
                    <h1><?php echo bloginfo('name'); ?></h1>
                    <hr />
                    <h2 class="text-center text-info"><b>User Account Requests</b></h2>
                    <h1 id="result" style="text-align:center;font-weight:bold;color:orange;"></h1>
                <?php
                $blogusers = get_users([ 'role__not_in' => ['administrator'],"orderby"=>"user_status","order"=>"DESC"]);

                ?>
                    
                <div class="col-sm-12">
                <style>
                    #mytable td,th,span{
                        font-weight: bold;
                        text-align: center;
                    }    

                    #mytable a{
                        text-decoration: none;
                        font-weight: bold;
                        
                    }
                    
                </style> 
                    
                <table id="mytable" class="table table-hover table-bordered" >
                  <thead class="bg-info text-light">
                    <tr style="padding:10px;">
                      <th style="padding:10px" scope="col">Profile</th>
                      <th style="padding:10px" scope="col">Full Name</th>
                      <th style="padding:10px" scope="col">Email</th>
                       <th style="padding:10px" scope="col">Role Type</th>
                    <th style="padding:10px" scope="col">Account Status</th>    
                      <th style="padding:10px" scope="col">Action</th>
                    </tr>
                  </thead>
                   <tbody id="result_update">

                <?php
                foreach ( $blogusers as $key=>$user ) {
                    //echo $user->ID;
                    $is_active = get_user_meta( $user->ID, "is_active",true);
                    $profession = get_user_meta( $user->ID, "wp_capabilities");

                    $user_meta=get_userdata($user->ID);

                    $user_roles=$user_meta->roles;  
                    ?>

                    <tr style="padding:10px" class="text-center">
                      <td style="padding:10px;border-bottom:2px solid black;" scope="row" ><img src="<?php echo get_avatar_url($user->user_email);?>" alt="No Image" class="text-danger img-fluid" width="50px" height="50px"  ></td>
                      <td style="padding:10px;border-bottom:2px solid black;" ><?php echo $user->display_name;?></td>
                      <td style="padding:10px;border-bottom:2px solid black;" ><?php echo $user->user_email; ?></td>
                      <td style="padding:10px;border-bottom:2px solid black;" ><?php  echo ($user_roles[0]); ?></td> 
                      <td style="padding:10px;border-bottom:2px solid black;" ><?php if($user->user_status==1){echo ' <span class="badge badge-success">Active</span>';}else{echo ' <span class="badge badge-warning">Pending</span>';}?></td>         
                      <td style="padding:10px;border-bottom:2px solid black;"><?php
                        if($user->user_status==0){
                            ?>
                          <a href="" id="btn-set-status" user_id="<?php echo $user->ID; ?>" status="<?php echo $user->user_status;?>" class="btn btn-success btn-sm">Active</a>
                           
                          <a href="" id="btn-set-status"  class="btn btn-sm btn-danger text-light" user_id="<?php echo $user->ID; ?>" status="<?php echo $user->user_status;?>" >Dective</a>
                            <?php
                        }if($user->user_status==1){
                            ?>
                          <a  style="cursor:default;" class="btn btn-sm btn-success text-light" disabled>Active</a>

                          <a href="" id="btn-set-status"  class="btn btn-sm btn-danger text-light" user_id="<?php echo $user->ID; ?>" status="<?php echo $user->user_status;?>"  >Dective</a>
                          
                          <a href="" id="view-user-orders" user_id="<?php echo $user->ID;?>" class="btn btn-primary btn-sm">View Orders</a>
                          <?php
                        }
                      ?>
                            
                        </td>

                    </tr>

                <?php
                }
                ?>
                 </tbody>
                </table>
                </div>    
                 <input type="hidden" id="hidden" value="<?php echo get_template_directory_uri();?>/ajax_actions.php" />
                <p id="user-orders-result"></p>
    <p id="cart-detail-result"></p>
                
                <script>

                      jQuery(document).ready(function () {

                    jQuery('#mytable').DataTable();
                    jQuery(".dataTables_length,.dataTables_info").hide();
                    
                        /*Change Order Status*/    
                        jQuery(document).on("click", "#btn-set-status", function (e) {
                        e.preventDefault();

                        user_id = jQuery(this).attr("user_id");
                        status = jQuery(this).attr("status");    
                        url =jQuery("#hidden").val();    

                        jQuery.ajax({
                        type: "post",
                        url: url,
                        data: "action=set_account_status&user_id="+user_id+"&status="+status,
                        success: function(data){

                            jQuery("#result").html(data);
                            setTimeout(function() { location.reload();},1000);
                        }   
                    });      

                }); 
                        /*Change Order Status*/
            
                        /*Show User Orders By ID*/    
                        jQuery(document).on("click", "#view-user-orders", function (e) {
                        e.preventDefault();

                        user_id = jQuery(this).attr("user_id");
                        url =jQuery("#hidden").val();    

                        jQuery.ajax({
                        type: "post",
                        url: url,
                        data: "action=show_user_orders&user_id="+user_id,
                        success: function(data){
                        jQuery("#user-orders-result").html(data);
                        jQuery('#user-orders-dialog-box').modal('show');    
                        }   
                    });      

                }); 
                        /*Show User Orders By ID*/
                      
                         
                          
                      
                        /*Show User Order Cart Details*/    
                        jQuery(document).on("click", "#cart-details", function (e) {
                        e.preventDefault();

                        order_id = jQuery(this).attr("order_id");
                        url =jQuery("#hidden").val();    

                        jQuery.ajax({
                        type: "post",
                        url: url,
                        data: "action=show_cart_details&order_id="+order_id,
                        success: function(data){
                        jQuery("#cart-detail-result").html(data);
                        jQuery('#user-orders-dialog-box').modal('hide');    
                        jQuery('#cart-detail-dialog-box').modal('show');    
                        }   
                    });      

                }); 
                        /*Show User Order Cart Details*/ 
                          
                      });
                </script>
                
      

                <?php
            }
        add_action("admin_menu","approve_accounts_admin_page",40);
        /*Approve/Disapprove User Accounts*/


        /*Show Users only His Products*/
        function show_only_my_posts($query) {
            global $pagenow;

            if( 'edit.php' != $pagenow || !$query->is_admin )
                return $query;

            if( !current_user_can( 'edit_others_posts' ) ) {
                global $user_ID;
                $query->set('author', $user_ID );
            }
            return $query;
        }
        add_filter('pre_get_posts', 'show_only_my_posts');
        /*Show Users only His Products*/

?>