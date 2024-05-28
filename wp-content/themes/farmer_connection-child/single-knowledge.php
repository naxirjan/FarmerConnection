
<?php

get_header();

?>

<p class="text-center">single-knowledge.php</p>
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
    #post a
    {
        color: white;
    }
</style>
<script>
 $(document).ready(function(){
     
     $("#comment").addClass("form-control");
     $(".comment-form-comment label").addClass("badge badge-dark").html("Enter Your Commnets Here").attr("rows",1);
     
 });

</script>
<?php
if(have_posts()){
while(have_posts()){
	the_post();?>

      <div class="row">
        <div class="col-sm-2"></div> 
         
        <div  class="col-sm-8 bg-info rounded" id="post">
		<br />
        <artical>		 
		<h2 class="text-center alert bg-dark text-light"><b><i><?php the_title();?></i></b>
            
            <?php
            $postdata = get_post_meta($post->ID);
                
             $check=false;
    
                for($i=0; $i<=isset($postdata['current_user_id'][$i]);$i++)
                {
                   
                    if(isset($postdata['current_user_id'][$i]) && $postdata['current_user_id'][$i] ==        get_current_user_id() && $postdata['votes_count'][$i]!=0) 
                       {
                        $check=true;   
                       }
                }    
    
                if($check)
                {
                ?> 
                <img src="<?php echo get_template_directory_uri()?>/images/liked.png" title="You Have Already Liked This Post!.." width="80" height="80"><b><i class="text-success"> Liked</i></b>
                <?php
                }
                ?>    
            
        </h2>
            <?php
                if(has_post_thumbnail()){
                ?>
                 <span><?php the_post_thumbnail("custom-full");?></span>    
                    
                <?php    
                }
                ?> 
            <hr />
            <span><b><i><?php the_content();?></i></b></span>
            </artical><hr />
         <?php 
             if(!$check)
                {
                ?>    
                    <p class="post-like">
                    <a data-post_id="<?php echo $post->ID;?>" current_user_id="<?php echo get_current_user_id();?>" href="#">    
                    <span class="qtip like" >
                    <img src="<?php echo get_template_directory_uri()?>/images/liked.png" title="Click Here To Like This Post!.." width="80" height="80">
                    </span>
                    </a>
                    <span class="text-danger"><b><i>Click If You Like The Post!...</i></b></span>    
                    </p> 
                     <span class="count" id="msg" ></span>
                    <?php
                    }
            ?>
           <hr />    
    <p><?php 
        
        if(is_single($post->ID) && comments_open($post->ID))
 				{
 					comments_template();	
 				}
        
        ?></p>        
            
    <hr/>        
<p align="center"><a href="<?php echo home_url();?>/knowledge-base" class="btn btn-dark" >View All Posts</a></p>            
</div>
        <div class="col-sm-2"></div>
    </div>          
<?php				
}
}


 get_footer();
?>



