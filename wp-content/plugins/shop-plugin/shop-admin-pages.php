<?php


function add_shop_admin_pages()   
{
   add_menu_page("Ecommerce","Ecommerce","manage_options","shop-page","shop_method",plugin_dir_url(__FILE__)."images/icon.png",16);
	
    
    
    
    
        add_submenu_page("shop-page","Orders","Orders","manage_options","orders-page","orders_method");
    
        add_submenu_page("shop-page","Reports","Reports","manage_options","reports-page","reports_method");
	
    }	
?>

<?php
	function shop_method()
	{
    
    ?>


	<div id="header">
<h1><b><i><?php bloginfo("name");?></i></b></h1>
<hr/>
<h2><strong><i>About Ecommerce Plugin</i></strong></h2>
<h3><b><i><u>Ecommerce Information</u></i></b></h3>        
<p><i><b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?

It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ‘lorem ipsum’ will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)
    <br />
    

</b></i></p>        
	<?php
	}



	function orders_method()
	{
        
        global $wpdb;

        $orders = $wpdb->get_results("SELECT uo.order_id,uo.cart_id,uo.order_date,uo.delivery_date,uo.shipping_address,uo.billing_address,uo.status,pm.method,c.city FROM wp_user_order uo,wp_pay_method pm, wp_city c
WHERE uo.payment_id=pm.payment_id AND uo.city_id=c.city_id");
        
		?>
        <div class="col-sm-12">
<h1><b><?php bloginfo("name");?></b></h1>
    <hr /> 
        <style>
            .table th,td,a
            {
                font-weight: bold;
            }
            .table th{
               
            }
            .modal-dialog{
                max-width: 1000px;
            }    
        </style>
        <h3 class="text-center text-info"><b>Customer Orders</b></h3>
        <p id="order_result" class="text-center"></p>
	 <table class="table table-hover  table-bordered" id="mytable">
  <thead class="bg-primary text-white text-center">
    <tr class="bg-info">
        <th >Order No</th>
        <th>Cart ID</th>
        <th >Order Date</th>
        <th >Delivery Date</th>
        <th >Shipping Address</th>
        <th >Billing Address</th>
        <th >Order Status</th>
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
                        <td><?php echo $order->cart_id;?></td>
                        <td><?php echo date("d M Y",strtotime($order->order_date));?></td>
                        <td><?php echo date("d M Y",strtotime($order->delivery_date));?></td>
                        <td><?php echo $order->shipping_address;?></td>
                        <td><?php echo $order->billing_address;?></td>
                        <td>
                            <?php 
                                if($order->status=='pending')
                                {
                                    ?>
                                    <span class="badge badge-warning">Pending</span>
                                    <?php
                                }
                                else if($order->status=='processed')
                                {
                                    ?>
                                    <span class="badge badge-info">Processed</span>
                                    <?php
                                }
                                else if($order->status=='delivered')
                                {
                                    ?>
                                    <span class="badge badge-success">Completed</span>
                                    <?php
                                }
                            ?>
                        </td>
                        <td >
                            <a id="view-details" order_id="<?php echo $order->order_id;?>" class="btn btn-primary text-light"> <b>View Details</b></a>
                            <?php
                            if($order->status=='pending'){
                            ?>    
                           <input  type="button" class="btn btn-info "  value="Process" onclick="ProcessOrder(<?php echo $order->order_id?>)" >

                            <input  type="button" class="btn btn-success "  value="Complete" onclick="CompleteOrder(<?php echo $order->order_id;?>)" disabled>
                            <?php    
                            } 
                            elseif($order->status=='processed'){
                            ?>    
                              <input  type="button" class="btn btn-info "  value="Process" onclick="ProcessOrder(<?php echo $order->order_id;?>)" disabled >

                            <input  type="button" class="btn btn-success "  value="Complete" onclick="CompleteOrder(<?php echo $order->order_id;?>)" >


                            <?php  
                            } 
                            elseif($order->status=='delivered'){
                            ?>    
                              <input  type="button" class="btn btn-info "  value="Process" onclick="ProcessOrder(<?php echo $order->order_id;?>)" disabled >

                            <input  type="button" class="btn btn-success "  value="Complete" onclick="CompleteOrder(<?php echo $order->order_id;?>)" disabled>


                            <?php  
                            } 
                            elseif($order->status==3){
                            ?>    
                              <input  type="button" class="btn btn-info "  value="Process" onclick="ProcessOrder(<?php echo $order->order_id;?>)" disabled >

                            <input  type="button" class="btn btn-success "  value="Complete" onclick="CompleteOrder(<?php echo $order->order_id;?>)" disabled>
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
    </div>        
<input type="hidden" id="hidden" value="<?php echo plugin_dir_url(__FILE__);?>ajax-order.php">        
   
    <script>
            jQuery(document).ready(function(){
            
                jQuery('#mytable').DataTable( {
                    dom: 'Bfrtip',
                     buttons: [
            
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2,3,4,5 ]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2,3,4,5 ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2,3,4,5 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2,3,4,5 ]
                }
            },
            
        ]
} );
                   
                
                    jQuery("#mytable_paginate").addClass("bg-dark btn-sm");
                    jQuery(".paginate_button previous").addClass("text-light");
                   
                    jQuery("#mytable_filter label").css("text-align","left");
                    jQuery(".dataTables_length,.dataTables_info").hide();

                
                
                /*btn View Order Details*/
                jQuery(document).on("click","#view-details",function(){             
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
     </script>
        
    <script>
function ProcessOrder(id){
    
var url = document.getElementById("hidden").value;
    
var orderid = document.getElementById("orderid"+id).value;
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("order_result").innerHTML= ajax.responseText;    
setTimeout(function(){location.reload();},1500);    
}
}

ajax.open("GET",url+"?flag=1&orderid="+orderid);
ajax.send();    
}    
function CompleteOrder(id){
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
document.getElementById("order_result").innerHTML= ajax.responseText;    
setTimeout(function(){location.reload();},1500);    
    
}
}

