
<?php


get_header();

if(have_posts())
{
?>
<p class="image.php"></p>
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
<h4 class="text-center rounded text-info ">Post Mime Type:<u><?php echo get_post_mime_type();?></u></h4>    
<p class="text-center"><?php echo wp_get_attachment_image($post->ID);?></p>
</artical><br />
            
    <p align="center"><a href="<?php echo home_url();?>" class="btn btn-dark" >View All Posts</a></p>            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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