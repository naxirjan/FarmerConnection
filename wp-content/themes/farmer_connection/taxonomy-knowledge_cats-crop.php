<?php

get_header();
?>
<div class="row">
    <div class="col-sm-2"></div>
      <div class="col-sm-8" style="background-color: #4adfe6;">
<p class="text-center">taxonomy-taxonomy.php</p>
<?php

$paged = get_query_var("paged");



    if(have_posts()){
     
        while(have_posts()){
        the_post();
        get_template_part("posts");
        echo "<br />";    
    ?>    
        
<?php    
        }
        ?>
          </div>
      <div class="col-sm-2"></div>
</div>  
        <div class="row">    
         <div class="col-sm-4"></div>   
         <div class="col-sm-4 rounded text-center" style="background-color:lightgray"> 
            <b> 
    <?php 
   
     
    previous_posts_link("Previous Posts &raquo;");
    ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
    
        next_posts_link("Next Posts &raquo;");
?>
             </b>
    </div>
        <div class="col-sm-4"></div>   
        </div>
            
    <?php   
}
else{
?>
<h4>No Mobiles  Were Found </h4>
<?php
}






get_footer();

?>