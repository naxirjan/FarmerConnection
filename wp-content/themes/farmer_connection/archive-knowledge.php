<?php
get_header();
require_once("require/session.php");
?>
   <br />

    <div class="row">
        <div class="col-sm-1 "></div>
        <div class="col-sm-3 bg-alert alert-dark" style="border-radius:20px;"><h3 class="text-center"><b><i>Knowledge Base</i></b></h3></div>&nbsp;
         <div  class="col-sm-7 bg-alert alert-dark text-center" style="border-radius:20px;">
          <form role="search" class="search-form" action="<?php echo home_url("/");?>" >
        <label>
        <input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x("Enter the word to search","placeholder")?>" value="<?php echo get_search_query()?>" name="s" title="<?php esc_attr_x("Enter the word to search","label")?>" style="border-radius:20px;" /> 
        <input type="hidden" name="post_type" value="knowledge" />    
        </label>      
        <input type="submit" class="search-submit btn-submit btn btn-success" value="<?php echo esc_attr_x("Search","submit button")?>" style="border-radius:20px;"/>     
          </form></div>
            
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-1"><a href=""></a></div>
        <div class="col-sm-3  rounded" style="height:300px;background-color:#d6d8d9">    
            <h3 class="rounded text-center text-info"><b><i>Recent Posts</i></b></h3>
            <hr />
            
        <ul>    
        <?php
            $recent_posts = wp_get_recent_posts(array('post_type'=>'knowledge'));
            foreach( $recent_posts as $recent ){
            ?>
            <li style="list-style-type:none;border-radius:20px;margin-top:5px;height:" class="bg-light">
                <b><i>&nbsp;
                <?php
                echo '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a>';
                ?><br />&nbsp;&nbsp;<a href="<?php echo get_author_posts_url(get_the_author_meta("ID"));?><?php echo the_author_meta('display_name',esc_attr($recent['post_author']));?>">Author</a>:&nbsp;
                <small class=""><?php echo the_author_meta('display_name',esc_attr($recent['post_author']));?></small>    
                </i></b>
            </li>
            
            <?php
        }
              // print_r($recent_posts);
        ?>
        </ul>
        </div>&nbsp;        
        <div class="col-sm-7 alert alert-dark"> 
            <p>archive-knowledge.php</p>
            <?php
                $paged = get_query_var("paged");

                $knowledge_posts = new WP_Query(array(
                "post_type" =>"knowledge",
                "posts_per_page" =>5,
                "orderby" =>"title",
                "order" =>"DESC",
                "paged"=> $paged   
                ));
               

                    if($knowledge_posts->have_posts())
                    {
                        while($knowledge_posts->have_posts())
                        {
                            $knowledge_posts->the_post();
                        get_template_part("posts"); 
                        echo "<br />";    
                        }//while
                        ?>
                            <div> 
                                <b> 
                        <?php    
                        previous_posts_link("",$knowledge_posts->max_num_pages);
                        ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php

                            next_posts_link("",$knowledge_posts->max_num_pages);
                    ?>
                                 </b>
                        <br />

                            <?php echo paginate_links(array(
                           "total" => $knowledge_posts->max_num_pages,
                            "current" => $paged,
                            "prev_text" =>__("Previous Posts &laquo;"),
                            "next_text" =>__("&raquo; Next Posts"),    
                            ));?>

                        
                            </div>        
                        <?php
                        wp_reset_postdata();    
                    }
                    else
                    {
                    ?>
                    <h4>Sorry, No Posts Were Found!... </h4>
                    <?php
                    }
                    ?>
        </div>
        <div class="col-sm-1"></div>
    </div>
<?php
get_footer();
?>