ajax.open("GET",url+"?flag=2&orderid="+orderid);
ajax.send();    
}
    
</script>     
    
<!--Order Details Dialog-->
<!-- Modal -->
       
<div id="order-details-result">       
</div> 
        
        
        
        
        
<?php
}

        

	function reports_method()
	{
        
		?>
       
        <h1 class="text-info text-center"><b><?php bloginfo("name");?></b></h1>
        <hr />
        <h3 class=" alert alert-success text-center"><b>Generate Reports</b></h3>
        <div class="row col-sm-12">
            <div class="col-sm-4"></div>    
            <div class="col-sm-4">
                <label for="report"><b>Report Types:</b></label>
                <select class="form-control" id="report">
                <option value="">--Select Report Types--</option>    
                <option value="1">Top Selling</option>  
                <option value="2">Low Inventory</option> 
                <option value="3">New Customers</option> 
            </select>
            <input type="hidden" id="hidden" value="<?php echo plugin_dir_url(__FILE__);?>ajax-order.php">    
        </div> 
            <div class="col-sm-4"></div>    
        </div> 
      
        <br /><br />
        <div class="row col-sm-12" id="report_controls"></div>
        
       <br />
        
        <div class="col-sm-12" id="report_results">
        </div>    
        
        
        <script>
        
        jQuery(document).ready(function(){
            
            
            
            //Reports Dropdown
            jQuery("#report").change(function(){
            
            jQuery("#report_results").html(null);    
              url = jQuery("#hidden").val();    
              report =   jQuery(this).val();
              
                jQuery.ajax({
                    
                type:'post',
                url:url,    
                data:"action=show_report_controls&report="+report,
                success:function(data){
                jQuery("#report_controls").html(data);
                },  
                    
                }) ;
                
               
         });
            
            
                /*Getting Date/Quantity Values*/
                jQuery(document).on("click","#btn-make-report",function(e){
                e.preventDefault();

                report_type = jQuery(this).attr('report_type');
                from_value = jQuery(this).parent().parent().find('input').val()
                low_inventory = jQuery(this).parent().parent().find('select').val()    
                to_value = jQuery(this).siblings('input').val();    

                    
                jQuery.ajax({

                    type:'post',
                    url:url,    
                 data:"action=make_report&report_type="+report_type+"&from_value="+from_value+"&to_value="+to_value+"&low_inventory="+low_inventory,
                    success:function(data){
                    jQuery("#report_results").html(data);
                    jQuery("#modalReports").modal('show');    

                        /*Datatables*/


                        jQuery(".dataTables_length,.dataTables_info").hide();
                        jQuery("#mytable_paginate").addClass("bg-dark btn-sm");
                        jQuery("#mytable_filter input").addClass("form-control");


                        jQuery('#mytable2').DataTable( {
                        dom: 'Bfrtip',
                         buttons: [            
                            {
                                extend: 'copyHtml5',

                            },
                            {
                                extend: 'csvHtml5',

                            },
                            {
                                extend: 'excelHtml5',

                            },
                            {
                                extend: 'pdfHtml5',

                            },

                            ]
                            });
                            /*Datatable*/
                        },  });    

                });//btn
                
        });
        </script>
    <?php    
    }
?>