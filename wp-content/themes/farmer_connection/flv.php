
<?php


get_header();

if(have_posts())
{
?>
<p class="text-center">flv.php</p>
<div class="row">   
<div class="col-sm-2"></div>        
<div  class="col-sm-8 alert bg-light ">
<?php
while(have_posts())
{
the_post();
?>


<artical>
<h2 class=" bg-dark text-white rounded text-center"><?php the_title();?></h2>
<h4 class="text-center rounded text-info ">Post Mime Type:<u><?php echo get_post_mime_type();?></u></h4><hr />    
<p class="text-center">
<video width="500" height="300" controls>
  <source src="<?php echo wp_get_attachment_url($post->ID);?>" type="<?php echo get_post_mime_type();?>">

</video>    
    
    
</p>
</artical>
            
    <p align="center"><a href="<?php echo home_url();?>" class="btn btn-dark" >View All Posts</a></p> </div>
<div class="col-sm-2">
    
<?php
}
?>
</div>        
</div>    
<?php
}
get_footer();


?>