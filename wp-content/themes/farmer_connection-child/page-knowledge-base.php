<?php
if(!is_user_logged_in())
{
     ?>
    <script type="text/javascript">
        window.location.href="<?php echo home_url();?>/signin";
    </script>
    <?php         
}

get_header();
?>
   <br />

    <div class="row">
        <div class="col-sm-1 "></div>
        <div class="col-sm-3  alert rounded bg-info">
            <h1 class="text-center text-light"><b><i>Knowledge Base Services</i></b></h1>
        </div>&nbsp;
         <div  class="col-sm-7 alert bg-info rounded text-center">
          <form role="search" class="search-form" action="<?php echo home_url("/");?>" >
     
        <input type="search" class="search-field text-center  bg-dark form-control" placeholder="<?php echo esc_attr_x("Enter the word to search","placeholder")?>" value="<?php echo get_search_query()?>" name="s" title="<?php esc_attr_x("Enter the word to search","label")?>"  /> 
        <input type="hidden" name="post_type" value="knowledge" />    
           <br />
        <input type="submit" class="search-submit btn-submit btn btn-lg btn-dark" value="<?php echo esc_attr_x("Search","submit button")?>" />     
          </form></div>
            
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-7 rounded bg-info">
            <br />
            
            <?php
                $paged = get_query_var("paged");

                $knowledge_posts = new WP_Query(array(
                "post_type" =>"knowledge",
                "posts_per_page" =>2,
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
                                <style>
                                    .page-numbers{
                                        background-color: white;
                                        
                                    }
                                    .page-numbers current{
                                        color: black;
                                        font-weight: bold;
                                    }
                                    .next{
                                        color: black;
                                    }
                                    .pre{
                                        color: black;
                                    }
                                </style>
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
            <br />
        </div>&nbsp;
           <div class="col-sm-3 bg-info rounded" style="height:500px;"> 
               <br />
            <h3 class="rounded alert text-center text-light bg-dark"><b><i>Recent Posts</i></b></h3>
            <hr /> 
        <ul>    
        <?php
            $recent_posts = wp_get_recent_posts(array('post_type'=>'knowledge',"posts_per_page"=>10));
            foreach( $recent_posts as $recent ){
            ?>
            <li style="list-style-type:none;border-radius:20px;margin-top:5px;height:" class="bg-light">
                <b><i>&nbsp;
                <?php
                echo '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a>';
                ?><br />&nbsp;&nbsp;<small>
                <a href="<?php echo get_author_posts_url(get_the_author_meta("ID"));?><?php echo the_author_meta('display_name',esc_attr($recent['post_author']));?>">BY</a>:</small>&nbsp;
                <?php echo the_author_meta('display_name',esc_attr($recent['post_author']));?>    
                </i></b>
            </li>
            
            <?php
        }
              // print_r($recent_posts);
        ?>
        </ul>
        </div>&nbsp;        
     
        <div class="col-sm-1"></div>
    </div>
<?php
get_footer();
?>