<?php
get_header();
global $wpdb;
global $current_user;
get_currentuserinfo();
?>
  

    <br />
        

       
        
             <?php
            $orders = $wpdb->get_results("SELECT uo.order_id,uo.cart_id ,uo.order_date,uo.delivery_date, uo.shipping_address, uo.billing_address, uo.status FROM wp_user_order uo
            INNER JOIN wp_cart c ON uo.cart_id = c.cart_id							
            INNER JOIN wp_pay_method p ON uo.payment_id = p.payment_id
            WHERE c.user_id=".$current_user->ID."  ORDER BY order_id DESC ");
            ?> 

            <script>

                $(document).ready(function(){
                    
                    
                   /* $('#mytable').dataTable( {
                      "searching": true,
                      "pagingType": "full_numbers"
                    } );
                    */
     
                    $('#mytable').DataTable();
                    $("#mytable_paginate").addClass("bg-dark btn-sm");
                    $(".paginate_button previous").addClass("text-light");
                    $("#mytable_filter input").addClass("form-control");
                    $("#mytable_filter label").css("text-align","left");
                    $(".dataTables_length,.dataTables_info").hide();
                    
                });
            </script>
         <style>
                        .modal-dialog{
                            max-width: 1000px;
                        }
                      #mytable td
                      {
                          font-weight: bold;
                      }
                  </style>
        <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" style="background-color: #4adfe6;">
                        <p id="result"></p>
                    <h3 class="alert bg-dark text-center text-light"><b>All Orders</b></h3>
                    <p id="cancel_order_result"></p>
                    
                  <table class="table table-hover  table-bordered " id="mytable">
                  <thead class="bg-dark text-white text-center">
                    <tr>
                        <th >Order No</th>
                        <th >Order Date</th>
                        <th >Delivery Date</th>
                        <th >Shipping Address</th>
                        <th >Billing Address</th>
                        <th >Status</th>
                        <th >Action</th>
                    </tr>
</thead>
                  <tbody id="table-body">
                        <?php 
                            foreach($orders as $order)
                            {
                                ?>
                                    <tr class="alert-dark text-center">
                                        <td><?php echo $order->order_id;?></td>
                                        <td><?php echo date("d M Y",strtotime($order->order_date));?></td>
                                        <td><?php echo date("d M Y",strtotime($order->delivery_date));?></td>
                                        <td><?php echo $order->shipping_address;?></td>
                                        <td><?php echo $order->billing_address;?></td>
                                        <td>
                                            <?php 
                                                if($order->status==0)
                                                {
                                                    ?>
                                                    <span class="badge badge-warning">Pending</span>
                                                    <?php
                                                }
                                                else if($order->status==1)
                                                {
                                                    ?>
                                                    <span class="badge badge-info">Processed</span>
                                                    <?php
                                                }
                                                else if($order->status==2)
                                                {
                                                    ?>
                                                    <span class="badge badge-success">Completed</span>
                                                    <?php
                                                }
                                                else if($order->status==3)
                                                {
                                                    ?>
                                                    <span class="badge badge-danger">Cancelled</span>
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td >
                                            <a href="" id="view-details" order_id="<?php echo $order->order_id;?>" class="btn btn-primary text-light btn-sm"> <b>View Details</b></a>
                                            <?php
                                            if($order->status==0){
                                            ?>    
                                            <input  type="button" class="btn btn-success btn-sm"  value="Cancel Order" onclick="CancelOrder(<?php echo $order->order_id;?>)">
                                            <?php    
                                            } 
                                            ?>
                                        </td>
                                        <input type="hidden" id="orderid<?php echo $order->order_id;?>" value="<?php echo $order->order_id;?>">
                                    </tr>
                                <?php
                            }
                        ?>
                  </tbody>
            </table>
            <input type="hidden" id="hidden" value="<?php echo get_template_directory_uri();?>/ajax-shop.php">        

               <script>
            jQuery(document).ready(function(){
                /*btn View Order Details*/
                jQuery(document).on("click","#view-details",function(e){
                    e.preventDefault();
                    order_id =jQuery(this).attr("order_id");
                    url = jQuery("#hidden").val();
                  
                    jQuery.ajax({
                      type:"post",
                      url:url,
                      data:"action=order_details&order_id="+order_id,
                      success:function(data){
                        jQuery("#order-details-result").html(data);
                        jQuery('#order-dialog-box').modal('show');
                        },   
                   });
                    
                });
            });
    
                
            function CancelOrder(id){
            var orderid = document.getElementById("orderid"+id).value;
            var ajax;
            var url = document.getElementById("hidden").value;    

            if (window.XMLHttpRequest){
            ajax = new XMLHttpRequest();
            }else{
            ajax = new ActiveXObject("Microsoft.XMLHTTP");
            }

            ajax.onreadystatechange= function(){
            if (ajax.readyState==4 && ajax.status==200){
            document.getElementById("cancel_order_result").innerHTML= ajax.responseText;    
            setTimeout(function(){location.reload();},1500);    

            }
            }

            ajax.open("GET",url+"?flag=3&orderid="+orderid);
            ajax.send();    
            }

            
            </script>
            
        <!--Order Details Dialog-->
<!-- Modal -->
         
<div id="order-details-result">       
</div>
        </div>
        <div class="col-sm-1"></div>
    </div>



<?php
get_footer();
?>