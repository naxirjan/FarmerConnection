<?php

/*
Template Name:Front Page
Template Post Type:post,page,my_team,testimonail
*/

get_header();
?>
<div class="container-fluid">
    
        <!--About Team-->
        <?php
        if(get_theme_mod("who_we_div_setting")=="yes")
        {
        ?>
        <div class="row">
        
        <div class="col-sm-12" style="background-color: #4adfe6;">
        <?php
        $page_id = get_theme_mod("who_we_team_title_desc_setting");   
         $query = new WP_Query(array(
         "page_id" =>$page_id
         )); 
        if($query->have_posts())
            {
            while($query->have_posts()){   
            $query->the_post();
          ?>
        <br />    
        <h1 class="text-center alert bg-dark text-light"><strong><u><i><?php the_title();?></i></u></strong></h1>
            <p class="text-center"><b>
           <i><?php  the_content(); 
               ?></i>
            </b>
            </p>                 
            <?php        
            }
        }
             
        ?>
        </div>
        
            
        <!--Team 1-->
        <?php
        if(get_theme_mod("who_we_post1_setting"))
        {
        $id = get_theme_mod("who_we_post1_setting"); // The Page or post ID
        $page_data = get_post( $id );
        $title = $page_data->post_title;
        $content = $page_data->post_content;
        $excerpt = substr($content, 0, 155);
        $featured_image = wp_get_attachment_url( get_post_thumbnail_id($id, 'thumbnail') );
        ?>
        <div class="col-sm-3 text-center rounded " style="background-color: #4adfe6;border:2px solid black;">
        <br />
        <img src="<?php echo $featured_image; ?>" width="200" height="250"/>
       <h4 class="text-danger"><strong><?php echo $title; ?></strong></h4>
        <h5><strong><?php echo  get_theme_mod("who_we_post1_desig_setting");?></strong></h5>
        <hr />
        <p> <strong><i class="text-dark"><?php echo $content; ?></i></strong> </p>

        </div>
        <?php
        }            
        ?>

            
             <!--Team 2-->
            <?php
            if(get_theme_mod("who_we_post2_setting"))
            {
                
            $id = get_theme_mod("who_we_post2_setting"); // The Page or post ID
            $page_data = get_post( $id );
            $title = $page_data->post_title;
            $content = $page_data->post_content;
            $excerpt = substr($content, 0, 155);
            $featured_image = wp_get_attachment_url( get_post_thumbnail_id($id, 'thumbnail') );
            ?>
            
            <div class="col-sm-3 text-center rounded"  style="background-color: #4adfe6; border:2px solid black;">
                  
            <br />
            <img src="<?php echo $featured_image; ?>" width="200" height="250" />
           <h4 class="text-danger"><strong><?php echo $title; ?></strong></h4>
            <h5><strong><?php echo  get_theme_mod("who_we_post2_desig_setting");?></strong></h5>
            <hr />
            <p> <strong><i class="text-dark"><?php echo $content; ?></i></strong> </p>
                      
            </div>
            <?php
            }            
            ?>
            
             
             <!--Team 3-->
            <?php
            if(get_theme_mod("who_we_post3_setting"))
            {
                
            $id = get_theme_mod("who_we_post3_setting"); // The Page or post ID
            $page_data = get_post( $id );
            $title = $page_data->post_title;
            $content = $page_data->post_content;
            $excerpt = substr($content, 0, 155);
            $featured_image = wp_get_attachment_url( get_post_thumbnail_id($id, 'thumbnail') );
            ?>
            
            <div class="col-sm-3 text-center  rounded" style="background-color: #4adfe6; border:2px solid black;">
                  
            <br />
            <img src="<?php echo $featured_image; ?>" width="200" height="250" />
           <h4 class="text-danger"><strong><?php echo $title; ?></strong></h4>
            <h5><strong><?php echo  get_theme_mod("who_we_post3_desig_setting");?></strong></h5>
            <hr />
            <p> <strong><i class="text-dark"><?php echo $content; ?></i></strong> </p>
                      
            </div>
            <?php
            }            
            ?>
            
            
             <!--Team 4-->
            <?php
            if(get_theme_mod("who_we_post4_setting"))
            {
            $id = get_theme_mod("who_we_post4_setting"); // The Page or post ID
            $page_data = get_post( $id );
            $title = $page_data->post_title;
            $content = $page_data->post_content;
            $excerpt = substr($content, 0, 155);
            $featured_image = wp_get_attachment_url( get_post_thumbnail_id($id, 'thumbnail') );
            ?>
            <div class="col-sm-3 text-center rounded" style="background-color: #4adfe6;border:2px solid black;">
            <br />
            <img src="<?php echo $featured_image; ?>" width="200" height="250" />
            <h4 class="text-danger"><strong><?php echo $title; ?></strong></h4>
            <h5><strong><?php echo  get_theme_mod("who_we_post4_desig_setting");?></strong></h5>
            <hr />
            <p><strong><i class="text-dark"><?php echo $content; ?></i></strong></p>
            </div>
            <?php
            }            
            ?>
    </div> 
    <hr />

<?php 
}
        ?>
    
      <!--About Client Feedback testimonails-->
        <?php  
          if(get_theme_mod("feedback_show_section_setting")){ 
            ?>  
            <style>
                .carousel-item h3{
                    color: green;
                }
                .carousel-item h4{
                    color: yellow;
                }

            </style>
        
            <div class="row">
                <div class="text-center col-sm-12 rounded" style="background-color:#222425">
                    <br />
                   <h1 class="text-white"><?php echo get_theme_mod("feedback_testimonail_type_setting");?></h1>
                    <span style="border-top:2px solid green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <br />
                    <div id="carouselExampleControls" class="carousel slide  text-white" data-ride="carousel">
                          <div class="carousel-inner">
                            <!--Feedback Post 1-->
                              <?php
                                // The Page or post ID
                                $id = get_theme_mod("feedback_post_1_setting"); 
                                $page_data = get_post( $id );
                                $title = $page_data->post_title;
                                $content = $page_data->post_content;
                              if($id){
                              ?>

                              <div class="carousel-item active">
                                <h5 class="d-block w-100 "><i>1. <?php echo $content;?></i></h5>
                                <br/>
                                <h3 class="d-block w-100 "><?php echo strtoupper($title);?></h3>
                                <h4 class="d-block w-100 "><?php echo strtoupper(get_theme_mod("feedback_companyname_1_setting"))?></h4>
                                <br />
                            </div>
                            <?php
                                }
                                
                              ?>

                              <!--Feedback Post 2-->
                              <?php
                                // The Page or post ID
                                $id = get_theme_mod("feedback_post_2_setting"); 
                                $page_data = get_post( $id );
                                $title = $page_data->post_title;
                                $content = $page_data->post_content;
                              if($id){
                              ?>

                              <div class="carousel-item">
                                <h5 class="d-block w-100 "><i>2. <?php echo $content;?></i></h5>
                                <br/>
                                <h3 class="d-block w-100 "><?php echo strtoupper($title);?></h3>
                                <h4 class="d-block w-100 "><?php echo strtoupper(get_theme_mod("feedback_companyname_2_setting"))?></h4>
                                <br />
                            </div>
                            <?php
                                }
                              ?>

                              <!--Feedback Post 3-->
                              <?php
                                // The Page or post ID
                                $id = get_theme_mod("feedback_post_3_setting"); 
                                $page_data = get_post( $id );
                                $title = $page_data->post_title;
                                $content = $page_data->post_content;
                              if($id){
                              ?>

                              <div class="carousel-item">
                                <h5 class="d-block w-100 "><i>3. <?php echo $content;?></i></h5>
                                <br/>
                                <h3 class="d-block w-100 "><?php echo strtoupper($title);?></h3>
                                <h4 class="d-block w-100 "><?php echo strtoupper(get_theme_mod("feedback_companyname_3_setting"))?></h4>
                                <br />
                            </div>
                            <?php
                                }
                              ?>

                               <!--Feedback Post 4-->
                              <?php
                                // The Page or post ID
                                $id = get_theme_mod("feedback_post_4_setting"); 
                                $page_data = get_post( $id );
                                $title = $page_data->post_title;
                                $content = $page_data->post_content;
                              if($id){
                              ?>

                              <div class="carousel-item">
                                <h5 class="d-block w-100 "><i>4. <?php echo $content;?></i></h5>
                                <br/>
                                <h3 class="d-block w-100 "><?php echo strtoupper($title);?></h3>
                                <h4 class="d-block w-100 "><?php echo strtoupper(get_theme_mod("feedback_companyname_4_setting"))?></h4>
                                <br />
                            </div>
                            <?php
                                }
                              ?>

                               <!--Feedback Post 5-->
                              <?php
                                // The Page or post ID
                                $id = get_theme_mod("feedback_post_5_setting"); 
                                $page_data = get_post( $id );
                                $title = $page_data->post_title;
                                $content = $page_data->post_content;
                              if($id){
                              ?>

                              <div class="carousel-item">
                                <h5 class="d-block w-100 "><i>5. <?php echo $content;?></i></h5>
                                <br/>
                                <h3 class="d-block w-100 "><?php echo strtoupper($title);?></h3>
                                <h4 class="d-block w-100 "><?php echo strtoupper(get_theme_mod("feedback_companyname_5_setting"))?></h4>
                                <br />
                            </div>
                            <?php
                                }
                              ?>

                              <!--Feedback Post 6-->
                              <?php
                                // The Page or post ID
                                $id = get_theme_mod("feedback_post_6_setting"); 
                                $page_data = get_post( $id );
                                $title = $page_data->post_title;
                                $content = $page_data->post_content;
                              if($id){
                              ?>

                              <div class="carousel-item">
                                <h5 class="d-block w-100 "><i>6. <?php echo $content;?></i></h5>
                                <br/>
                                <h3 class="d-block w-100 "><?php echo strtoupper($title);?></h3>
                                <h4 class="d-block w-100 "><?php echo strtoupper(get_theme_mod("feedback_companyname_6_setting"))?></h4>
                                <br />
                            </div>
                            <?php
                                }
                              ?>

                              <!--Feedback Post 7-->
                              <?php
                                // The Page or post ID
                                $id = get_theme_mod("feedback_post_7_setting"); 
                                $page_data = get_post( $id );
                                $title = $page_data->post_title;
                                $content = $page_data->post_content;
                              if($id){
                              ?>

                              <div class="carousel-item">
                                <h5 class="d-block w-100 "><i>7. <?php echo $content;?></i></h5>
                                <br/>
                                <h3 class="d-block w-100 "><?php echo strtoupper($title);?></h3>
                                <h4 class="d-block w-100 "><?php echo strtoupper(get_theme_mod("feedback_companyname_7_setting"))?></h4>
                                <br />
                            </div>
                            <?php
                                }
                              ?>

                              <!--Feedback Post 8-->
                              <?php
                                // The Page or post ID
                                $id = get_theme_mod("feedback_post_8_setting"); 
                                $page_data = get_post( $id );
                                $title = $page_data->post_title;
                                $content = $page_data->post_content;
                              if($id){
                              ?>

                              <div class="carousel-item">
                                <h5 class="d-block w-100 "><i>8. <?php echo $content;?></i></h5>
                                <br/>
                                <h3 class="d-block w-100 "><?php echo strtoupper($title);?></h3>
                                <h4 class="d-block w-100 "><?php echo strtoupper(get_theme_mod("feedback_companyname_8_setting"))?></h4>
                                <br />
                            </div>
                            <?php
                                }
                              ?>

                              <!--Feedback Post 9-->
                              <?php
                                // The Page or post ID
                                $id = get_theme_mod("feedback_post_9_setting"); 
                                $page_data = get_post( $id );
                                $title = $page_data->post_title;
                                $content = $page_data->post_content;
                              if($id){
                              ?>

                              <div class="carousel-item">
                                <h5 class="d-block w-100 "><i>9. <?php echo $content;?></i></h5>
                                <br/>
                                <h3 class="d-block w-100 "><?php echo strtoupper($title);?></h3>
                                <h4 class="d-block w-100 "><?php echo strtoupper(get_theme_mod("feedback_companyname_9_setting"))?></h4>
                                <br />
                            </div>
                            <?php
                                }
                              ?>

                              <!--Feedback Post 10-->
                              <?php
                                // The Page or post ID
                                $id = get_theme_mod("feedback_post_10_setting"); 
                                $page_data = get_post( $id );
                                $title = $page_data->post_title;
                                $content = $page_data->post_content;
                              if($id){
                              ?>

                              <div class="carousel-item">
                                <h5 class="d-block w-100 "><i>10. <?php echo $content;?></i></h5>
                                <br/>
                                <h3 class="d-block w-100 "><?php echo strtoupper($title);?></h3>
                                <h4 class="d-block w-100 "><?php echo strtoupper(get_theme_mod("feedback_companyname_10_setting"))?></h4>
                                <br />
                            </div>
                            <?php
                                }
                              ?>

                        </div>
                          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                </div>
            </div>    
        <?php    
          }
        ?>
    

          <!--Agriculture Blog-->
    <?php
    // The Page or post ID
    if(get_theme_mod("agro_show_blog_setting"))
    {
        echo "<hr />";
        $id = get_theme_mod("agro_blog_page_setting"); 
        $page_data = get_post( $id );
        $title = $page_data->post_title;
        $content = $page_data->post_content;
            if($id){
            ?>
    
            <h2 class="text-center text-light alert bg-dark"><b><?php echo $title;?></b></h2>

            <p><strong><i><?php echo $content;?></i></strong></p>
            <?php
            }
            else{
            ?>
             <h3 class="text-center"><b><i><u>Title Of Page Here</u></i></b></h3>
            <p class="text-center"><strong><i>Content Of Page Here</i></strong></p> 
      
            <?php
            }
            
    ?>    
    <div class="row">

        <?php 
        
            $cat_id = get_theme_mod('branches_setting');
            $total =  get_theme_mod('branches_no_post_setting');
             
        $query = new WP_Query(array(
        "cat"=>$cat_id,
        "posts_per_page"=>$total
        ));
        
        
        if($query->have_posts())
        {  
            while($query->have_posts())
            {
                $query->the_post();
                ?>
                 <div class="col-sm-4  rounded" style="background-color: #4adfe6;border:2px solid black;">
                    <br />
                     <h2 class="text-dark"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                     <hr />
                     <p class="text-dark">
                         <i class="dashicons dashicons-admin-users"></i>By: 
                         <strong>
                         <a class='badge badge-dark' href="<?php echo get_author_posts_url(get_the_author_meta("ID"));?>"><?php the_author();?>
                         </a>
                         </strong>
                         &nbsp;&nbsp;
                         <i class="dashicons dashicons-clock"></i> Date: 
                         <span class="badge badge-dark"> 
                             <?php echo get_the_date('d F Y');?> 
                         </span>
                         &nbsp;&nbsp;
                         
                          <?php 
                            $comments =get_comments_number($post->ID);
                            if($comments > 0)
                            {?>
                            <i class="dashicons dashicons-format-chat"></i>    
                            <span class="text-white"> 
                                <?php 
                                    echo get_comments_number($post->ID);
                                    ?>
                            </span>
                            <?php
                            }    
                             ?>
                     </p>
                     <hr />
                        <img class="img-fluid rounded" src="<?php echo get_the_post_thumbnail_url();?>" />
                        <br />
                        <p class="text-dark">
                        <?php
                            if($post->post_excerpt)
                            {
                            ?>
                            <span class="text-dark"><b><?php echo get_the_excerpt();?></b></span>
                            <br /><br />
                            <span class="text-center">
                            <a class="btn btn-warning" style="border-radius:30px;" href="<?php the_permalink();?>"><b>Read More!...</b></a>
                            </span>
                            <?php
                            }else{
                             ?>
                             <span class="text-white"><?php echo get_the_content();?></span>    
                            <?php
                            }
                            ?>
                         </p>
                        <br />
                     <br />
                </div>    
                <?php
            }
        }     
              
        ?>  
      </div>
    <?php
    }
    ?> 
    
</div>
<?php
get_footer();
?>
