<?php

	if(isset($_GET['action']))
	{		   
		if($_REQUEST['action'] == 'confirm_order')
		{	
			if(isset($_SESSION['user']))
		 	{
		 		////
		 		$_REQUEST['b_name'] = "abc";
		 		$_REQUEST['b_email'] = "abc@yahoo.com";
		 		$_REQUEST['b_phone_number'] = "03121111111";
		 		$_REQUEST['b_address'] = "xyz";
		 		$_REQUEST['b_city'] = "Hyderabad";
		 		$_REQUEST['b_state'] = "Sindh";
		 		$_REQUEST['b_country'] = "Pakistan";

		 		$_REQUEST['s_name'] = "abc";
		 		$_REQUEST['s_email'] = "abc@yahoo.com";
		 		$_REQUEST['s_phone_number'] = "03121111111";
		 		$_REQUEST['s_address'] = "xyz";
		 		$_REQUEST['s_city'] = "Hyderabad";
		 		$_REQUEST['s_state'] = "Sindh";
		 		$_REQUEST['s_country'] = "Pakistan";

		 		$_REQUEST['payment'] = 1;
 		 		////
		    	$current_user =$_SESSION['user'];
		    	$message = "";
		    	$user_cart = $wpdb->get_row("SELECT * FROM wp_carts WHERE cart_status = 0 AND user_id =".$current_user->ID." ORDER BY id DESC");	
		    	if($user_cart)//user cart for proccessing found in db
		    	{
		    		$billing_address = array("name"=>$_REQUEST['b_name'],"email"=>$_REQUEST['b_email'],"phone_number"=>$_REQUEST['b_phone_number'],"address"=>$_REQUEST['b_address'],"city"=>$_REQUEST['b_city'],"state"=>$_REQUEST['b_state'],"country"=>$_REQUEST['b_country']);
		    		$result = null;
		    		$result = $wpdb->insert('wp_addresses',$billing_address,array('%s','%s','%s','%s','%s','%s','%s'));
		    		if($result)
		    		{
		    			$ba_id = $wpdb->insert_id;
		    			$shipping_address = array("name"=>$_REQUEST['s_name'],"email"=>$_REQUEST['s_email'],"phone_number"=>$_REQUEST['s_phone_number'],"address"=>$_REQUEST['s_address'],"city"=>$_REQUEST['s_city'],"state"=>$_REQUEST['s_state'],"country"=>$_REQUEST['s_country']);
		    			$result = null;
		    			$result = $wpdb->insert('wp_addresses',$shipping_address,array('%s','%s','%s','%s','%s','%s','%s'));
		    			if($result)
		    				$sa_id = $wpdb->insert_id;

		    			$order_data = array('cart_id'=>$user_cart->id,'payment_id'=>$_REQUEST['payment'],'delivery_date'=>date("Y-m-d H:i:s",strtotime("+3 day")),'billing_address_id'=>$ba_id,'shipping_address_id'=>isset($sa_id)?$sa_id:$ba_id);
		    			print_r($order_data);
		    			$result = null;
		    			$result = $wpdb->insert('wp_orders',$order_data,array('%d','%d','%s','%d','%d'));
		    			if($result)
		    			{
		    				echo "order added";
		    				$update_cart = array("cart_status"=>1);
		    				$result = null;
		    				$result = $wpdb->update('wp_carts',$update_cart,array("id"=>$user_cart->id),array('%d'),array('%d'));
		    				if($result)
		    				{
		    					///order has been placed,now deduct products stocks
		    					////////////Deduct Stocks///////////
		    					$cart_products =  $wpdb->get_results("SELECT * FROM wp_cart_products WHERE cart_id =".$user_cart->id);
		    					foreach($cart_products as $product)
		    					{
		    						$stock = get_post_meta($product->product_id,"stock",true);	  						
				    				update_post_meta($product->product_id,'stock',($stock-$product->quantity));
		    					}
		    					////////////Deduct Stocks///////////
		    					echo "<p class='text-success text-center'>order has been placed successfully.</p>";
		    					$_SESSION['order_placed'] = 1;
		    					$_SESSION['message'] = "<p class='text-success text-center'>order has been placed successfully.</p>";
		    					wp_redirect(get_permalink(227));exit;

		    				}
		    			}
		    		}

		    	}		    		    
	     	}  
		}	  
	}
   
?>