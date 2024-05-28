<?php
get_header();
?>








<div class="jumbotron" id="bg-about">
        
    
    <!--Best Slider-->
    <?php
        if(is_active_sidebar("header_area_1"))
        {
            dynamic_sidebar("header_area_1");
        }   
    ?>
    
    <!--About Future History Policy-->
    <?php 
    if(get_theme_mod("about_show_section_setting")==0)
    {
    ?>
    <div class="row">
        <!--Future-->
        <div class="col-sm-4 text-center rounded" style="background-color:#578e96">
            <br />
            <?php
            // The Page or post ID
            $id = get_theme_mod("about_future_setting"); 
            $page_data = get_post( $id );
            $title = $page_data->post_title;
            $content = $page_data->post_content;
            $excerpt = substr($content, 0, 300);
            $featured_image = wp_get_attachment_url( get_post_thumbnail_id($id, 'thumbnail') );
            ?>
           <h3 class="text-white"><b><i><u><?php echo $title;?></u></i></b></h3>
            <br />
            <p class="text-white"> <?php echo $excerpt;?>...</p>
            <a href="<?php echo get_post_permalink($id);?>" class="btn btn-warning" style="border-radius:30px;">Read More</a>
            <br /><br />
        </div>
        <!--History-->
        <div class="col-sm-4 text-center rounded" style="background-color:#578e96;border-left:1px dashed black;">
            <br />
             <?php
            // The Page or post ID
            $id = get_theme_mod("about_history_setting"); 
            $page_data = get_post( $id );
            $title = $page_data->post_title;
            $content = $page_data->post_content;
            $excerpt = substr($content, 0, 300);
            $featured_image = wp_get_attachment_url( get_post_thumbnail_id($id, 'thumbnail') );
            ?>
            <h3 class="text-white"><b><i><u><?php echo $title;?></u></i></b></h3>
            <br />
            <p class="text-white"> <?php echo $excerpt;?>...</p>
            <a href="<?php echo get_post_permalink($id);?>" class="btn btn-warning" style="border-radius:30px;">Read More</a>
            <br /><br />
        </div>
        <!--Policy-->
        <div class="col-sm-4 text-center rounded" style="background-color:#578e96;border-left:1px dashed black;">
            <br />
             <?php
            // The Page or post ID
            $id = get_theme_mod("about_policy_setting"); 
            $page_data = get_post( $id );
            $title = $page_data->post_title;
            $content = $page_data->post_content;
            $excerpt = substr($content, 0, 300);
            $featured_image = wp_get_attachment_url( get_post_thumbnail_id($id, 'thumbnail') );
            ?>
            <h3 class="text-white"><b><i><u><?php echo $title;?></u></i></b></h3>
            <br />
            <p class="text-white"> <?php echo $excerpt;?>...</p>
            <a href="<?php echo get_post_permalink($id);?>" class="btn btn-warning" style="border-radius:30px;">Read More</a>
            <br /><br />
        </div>
    </div>  
    <hr />
    <?php
    }
    ?>
    

   <!--Google Map-->
    <div class="row">
    <div class="col-sm-12">
     <?php
        if(is_active_sidebar("footer_area_2"))
        {
            dynamic_sidebar("footer_area_2");
        }   
    ?>
    </div>
    
</div> 

    
</div>


<?php
get_footer();
?>