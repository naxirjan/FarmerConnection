<?php
//require_once("require/session.php");
if(!is_user_logged_in())
{
     ?>
    <script type="text/javascript">
        window.location.href="<?php echo home_url();?>/signin";
    </script>
    <?php         
}

get_header();

global $current_user;
get_currentuserinfo();
?>
     <br />

 
                         <script>

              $(document).ready(function(){
                    
                 
                    $('#mytable').DataTable();
                    $(".dataTables_length,.dataTables_info").hide();
                    $("#mytable_paginate").addClass("bg-dark btn-sm");
                    $("#mytable_filter input").addClass("form-control bg-dark").attr('placeholder','Enter The Word To Search');
                    $("#mytable_filter label").css({"text-align":"left","font-weight":'bold'}).addClass('text-light');
                  
                    $(".dataTables_length,.dataTables_info").hide();
                    
                });
    </script>

    
    <?php

    if($current_user->roles[0]=='farmer' || $current_user->roles[0]=='academic')
    {
    ?>
     <div class="row">
        
            
         <div class="col-sm-12 bg-info">
             <br />
            <h1 class="text-center alert text-light bg-dark"><b><i>Consultancy Service</i></b></h1>
           <table class="table  bg-warning table-hover   rounded" id="mytable">
                <thead class="bg-dark table-bordered text-white text-center">
                    <style>
                        #cols th,td{
                            font-style: italic;
                            font-weight: bold;
                        }
                        .avatar {
                            width: 30px;
                            height: 30px;
                        }
                    </style>
                    <tr id="cols">
                        <th>Profile</th>
                        <th>Person</th>
                        <th>Cell</th>
                        <th>Email</th>
                        <th>Profession</th>
                        <th>Expertise</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Like</th>
                        <th>Action</th>
                    </tr>
                </thead>
               <tbody>
                   <?php 
                  
                 
                    $args = array(
                        'fields'       => 'all',
                        'role'         =>'consultant' 
                        
                    );

                    $users = new WP_User_Query( $args );

                    ?>
                             <?php
                                $i=0;
                                if ( $users->get_results() ) 
                                    foreach( $users->get_results() as $all_user ) {
                                        
                                    $account_liked = get_user_meta($all_user->ID,'account_liked',true);    
                                    $user_liked =  get_user_meta($all_user->ID,'account_liked_by');  
                                        
                                    if($current_user->ID !=$all_user->ID){        
                                   ?>

                    <tr class="text-center">
                        <td>
                            <?php echo get_avatar($all_user->ID);?>    
                        </td>
                        <td >
                            <span class="badge badge-success"><i>
                                <?php 
                                    echo ucfirst($all_user->display_name); 
                                ?>
                                </i>
                            </span>
                        </td>
                        
                        <td>
                            <?php echo $all_user->cell;?>
                        </td>
                        
                        <td>
                            <?php echo $all_user->user_email;?>
                        </td>
                       
                        <td>
                            <?php echo $all_user->roles[0];?>
                        </td>
                       
                        <td>
                            <?php  if(isset($all_user->expertise)){echo $all_user->expertise;}else{echo "<span class='badge badge-danger'>No Expertise Level</span>";}?>
                        </td>
                        
                        <td>
                            <?php echo $all_user->profession_category;?>
                        </td>
                        
                         <td>
                            <?php echo $all_user->city." / ".$all_user->state." / ".$all_user->country;?>
                        </td>
                        <td>
                            <?php 
                                if($account_liked>0)
                                {
                                ?>
                                <span class="badge badge-warning">(<?php echo $account_liked;?>)</span> / 
                                <?php
                                }?>
                            
                            <?php
                                        
                              if(in_array($current_user->ID, $user_liked))
                              {
                            ?>
                            <img src="<?php echo get_template_directory_uri();?>/images/liked.png" width="30" height="30" title='You Have Already Liked'/>
                            <?php
                            }
                            else
                            {
                            ?>
                            <a id="like-profile" href="" like_user_id="<?php echo $current_user->ID;?>" like_consultant_id="<?php echo $all_user->ID;?>">
                                <img src="<?php echo get_template_directory_uri();?>/images/like.png" width="30"    height="30" />
                            </a>
                            <?php
                            
                            }            
                            ?>      
                            
                        </td>
                        <td>
                            <a id="ask-question" href="" consultant_id="<?php echo $all_user->ID;?>" user_id="<?php echo $current_user->ID;?>" consult_category="<?php echo $all_user->profession_category;?>" class="btn btn-success btn-sm"><b>Ask Question</b></a>
                            <a href="<?php echo home_url();?>/users-questions?consult_id=<?php echo $all_user->ID;?>"  class="btn btn-primary btn-sm"><b>View Answers</b></a>
                        </td>
                   </tr>
                   <?php
                   }
                
                    }
                    ?>    
               </tbody>
           </table>
            
             
             <script>
             
                 $(document).ready(function(){
                    
                    var consultant_id=null;
                    var consult_category=null; 
                     
                    
                     /*Show Modal for Asking Question From Consultant*/
                     $(document).on("click","#ask-question",function(e){
                     e.preventDefault();
                         
                        consultant_id = $(this).attr("consultant_id");
                        consult_category  = $(this).attr("consult_category");
                        url = $("#hidden").val();

                         $('#questionModel').modal('show');
                     });
                       /*Ask Question From Consultant*/
                     
                     
                     /*Submit To Ask Question*/
                     $("#btn-submit-question").click(function(){
                         question = $("#question").val();
                         description = $("#description").val();
                        jQuery.ajax({
                            type: "post",
                            url: url,
                            data:"action=ask_question&consultant_id="+consultant_id+"&question="+question+"&description="+description+"&consult_category="+consult_category,
                            success: function(data){
                                
                                $('#questionModel').modal('hide');
                                 
                                $('#successModel').modal('show');
                                $("#result-message").html(data);
                               
                                }   
                        });//jQuery
                     });
                     /*Submit To Ask Question*/
                     
                    
                     /*Like Consultant Profile*/
                     $(document).on("click","#like-profile",function(e){
                     e.preventDefault();
                     
                     like_consultant_id = $(this).attr('like_consultant_id');
                    like_user_id = $(this).attr('like_user_id');     
                        url = $("#hidden-like").val();
                       
                        $.ajax({
                        type:'post',
                        url:url,
                        data:"action=account_like&like_consultant_id="+like_consultant_id+"&like_user_id="+like_user_id,
                        success:function(data){
                        $("#modelLikeText").html(data);
                        $("#modelLike").modal('show');
                        },  
                            
                        });
                        
                         
                         $(".close").click(function(){
                                 
                            window.location.href="<?php echo home_url();?>/consultancy-service";     
                         });
                         
                     });      
                    /*Like Consultant Profile*/
                     
                     
                 });                    
             </script>
             
             <p id="a"></p>
             <input type="hidden" id="hidden-like" value="<?php echo get_template_directory_uri();?>/ajax_actions.php" />
             
            <!-- Modal Add Question-->
            <div class="modal fade" id="questionModel" tabindex="-1" role="dialog" aria-labelledby="questionModelLabel" aria-hidden="true">
              <div class="modal-dialog " role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-info" id="questionModelLabel"><b>Ask The Question</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <span class="badge badge-dark">Question : </span>  
                   <input type="text" id="question" class="form-control" style="font-weight:bold;" required/>
                    <br />
                      <span class="badge badge-dark">Description : </span>  
                   <textarea class="form-control" id="description" style="font-weight:bold;" required></textarea>
                  </div>
                  <div class="modal-footer">
                      <input type="hidden" id="hidden" value="<?php echo get_template_directory_uri();?>/ajax_actions.php" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-submit-question" class="btn btn-success">Submit Question</button>
                  </div>
                </div>
              </div>
            </div>



            <!--Model Success-->
             <!-- Modal -->
            <div class="modal fade" id="successModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel"><b>Alert!...</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h5 class="text-dark" id="result-message"><b></b></h5>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
