
<?php

get_header();

?>

<p class="text-center">single-consultancy.php</p>
<style>
    #submit
    {
        border-radius: 20px;
        background-color: forestgreen;
        padding: 5px;
        color: white;
        font-style: oblique;
        border: none;
        
    }
</style>
<script>
 $(document).ready(function(){
     
     $("#comment").addClass("form-control").css("height","100");
     $(".comment-form-comment label").addClass("badge badge-dark").html("Enter Your Answer Here");
     $("#submit").val("Submit Answer");
     
 });

</script>
<?php
if(have_posts()){
while(have_posts()){
	the_post();?>

      <div class="row">
        <div class="col-sm-2"></div> 
        <div  class="col-sm-8" style="background-color: #4adfe6;">
		<artical>
		 
		<h2 class="text-info"><b><i><?php the_title();?></i></b>
        </h2>
            <?php
            
                if(has_post_thumbnail()){
                ?>
                 <span><?php the_post_thumbnail("custom-full");?></span>    
                    
                <?php    
                }
                ?> 
            <hr />
        	<span><i><?php the_content();?></i></span>
            </artical><br />
         
           
    <p><?php 
        
        if(is_single($post->ID) && comments_open($post->ID))
 				{
 					comments_template();	
 				}
        
        ?></p>        
            
    <hr/>        
<p align="center"><a href="<?php echo home_url();?>/users-questions/?user_id=<?php echo $post->post_author;?>" class="btn btn-dark" >Go Back</a></p>            
</div>
        <div class="col-sm-2"></div>
    </div>          
<?php				
}
}


 get_footer();
?>



