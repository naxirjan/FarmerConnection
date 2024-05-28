<?php
get_header();
    if($_POST)
{
    global $wpdb;
    $message = NULL;
    
        
        
        
    $email_exists = email_exists($_REQUEST['email']);
    
    $user_exists = username_exists($_REQUEST['username']);

    if($email_exists && $user_exists)
    {
        
        $message ="Username & Email Already Exists";
    }
    else if($email_exists)
    {
        $message ="Email Already Exists";
    }
    else if($user_exists)
    {
        $message ="User Already Exists";
    }
    
    else
    {
        $user_id = wp_create_user($_POST['username'],$_POST['password'],$_POST['email']);
        
        if($user_id)
        {
            $userdata = array("cell","city","state","country","wp_capabilities","profession_category","expertise");
            for($i=0; $i<=isset($userdata[$i]); $i++)
            {
               // update_user_meta( $user_id, $userdata[$i], $_POST[$userdata[$i]]);    
            
                if(isset($_POST[$userdata[$i]]))
                {
                     update_user_meta( $user_id, $userdata[$i], $_POST[$userdata[$i]]);
                    
                }

            }
           
           // update_user_meta( $user_id, 'cell', $_POST['cell'] );
            $message = "Account Has Been Created Sccessfully!...";
        }
        else
        {
            $message = "Account Creation Failed, Please Try Again!...";
        }
    }

}
?><hr />
    <style>
        .badge,#btn-submit{
           
            font-weight: bold;
        }
        #signup-form
        {
            background-color: #d6d6d6;
        }
        
    </style>


        <script>
            $(document).ready(function() {
               
                 //Setting Active color of header signup button
                $(".btn-head-signup").css({background:"red",color:"white"});
                $("#cats_section").hide();
                
                $("#profession").change(function(){

                if($("#profession option:selected").attr("role") == "Consultant"){
                $("#cats_section").show();
                }else
                {
                   $("#cats_section").hide();  
                }
               
                    
                if($("#profession option:selected").attr("role") == "Academic"){
                $("#levels").hide();
                }else
                {
                  $("#levels").show();  
                }    
            });

        });
        </script>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class=" text-light col-sm-10 rounded" id="signup-form" style="background-color: #4adfe6;">
            <br />
        <h1 class="text-center alert bg-dark text-light rounded" style="padding:10px;"><b>Register Yourself By Creating New Account</b></h1>
        <h4 class="text-center text-dark"><b>Enter Your Complete Information To Signup</b></h4>    
        <hr />        
        <?php
        if(isset($message))
        {
            ?>
            <div class="alert  alert-warning alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Alert</strong>
            <h3 class="text-center"><?php echo $message;?></h3>    
            </div>
            <?php
        }        
        ?>  
                
            <p class="text-center text-warning" id="controls_invalid"></p>
            <!--JQuery Validation-->
               <form id="form_1" name="form_1" method="POST" action="" enctype="multipart/form-data">
                            
                            <strong class="badge badge-dark text-light">Username:</strong>
                            <input type="text" name="username" id="username" class="form-control bg-dark text-light" required>    
                        <hr />
                            <strong class="badge badge-dark text-light">Email:</strong>
                            <input type="email" name="email" id="email" class="form-control bg-dark text-light">    
                        <hr />
                            <strong class="badge badge-dark text-light">Password:</strong>
                            <input type="password" name="password" class="form-control bg-dark text-light" id="password">    
                        <hr />
                            <strong class="badge badge-dark text-light">Cell No:</strong>
                            <input type="number" name="cell" class="form-control bg-dark text-light" id="cell">    
                        <hr />
                        <div class="form-group">
                        <strong class="badge badge-dark text-light">Location:</strong>
                        <select  class="form-control bg-dark text-light" id="city" name="city">
                          <option value="">--Select City--</option>
                          <option value="Dadu">Dadu</option>
                          <option value="Jamshoro">Jamshoro</option>
                          <option value="Karachi">Karachi</option>
                          <option value="Hyderabad">Hyderabad</option>
                          <option value="Larkana">Larkana</option>
                        </select>
                        </div>   
                        <div class="form-group">    
                        <select  class="form-control bg-dark text-light" id="state" name="state">
                          <option value="">--Select State--</option>
                          <option value="Sindh">Sindh</option>
                          <option value="Punjab">Punjab</option>
                          <option value="Sarhad">Sarhad</option>
                          <option value="KPK">KPK</option>
                          <option value="Baloachistan">Baloachistan</option>
                        </select>
                        </div>   
                        <div class="form-group">    
                        <select  class="form-control bg-dark text-light" id="country" name="country">
                          <option value="">--Select Country--</option>
                          <option value="Pakistan">Pakistan</option>
                          <option value="Turkey">Turkey</option>
                          <option value="China">China</option>
                          <option value="Iran">Iran</option>
                          <option value="Saudi Arabia">Saudi Arabia</option>
                        </select>   
                        </div>
                        <hr />
                        <strong class="badge badge-dark text-light">Profession:</strong>
                        <div class="form-group">
                        <select class="form-control bg-dark text-light" id="profession" name="profession">
                          <option value="">--Select The Profession--</option>
                          <?php
                                global $wp_roles;
                                $user_roles = $wp_roles->roles;
                                foreach($user_roles as $key => $user_role)
                                {
                                if($user_role['name']!='Administrator'){    
                                ?>
                                <option value="<?php echo $user_role['name'];?>" role="<?php echo $user_role['name'];?>"><?php echo $user_role['name'];?></option>
                                <?php
                                }
                                }
                            ?>
                        </select>
                        </div>
                        <div class="form-group" id="cats_section">
                        <strong class="badge badge-dark text-light" id="cat_label" >Category:</strong>    
                        <select class="form-control bg-dark text-light" id="profession_category" name="profession_category">
                          <option value="">--Select The Category--</option>
                          <?php
                                $taxonomy_objects =  $terms = get_terms(['taxonomy' => "consult_cats",'hide_empty' => false]);
                                foreach($taxonomy_objects as $key => $taxonomy_object)
                                {
                                ?>
                                <option value="<?php echo $taxonomy_object->term_id;?>"><?php echo $taxonomy_object->name;?></option>
                                <?php
                                }
                            ?>
                        </select>
                            
                        </div>
                       <hr />
                        <div class="form-group" id="levels">
                        <strong class="badge badge-dark text-light">Level Of Expertise:</strong>    
                        <select class="form-control bg-dark text-light" id="expertise" name="expertise">
                          <option value="">--Select The Expertise level--</option>
                          <option value="Expert">Expert</option>
                          <option value="Beginner">Beginner</option>
                          <option value="Intermediate">Intermediate</option>
                        </select>
                            
                        </div>
                        
                        <p class="text-center">
                        <input type="submit" class="btn btn-dark" id="btn-submit"  name="btn-submit" value="Signup" style="width:200px;"/> </p>
                        <p class="text-center">
                    <a href="<?php echo home_url();?>/signin" class="btn btn-light" style="width:200px;"><b>Signin</b></a>
                    </p>
                    </form>
                <input type="hidden" id="hidden" value="<?php echo get_template_directory_uri();?>/ajax_actions.php"/>
                </div>    
            <div class="col-sm-1"></div>
        </div>
<?php
get_footer();
?>