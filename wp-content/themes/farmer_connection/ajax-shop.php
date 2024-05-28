<?php

require_once("require/shop-cart-class.php");
require_once('../../../wp-config.php');
require_once('../../../wp-includes/wp-db.php');

        require_once("require/shop-cart-class.php");
        require_once("shopping-cart/dal_cart.php");
        require_once("shopping-cart/dal_cart_product.php");

                $shop_obj       = new Shop_Session_Class();
                $cart           = new Cart_DAL();	
                $cartProduct    = new Cart_Product_DAL();
                $shop_obj = new Shop_Session_Class();

                        global $current_user;
                        get_currentuserinfo();
                        global $wpdb;
            

/*Add Product In Cart*/
if(isset($_REQUEST['action']) && $_REQUEST['action']=='add_cart')
{        
    if(is_user_logged_in())
    {    
    
        $productId  = $_REQUEST['product_id'];
        $quantity   = $_REQUEST['quantity'];

        $result     = $cart->getUserCart($current_user->ID);
        $cartID     = $result[0]->cart_id;
        $cart_exist = $result[0]->cart_exist; 
        
        
       

        if($cart_exist == 1)
        {

            $result = $wpdb->get_results("SELECT * FROM wp_cart_product WHERE cart_id = ".$cartID." AND product_id = ".$productId);

             
            if($result)
            {

                if($quantity <= 0)
                {
                    $result = $cartProduct->deleteCartProduct($cartID,$productId);
                }
                else
                {
                    $quantity = $result[0]->quantity+$quantity; 
                    $result = $cartProduct->updateCartProduct($cartID,$productId,$quantity);
                    if($result){
                     echo "Product Exists, Quantity Updated";
                    }
                   
                }	
            }

            else{

                if($quantity > 0)
                {
                    $result = $cartProduct->addCartProduct($cartID,$productId,$values['quantity']);
                    if($result)
                    {
                    echo "Product Has Been Added.";
                    }
                }

            }

        }

        
        else if($cart_exist==0)
        {
            $result = $cart->addCart($insert_id,$current_user->ID);   
            if($result)
            {

                $result = $cartProduct->addCartProduct($insert_id,$productId,$quantity);
                if($result)
                {
                     echo "Product Has Been Added In Cart Successfully";
                }					
            }
        }   
    
    
    } 
    
            if(!is_user_logged_in())
            {    

                $result =$shop_obj->addProductInSession($_REQUEST['product_id'],$_REQUEST['product_name'],$_REQUEST['quantity'],$_REQUEST['price']);    

                if($result)
                {
                    echo $result;
                }   
            }

}


/*Show Order Details*/
if(isset($_REQUEST['action']) && $_REQUEST['action']=='order_details')
{
         $order_details = $wpdb->get_results(" SELECT uo.order_id,uo.cart_id ,uo.order_date,uo.delivery_date, uo.shipping_address, uo.billing_address, uo.status,p.method ,cit.city FROM wp_user_order uo
							INNER JOIN wp_cart c ON uo.cart_id = c.cart_id							
							INNER JOIN wp_pay_method p ON uo.payment_id = p.payment_id
							INNER JOIN wp_city cit ON uo.city_id=cit.city_id 
							WHERE uo.order_id=".$_REQUEST['order_id']." ORDER BY order_id DESC  ");      
        
        
    ?>
        
          <div class="modal fade" id="order-dialog-box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #4adfe6;">
              <div class="modal-header">
                <h5 class="modal-title alert bg-dark text-light" id="exampleModalLabel"><b>COMPLETE ORDER INFORMATION</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <style>
                        #tbl-prodcts th,td,#tbl-orders th,td{
                            font-size: 80%;
                            font-weight: bold;
                        }
                </style>
              <div class="modal-body">
                  <h5 class="text-danger"><b>Order Details &nbsp;<span class="text-primary">(<?php if($order_details[0]->status==0){echo "Pending";}else if($order_details[0]->status==1){echo "Processed";}else if($order_details[0]->status==2){echo "Completed";}else if($order_details[0]->status==3){echo "Cancelled";} ?>)</span></b></h5>
                  <table class="table table-striped table-bordered" id="mytable">
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
                    <table class="table table-bordered" id="tbl-prodcts">
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
                  <table class="table table-bordered" id="tbl-prodcts">
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
                                 <td><?php echo get_post_meta($products[$key]->product_id,"price",true);?></td>
                                 <td><?php echo $products[$key]->quantity;?></td>
                                 <td><?php echo ($products[$key]->quantity*get_post_meta($products[$key]->product_id,"price",true));?></td>
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


  //Cancel Order
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==3) {
        $order_id = $_REQUEST['orderid'];
        
        $table="wp_user_order";
        $data = array("status"=>3);
        $id =array("order_id"=>$order_id);
        $update = $wpdb->update($table,$data,$id);
    
        if($update)
        {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                 <h4> <strong>Success,</strong> Order Has Been Cancelled Successfully!...</h4>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            <?php
        }    
        else
        {
            $wpdb->print_error();
        }
}



