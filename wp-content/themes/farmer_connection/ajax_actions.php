<?php

require_once('../../../wp-config.php');
require_once('../../../wp-includes/wp-db.php');
global $wpdb;





//Add Chat Message
if(isset($_REQUEST['action']) && $_REQUEST['action']=='ask_question_user')
{    
    $user_id       = get_current_user_id();
    $consultant_id = $_REQUEST['consutant_id'];
    $question      = $_REQUEST['question'];
    $description   = $_REQUEST['description'];
    $category      = array($_REQUEST['consult_category']);   
    
    $defaults = array(
        'post_author' => $user_id,
        'post_title' =>$question,
        'post_status' => 'publish',
        'post_type' => 'consultancy',
        'comment_status' => 'open',
        'post_parent' => 0,
        'menu_order' => 0,
        );
    
    $result_id = wp_insert_post($defaults);
    wp_set_post_terms($result_id,$category,"consult_cats",true);   
    $result = update_post_meta($result_id,"consutant_id",$consultant_id);

    
    if($result)
    {
       echo "Question has Been Submitted Successfully!...";
    }
    else
    {
        echo "Please Insert The QUestion & Description!...";
    }
    
}

/*Update User Account Status*/
if ( !function_exists( 'update_user_status' ) ) { 
    require_once ABSPATH . '/wp-admin/includes/ms.php'; 
} 

//Approve / Disapprove Accounts
if(isset($_REQUEST['action']) && $_REQUEST['action']=='set_account_status'){
    
    $blogusers = get_users([ 'role__in' => ['academic','farmer','consultant'],"orderby"=>"user_status","order"=>"DESC" ]);
    
    
    if($_REQUEST['status']==0)
    {
        $status = 1;
    }
    else if($_REQUEST['status']==1)
    {
        $status = 0;
    }
    $user_id = (int) $_REQUEST['user_id'];
   $update=  $wpdb->update("wp_users", array("user_status"=>$status), array("ID"=>$user_id));
 
	if($update){

        if($status==1)
        {
            echo "Account Disapproved Successfully!...";
        }
        else if($status==0)
        {
            echo "Account Approved Successfully!...";
        }
        
    }
else
{
    echo "Sorry, Something Went Wrong!...";
}    
}


