<?php 








//Count Pending Cart Products From DB 
global $current_user;
    get_currentuserinfo();
global $wpdb;

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
            
            <nav class="navbar navbar-expand-md  navbar-info fixed-top bg-info">
              
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
                
      <div class="collapse navbar-collapse" id="navbarCollapse">
         
        <ul class="navbar-nav mr-auto">
           
            <li class="nav-item">
            <br />    
            <a href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri();?>/images/logo.png"  width="50" height="50" class="img-fluid"/></a></li>
            
            <li class="nav-item">
                <br />
                &nbsp;
                <?php 
                            if(! is_user_logged_in())
                            {
                            ?>    
                               <a href="<?php echo home_url();?>/signin"  class="btn btn-dark btn-head-signin" style="width:100px;"><b>Sigin</b></a>
                               <a href="<?php echo home_url();?>/signup" id="btn-auths" class="btn btn-dark btn-head-signup" style="width:100px;"><b>Sigup</b></a>
                           <?php     
                            }
                            else if(is_user_logged_in()){
                                ?>
                                <span class="btn btn-dark btn-lg">Welcome, <strong> <?php echo ucfirst($current_user->user_login);?></strong>
                                </span>
                                <span class="dropdown">
                                   
                                      <button class="btn btn-dark btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
                                        <b>Account Settings</b>
                                      </button><label></label>
                                      <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                        
                                        <a class="dropdown-item text-light" href="<?php echo home_url();?>/profile" ><b>Profile</b></a>
                                        
                                          <?php if($check_cart){?>
                                        <a class="dropdown-item text-light" href="<?php echo home_url();?>/user-orders" ><b>Orders</b></a>  
                                        
                                          <?php
                                        }
                                        if($current_user->roles[0]!="academic" && $current_user->roles[0]!="farmer"){
                                        ?>
                                        <a class="dropdown-item text-light" href="<?php echo home_url();?>/wp-admin" ><b>Dashboard</b></a>
                                        <?php
                                        }
                                
                                        if($current_user->roles[0]=="farmer"){
                                        ?>
                                        <a class="dropdown-item text-light" href="<?php echo home_url();?>/wp-admin/post-new.php?post_type=product" ><b>Dashboard</b></a>
                                        <?php
                                        }
                                
                                
                                       
                                        ?>
                                          
                                        <a href="logout"  class="dropdown-item text-light"  ><b>Logout</b></a>
                                      </div>
                                    
                                </span>
                               
                                <br />
                                <?php        
                                }        
                            ?>
            </li>
            <li class="nav-item">
            <br/>     <?php
      $navigation_menu = array("theme_location" =>"header_menu");
      wp_nav_menu($navigation_menu);
                        ?> </li>
            <li class="nav-item">
            <br/>     &nbsp;
                <?php
                
                    if(is_user_logged_in())
                    {
                        
                    if($count_cart_products[0]->total)
                    {    
                     ?>
                          <a class="btn btn-dark btn-lg text-primary" href="<?php echo get_home_url();?>/checkout" style="border-radius:30px;"><b>Cart (<?php echo $count_cart_products[0]->total; ?>)</b></a>  
                        <?php   
                    }
                    else
                    {
                    ?>    
                      <a class="btn btn-dark btn-lg text-primary" style="border-radius:30px;"><b>Cart (0)</b></a> 
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
                          <a class="btn btn-dark btn-lg text-primary" href="<?php echo get_home_url();?>/checkout" style="border-radius:30px;"><b>Cart (<?php echo $total; ?>)</b></a>  
                        <?php   
                    }
                     else{
                   
                        ?>
                            <a class="btn btn-dark btn-lg text-primary" style="border-radius:30px;"><b>Cart (0)</b></a>                        
                        <?php
                    }    
                    }
               // session_destroy();
                ?>
                </li>
            </ul>
      </div>
    </nav>
                

           <br /><br /><br /><hr />
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
