<?php
get_header();
?>
   <br />





    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5 text-center rounded" style="padding:10px;background-color:#4adfe6;">
            <h4 class="text-dark"><b>Want To REPLY And POST New Messages?</b></h4><b>Click On <a href="<?php echo home_url();?>/signup" class="badge badge-danger">Register</a> For Lifetime Free Membership</b>
        </div>
        <div class="col-sm-5 rounded" style="background-color:#4adfe6;"><h1 class="text-center text-dark"><b>Discussion Forum</b></h1>
        <p class="text-center"><b>Ask Questions / Give Answers To Help The Others!...</b></p>
        </div>    
        <div class="col-sm-1"></div>
    </div>
    <hr />
    <script>

              $(document).ready(function(){
                   
                    $('#mytable').DataTable();
                    
                    $(".dataTables_length,.dataTables_info").hide();
                    $("a.paginate_button ").addClass("bg-dark");
                    $("#mytable_filter input").addClass("form-control");
                    $("#mytable_filter label").css("text-align","left");
                  
                    //$(".dataTables_length,.dataTables_info").hide();
                    
                });
    </script>
    <div class="row col-sm-12 rounded">
        
        <div class="col-sm-3 rounded text-center " style="height:400px;background-color:#4adfe6">
            <br />
            <a href="<?php echo home_url();?>/add-discussion" class="btn btn-success"><h4><b>Add Your Discussion</b></h4></a>
         <br /><br /><hr />
            <h4 class="alert bg-dark text-white"><b>Recent Discussions</b></h4>
            <ul>
                
            <?php
                $recent_posts = wp_get_recent_posts(array('post_type'=>'forum',"orderbydate"=>"date","order"=>"DESC","posts_per_page"=>5));
                foreach( $recent_posts as $recent ){
                    ?>
                        <li style="list-style-type:none;margin-top:10px;"><a id="set_views" views_post_id="<?php echo $recent["ID"];?>" class=" text-primary rounded" style="padding:5px;" href="<?php echo get_permalink($recent["ID"]);?>"><b><?php echo $recent["post_title"];?></b></a> </li> 
                <?php
                   
                }
            ?>    
            </ul>
        </div>
        <div class="col-sm-9 rounded" style="background-color:#4adfe6">
            <br />
           <table class="table table-hover bg-dark rounded" id="mytable">
                <thead class="bg-dark text-white text-center">
                    <style>
                        #cols th,td{
                            font-style: italic;
                            font-weight: bold;
                        }
                        .avatar {
                            width: 50px;
                            height: 50px;
                        }
                    </style>
                    <tr >
                        <th>Profile</th>
                        <th>Person</th>
                        <th>Discussion Title</th>
                        <th>Category</th>
                        <th>Start Date</th>
                        <th>Replies</th>
                        <th>Views</th>
                    </tr>
                </thead>
               <tbody>
                   <?php 
                  
                   $args = array("post_type"=>"forum");
                   $forum_posts = get_posts($args);
                   
                   foreach($forum_posts as $forum_post){
                   ?>
                    <tr>
                        <td class="text-center" >
                            
                        <?php echo get_avatar($forum_post->post_author);?>    
                        </td>
                        <td class="text-center" >
                            <span class="badge badge-success">
                                <?php 
                                    $author = get_user_by( 'ID', $forum_post->post_author);
                                    echo ucfirst($author->display_name); 
                                ?>
                                
                            </span>
                        </td>
                        
                        
                        <td class="text-center">
                            <?php 
                    //display comments
                    $comments = get_comments(array(
                        'post_id' => $forum_post->ID,
                        'count' =>true
                        ));
                    if(!$comments)
                    {
                        ?>
                        <small class="badge badge-warning">Pending</small>
                        <?php
                    }
                    ?>
                        <a id="set_views"   views_post_id="<?php echo $forum_post->ID?>" href="<?php echo $forum_post->post_name;?>"><?php echo $forum_post->post_title;?></a></td>
                        
                        <td class="text-center"><span class="text-warning"><?php  echo get_the_term_list($forum_post->ID,"forum_cats");?></span></td>
                        
                        <td class="text-center"><span class="badge badge-dark"><span class="dashicons dashicons-clock"></span><?php echo date("d-m-Y h:i:s a",$forum_post->post_date);?></span></td>
                        <td class="text-center"><span class="badge badge-success"><span class="dashicons dashicons-admin-comments"></span>
                            <?php 
                                    $count_comments= wp_count_comments($forum_post->ID);
                                    echo $count_comments->total_comments;
                            ?>
                            </span>
                        </td>
                        <td class="text-center"><span class="badge badge-warning"><span class="dashicons dashicons-welcome-view-site"></span>
                            <?php
                                    $views = get_post_meta($forum_post->ID,'views_count');
                                    if(isset($views[0]))
                                    {
                                        echo $views[0];
                                    }else
                                    {
                                        echo "0";
                                    }
                            ?> 
                            </span>
                        </td>
                    </tr>
                   <?php
                   }
                    ?>    
               </tbody>
           </table>
       </div>
      
    </div>

<?php
get_footer();
?>