
<?php

get_header();

?>

<p class="text-center">page.php</p> 
<?php
if(have_posts()){
while(have_posts()){
	the_post();?>

      <div class="row">
        <div class="col-sm-2"></div>  
        <div  class="col-sm-8 alert bg-light">
		<artical>
		 
		<h2><?php the_title();?>
        </h2>
            <?php
                if(has_post_thumbnail()){
                ?>
                 <span><?php the_post_thumbnail("custom-full");?></span>    
                    
                <?php    
                }
      
                ?> 
            
            
            <hr />
        	<span><?php the_content();?></span>
            </artical><br />
            
<p align="center"><a href="<?php echo home_url();?>" class="btn btn-dark" >View All Posts</a></p>            
</div>
<div class="col-sm-2"></div>
</div>          
          
          
				<?php				
				}

                }


 get_footer();
?>



