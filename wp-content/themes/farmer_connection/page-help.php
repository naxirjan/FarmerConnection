
<?php

get_header();

?>

<p class="text-center">page-help.php</p> 
<?php
if(have_posts()){
while(have_posts()){
	the_post();?>

      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-3 rounded" style="background-color:#4adfe6;height:400px;">
          <br />
          <h3 class="alert bg-dark text-light">Most Asked Questions</h3>
        <h4>What is Lorem Ipsum?</h4>
        <h4>Why do we use it?</h4>
        <h4>When do we use it?</h4>
        <h4>Where can I get some?</h4>
        <h4>How we can use it?</h4>    
          </div>  &nbsp;
        <div  class="col-sm-7 rounded" style="background-color:#4adfe6;">
		<br />
		 
		<h2 class="alert bg-dark text-center text-light"><?php the_title();?>
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
          </div>
<div class="col-sm-1"></div>
</div>          
          
          
				<?php				
				}

                }


 get_footer();
?>



