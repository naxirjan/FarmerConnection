
<?php

get_header();

?>

<p class="text-center">profile.php</p>
      <div class="row">
        <div class="col-sm-1"></div> 
        <div  class="col-sm-7  rounded text-center " style="background-color: #4adfe6;">
            <?php 
                    global $current_user;
                    get_currentuserinfo();
                    $user = new WP_User($current_user->ID);
            ?>
            <br />
        <h3 class="alert bg-dark text-light"><b><u>ACCOUNT INFORMATION (<?php echo $current_user->user_login;?>)</u></b></h3>
           <div class="text-center">
              <hr />
               <p class="text-center"><?php echo get_avatar($current_user->ID);?></p>
                <hr />
               <table class="table">
                <style>
                    table th{
                        font-size: 20px;
                    }
                </style>
                
                    <tr>
                    <?php
                    if($current_user->ID)
                    {
                    ?>
                    <tr>
                    <th class="text-light bg-dark">User ID:</th>    
                    <th class="bg-light"><?php echo $current_user->ID;?></th>
                    </tr>
                    <?php    
                    }  
                    if($user)
                    {
                    ?>
                    <tr>
                    <th class="text-light bg-dark">Account Role:</th>    
                    <th class="bg-light">    
                    <?php $user = new WP_User($current_user->ID);
                        if ( !empty( $user->roles ) && is_array( $user->roles ) ) 
                        {
                            foreach ( $user->roles as $role ){
                                echo ucfirst($role);
                        }
                    }?>
                    </th>
                    </tr>
                    <?php    
                    }
                    if($current_user->user_login)
                    {
                    ?>
                    <tr>
                    <tr>
                    <th class="text-light bg-dark">User Name:</th>    
                    <th class="bg-light"><?php echo $current_user->user_login;?></th>
                    </tr>
                    <?php    
                    }
                    if($current_user->display_name)
                    {
                    ?>
                     <tr>
                    <th class="text-light bg-dark">Display Name:</th>    
                    <th class="bg-light"><?php echo $current_user->display_name;?></th>
                    </tr>
                    <?php    
                    }
                    if($current_user->first_name)
                    {
                    ?>
                    <tr>
                    <th class="text-light bg-dark">First Name:</th>    
                    <th class="bg-light"><?php echo $current_user->first_name;?></th>
                    </tr>
                    <?php    
                    }
                    if( $current_user->last_name)
                    {
                    ?>
                    <tr>
                    <th class="text-light bg-dark">Last Name:</th>    
                    <th class="bg-light"><?php echo $current_user->last_name;?></th>
                    </tr>
                    <?php    
                    }
                    if($current_user->user_email)
                    {
                    ?>
                    <tr>
                    <th class="text-light bg-dark">Email Address:</th>    
                    <th class="bg-light"><?php echo $current_user->user_email;?></th>
                    </tr>
                    <?php    
                    }
                    if($current_user->user_url)
                    {
                    ?>
                     <tr>
                    <th class="text-light bg-dark">User URL:</th>    
                    <th class="bg-light"><?php echo $current_user->user_url;?></th>
                    </tr>
                    <?php    
                    }
                    if($current_user->user_registered)
                    {
                    ?>
                     <tr>
                    <th class="text-light bg-dark">Registration Date:</th>    
                    <th class="bg-light"><?php echo $current_user->user_registered;?></th>
                    </tr>
                    <?php    
                    }
                    if($current_user->description)
                    {
                    ?>
                     <tr>
                    <th class="text-light bg-dark">Description:</th>    
                    <th class="bg-light"><?php echo $current_user->description;?></th>
                    </tr>
                    <?php    
                    }    
                    ?>    
                    
            </table>
            </div>
        </div>&nbsp;
        <div class="col-sm-3 rounded text-center" style="background-color:#4adfe6;height:550px;">
            <br />
        <h3 class="alert bg-dark text-light"><b><u>DETAILS</u></b></h3>
            <br />
            <p><b>
               <h4> <span class="badge badge-dark">Total Published Posts</span></h4>
                <span style="font-size:30px;"><?php echo count_user_posts($current_user->ID , array("post","knowledge")); ?></span>
                </b>
            </p>
            <hr />
            <b>
            <h4><span class="badge badge-dark">Recent Published Posts</span></h4>
            </b>    
              
        <?php
            $recent_posts = wp_get_recent_posts(array('author'=>$current_user->ID,'post_type'=>array("post","knowledge"),"posts_per_page"=>5,"ordderby"=>"date","order"=>"ASC"));
              
            if($recent_posts){ 
            ?>
             <ul>  
            <?php   
            foreach( $recent_posts as $recent ){
            ?>
            <li style="list-style-type:none;border-radius:20px;margin-top:5px;height:" class="bg-light">
                <b>&nbsp;
                <?php
                echo '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a>';
                ?>  
                </b>
            </li>
            
            <?php
        }
            ?>
             </ul>      
            <?php     
            }
            else
            {
                ?>
               <h4 style="font-size:20px;list-style-type:none;" class="text-danger"><b>No Recent Posts</b></h4>
               <?php
            }
              
        ?>
              
            <hr />
            <h4><span class="badge badge-dark">Total Liked Posts By Me</span></h4>
                <?php 
                    
                    $total_likes =0;
                    $args = array('post_type'=> array('post','knowledge'));
                    $posts_array = get_posts( $args ); 
                    foreach( $posts_array as $key => $posts ){ 
                   $total_likes += get_post_meta($posts->ID,'votes_count',"current_user_id",get_current_user_id());
                    }
                ?>
            <h2><b><?php echo $total_likes;?></b></h2>
            
             <hr />
            <h4><span class="badge badge-dark">Profile Liked By</span></h4>
                <?php 
                      $account_liked = get_user_meta(get_current_user_id(),'account_liked',true); 
                   if($account_liked>0)
                   {
                    ?>
                <h2><b><?php echo $account_liked;?></b></h2>
                <?php
                   }
            else{
               ?>
                <h2><b>0</b></h2>
                <?php  
            }
            ?>           
            
        </div>  
        <div class="col-sm-1"></div>
    </div>          
<?php				
 get_footer();
?>