</div>             
            </div>
        
         <!--Model Success-->
             <!-- Modal -->
            <div class="modal fade" id="modelLike" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content bg-info">
                  <div class="modal-header">
                    <h5 class="modal-title text-light" id="exampleModalLabel"><b>Alert!...</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h4 class="text-light text-center" id="modelLikeText"><b></b></h4>
                  </div>
                  <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary close" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
</div>             
            </div>
        
      
<?php
    }

    if($current_user->roles[0]=='consultant' || $current_user->roles[0]=='administrator')
    {
    ?>
     <div class="row">
        <div class="col-sm-1"></div>
     
         <div class="col-sm-10">
            <h3 class="text-center bg-light"><b><i>Consultancy Service</i></b></h3>
             
           <table class="table table-sm table-respon bg-light table-striped rounded" id="mytable">
                <thead class="bg-info table-bordered text-white text-center">
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
                    <tr id="cols">
                        <th>Profile</th>
                        <th>Person</th>
                        <th>Cell</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
               <tbody>
                   <?php 
                  
                
                    $args = array(
                        'fields'       => 'all',
                        'role__not_in' => array('consultant',"administrator"),
                    );

                    $users = new WP_User_Query( $args );

                    ?>
                             <?php
                                if ( $users->get_results() ) 
                                    foreach( $users->get_results() as $all_user ) {
                                        
                                        if($current_user->ID !=$all_user->ID){        
                                   ?>

                    <tr class="text-center">
                        <td>
                            <?php echo get_avatar($all_user->ID);?>    
                        </td>
                        <td >
                            <span class="badge badge-success"><i>
                                <?php 
                                    echo ucfirst($all_user->display_name); 
                                ?>
                                </i>
                            </span>
                        </td>
                        
                        <td>
                            <?php echo $all_user->cell;?>
                        </td>
                        
                        <td>
                            <?php echo $all_user->user_email;?>
                        </td>
                       
                         <td>
                            <?php echo $all_user->city." / ".$all_user->state." / ".$all_user->country;?>
                        </td>
                        
                        <td>
                            <a href="<?php echo home_url();?>/users-questions?user_id=<?php echo $all_user->ID;?>"  class="btn btn-primary"><b>View Questions</b></a>
                        
                        </td>
                   </tr>
                   <?php
                   }
                    }
                    ?>    
               </tbody>
           </table>
          
             
             <script>
             
                 $(document).ready(function(){
                    
                     
                    var consultant_id=null;
                    var consult_category=null; 
                     
                     $(document).on("click","#ask-question",function(e){
                     e.preventDefault();
                         
                        consultant_id = $(this).attr("consultant_id");
                        consult_category  = $(this).attr("consult_category");
                        url = $("#hidden").val();

                         $('#questionModel').modal('show');
                     });
                    
                     $("#btn-submit-question").click(function(){
                        
                         question = $("#question").val();
                         description = $("#description").val();
                      jQuery.ajax({
                            type: "post",
                            url: url,
                            data:"action=ask_question&consultant_id="+consultant_id+"&question="+question+"&description="+description+"&consult_category="+consult_category,
                            success: function(data){
                                
                                $('#questionModel').modal('hide');
                                 
                                $('#successModel').modal('show');
                                $("#result-message").html(data);
                               
                                }   
                        });//jQuery
                         
                         
                     });
                     
                     
                 });                    
             </script>
             
           
             
            <!--Model-->
            <!-- Button trigger modal -->


<!-- Modal Add Question-->
<div class="modal fade" id="questionModel" tabindex="-1" role="dialog" aria-labelledby="questionModelLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-info" id="questionModelLabel"><b>Ask The Question</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="badge badge-dark">Question : </span>  
       <input type="text" id="question" class="form-control" style="font-weight:bold;" required/>
        <br />
          <span class="badge badge-dark">Description : </span>  
       <textarea class="form-control" id="description" style="font-weight:bold;" required></textarea>
      </div>
      <div class="modal-footer">
          <input type="hidden" id="hidden" value="<?php echo get_template_directory_uri();?>/ajax_actions.php" />
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btn-submit-question" class="btn btn-success">Submit Question</button>
      </div>
    </div>
  </div>
</div>
        
           
             
<!--Model Success-->
 <!-- Modal -->
                <div class="modal fade" id="successModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-success" id="exampleModalLabel"><b>Alert!...</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h5 class="text-dark" id="result-message"><b></b></h5>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>             
       </div>
      <div class="col-sm-1"></div>
    </div>    
<?php
    }

get_footer();
?>