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

  
    global $current_user;
    get_currentuserinfo();

    require_once("require/shop-cart-class.php");
    require_once("shopping-cart/dal_cart.php");
    require_once("shopping-cart/dal_cart_product.php");

    $shop_obj       = new Shop_Session_Class();
    $cart           = new Cart_DAL();	
    $cartProduct    = new Cart_Product_DAL(); 

    ?>
    
    <br />
    <style>
         .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
            background-color: red;
             font-style: italic;
             font-weight: bold;
        }
        input,#tabs_2_2 span{
            font-style: italic;
            font-weight: bold;
        }
        #tabs_2_2 span{color: red;}
        #mytable td{
            font-weight: bold;
            font-style: italic;
        }
    </style>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-9" style="background-color: #4adfe6;">
            <br />
            <form method="POST">
            <h2 class="text-center alert bg-dark text-light"><b><i>SHIPPING DETAILS</i></b></h2>
                 <?php
                        if(isset($_POST['btn-place-order']))
                        {
                            $message = "";
                            $cart_id = $wpdb->get_row("SELECT * FROM wp_cart WHERE status = 0 AND user_id =".$current_user->ID." ORDER BY cart_id DESC");	
                            if($cart_id)//user cart for proccessing found in db
                            {
                                /* "email"            => $_REQUEST['email'],*/ 
                                /* "cell"             => $_REQUEST['cell'], */
                                
                               $order_data = array(
                                   
                                    "billing_address"  => $_REQUEST['billing_address'],
                                    "shipping_address" => $_REQUEST['shipping_address'],   
                                    "city_id"             => $_REQUEST['city'],
                                    "payment_id"       => $_REQUEST['pay_method'],
                                    "cart_id"          => $cart_id->cart_id,
                                    "order_date"       => date("Y-m-d H:i:s"),
                                    "delivery_date"    => date("Y-m-d H:i:s",strtotime("+3 day")),
                                    );
                                
                                //    echo "<pre>";
                                  //  print_r($order_data);

                                    $result = null;
                                    $result = $wpdb->insert('wp_user_order',$order_data);
                                    if($result)
                                    {
                                        
                                        $cart_status = array("status"=>1);
                                        
                                        
                                        $result = null;
                                        $result = $wpdb->update('wp_cart',$cart_status,array("cart_id"=>$cart_id->cart_id));
                                        
                                        if($result)
                                        {
                                            
                                            $cart_products =  $wpdb->get_results("SELECT * FROM wp_cart_product WHERE cart_id =".$cart_id->cart_id);
                                            
                                            foreach($cart_products as $product)
                                            {
                                                $stock = get_post_meta($product->product_id,"stock",true);	  						
                                                update_post_meta($product->product_id,'stock',($stock-$product->quantity));
                                            }
                                            
                                            ////////////Deduct Stocks///////////
                                            echo "<h3 class='alert alert-success text-center'>order has been placed successfully.</h3>";
                                            
                                        }
                                    }
                                }    
                        }    
                        ?>
                
                
                
            <ul class="nav nav-pills nav-fill mb-3" id="tabs_2" role="tablist">
                <li class="nav-item alert-dark">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tabs_2_1" role="tab" aria-controls="home" aria-selected="true">
                        <span class="nav-link-icon d-block"><i class="fab fa-connectdevelop fa-2x"></i></span>
                        <span class="d-none d-sm-block mt-3"><b><i>1. YOUR EMAIL</i></b></span>
                    </a>
                </li>
                <li class="nav-item alert-dark rounded">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tabs_2_2" role="tab" aria-controls="profile" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fas fa-code fa-2x"></i></span>
                        <span class="d-none d-sm-block mt-3"><b><i>2. ADDRESS</i></b></span>
                    </a>
                </li>
                <li class="nav-item alert-dark">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tabs_2_3" role="tab" aria-controls="contact" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fab fa-node-js fa-2x"></i></span>
                        <span class="d-none d-sm-block mt-3"><b><i>3. ORDER SUMMARY</i></b></span>
                    </a>
                </li>
                   <li class="nav-item alert-dark">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tabs_2_4" role="tab" aria-controls="contact" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fab fa-node-js fa-2x"></i></span>
                        <span class="d-none d-sm-block mt-3"><b><i>4. PAYMENT METHOD</i></b></span>
                    </a>
                </li>        
            </ul>
        <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active col-sm-4" id="tabs_2_1" role="tabpanel" aria-labelledby="home-tab">
        <label style="color:red;"><b><i>Email:</i></b></label>
        <input type="email" name="email" value="<?php echo $current_user->user_email;?>" class="form-control bg-dark text-light" required/>
        <br />
    </div>
    <div class="tab-pane fade" id="tabs_2_2" role="tabpanel" aria-labelledby="profile-tab">
            <span>Billing Address:</span> 
            <input type="text" class="form-control col-sm-6 bg-dark text-light" placeholder="enter billing address (city, state)" name="billing_address" value="" required><br />

            <span>Shipping Address:</span>
           <input type="text" class="form-control bg-dark text-light" placeholder="enter shipping address (city, state)" name="shipping_address" value="" required><br />

            <span>City:</span>   
            <select class="form-control bg-dark text-light" name="city" required>
                <option value="">select the city</option>    
                    <?php
                        $cities=$shop_obj->get_cities(); 
                        if($cities)
                        {
                            foreach( $cities as $city)
                            {
                            ?>
                             <option value="<?php echo $city->city_id;?>"><?php  echo $city->city;?></option>
                            <?php 
                            }
                        }    
                    ?>
            </select> <br />

            <span>Cell:</span>
             <input type="text" class="form-control bg-dark text-light" placeholder="enter cell no" name="cell" value="<?php echo $current_user->cell;?>" required><br />
            </div>
    <div class="tab-pane fade" id="tabs_2_3" role="tabpanel" aria-labelledby="contact-tab">
             <?php
                   if(is_user_logged_in())
          {      
            //User Cart ID (echo result);
            $result = $cart->getUserCart($current_user->ID);    
             if($result){
                //$cartID = $result;
                $result_cartProduct = $cartProduct->getCartProducts($result);
                    if($result_cartProduct)
                     { 
                         $i=0;
                         $subtotal=0;
                         $total=0;
                      ?>
                        <div>
                        <table class="table table-striped table-bordered responsive">
                            <thead>
                                <tr class="bg-dark text-white">

                                    <th style="text-align:center;">Product Name</th>
                                    <th style="text-align:center;">Price</th>
                                    <th style="text-align:center;">Quantity</th>
                                     <th style="text-align:center;">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                        foreach($result_cartProduct as $key => $cart_product)
                        { 
                            $i+=1;
                            $id       = $cart_product->product_id;
                            $name     = get_the_title($cart_product->product_id);
                            $price    = get_post_meta($cart_product->product_id, 'price', true );
                            $quantity = $cart_product->quantity;
                            $subtotal    = ($price * $quantity);
                            $total+=$subtotal;    
                        ?>
                           <tr>
                                 <td style="text-align:center;"><?php echo $name;?></td>
                                 <td style="text-align:center;">$<?php echo  $price;?></td>
                                 <td style="text-align:center;"><?php echo $quantity;?></td>
                                 <td style="text-align:center;">$<?php echo $subtotal;?></td>
                          </tr>
                        <?php        
                        }
                    ?>
                </tbody>
            </table>
        </div>    
        <div>    
            <button class="btn btn-dark float-right"><?php echo "Total Amount : $",$total;?></button>
            <br /><br />
        </div>                 
    <?php                
    }
     else
     {
         ?>
            <script type="text/javascript">
                window.location.href="<?php echo home_url();?>";
            </script>
        <?php     
    }       
    }
}//Login If
        
       
           if(!is_user_logged_in()){
            $result=$shop_obj->getSessionProducts();        
    ?>
                        <div>
                        
                                <?php
                                    if(isset($_REQUEST['btn-update-cart']))
                                        {
                                       ?>
                                        <p class="alert alert-success text-center"><b><i>Success, 
                                        <?php
                                        for($i = 1; isset($_REQUEST['product_id'.$i]); $i++)
                                        {
                                            if($_POST['quantity'.$i] <= 0)
                                            {
                                                $shop_obj->deleteProductSession($_POST['product_id'.$i]);
                                            }
                                            else
                                            {
                                             $shop_obj->addProductInSession($_POST['product_id'.$i],$_POST['product_name'.$i],$_POST['quantity'.$i],$_POST['price'.$i]);
                                            }
                                        }
                                        $i-=1;
                                        echo $i."Products Updated Successfully.";
                                        
                                    ?>
                                    </i></b>        
                            </p>        
                                    <?php        
                                    }
                                ?>
                          
                        <table class="table table-striped table-bordered responsive">
                            <thead>
                                <tr class="bg-dark text-white">

                                    <th style="text-align:center;">Product Name</th>
                                    <th style="text-align:center;">Price</th>
                                    <th style="text-align:center;">Quantity</th>
                                     <th style="text-align:center;">Sub Total</th>
                                </tr>
                            </thead>
                        <tbody>
      <?php
               
                        $count=0;
                        $i=0; 
                    if($result){    
                    foreach($result as $key=>$value){
                   $i+=1;
                    ?>    
                       <tr>
                             <td style="text-align:center;"><?php echo $result[$key]['product_name'];?></td>
                             <td style="text-align:center;"><?php echo $result[$key]['price'];?></td>
                             <td style="text-align:center;"><input type="number" class="form-control" value="<?php echo $result[$key]['quantity'];?>" name="quantity<?php echo $i;?>" min="0" max="20"></td>
                
                            <td style="text-align:center;">  <?php echo ($result[$key]['price']*$result[$key]['quantity']);?></td>
                </tr>
                   <?php        
                     $count+=($result[$key]['price']*$result[$key]['quantity']);    
                    }
                    }
                    ?>
                    
                    </tbody>
                    </table>
                        </div>    
                    <div>    
                    <button class="btn btn-primary"><i class="glyphicon glyphicon-usd"></i>&nbsp;<?php echo "Total Amount : ",$count;?></button>
                         <br /> <br />
                  </div>                 
    <?php                
     }        
    ?>
        
    </div>
    <div class="tab-pane fade" id="tabs_2_4" role="tabpanel" aria-labelledby="contact-tab">
                
                        
                    
                    <table class="table table-responsive table-striped" id="mytable">
                        
                        <?php
                        $pay_methods = $shop_obj->get_pay_methods(); 
                        if($pay_methods)
                        {
                            foreach( $pay_methods as $pay_method)
                            {
                            ?>
                            <tr>
                            <td><input type="radio" name="pay_method" id="pay_method" value="<?php echo $pay_method->payment_id;?>" ></td>
                            <td><?php echo $pay_method->method;?></td>
                            
                        </tr>
                            <?php 
                            }
                        }
                    ?>
                            </table>
                        
                        <span class="float-right"> <input type="submit" name="btn-place-order" value="Place Order Now" class="btn btn-dark ">
                            
                      </span>  
         <br /> <br />
                
    </div>
           
</div>        
    
        </form>
        </div>
        <div class="col-sm-2"></div>
    </div>

    


<?php
get_footer();
?>