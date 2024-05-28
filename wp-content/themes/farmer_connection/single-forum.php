
<?php

get_header();

?>

<p class="text-center">single-discussion.php</p>
<style>
   
    .fn,.says{
        font-weight: bold;
        font-size: 20px;
        color: green;
    }
    .avatar{
        width: 50px;
        height: 50px;
    }
    .comment-meta a,p{
        font-style: italic;
        font-weight: bold;
    }
    
</style>
<script>
 $(document).ready(function(){
     
     $("#comment").addClass("form-control bg-dark text-light");
     $(".comment-form-comment label").addClass("badge badge-dark").html("Enter Your Discussion Here").attr("rows",1);
     $(".submit").val("Add Discussion");
     $(".submit").addClass('btn btn-success');
 });

</script>
<?php
if(have_posts()){
while(have_posts()){
	the_post();?>

      <div class="row">
        <div class="col-sm-2"></div> 
        <div  class="col-sm-8" style="background-color: #4adfe6;">
		<br />
		<h2 class="text-center alert bg-dark text-center text-light"><b><i><?php the_title();?></i></b>
            
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
        	<span><i><?php the_content();?></i></span>
           <hr />
           <?php 
             if(!$check)
                {
                ?>    
                    <p class="post-like">
                    <a data-post_id="<?php echo $post->ID;?>" current_user_id="<?php echo get_current_user_id();?>" href="#">    
                    <span class="qtip like" >
                    <img src="<?php echo get_template_directory_uri()?>/images/liked.png" title="Click Here To Like This Post!.." width="60" height="60">
                    </span>
                    </a>
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

                ?>
            </p>        
            
    <hr/>        
<p align="center"><a href="<?php echo home_url();?>/discussion-forum" class="btn btn-dark" >View All Posts</a></p>            
</div>
        <div class="col-sm-2"></div>
    </div>          
<?php				
}
}


 get_footer();
?>



