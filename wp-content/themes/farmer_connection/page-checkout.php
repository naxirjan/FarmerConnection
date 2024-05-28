<?php
    require_once("require/shop-cart-class.php");
    require_once("shopping-cart/dal_cart.php");
    require_once("shopping-cart/dal_cart_product.php");

         global $current_user;
         get_currentuserinfo();

            $shop_obj = new Shop_Session_Class();
            $cart = new Cart_DAL();
            $cartProduct = new Cart_Product_DAL();

                get_header();
                //session_destroy();
                ?>

<p class="text-center">page-checkout.php</p>
 <div class="row">        
<div class="col-sm-2">  </div> 
 <div class="col-sm-8 rounded" style="background-color: #4adfe6;">
     <br >
     <h3 class="alert bg-dark text-light text-center"><b>Products In Cart</b></h3>
       <?php
            if(isset($_REQUEST['btn-update-cart']))
            {

                if(is_user_logged_in())
                {
                   //Get User Cart ID
                    $result = $cart->getUserCart($current_user->ID);
                        if($result)
                        {
                           $flag = 0;
                            $quantity=0;
                            global $wpdb;
                            for($i = 1; isset($_REQUEST['product_id'.$i]); $i++)
                            {
                                
                               $product_id = $_REQUEST['product_id'.$i];
                                $quantity = $_REQUEST['quantity'.$i];
                                
                               
                                
                                $cartProductsResult = $cartProduct->getCartProduct($result,$product_id);
                                    if($cartProductsResult)
                                    {
                                        $cartID       = $cartProductsResult[0]->cart_id;
                                        $productID    = $cartProductsResult[0]->product_id;
                                        $cartQuantity = $cartProductsResult[0]->quantity;
                                        
                                       // echo "Cart ID: ".$cartID; 
                                            if($quantity<=0)
                                            {
                                                $result = $cartProduct->deleteCartProduct($cartID,$product_id);  
                                            }
                                            else
                                            {
                                              
                                            $data=array("quantity"=>$quantity);
                                            $id=array("cart_id"=>$cartID,"product_id"=>$product_id);
                                            $table="wp_cart_product";
                                            $wpdb->update($table,$data,$id);
                                            
                                            
                                            }
                                    //echo "Product has been updated ".$result;	    
                                    }
                                    else
                                    {
                                    //echo "Else Of If Cart Product";
                                            if($cartQuantity > 0)
                                            {
                                                $result = $cartProduct->addCartProduct($cartID,$productID,$cartQuantity);
                                            }
                                    //echo "Product has been added ".$result;
                                    }
                                
                                    if($result)
                                    {     $id=$productID;
                                        $shop_obj->deleteProductSession($id);
                                        $flag++;
                                    }
                            }//loop
                        }//if
                        else
                        {
                            //echo "Else Of If Cart ID";
                            $result = $cart->addCart($insert_id,$current_user->ID);
                            if($result)
                            {
                               $flag = 0;
                                for($i = 1; isset($_REQUEST['product_id'.$i]); $i++)
                                {
                                    $product_id = $_REQUEST['product_id'.$i];
                                    $quantity = $_REQUEST['quantity'.$i];
                                        if($quantity > 0)
                                        {
                                            $result = $cartProduct->addCartProduct($insert_id,$product_id,$quantity);
                                        }
                                        else
                                        {
                                            //$id=$cartProduct->getProductId();
                                            $shop_obj->deleteProductSession($product_id);
                                        }
                                        if($result)
                                        {
                                            $shop_obj->deleteProductSession($product_id);
                                            $flag++;
                                        }
                                }//Loop

                            }//End if
                        }
                        $result_message = $flag." Products Updated Successfully";
                        
                        if($result_message)
                        {
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Message,</strong> <?php echo $result_message;?> 
                           <button id="alert" type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span   aria-hidden="true">&times;</span>
                          </button>
                        </div>         
                            <?php
                        }
                }//If user login
                else if(!is_user_logged_in())
                {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Success,</strong> 
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
                        echo $i."<b><i> Product(s) Updated Successfully.</i></b>";

                    ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span id="alert" aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    <?php
                }
            }
        ?>
        <script>
        $(document).ready(function(){
        $( "#alert" ).click(function() {
        window.location.href="<?php echo home_url();?>/checkout";
        });
        });
        </script>
     
     <form method="POST" id="form1" action="">
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
                        <table class="table table-striped table-bordered" >
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
                                 <td style="text-align:center;"><input type="number" class="form-control" value="<?php echo $quantity;?>" name="quantity<?php echo $i;?>" min="0" max="20"></td>
                                 <td style="text-align:center;">  $<?php echo $subtotal;?></td>

                             <input type="hidden" value="<?php echo $id;?>" name="product_id<?php echo $i;?>" />   
                             <input type="hidden" value="<?php echo $name;?>" name="product_name<?php echo $i;?>" /> 
                             <input type="hidden" value="<?php echo  $price;?>" name="price<?php echo $i;?>" />            
                            </tr>
                        <?php        
                        }
                    ?>
                </tbody>
            </table>
        </div>    
        <div>    
            <input type="submit" value="Update" name="btn-update-cart" id="btn-update-cart" class="btn btn-primary " />    
            <a  href="place-order" class="btn btn-success" >Process To Next Step</a>    
            <button class="btn btn-dark float-right"><?php echo "Total Amount : $".$total;?></button>
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
         
        else if(!is_user_logged_in()){
            $result=$shop_obj->getSessionProducts();
            if($result){
    ?>
                        <div>
                        <table class="table table-striped table-bordered">
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
               <input type="hidden" value="<?php echo $result[$key]['product_id'];?>" name="product_id<?php echo $i;?>" />      
                <input type="hidden" value="<?php echo $result[$key]['product_name'];?>" name="product_name<?php echo $i;?>" /> 
                <input type="hidden" value="<?php echo $result[$key]['price'];?>" name="price<?php echo $i;?>" />            
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
                    <input type="submit" value="Update" name="btn-update-cart" id="btn-update-cart" class="btn btn-primary " />    
                    <a  href="place-order" class="btn btn-success" >Process To Next Step&nbsp;<i class="glyphicon glyphicon-forward"></i><i class="glyphicon glyphicon-forward"></i></a>    
                    <button class="btn btn-primary"><i class="glyphicon glyphicon-usd"></i>&nbsp;<?php echo "Total Amount : ",$count;?></button>
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
         
         
         
         
            function current_url() {
                        $current_url  = ( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
                        $current_url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
                        $current_url .= $_SERVER["REQUEST_URI"];

                        return $current_url;
                    }
            
            echo $_SESSION['url'];
         
         ?>
   </form>    
</div>        
<div class="col-sm-2"></div>   
</div>
  
<?php
get_footer();

?>