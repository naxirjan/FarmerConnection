
<?php
    get_header();
?>
    <p class="text-center">Singular.php</p>
        <?php
        if(have_posts())
        {
            while(have_posts())
            {
                the_post();?>
                  <div class="row">
                        <div class="col-sm-1"></div>  
                        <div  class="col-sm-10 alert alert-dark">
                            <artical>
                            <h2 class="text-center"><?php the_title();?>
                            </h2><hr />
                                <?php
                                    if(has_post_thumbnail())
                                    {
                                    ?>
                                     <p class="text-center"><?php the_post_thumbnail("custom-full");?></p>   <?php    
                                    }
                                 ?> 
                                <hr />
                                <span class="text-dark"><?php echo the_content();?></span>
                                </artical><br />
                              <p><?php 
        
                            if(is_single($post->ID) && comments_open($post->ID))
                            {
                                comments_template();	
                            }
        
        ?></p>
                            <br />
                                <p align="center"><a href="<?php echo home_url();?>" class="btn btn-dark" >View All Posts</a></p>          
                        </div>
                        <div class="col-sm-1"></div>
                    </div>  
                    <?php				
                }
        }
 get_footer();
?>



