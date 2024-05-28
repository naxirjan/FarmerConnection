
<?php
    get_header();
?>
    <p class="text-center">Single.php</p>
        <?php
        if(have_posts())
        {
            while(have_posts())
            {
                the_post();?>
                  <div class="row">
                        <div class="col-sm-1"><span id="show"></span></div>  
                        
                        <div  class="col-sm-10 rounded" style="background-color:#4adfe6">
                            <br />
                            <h2 class="text-center alert bg-dark text-light"><?php the_title();?>
                             <?php
                            $postdata = get_post_meta($post->ID);

                             $check=false;

                                for($i=0; $i<=isset($postdata['current_user_id'][$i]);$i++)
                                {

                                    if(isset($postdata['current_user_id'][$i]) && $postdata['current_user_id'][$i] == get_current_user_id() && $postdata['votes_count'][$i]!=0) 
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
                                    if(has_post_thumbnail())
                                    {
                                    ?>
                                     <p class="text-center"><?php the_post_thumbnail("custom-full");?></p>   <?php    
                                    }
                                 ?> 
                                <hr />
                                <span class="text-dark"><?php echo the_content();?></span>
                                <br />
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
                                                <span class="text-danger"><b>(Click If You Like The Post)</b></span>
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
                            <br />
                                <p align="center"><a href="<?php echo home_url();?>" class="btn btn-dark" >View All Posts</a></p>          
                        </div>
                        <div class="col-sm-1"></div>
                      <script>
                       $(document).ready(function(){
     
     $("#comment").addClass("form-control bg-dark text-light").css("height","100");
     $("#comments>h3").addClass("btn btn-info");
     $("#reply-title").addClass("btn btn-dark");
     $(".logged-in-as a").addClass("badge badge-warning text-dark");
     $("#submit").addClass("btn btn-success");
     $(".comment-form-comment label").addClass("badge badge-dark").html("Enter Your Discussion Reply Here");
     
     
 });

</script>
                    </div>  
                    <?php				
                }
        }
 get_footer();
?>



