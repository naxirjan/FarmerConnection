<?php
global $wpdb;
    get_header();
    require_once("require/session.php");
?>
    <br />




    <div class="row">
        <div class="col-sm-4 "></div>
       
         <div  class="col-sm-4 text-center" >
        <h3 class="alert bg-dark text-light"> <b><i>Consulatancy Service</i></b></h3>
         </div>
         <div class="col-sm-4"></div>
            
    </div>
    <hr />
    <script>

              $(document).ready(function(){
                   /* $('#mytable').dataTable( {
                      "searching": true,
                      "pagingType": "full_numbers"
                    } );
                    */
     
                    $('#mytable').DataTable();
                    $(".dataTables_length,.dataTables_info").hide();
                    $("a.paginate_button ").addClass("bg-dark");
                    $("#mytable_filter input").addClass("form-control");
                    $("#mytable_filter label").css("text-align","left");
                    //$(".dataTables_length,.dataTables_info").hide();
                    
                });
    </script>

   
    <?php 
    if(isset($_REQUEST['consult_id']))
    {?>

    <div class="row">     
        <style>
        #mytable th,td
        {
            font-weight: bold;
            font-style: italic;
            text-align: center;
        }
        </style>
        <div class="col-sm-1"></div>
        <div class="col-sm-10 rounded" style="background-color: #4adfe6;">
            
            <?php 
             $id_consultant = $_REQUEST['consult_id'] ;   
                    date_default_timezone_set("Asia/Karachi");                      
                    $args = array("post_type"=>"consultancy","post_author"=>get_current_user_id());
                    $all_posts = get_posts($args);
            ?> 
            <table id="mytable" class="table table-hover">
                <thead>
                    <tr class="bg-info text-white">
                        <th>Question Title</th>
                        <th>Category</th>
                        <th>Posted On</th>
                        <th>Answered By</th>
                        <th>Replied Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                   
                <?php
                    foreach($all_posts  as $all_post){

                      $consutant_id=  get_post_meta($all_post->ID,"consutant_id",true);

                        if($id_consultant==$consutant_id){
                            
                        ?>
                            <tr>
                                <td>
                                    <span><?php echo $all_post->post_title;?></span>
                                </td>
                                 <td>
                                    <span class="badge badge-dark"><?php $cats = get_the_terms($all_post->ID,"consult_cats"); echo $cats[0]->name;?></span>
                                </td>
                                
                                <td>
                                    <span class="badge badge-dark"><?php echo $all_post->post_date;?></span>
                                </td>
                                
                               
                                 
                                
                                <td>
                                    <span class="badge badge-info"><?php $user=get_user_by("id",$consutant_id); echo $user->display_name;?></span>
                                </td>
                               
                                <td>
                                   
                                        <?php 
                                            if($all_post->comment_count>0)
                                            {
                                            ?>
                                         <span class="badge badge-success">
                                        <a class="text-light" href="<?php echo get_the_permalink($all_post->ID);?>">View Answer</a>
                                        </span>
                                            <?php
                                           }
                                        else{
                                            echo  '<span class="badge badge-warning">Pending</span>';
                                        }
                                        ?>
                                </td>
                                
                            </tr>    
                        <?php
                        }
                        else
                        {
                            ?>
                    <script>
                    
                        $(document).ready(function(){
                         $("#mytable,#mytable_wrapper").hide();  
                          
                            
                            
                        });
                    </script>
               <h3 class="alert alert-warning text-center">No Answers From (<?php $user=get_user_by("id",$_REQUEST['consult_id']); echo $user->display_name;?>) Were Found!...<a href="<?php echo home_url();?>/consultancy-service/"><b>&nbsp;Go back</b> </a></h3>
                <br />    
                <?php
                        die();
                        }
                    }
                ?>
                </tbody>
            </table>
            <br />
            <a class="btn btn-dark" href="<?php echo home_url();?>/consultancy-service/"><b>&nbsp;Go back</b> <br /></a>
            
            <?php
            
            ?>
           
        </div>
        <div class="col-sm-1"></div>
             
</div>
    <?php
    }
    else if(isset($_REQUEST['user_id']))
    {

            $id_user = $_REQUEST['user_id'] ; 

            $args = array("post_type"=>"consultancy","author"=>$id_user);
            $all_posts = get_posts($args);
                 ?>
                    <div class="row">     
            <style>
            #mytable th,td
            {
                font-weight: bold;
                font-style: italic;
                text-align: center;
            }
            </style>
            <div class="col-sm-2"></div>
            <div class="col-sm-8 ">            
                <?php        
                if($all_posts)
                {
                 ?>     
                <h3 class="alert alert-success text-center">Questions From (<?php $user=get_user_by("id",$_REQUEST['user_id']); echo $user->display_name;?>)<a href="<?php echo home_url();?>/consultancy-service/"><b>&nbsp;Go back</b></a></h3>
                <table id="mytable" class="table  table-striped ">
                    <thead>
                        <tr class="bg-info text-white">
                            <th>Question Title</th>
                            <th>Question Category</th>
                            <th>Posted Date</th>
                            <th>Asked By</th>
                            <th>Replied Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            
                            foreach($all_posts  as $all_post){

                          $consutant_id=  get_post_meta($all_post->ID,"consutant_id",true);
                            if($consutant_id==get_current_user_id()){

                            ?>
                                <tr>
                                    <td>
                                        <span><?php echo $all_post->post_title;?></span>
                                    </td>
                                     <td>
                                        <span class="badge badge-dark"><?php $cats = get_the_terms($all_post->ID,"consult_cats"); echo $cats[0]->name;?></span>
                                    </td>

                                    <td>
                                        <span class="badge badge-dark"><?php echo $all_post->post_date;?></span>
                                    </td>




                                    <td>
                                        <span class="badge badge-info"><?php $user=get_user_by("id",$all_post->post_author); echo $user->display_name;?></span>
                                    </td>

                                    <td>

                                            <?php 
                                                if($all_post->comment_count>0)
                                                {
                                                ?>
                                             <span class="badge badge-success">
                                                Answered
                                            </span>
                                                <?php
                                               }
                                            else{
                                                echo  '<span class="badge badge-warning">Pending</span>';
                                            }
                                            ?>
                                    </td>
                                    <td>
                                    <?php 
                                            if($all_post->comment_count>0)
                                            {
                                            ?>
                                             <span class="badge badge-success">
                                            <a class="text-light" href="<?php echo get_the_permalink($all_post->ID);?>">View Answer</a>
                                            </span>
                                                <?php
                                            }else
                                            {
                                             ?>
                                             <span class="badge badge-primary">
                                            <a class="text-light" href="<?php echo get_the_permalink($all_post->ID);?>">Give Answer</a>
                                            </span>
                                                <?php   
                                            }
                                        ?>
                                    </td>

                                </tr>    
                            <?php
                            }    
}
                            ?>
                    </tbody>
                </table>
                <?php        
                }
                else
                {
                    ?>  <br />
                        <h3 class="alert alert-warning text-center">No Question From (<?php $user=get_user_by("id",$_REQUEST['user_id']); echo $user->display_name;?>) Were Found!...<a href="<?php echo home_url();?>/consultancy-service/"><b>&nbsp;Go back</b></a></h3>
                    <?php    
                }
            ?>
            </div>    
            <div class="col-sm-2"></div>     
   
</div>            
            <?php            
    }           
    get_footer();
?>