/*Show User Orders By User ID*/
if(isset($_REQUEST['action']) && $_REQUEST['action']=='show_user_orders')
{
    
    $user_orders = $wpdb->get_results("SELECT uo.order_id,uo.cart_id ,uo.order_date,uo.delivery_date, uo.shipping_address, uo.billing_address,p.method, uo.status FROM wp_user_order uo 
    INNER JOIN wp_cart c ON uo.cart_id = c.cart_id							
    INNER JOIN wp_pay_method p ON uo.payment_id = p.payment_id
    WHERE c.user_id=".$_REQUEST['user_id']."  ORDER BY order_id DESC ");      
           ?>
                                     
            <div class="modal fade" id="user-orders-dialog-box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title alert bg-dark text-light" id="exampleModalLabel"><b>USER ORDERS INFORMATION</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <style>
                        #tbl-prodcts th,td,#tbl-orders th,td{
                           
                            font-weight: bold;
                        }
                    .modal-content{
                        width: 1200px;
                        margin-left: -300px;
                    }
                </style>
              <div class="modal-body">
                  <?php
                    
                    if($user_orders){
                    ?>    
                  <h5 class="text-danger"><b>All Orders</b></h5>
                  <table class="table table-striped table-hover table-bordered" id="mytable">
                      <thead class="bg-dark text-center text-light">
                        <tr>
                            <th >Order ID</th>
                            <th >Cart ID</th>
                            <th >Order Date</th>
                            <th >Delivery Date</th>
                            <th >Shipping Address</th>
                            <th >Billing Address</th>
                            <th >Clity</th>
                            <th >Payment Method</th>
                            <th >Status</th>
                            <th>Details</th>
                        </tr>
                      </thead>
                    <tbody>
                    <?php
                        
                        foreach($user_orders as $key => $user_order)
                        {
                            
                        ?>    
                        <tr>
                            <td><?php echo $user_order->order_id;?></td>
                            <td><?php echo $user_order->cart_id;?></td>
                            <td><?php echo date("d F Y",strtotime($user_order->order_date));?></td>
                            <td><?php echo date("d F Y",strtotime($user_order->delivery_date));?></td>
                            <td ><?php echo $user_order->billing_address;?></td>
                            <td><?php echo $user_order->shipping_address;?></td>
                            <td><?php echo $user_order->city;?></td>
                            <td><?php echo $user_order->method;?></td>
                            <td>
                                <?php
                                    if($user_order->status!='cancelled')
                                    {?>
                                        <span class="badge badge-<?php if($user_order->status=="pending"){echo "warning";}else if($user_order->status=="processed"){echo "info";}else if($user_order->status=="delivered"){echo "success";}?>"><?php echo $user_order->status;?></span>
                                <?php
                                    }
                                ?>
                            </td>
                            <td><a href="" class="btn btn-primary btn-sm" id="cart-details" order_id="<?php echo $user_order->order_id;?>"><b>View Details</b></a></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                  </table>
                  <?php
                    }
                    else
                    {
                        ?>
                        <h3 class="alert alert-warning text-center"><b>Sorry, No Orders Were Found!...</b></h3>    
                        <?php
                    }
                    ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

      <?php


}


/*Show User Order Cart Detail*/
if(isset($_REQUEST['action']) && $_REQUEST['action']=='show_cart_details')
{
         $order_details = $wpdb->get_results(" SELECT uo.order_id,uo.cart_id ,uo.order_date,uo.delivery_date, uo.shipping_address, uo.billing_address, uo.status,p.method ,cit.city FROM wp_user_order uo
							INNER JOIN wp_cart c ON uo.cart_id = c.cart_id							
							INNER JOIN wp_pay_method p ON uo.payment_id = p.payment_id
							INNER JOIN wp_city cit ON uo.city_id=cit.city_id 
							WHERE uo.order_id=".$_REQUEST['order_id']." ORDER BY order_id DESC  ");      
        
        
    ?>
        
          <div class="modal fade" id="cart-detail-dialog-box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #4adfe6;">
              <div class="modal-header">
                <h5 class="modal-title text-light alert bg-dark" id="exampleModalLabel"><b>CUSTOMER'S COMPLETE ORDER INFORMATION</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <style>
                        #tbl-prodcts th,td,#tbl-orders th,td{
                           
                            font-weight: bold;
                        }
                </style>
              <div class="modal-body">
                  <h5 class="text-danger"><b>Order Details &nbsp;<span class="text-primary">(<?php echo $order_details[0]->status;?>)</span></b></h5>
                  <table class="table bg-light table-hover table-bordered" id="mytable">
                      <thead class="bg-dark text-center text-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Cart ID</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Billing Address</th>
                            <th>Shipping Address</th>
                            <th>City</th>
                            <th>Payment Metdod</th>
                        </tr>
                      </thead>
                    <tbody>
                        <tr class="text-center">
                            <td><?php echo $order_details[0]->order_id;?></td>
                            <td><?php echo $order_details[0]->cart_id;?></td>
                            <td><?php echo date("d F Y",strtotime($order_details[0]->order_date));?></td>
                            <td><?php echo date("d F Y",strtotime($order_details[0]->delivery_date));?></td>
                            <td ><?php echo $order_details[0]->billing_address;?></td>
                            <td><?php echo $order_details[0]->shipping_address;?></td>
                            <td><?php echo $order_details[0]->city;?></td>
                            <td><?php echo $order_details[0]->method;?></td>
                        </tr>
                    </tbody>
                  </table>
                  <hr />
                    <?php
                        
                     $userdata = $wpdb->get_results("SELECT u.* FROM wp_users u,wp_cart c WHERE u.ID=c.user_id AND c.cart_id=".$order_details[0]->cart_id."");
                        /*                        foreach($users as $user_id){
                                print_r(get_user_meta ( $user_id->ID));
                            }*/
                    ?>
                    <h5 class="text-danger"><b>User Details</b></h5>
                    <table class="table table-bordered bg-light table-hover" id="tbl-prodcts">
                        <thead class="bg-dark text-center text-light">
                            <tr>
                                 <td>ID</td>
                                 <td>Name</td>
                                 <td>Email</td>
                                 <td>Cell</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                 <td><?php echo $userdata[0]->ID;?></td>
                                 <td><?php echo $userdata[0]->user_nicename;?></td>
                                 <td><?php echo $userdata[0]->user_email;?></td>
                                 <td><?php echo get_user_meta($userdata[0]->ID,'cell',true);?></td>
                            </tr>
                        </tbody>
                  </table>
                
                  <hr />
                           
                    <?php
                         $products = $wpdb->get_results("SELECT c.product_id, c.quantity,p.post_title FROM wp_cart_product c,wp_posts p WHERE c.product_id = p.ID  AND c.cart_id = ".$order_details[0]->cart_id);
        
                       // print_r($result);
   
                        $price = get_post_meta($products[0]->product_id,"price",true);
                    ?>
                    <h5 class="text-danger"><b>Products Details</b></h5>
                  <table class="table table-bordered bg-light table-hover" id="mytable">
                        <thead class="bg-dark text-center text-light">
                            <tr>
                                 <td>Product</td>
                                 <td>Price</td>
                                 <td>Quantity</td>
                                 <td>Sub Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total=0;    
                            foreach($products as $key => $product){
                            $total+=($products[$key]->quantity*get_post_meta($products[$key]->product_id,"price",true));    
                            ?>
                            <tr class="text-center">
                                 <td><?php echo get_the_title($products[$key]->product_id);?></td>
                                 <td>$<?php echo get_post_meta($products[$key]->product_id,"price",true);?></td>
                                 <td><?php echo $products[$key]->quantity;?></td>
                                 <td>$<?php echo ($products[$key]->quantity*get_post_meta($products[$key]->product_id,"price",true));?></td>
                            </tr>
                            <?php
                            }
                            ?>    
                        </tbody>
                  </table>
                  <button class="btn btn-warning float-right"><b>Total Amount: </b>$<?php echo $total;?></button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      <?php
        }


/*Like Consultant Profile*/

if(isset($_REQUEST['action']) && $_REQUEST['action']=='account_like')
{    

    $liked = get_user_meta($_REQUEST['like_consultant_id'],'account_liked',true);
    $update = update_user_meta($_REQUEST['like_consultant_id'],'account_liked',$liked+1);
    $update = add_user_meta($_REQUEST['like_consultant_id'],'account_liked_by',$_REQUEST['like_user_id']);
        
    
        if($update)
        {
            echo "Thank you to like the account :)";
        }
        else
        {
            echo "Something Went Wrong";
        }    
}
    
?>


