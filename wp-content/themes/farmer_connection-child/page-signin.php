<?php
get_header();
?>
 <hr />
    <style>
        .badge,#btn-submit{
            font-style: italic;
            font-weight: bold;
        }
        #signup-form
        {
            background-color: #d6d6d6;
        }
    </style>  
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="bg-info text-white col-sm-6 rounded">
            <br />
        <h3 class="text-center bg-light text-dark rounded" style="padding:10px;"><b><i>Signin Your Account Here</i></b></h3>
        <p class="text-center text-info"><b><i>Enter Your Authentication Information To Signin</i></b></p> 
            <?php
            if( isset($_REQUEST['login']))
            {
                ?>
                <!--<p class="alert alert-danger text-center"><b></b><small></small></p>-->
                <div class="alert bg-danger alert-dismissible fade show" role="alert"><i>
                  <strong>Username/Password Is Wrong</strong>&nbsp; (Or Account Is Temporary Deactived)</i>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
            }
            ?>    
        <hr />        
            <?php
            if(isset($message))
            {
                ?>
                <p class="badge badge-danger"><?php echo $message;?></p>
                <?php
            }        
            ?>   

                <!--JQuery Validation-->
                <script type="text/javascript">

               var userForm_1;

                $(document).ready(function(){
                    
                    
                    $(".close").click(function(){
                        
                    window.location.href="<?php echo home_url();?>/signin";    
                        
                    });
                    
                    
                    //Setting Active color of header signin button
                    $(".btn-head-signin").css({background:"red",color:"white"});
                    
                    $("#user_name,#password").addClass("form-control").attr("required","required");
                    $(".login-username label,.login-password label,.login-remember label").addClass("badge badge-light text-dark");
                    $("#wp-submit").addClass("btn btn-light btn-lg").css({width:'200','font-weight':'bold'});
                    $(".login-submit").addClass("text-center");
                    
                    userForm_1 = $("#form_1").validate({
                      rules: {
                        user_name: {
                          required: true
                        } ,
                          password: {
                        required: true,
                        }
                     }
                       
                    //Form
                  });
                    
                });    
                </script>
                <?php
               
                    
                    if(isset($_SESSION['products']))
                    {
                     $url="/checkout";   
                    }
                    else if($user_pending_cart==true)
                    {
                      $url="/place-order";   
                    }
                    else if(!isset($_SESSION['products']))
                    {
                      $url="/profile";   
                    }
            
                   
                    $defaults = array(
                        'echo' => true,
                        // Default 'redirect' value takes the user back to the request URI.
                        'redirect' => home_url().$url,
                        'form_id' => 'form_1',
                        'label_username' => __( 'User Name:' ),
                        'label_password' => __( 'Password' ),
                        'label_remember' => __( 'Remember Me' ),
                        'label_log_in' => __( 'Signin' ),
                        'id_username' => 'user_name',
                        'id_password' => 'password',
                        'id_remember' => 'remember_me',
                        'id_submit' => 'wp-submit',
                        'remember' => true,
                        'value_username' => '',
                        // Set 'value_remember' to true to default the "Remember me" checkbox to checked.
                        'value_remember' => false,
                    );
                
            
                    wp_login_form($defaults);
            
            ?>
                <p class="text-center">
                <a href="<?php echo home_url();?>/signup" class="btn btn-dark btn-lg" style="width:200px;">Signup</a>
                </p>    
                </div>    
            <div class="col-sm-3"></div>
    </div>
<?php 
get_footer(); 
?>