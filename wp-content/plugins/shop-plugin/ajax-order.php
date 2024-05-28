<?php
    require_once('../../../wp-config.php');
    require_once('../../../wp-includes/wp-db.php');
    global $wpdb;
    if(isset($_REQUEST['action']) && $_REQUEST['action']=='order_details')
    {
         $order_details = $wpdb->get_results(" SELECT uo.order_id,uo.cart_id ,uo.order_date,uo.delivery_date, uo.shipping_address, uo.billing_address, uo.status,p.method ,cit.city 
                FROM wp_user_order uo
							INNER JOIN wp_cart c ON uo.cart_id = c.cart_id							
							INNER JOIN wp_pay_method p ON uo.payment_id = p.payment_id
							INNER JOIN wp_city cit ON uo.city_id=cit.city_id 
							WHERE uo.order_id=".$_REQUEST['order_id']." ORDER BY order_id DESC  ");      
        
        
    ?>
          <div class="modal fade" id="order-dialog-box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #4adfe6;">
              <div class="modal-header">
                <h5 class="modal-title text-light alert bg-dark" id="exampleModalLabel"><b>COMPLETE ORDER INFORMATION</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <style>
                        #tbl-prodcts th,td,#tbl-orders th,td{
                            font-size: 80%;
                        }
                    </style>
              <div class="modal-body">
                  <h5 class="text-danger"><b>Order Details &nbsp;(
                      
                          <?php if($order_details[0]->status=='pending')
                            {
                                echo "<span class='badge badge-warning'>Pending</span>";
                            }
                            else if($order_details[0]->status=='processed')
                            {
                                echo "<span class='badge badge-info'>Success</span>";
                            }
                            else if($order_details[0]->status=='delivered')
                            {
                                echo "<span class='badge badge-success'>Delivered</span>";
                            } 
                            ?>&nbsp;)
                      </b></h5>
                  <table class="table table-striped table-bordered" id="tbl-orders">
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
                        <tr>
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
                            <tr>
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
                            <tr>
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


    //Process Order
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==1) {
       $order_id = $_REQUEST['orderid'];     
            
            $table="wp_user_order";
            $data = array("status"=>1);
            $id =array("order_id"=>$order_id);
            $update = $wpdb->update($table,$data,$id);
                
                if($update)
                {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                         <h4> <strong>Success,</strong> Order Has Been Processed Successfully!...</h4>
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

  //Complete Order
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==2) {
        $order_id = $_REQUEST['orderid'];
        
        $table="wp_user_order";
        $data = array("status"=>2);
        $id =array("order_id"=>$order_id);
        $update = $wpdb->update($table,$data,$id);
    
        
        if($update)
        {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                 <h4> <strong>Success,</strong> Order Has Been Completed Successfully!...</h4>
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

/*Show report Controls Date/Quantity*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='show_report_controls')
{

     
    if($_REQUEST['report']==1)
    {
        ?>
        
        <div class="col-sm-2"></div>
        <div class="col-sm-4"><b>Date From:</b><input type="date" id="top_sale_fromdate" class="form-control"/></div>
        <div class="col-sm-4"><b>Date To:</b><input type="date" id="top_sale_todate" class="form-control" /><br />
            <a href="" class="btn btn-success text-white" report_type='top_selling' id="btn-make-report"><b>Submit</b></a>
        </div>
        <div class="col-sm-2"></div>
        
       
        <?php
    }
    else if($_REQUEST['report']==2)
    {
        ?>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <span><b></b></span>
                <div class="form-group">
                    <label for="report"><b>Low Inventory Quantity:</b></label>
                    <select class="form-control" id="report">
                        <option value="">--Select Less Than Quantity--</option>    
                        <option value="10">Less Than 10</option>  
                        <option value="20">Less Than 20</option> 
                        <option value="30">Less Than 30</option> 
                        <option value="40">Less Than 40</option> 
                        <option value="50">Less Than 50</option> 
                    </select>
                </div>
                <p class="text-center">
                    <a href="" class="btn btn-success text-white" report_type='low_inventory' id="btn-make-report"><b>Submit</b></a>
                </p>    
        </div>
        
        <div class="col-sm-3"></div>
        
        <?php
    }
    else if($_REQUEST['report']==3)
    {
        ?>
        <div class="col-sm-2"></div>
        <div class="col-sm-4"><b>Date From:</b><input type="date" id="new_customers_fromdate" class="form-control"/></div>
        <div class="col-sm-4"><b>Date To:</b><input type="date" id="top_sale_todate" class="form-control" /><br />
                <a href="" class="btn btn-success text-white" report_type='new_users' id="btn-make-report"><b>Submit</b></a>
        </div>
        <div class="col-sm-2"></div>
           
        <?php
    }
   
}


/*Make Reports*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='make_report')
{
   
    if($_REQUEST['report_type']=='top_selling')
    {
        $from = $_REQUEST['from_value'];
        $to = $_REQUEST['to_value'];
        
        $top_sellings = $wpdb->get_results("SELECT cp.product_id, SUM(cp.quantity) AS 'quantity',uo.order_date FROM wp_user_order uo,wp_cart_product cp,wp_cart c WHERE uo.order_date BETWEEN '".$from."' AND '".$to."' AND uo.cart_id = c.cart_id AND cp.cart_id = c.cart_id
        GROUP BY cp.product_id HAVING COUNT(cp.product_id) > 1");
        
              if($top_sellings)
         {

         ?>
    <style>#mytable2 td th{
    font-weight: bold;
    }</style>
          <table class="table table-bordered table-hover" id="mytable2">
                          <thead class="bg-info text-center text-light">
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Is Featured</th>
                                <th>In Stock</th>
                                <th>Category</th>
                                <th>Product Owner</th>
                                <th>Order Date</th>
                            </tr>
                          </thead>
                        <tbody>
                            <?php
                                foreach($top_sellings as $top_selling){

                                      
                                $price = get_post_meta($top_selling->product_id,'price',true);
                                $featured = get_post_meta($top_selling->product_id,'is_featured',true);    
                                $stock = get_post_meta($top_selling->product_id,'stock',true);
                                
                                $postdata = get_post($top_selling->product_id);
                                $auhtor = get_user_by('ID',$postdata->post_author);    

                                $cats = wp_get_object_terms($top_selling->product_id, 'product_cats', array( 'fields' => 'names' ,"orderby"=>"term_id","order"=>"ASC") );
        
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $top_selling->product_id;?></td>
                                    <td><?php echo get_the_title($top_selling->product_id);?></td>
                                    <td><?php echo $price;?></td>
                                    <td><?php echo $top_selling->quantity;?></td>
                                    <td><?php if($featured>0){echo 'YES';}else{echo 'NO';} ?></td>
                                    <td><?php echo $stock;?></td>
                                    <td><?php echo $cats[0]." / ".$cats[1];?></td>
                                    <td><?php echo $auhtor->display_name;?></td>
                                    <th><?php echo date('d-m-Y',strtotime($top_selling->order_date));?></th>
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
                <!-- Modal -->
            <div class="modal fade" id="modalReports" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content bg-danger">
              <div class="modal-header">
                <h3 class="modal-title text-dark" id="exampleModalLabel"><b>Alert !...</b></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body ">
                  <h4 class="text-center text-light">No Top Selling Products Were Found <b><span class="text-dark"><br />From</span> <span class="text-warning">(<?php echo date('d-m-Y',strtotime($from)); ?>)</span> <span class="text-dark">To</span> <span class="text-warning">(<?php echo date('d-m-Y',strtotime($to));?>)</span></b></h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
            
        <?php
        }

        
    }
        
 
    else if($_REQUEST['report_type']=='low_inventory')
    {
        
        $products = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE meta_key ='stock' AND meta_value<".$_REQUEST['low_inventory']."");
         if($products)
         {

         ?>
    <style>#mytable2 td th{
    font-weight: bold;
    }</style>
          <table class="table table-bordered table-hover" id="mytable2">
                          <thead class="bg-info text-center text-light">
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Is Featured</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th>Product Owner</th>
                            </tr>
                          </thead>
                        <tbody>
                            <?php
                                foreach($products as $product){



                                $price = get_post_meta($product->post_id,'price',true);
                                $featured = get_post_meta($product->post_id,'is_featured',true);    
                                $stock = $product->meta_value;
                                $postdata = get_post($product->post_id);
                                $auhtor = get_user_by('ID',$postdata->post_author);    


                            $cats = wp_get_object_terms($product->post_id, 'product_cats', array( 'fields' => 'names' ,"orderby"=>"term_id","order"=>"ASC") );

                                ?>
                                <tr class="text-center">
                                    <td><?php echo $product->post_id;?></td>
                                    <td><?php echo $postdata->post_title;?></td>
                                    <td><?php echo $price;?></td>
                                    <td><?php if($featured>0){echo 'YES';}else{echo 'NO';} ?></td>
                                    <td><?php echo $stock;?></td>
                                    <td><?php echo $cats[0]." / ".$cats[1];?></td>
                                    <td><?php echo $auhtor->display_name;?></td>
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
<!-- Modal -->
<div class="modal fade" id="modalReports" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h3 class="modal-title text-dark" id="exampleModalLabel"><b>Alert !...</b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
       <h4 class="text-light text-center">Sorry, No Products Were Found Less Than (<span><?php echo $_REQUEST['low_inventory'];?> ) Stock</span></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        <?php
         }

        }
 
    else if($_REQUEST['report_type']=='new_users')
     {
        
            date_default_timezone_set('asia/karachi');
            $from = date('Y-m-d',strtotime($_REQUEST['from_value']));
            $to =   date('Y-m-d',strtotime($_REQUEST['to_value']));

            $all_users = $wpdb->get_results("SELECT ID FROM wp_users WHERE  user_registered BETWEEN '".$from."' AND '".$to."' "); 
       
                 if($all_users)
         {
            ?> 
        <hr />
        <h4 class="text-center"><b>Results From ( <span class="text-success"><?php echo date('d-m-Y',strtotime($from)); ?></span> &nbsp;To&nbsp; <span class="text-success"><?php echo date('d-m-Y',strtotime($to));?></span> )</b></h4>
        <table class="table table-bordered table-hover" id="mytable2">
                              <thead class="bg-info text-center text-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Profession</th>
                                    <th>Expertise Level</th>
                                    <th>Cell</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                </tr>
                              </thead>
                            <tbody>
                                <?php
                                    foreach($all_users as $all_user){
                                        
                                    $user_data = get_userdata($all_user->ID);
                                    
                                    $profession = get_user_meta($all_user->ID,'wp_capabilities');
                                    $expertise = get_user_meta($all_user->ID,'expertise',true);
                                    $cell = get_user_meta($all_user->ID,'cell',true);
                                    $city = get_user_meta($all_user->ID,'city',true);
                                    $state = get_user_meta($all_user->ID,'state',true);
                                    $country = get_user_meta($all_user->ID,'country',true);   
                                    ?>
                                <tr>
                                    <td><?php echo $user_data->ID;?></td>
                                    <td><?php echo $user_data->display_name;?></td>
                                    <td><?php echo $user_data->user_email;?></td>
                                    <td><?php echo date('d-m-Y',strtotime($user_data->user_registered));?></td>
                                    <td><?php echo ucfirst($user_data->roles[0]);?></td>
                                    <td><?php echo $expertise;?></td>
                                    <td><?php echo $cell;?></td>
                                    <td><?php echo $city;?> / <?php echo $state;?> / <?php echo $country;?></td>
                                    <td><?php if($user_data->user_status==0){echo "<span class='text-success'>Active</span>";}else if($user_data->user_status==1){echo "Pending";}?></td>
                                    
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
            <!-- Modal -->
            <div class="modal fade" id="modalReports" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h3 class="modal-title text-dark" id="exampleModalLabel"><b>Alert !...</b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
          <h4 class="text-center text-light">No New Users Were Found<b><span class="text-dark"><br />From</span> <span class="text-warning">(<?php echo date('d-m-Y',strtotime($from)); ?>)</span><span class="text-dark"> To</span> <span class="text-warning">(<?php echo date('d-m-Y',strtotime($to));?>)</span></b></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
            <?php
        }    


    }
 
    

        
    
    }
    
?>