
<?php


get_header();

if(have_posts())
{
?>
<p class="text-center">pdf.php</p>
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
    <a href="<?php echo wp_get_attachment_url($post->ID);?>"><?php echo wp_get_attachment_url($post->ID);?></a>
 </p>
</artical>
            
    <p align="center"><a href="<?php echo home_url();?>" class="btn btn-dark" >View All Posts</a></p>            </div>
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