<?php
		

		class Cart_DAL 
		{
			
            
            
            
            
            
            public function addCart(&$insert_id,$user_id)
			{	
                global $wpdb;
               
				$wpdb->show_errors();
              
                $result =   $wpdb->insert( 'wp_cart', array( 'user_id' => $user_id),array( '%d' ) );
            
				if($result)
				{
					$insert_id = $wpdb->insert_id;
					return $result;
				}
				else
                {
                   return $wpdb->print_error();
                }
				
			}
        
        
            
			/*public function updateCartStatus()
			{		
                global $wpdb;
				$wpdb->show_errors();
                
                    $data = array(
                    "status"     => $this->getStatus());
                    $id = array("cart_id" => $this->getCartId());
                    $tabename = "wp_cart";
                    $result = $wpdb->update($tabename, $data, $id);

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
                
                
                
			

			/*public function deleteCart()
			{
			         	
               global $wpdb;
				$wpdb->show_errors();
                
                $id = array("cart_id" => $this->getCartId());
    
                $tablename = "wp_cart";
                $result = $wpdb->delete($tablename,$id);
               
               if($result)
					return $result;
				else
				return  $wpdb->print_error();
			}
           
            */
            
       /*     public function getCart()
			{
				global $wpdb;
				$wpdb->show_errors();
                
                $query = ;
				 $result = $wpdb->get_results("SELECT * FROM cart WHERE cart_id = ".$this->getCartId());
				if($result)
					return $result;
				else
					return $wpdb->print_error();
					
			}
       */     
            
			public function getUserCart($id)
			{
               
                global $wpdb;
                $wpdb->show_errors();
                $result  = $wpdb->get_results( "SELECT COUNT(wp_cart.cart_id) AS 'cart_exist' , cart_id FROM wp_cart WHERE user_id = '".$id."' AND STATUS = 0;" );
               if($result){
                return $result;
               }
                else
                {
                    return "No User Cart ID"; 
                }
        	}

        /*    
            public function getCarts()
			{
                global $wpdb;
				$wpdb->show_errors();
                
				
				$result = $wpdb->get_results("SELECT * FROM cart WHERE user_id = ".$this->getUserId()." AND cart_id = ".$this->getCartId());
			
                if($result){
                return $result;
            }
            else{
                return $wpdb->print_error();
            }    
                
            }			
		*/
        
        /*    public function getPendingCartProducts()
            {
                    
                    global $wpdb;
				$wpdb->show_errors();
                
            	$result = $wpdb->get_results("SELECT  user.user_id,user.first_name, product.product_id,product.product,product.price,cart_product.quantity,product.price*cart_product.quantity AS 'Sub Total',cart.status FROM USER, product,cart_product,cart WHERE 
            cart.user_id=user.user_id AND cart.cart_id=cart_product.cart_id AND product.product_id=cart_product.product_id AND cart.status=0 AND user.user_id= ".$this->getUserId()." ");
				
			if($result){
                return $result;
            }
            else{
                return $wpdb->print_error();
            }    
                 
    }    
       */
            
            
            public function countCart($user_id){
               
                global $wpdb;
				$wpdb->show_errors();
            
            	$result = $wpdb->get_results("SELECT SUM(wp_cart_product.quantity) as 'total' FROM wp_cart_product,wp_cart WHERE wp_cart_product.cart_id=wp_cart.cart_id AND wp_cart.status=0 AND wp_cart.user_id=".$user_id." ");
                
                if($result){
                    return $result;
                }
                else{
                    return $wpdb->print_error();
                }    
            }
        
            
            
        }

    ?>