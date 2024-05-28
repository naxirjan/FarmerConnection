<?php
require_once("require/session.php");
get_header();
?>
   <br />
    <hr />



  <!--JQuery Validation-->
                <script type="text/javascript">

               var userForm_2;

                   
                    
                $(document).ready(function(){
                    
                    $( "#userForm_2" ).submit(function( event ) {
                           
                            event.preventDefault();
                     
                        category = $("#category").val();
                        question = $("#question").val();
                        description = $("#description").val();
                        url = $("#hidden").val();    

                        jQuery.ajax({
                            type: "post",
                            url: url,
                            data: "action=add&category="+category+"&question="+question+"&description="+description,
                            success: function(data){
                                $("#controls_invalid").addClass("alert-success").css({fontWeight:"bold",fontStyle:"italic"});
                                $("#controls_invalid").html(data);
                                

                                }   
                        });//jQuery
                        
                  });
                    
                    userForm_2 = $("#userForm_2").validate({
                      rules: {
                            category: {
                            required: true
                            },

                            question: {
                            required: true,
                            },

                            description:{
                            required: true,  
                            }  
                     },
                    messages: {
                            category: {
                            required: "<span class='w-100 p-1 badge badge-danger alert-dismissible fade show ' role='alert'><i><strong>Error: </strong>Please Select The Category!...</i></span>"
                            },

                            question: {
                              required:"<span class='w-100 p-1 badge badge-danger alert-dismissible fade show ' role='alert'><i><strong>Error: </strong>Please Enter The Question Title!...</i></span>" ,
                            },
                            description: {
                              required:"<span class='w-100 p-1 badge badge-danger alert-dismissible fade show ' role='alert'><i><strong>Error: </strong>Please Enter The Question Description!...</i></span>" ,
                            }            
                                },
                    invalidHandler: function(){
                                $("#controls_invalid").html("<br /><span id='alert' class='w-100 p-3 alert alert-danger alert-dismissible fade show ' role='alert'><strong>Total "+userForm_2.numberOfInvalids()+" Fields Are Invalid, Please Correct Them!....</strong></span><br />");
                                }        
                     });
                    
                });    
                </script>

        


    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6" style="background-color:#4adfe6;">
            <br />
            <h3 class="text-center alert bg-dark text-white" style="padding:5px;"><b><i> Add Your Question / Message </i></b></h3>
               
                <p id="controls_invalid" class="text-center"></p>
                
               <form id="userForm_2" name="userForm_2" method="POST" action="">
                            
                <div class="form-group">
                        <strong class="badge badge-dark">Category:</strong>
                        <select  class="form-control bg-dark text-light" id="category" name="category">
                          <option value="">--Select Category--</option>
                            <?php
                                $args = array(
                                "hide_empty"=>false,
                                "orderby" =>"term_id",
                                "order" => "ASC"    
                                );
                            
                                $categories = get_terms("forum_cats",$args);
                                foreach($categories as $category)
                                {
                                    
                                ?>
                              <option value="<?php echo $category->name;?>"><?php echo $category->name;?></option>
                              <?php
                                }
                            ?>            
                        </select>
                        </div> 
                    
                   
                   
                            <strong class="badge badge-dark">Question/Message:</strong>
                            <input type="text" name="question" id="question" class="form-control bg-dark text-light">    
                        <hr />
                            <strong class="badge badge-dark">Description:</strong>
                            <textarea rows="5" name="description" id="description" class="form-control bg-dark text-light"></textarea>    
                        <hr />
                        <p class="text-center">
                        <input type="submit"  class="btn btn-dark" id="btn-submit"  name="btn-submit" value="Submit" />
                        </p>
                            <p><a  class="btn btn-success"href="<?php echo home_url();?>/discussion-forum"><b><i>View Discussions</i></b></a></p>
                        </form>    
                        <input type="hidden" id="hidden" value="<?php echo get_template_directory_uri();?>/ajax_actions.php"/>
        
            </div>
       <div class="col-sm-3"></div>
    </div>

<?php
get_footer();
?>