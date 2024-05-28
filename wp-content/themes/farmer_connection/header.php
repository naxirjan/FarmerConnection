<?php 
//ini_set('display_errors','Off');

//Count Pending Cart Products From Session
require_once("require/shop-cart-class.php");
$shop_obj = new Shop_Session_Class();
$count_products = $shop_obj->getSessionProducts();

   
//Count Pending Cart Products From DB 
global $current_user;
    get_currentuserinfo();
global $wpdb;
require_once("shopping-cart/dal_cart.php");
$cart = new Cart_DAL();
$count_cart_products = $cart->countCart($current_user->ID);  



$check_cart =  $wpdb->get_results("SELECT * FROM wp_cart WHERE user_id=".$current_user->ID."");


?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
	<head>
			<meta charset="<?php bloginfo('charset');?>" />
			<meta name="viewport" content="width=device-width" />
					<title><?php bloginfo('name');?></title>
		    <?php wp_head();?>
		</head>
    <body <?php body_class();?>>
        
        <div class="container-fluid" >
            <!--NavBar-->
            
            <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #4adfe6;">
             
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
                
      <div class="collapse navbar-collapse" id="navbarCollapse">
         
        <ul class="navbar-nav mr-auto">
             
            <li class="nav-item"><br /> <a href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri();?>/images/logo.png"  width="100" height="100" class="img-fluid"/></a></li>
            
            <li class="nav-item">
                &nbsp;
                <?php 
                            if(! is_user_logged_in())
                            {
                            ?>  <br />  <br />  
                               <a href="<?php echo home_url();?>/signin" id="btn-auths" class="btn dark btn-head-signin" style="width:100px;"><b><i>Sigin</i></b></a>
                               <a href="<?php echo home_url();?>/signup" id="btn-auths" class="btn btn-head-signup" style="width:100px;"><b><i>Sigup</i></b></a>
                                <br />
                           <?php     
                            }
                            else if(is_user_logged_in()){
                                ?><br /> <br /> 
                                <span class="btn btn-success btn-lg"><i>Welcome, <strong> <?php echo ucfirst($current_user->user_login);?></strong></i>
                                </span>
                                <span class="dropdown">
                                   
                                      <button class="btn btn-light btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
                                        <b><i>Account Settings</i></b>
                                      </button><br />
                                      <div class="dropdown-menu alert alert-dark" aria-labelledby="dropdownMenuButton">
                                        
                                        <a class="dropdown-item" href="<?php echo home_url();?>/profile" ><b><i>Profile</i></b></a>
                                        
                                          <?php if($check_cart){?>
                                        <a class="dropdown-item" href="<?php echo home_url();?>/user-orders" ><b><i>Orders</i></b></a>  
                                        
                                          <?php
                                        }
                                        ?>
                                        <a class="dropdown-item" href="<?php echo home_url();?>/wp-admin" ><b><i>Dashboard</i></b></a>
                                        <?php
                                    
                                        if($current_user->roles[0]=="farmer"){
                                        ?>
                                        <a class="dropdown-item" href="<?php echo home_url();?>/wp-admin/post-new.php?post_type=product" ><b><i>Dashboard</i></b></a>
                                        <?php
                                        }
                                
                                
                                       
                                        ?>
                                          
                                        <a href="logout"  class="dropdown-item"  ><b><i>Logout</i></b></a>
                                      </div>
                                    
                                </span>
                               
                                <?php        
                                }        
                            ?>
                <h4><b>Farmer Connection</b></h4>
            </li>
            <li class="nav-item"><br /> <br />  <?php
      $navigation_menu = array("theme_location" =>"header_menu");
      wp_nav_menu($navigation_menu);
                        ?> </li>
            <li class="nav-item">
            <br /> <br />   &nbsp;  
                <?php
                
                    if(is_user_logged_in())
                    {
                        
                    if($count_cart_products[0]->total)
                    {    
                     ?>
                          <a class="btn btn-light btn-lg text-primary" href="<?php echo get_home_url();?>/checkout" style="border-radius:30px;"><b><i>Cart (<?php echo $count_cart_products[0]->total; ?>)</i></b></a>  
                        <?php   
                    }
                    else
                    {
                    ?>    
                      <a class="btn btn-light btn-lg text-primary" style="border-radius:30px;"><b><i>Cart (0)</i></b></a> 
                    <?php
                    }   
                        
                    }
                    else if(!is_user_logged_in())
                    {
                        
                        if($count_products){
                        $total=0; 
                        foreach($count_products as $count_product)
                        { 
                            $total+=$count_product['quantity'];
                        }
                        ?>
                          <a class="btn btn-light btn-lg text-primary" href="<?php echo get_home_url();?>/checkout" style="border-radius:30px;"><b><i>Cart (<?php echo $total; ?>)</i></b></a>  
                        <?php   
                    }
                     else{
                   
                        ?>
                            <a class="btn btn-light btn-lg text-primary" style="border-radius:30px;"><b><i>Cart (0)</i></b></a>                        
                        <?php
                    }    
                    }
               // session_destroy();
                ?>
                </li>
            </ul>
      </div>
    </nav>
                

           <br /><br /><br /><br /><br />
            <!--Header Image-->
            <div class="row" id="header_background"> 
                   <br />
                   <?php if(get_header_image()){
                    ?>
                   <img class=" rounded" src="<?php header_image(); ?>" width="100%" height="350"/>
                   <?php
                    }
                   else{
                    ?> 
                   <img class=" rounded" src="<?php echo get_template_directory_uri()."/images/farmer.png";?>" width="100%" height="350"/>
                    <?php   
                   }
                   ?>
                </div>
          
            <!--Header Menu-->
            <div class="row" id="header_background"> 
                <div class="col-sm-12" >
                   <?php
    
                        //if($post->post_parent >0 or get_page_childrens())
                        if($post->post_parent >0 or get_page_childrens())
                        {
                        ?>    
                            <div clas="navigation" id="submenu">
                            <br />
                            <span><a href="<?php echo get_the_permalink(get_parent_page());?>"><?php echo get_the_title(get_parent_page());?></a></span>
                            <?php
                            $options =array("child_of"=>get_parent_page(),);
                            wp_page_menu($options);    
                            ?>        
                            </div>
                        <?php
                        }
                        ?>
                    <br /><br />
                </div>
                
            </div>