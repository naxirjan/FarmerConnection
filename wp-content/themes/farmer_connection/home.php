<?php
    get_header();
    ?>
        <hr />
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3 rounded" style="background-color:#4adfe6;height:600px;">
                
                <br /><br /><br />
                <h3 class="alert bg-dark text-light text-center"><b>Search Here</b></h3>
        <div>        
        <form role="search"  action="<?php echo home_url("/");?>">
        <b class="text-dark">Search Here</b>    
        <input type="search" class="search-field form-control text-center bg-dark field-group" placeholder="<?php echo esc_attr_x("Enter the word to search","placeholder")?>" value="<?php echo get_search_query()?>" name="s" title="<?php esc_attr_x("Enter the word to search","label")?>" /> 
        <input type="hidden" name="post_type" value="post" />
            <br />
            <p class="text-center">
        <input type="submit" class="search-submit btn-submit btn  btn-light" value="<?php echo esc_attr_x("Search","submit button")?>"/>     
        </p>
            </form>
         
        <hr />    
        </div>
        <div>
         <h3 class="alert bg-dark text-light text-center"><b>Recent Posts</b></h3>    
         <?php
            $recent_posts = wp_get_recent_posts(array('post_type'=>"post","posts_per_page"=>5,"ordderby"=>"date","order"=>"DESC"));
              
            if($recent_posts){ 
            ?>
             <ul>  
            <?php   
            foreach( $recent_posts as $recent ){
            ?>
            <li style="list-style-type:none;border-radius:20px;margin-top:5px;height:" class="bg-light">
                <b><i>&nbsp;
                <?php
                echo '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a>';
                ?>  
                </i></b>
            </li>
            
            <?php
        }
            ?>
             </ul>      
            <?php     
            }
            else
            {
                ?>
               <h4 style="font-size:20px;list-style-type:none;" class="text-info"><b><i>No Recent Posts</i></b></h4>
               <?php
            }
              
        ?>        
                
        </div>
            
        </div>&nbsp;
            
            <div class="col-sm-7 rounded" style="background-color: #4adfe6;">
                
                <br />
    <?php
                
       $paged = get_query_var("paged");
        $blog_posts = new WP_Query(array(
        "post_type" =>"post",
        "posts_per_page" =>3,
        "orderby" =>"date",
        "order" =>"DESC",
        "paged"=> $paged   
        ));
     
    if($blog_posts->have_posts())
    { $count=0;
        while($blog_posts->have_posts())
        {
            $count++;
            $blog_posts->the_post();
            if(get_post_format()=="aside" 
                   OR get_post_format()=="audio" 
                   OR get_post_format()=="video" 
                   OR get_post_format()=="image" 
                   OR get_post_format()=="gallery" 
                   OR get_post_format()=="link" 
                   OR get_post_format()=="quote" 
                   OR get_post_format()=="status" 
                   OR get_post_format()=="chat")
                {
                get_template_part("post",get_post_format());
                echo "<br />";    
                }
                else{
                get_template_part("posts");    
                 echo "<br />";
                } 
        }
     }   
    ?>         
                  <div> 
                    <style>
                        .page-numbers{
                            background-color:white;

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
                        previous_posts_link("",$blog_posts->max_num_pages);
                        ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php

                        next_posts_link("",$blog_posts->max_num_pages);
                        ?>
                    </b>
                        <br />
                      <?php echo paginate_links(array(
                           "total" => $blog_posts->max_num_pages,
                            "current" => $paged,
                            "prev_text" =>__("Previous Posts &laquo;"),
                            "next_text" =>__("&raquo; Next Posts"),    
                            ));?>
                    </div> 
                <br /><br />
        </div>
        <div class="col-sm-1"></div>
        <br />
                
</div>    
        <?php            
    get_footer();
?>