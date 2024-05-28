<?php
		
		
		class Cart_Product_DAL 
		{
			
            
            
            
            
            
			public function getCartProduct($cart_id,$product_id)
			{
                 global $wpdb;
				
				
				$result = $wpdb->get_results("SELECT * FROM wp_cart_product WHERE cart_id = ".$cart_id[0]->cart_id." AND product_id = ".$product_id);
				if($result)
					return $result;
				else
				return "No Cart Product";
					
			}
            
           
            public function updateCartProduct($cart_id,$product_id,$quantity)
			{				
				
                global $wpdb;
                $wpdb->show_errors();
                
                $data=array("quantity"=>$quantity);
                $id=array("cart_id"=>$cart_id,"product_id"=>$product_id);
                $table="wp_cart_product";
                $result = $wpdb->update($table,$data,$id);
				
                if($result!==false)
				{
					return $result;
				}
			  	
			}
            
            
            
			public function deleteCartProduct($cart_id,$product_id)
			{
		
                 global $wpdb;
				
				$id=array("cart_id"=>$cart_id,"product_id"=>$product_id);
                $table="wp_cart_product";
                
				$result = $wpdb->delete($table,$id);
				if($result){
					return $result;
                }
				else
                {
				return "Product Not Deleted";
                }
            }
		

			public function addCartProduct($cart_id,$product_id,$quantity)
			{						
                global $wpdb;
				$data =array(
                    "cart_id"=>$cart_id,
                    "product_id"=>$product_id,
                    "quantity"=>$quantity
                );
                
                $format =  array( '%d', '%d','%d');               
                $table="wp_cart_product";
               
				$result = $wpdb->insert($table,$data,$format);
				if($result)
				{
					return $result;
				}
			  	else
				{
					 return "Products Not Added";
			    }
			}
		

			public function getCartProducts($cart_id)
			{
				
                 global $wpdb;
				$wpdb->show_errors();
                
                
				 $result = $wpdb->get_results("SELECT c.product_id, c.quantity,p.post_title FROM wp_cart_product c,wp_posts p WHERE c.product_id = p.ID  AND c.cart_id = ".$cart_id[0]->cart_id);
				if($result){
					return $result;
                }else{
				 return "No Cart Products";
			
                
        			}        
                }


		/*  public function getCartProductsForDetails()
          {  
                 global $wpdb;
                 $wpdb->show_errors();

                 $result = $wpdb->get_results("SELECT p.product,p.price,p.free_shipping ,c.quantity,p.price*c.quantity ,p.product,p.price
                 FROM cart_product c,product p 
                 WHERE c.product_id = p.product_id AND c.cart_id =".$this->getCartId()." ");
                if($result)
                {
                    return $result;
                }
                else
                {
                    return $wpdb->print_error();
                }

            } 
        */   

        
        }

?>