if(isset($_REQUEST['action']) && $_REQUEST['action'] == "search")
{
    
  ?>
    <div class="row">    
    <div class="col-sm-3">
            <h3 class="bg-info text-light text-center">Categories</h3> 
           <div id="accordion">
  <?php
        $i=0;       
       $taxonomy = 'product_cats';
    $postType = 'product';
    $terms = get_terms(['taxonomy' => $taxonomy, 'orderby' => 'term_id', 'parent' => 0, 'hide_empty' => false]);
    foreach($terms as $term){
    $i++;    
    ?>        
    <div class="card">
    <div class="card-header" id="heading<?php echo $i;?>">
      <h5 class="mb-0 text-center">
        <button class="btn  btn-link btn-sm  collapsed" data-toggle="collapse" data-target="#collapse<?php echo $i;?>" aria-expanded="false" aria-controls="collapse<?php echo $i;?>">
            <h4><?php echo $term->name;?></h4>
        </button>
      </h5>
    </div>

    <div id="collapse<?php echo $i;?>" class="collapse" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordion">
      <div class="card-body">
       <?php
         $childTerms = get_terms(['taxonomy' => $taxonomy, 'orderby' => 'term_id', 'parent' => $term->term_id, 'hide_empty' => false]);

        foreach($childTerms as $childTerm)
        {
        ?>
           <a id="search" cat_id="<?php echo $childTerm->term_id;?>"><h5 class="text-center btn-outline-info rounded"><?php echo $childTerm->name ?></h5></a>
        <?php  
        }
        ?>
      </div>
    </div>
  </div>
   <?php
    }
    ?>    
               
               
</div>
             
             
             
           
         </div>    
     <?php
    $args = array(
        'post_type' => 'product',
        'tax_query' => array(
            array(
            'taxonomy' => 'product_cats',
            'field'    => 'id',
            'terms'    => $_REQUEST['cat_id']
        ),
    ),
);


$product_posts = new WP_Query( $args );



    if($product_posts->have_posts()){
     
    while($product_posts->have_posts()){
    $product_posts->the_post();    
    $get_all_meta_values = get_post_custom($post->ID);
    $price=$get_all_meta_values["price"][0];
    $email=$get_all_meta_values["email"][0];
    $featured =$email=$get_all_meta_values["is_featured"][0];    
     $stock = $get_all_meta_values["stock"][0]; 
        
        $cat = wp_get_object_terms( $post->ID, 'product_cats', array( 'fields' => 'names',"orderby"=>"term_id","order"=>"ASC" ) );
        
                ?>  
   <style>
                .box-shadow h3,span,p,a{
                    font-style: italic;
                }    
            </style> 
                
            <div class="col-md-3">
              <div class="card mb-4 box-shadow">
                  
                <img class="card-img-top" src="<?php echo get_the_post_thumbnail_url($post->ID);?>"  data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                <div class="card-body">
                    <span class="text-danger"><b><?php echo $cat[0];?></b></span>/
                    <span class="text-info"><b><?php echo $cat[1];?></b></span>
                    <?php if($featured==1)
                    {
                        ?>
                            <span class="badge badge-warning float-right">Featured</span>
                        <?php
                    }
                    ?>
                    <hr />
                    <h3><a href="<?php echo get_the_permalink($post->ID);?>"><?php the_title();?></a></h3>
                    <b><span class="text-info">Price:&nbsp;</span><span class="text-dark">$<?php echo $price;?></span></b><br />
                    <?php
                        if($stock)
                        {
                            ?>
                               <b> <span class="text-info">In Stock:&nbsp;</span><span class="text-dark"><?php echo $stock;?></span></b><br />
                            <?php    
                        }
                    ?>
                    <?php
                    if(!empty($get_all_meta_values["email"][0])){
                    ?>
                    <b><span class="text-info">Contact:&nbsp;</span><span class="text-dark"><?php echo $get_all_meta_values["email"][0];?></span></b>
                   
                    <?php
                    }
                    ?>    
                    <hr/>
                  <div class="text-center">
                    <div class="btn-group align-items-center">
                      <a href="<?php echo get_the_permalink($post->ID);?>" class="btn  btn-success"><b>Quick View</b></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    <?php   
    } 
    wp_reset_postdata();    
}
    else{
?>
<div class="col-sm-8">        
<h4 class="text-center alert alert-warning"><b>Sorry, Results Were Not Found !...</b></h4>
</div>
    <?php
}
  
?>
        </div>
<?php        
    
}




?>