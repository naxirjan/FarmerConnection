        <div class="bg-light" style="border-radius:30px;padding:5px;">
            <p >&nbsp;&nbsp;
                <b><i>
                 <span class="text-dark">Author:</span>
                 <a href="<?php echo get_author_posts_url(get_the_author_meta("ID"));?>"><?php the_author();?></a>
                 &nbsp;&nbsp;
                 <span class="text-dark">Date:</span> 
                <span ><a class="text-primary"><?php echo get_the_date("Y-m-d h:i:s A");?></a></span>
                    </i></b>      
            </p>
		<hr/>
		<h2 class="text-center"><a id="set_views"   views_post_id="<?php echo $post->ID?>" href="<?php echo get_the_permalink();?>"><?php the_title();?></a>
        </h2>
            <?php
            if(has_post_thumbnail()){
                ?>
                 <p class="text-center"><?php the_post_thumbnail("custom-medium");?><p>    
                <?php    
                }
            if($post->post_excerpt){
            ?>
            <span><?php echo get_the_excerpt($post->ID);?><a id="set_views" views_post_id="<?php echo $post->ID?>"  style="border-radius:20px;" class=" btn btn-sm btn-warning" href="<?php the_permalink();?>"><b><i>Read More!...</i></b></a></span>
            <?php
            }
            else{
             ?>
             <span><?php the_content();?></span>    
            <?php
            }
            ?>
            <hr />
            <span>
             <?php  
                $categories = get_the_terms($post->ID,'knowledge_cats');
                $separator =", ";
                $output = "";
                if($categories)
                {     
             ?>
             &nbsp;&nbsp;
             <span class="text-dark"><b><i>Categories:</i></b></span> 
             <strong>
             <?php
            foreach($categories as $category)
            {
                $output.="<a id='post_href' href='".get_category_link($category->term_id)."'><i>".$category->name."</i></a>".$separator;
            }        
            echo trim($output,$separator);                            
            ?>        
            </strong>
             <?php
                }
                ?>
            </span> 
            <span>
            <?php
            $tags = get_the_tags();
            $separator = ", ";
            $output="";
            
            if($tags){
             ?>
             &nbsp;&nbsp;
             <span class="text-dark"><b><i>Tags:</i></b></span> 
             <strong>
             <?php
            foreach($tags as $tag)
            {
                $output.="<a id='post_href' href='".get_tag_link($tag->term_id)."'><i>".$tag->name."</i></a>".$separator;
            }        
            echo trim($output,$separator);                            
            ?>        
            </strong>
             <?php
                }
                ?>
            </span>
            <!--Knowledge post type Cats-->
            <span> 
            <b><i>    
            <?php
            $cats = get_the_terms(get_the_ID(), 'knowledge_cats' ); 
            $separator = ", ";
            $output="";
            if($cats){
             ?>
             &nbsp;&nbsp;
             <span class="text-dark">Categories:</span> 

                 <?php
                foreach($cats as $cat)
                {
                    $output.="<a id='post_href' href='".get_term_link($cat->term_id)."'>".$cat->name."</a>".$separator;
                }        
                echo trim($output,$separator);                            
                ?> 
             <?php
                }
                ?>
                </i></b>
            </span>
            <!--Knowledge post type tags-->
            <span>
                <b><i>
            <?php
            $tags = get_the_terms(get_the_ID(),'knowledge_tags'); 
            $separator = ", ";
            $output="";
            if($tags){
             ?>
             &nbsp;&nbsp;
             <span class="text-dark">Tags:</span> 

             <?php
            foreach($tags as $tag)
            {
                $output.="<a id='post_href' href='".get_term_link($tag->term_id)."'>".$tag->name."</a>".$separator;
            }        
            echo trim($output,$separator);                            
            ?> 
             <?php
                }
                ?>
                </i></b>    
            </span>
            <br />&nbsp;&nbsp;
            <!--Comments-->
            <?php 
                    //display comments
                    $comments = get_comments(array(
                        'post_id' => $post->ID,
                        'count' =>true
                        ));
                    if($comments)
                    {?>
                    <span>
                        <b>
                            <i>
                                Comments:<span class="dashicons dashicons-admin-comments"></span>
                                 <a class="badge badge-info" href="<?php echo get_comments_link($post->ID);?>"><?php echo $comments;?></a>
                            </i>
                        </b>
                     </span>
                    <?php
                    }
            ?>
                   
            <!--Likes-->
            <?php
                $total_likes=0;
               $likes = get_post_meta($post->ID,'votes_count');
                foreach($likes as $like)
                {
                  $total_likes+=$like;  
                }
            
                if($total_likes)
                {
                ?>
                    &nbsp;&nbsp;<span>
                        <b><i>Likes:<span class="dashicons dashicons-thumbs-up"></span>&nbsp;
                        <span class="badge badge-info"><?php  echo $total_likes;?></span>
                        </i>
                        </b>
                    </span>
                <?php
                }
            ?>
            
            <!--Views-->
            <?php
               $views = get_post_meta($post->ID,'views_count');
                if(isset($views[0]))
                {?>
                    &nbsp;&nbsp;<span>
                        <b><i>Views:<span class="dashicons dashicons-welcome-view-site"></span>&nbsp;
                        <span class="badge badge-info"><?php echo $views[0];?></span>
                        </i>
                        </b>
                    </span>
                <?php
                }
            ?>
        </div>