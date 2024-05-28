








<?php
	get_header();
$count=0;
?>
<hr />
 <div class="row">
    <div class="col-sm-1"></div>
      <div class="col-sm-3 rounded" style="background-color:#4adfe6">
          <br />
           <h4 class="alert bg-dark text-white text-center"><b>ABOUT AUTHOR</b></h4>
            <?php 
                    global $current_user;
                    get_currentuserinfo();
                    $user = new WP_User($current_user->ID);
            ?>
           <center>
            <table class="table">
                <style>
                    table th{
                        font-style: italic;
                    }
                </style>
                
                    <tr>
                    <th>
                    </th>    
                    <th><?php echo get_avatar($current_user->ID);?></th>
                    </tr>
                    <tr>
                    <?php
                    if($user)
                    {
                    ?>
                    <tr>
                    <th class="text-light bg-dark">Account Role:</th>    
                    <th class="text-dark bg-light">    
                    <?php $user = new WP_User($current_user->ID);
                        if ( !empty( $user->roles ) && is_array( $user->roles ) ) 
                        {
                            foreach ( $user->roles as $role ){
                                echo $role;
                        }
                    }?>
                    </th>
                    </tr>
                    <?php    
                    }
                    if($current_user->first_name)
                    {
                    ?>
                    <tr>
                    <th class="text-light bg-dark">First Name:</th>    
                    <th class="text-dark bg-light"><?php echo $current_user->first_name;?></th>
                    </tr>
                    <?php    
                    }
                    if( $current_user->last_name)
                    {
                    ?>
                    <tr>
                    <th class="text-light bg-dark">Last Name:</th>    
                    <th class="text-dark bg-light"><?php echo $current_user->last_name;?></th>
                    </tr>
                    <?php    
                    }
                    if($current_user->user_email)
                    {
                    ?>
                    <tr>
                    <th class="text-light bg-dark">Email Address:</th>    
                    <th class="text-dark bg-light"><?php echo $current_user->user_email;?></th>
                    </tr>
                    <?php    
                    }
                    if($current_user->user_url)
                    {
                    ?>
                    <tr>
                    <th class="text-light bg-dark">User URL:</th>    
                    <th class="text-primary bg-light"><?php echo $current_user->user_url;?></th>
                    </tr>
                    <?php    
                    }
                    if($current_user->description)
                    {
                    ?>
                    <tr>
                    <th class="text-light bg-dark">Description:</th>    
                    <th class="text-dark bg-light"><?php echo substr($current_user->description,0,100);?></th>
                    </tr>
                    <?php    
                    }    
                    ?>    
                    
            </table>
            </center>      
        </div>&nbsp;
        <div class="col-sm-7 rounded" style="background-color:#4adfe6">
        <br />    
        <h2 class="bg-dark text-center text-white" style="border-radius:30px;padding:5px;"><b>Posts Whose Author Is:  <span class="text-danger"><?php the_author();?></span></b></h2>                 
            <?php    
            if(have_posts())
            {         
            while(have_posts())
                {
                $count++;
                the_post();
                get_template_part("posts");
                ?>
                <br />						
                <?php				
                }
            }
            else
            {
             ?>
                <h2 class="alert alert-warning">No Posts of <?php the_author();?> Were Found</h2>
            <?php                    
            }
             ?>
            <style>
                #pagination
                {
                    border-radius: 20px;
                    padding: 10px;
                }


                #pagination a
                {
                    font-weight: bold;
                    font-style: italic;
                }
            </style>

                <p class="text-center">
                <span  class="bg-light" id="pagination">
                <?php
                previous_posts_link("&laquo; Previous Posts",$out_staff_posts->max_num_pages);
                ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
                next_posts_link("Next Posts &raquo;",$our_staff_posts->max_num_pages);
                ?>
                </span>
                </p>
            <br /><br />

</div> 
        <div class="col-sm-1"></div>
     <?php
		get_footer();
     ?>

