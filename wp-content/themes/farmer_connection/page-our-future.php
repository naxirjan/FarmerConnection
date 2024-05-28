<?php


get_header();

?>


<br /><br /><br />
<div class="row">
<?php


    if(have_posts())
    {
         
    while(have_posts())
    {
    the_post();
    ?>

<div class="col-sm-2">page-our-future.php</div>    
<div  class="col-sm-8 text-center text-white rounded" style="background-color:#578e96">
<artical>
<h2><strong><i><u><?php the_title();?></u></i></strong>
</h2>
<br />    
<span><strong><i><?php the_content();?></i></strong></span>
</artical><br /> 
<a href="<?php echo home_url();?>" class="btn btn-warning">GO TO BACK</a>
    <br/><br/>    
</div>
<div class="col-sm-2"></div>    
   
    <?php
    }
    }
?>
</div>     
<?php    
    
    get_footer();


?>