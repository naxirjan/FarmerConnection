<?php
	require_once("../business_logic_layer/bll_order.php");

	Class OrderDAL extends Order_BLL
	{
		private $connection;
        
        
        
        

		public function __construct($hostname, $username, $password, $database){
			$this->connection = mysqli_connect($hostname, $username, $password, $database);

			if(mysqli_connect_errno())
			{
				echo "Database Connection Problem ".mysqli_connect_error()."<br />";
			}
		}


        
        
        
        
        public function addOrder()
			{				
				$query = "INSERT INTO user_order (cart_id, payment_id, billing_address, shipping_address, order_date, delivery_date) VALUES( ".$this->getCartId().", ".$this->getPaymentId().", '".$this->getBillingAddress()."', '".$this->getShippingAddress()."','".$this->getOrderDate()."', '".$this->getDeliveryDate()."' )";
				$result = mysqli_query($this->connection,$query);
			  if($result)
					return $result;
				else
				return mysqli_error($this->connection);
			}
			public function updateOrder()
			{				
				$query = "UPDATE user_order SET cart_id ='".$this->getCartId()."',payment_id='".$this->getPaymentId()."', billing_address ='".$this->getBillingAddress()."', shipping_address = ".$this->getShippingAddress().",get_order_date = ".$this->getOrderDate().", delivery_date = ".$this->getDeliveryDate()." WHERE order_id = ".$this->getOrderId()." ";
	 		  	$result = mysqli_error($this->connection,$query);
			  if($result)
					return $result;
				else
				return mysqli_error($this->connection);
			}
			public function updateOrderDeliveryDate()
			{	
				$query = "UPDATE order SET order_delivery_date = '".$this->getOrderDeliveryDate()."'  WHERE order_id = ".$this->getOrderId();
	 		  	$result = mysqli_query($this->connection,$query);
			  if($result)
					return $result;
				else
				return mysqli_error($this->connection);
			}
			public function deleteOrder()
			{
				$query = "DELETE FROM user_order WHERE order_id = ".$this->getOrderId()." ";
				$result = mysqli_query($this->connection,$query);
				if($result)
					return $result;
				else
				return mysqli_error($this->connection);
			}



			public function changeOrderStatus()
			{
				$query = "UPDATE user_order SET status='".$this->getStatus()."' WHERE order_id = ".$this->getOrderId()." ";
				$result = mysqli_query($this->connection,$query);
				if($result){
					return $result;
				}
				else{
				return mysqli_error($this->connection);
			}
		}



			public function getOrder()
			{
				$query = "SELECT * FROM user_order WHERE order_id = ".$this->getOrderId()." ";
				 $result = mysqli_query($this->connection,$query);
				if($result->num_rows)
					return $result;
				else
					return mysqli_error($this->connection);
					
			}
			public function checkOrder()
			{
				$query = "SELECT order_id FROM user_order WHERE order_id = ".$this->getOrderId()." ";
				 $result = mysqli_query($this->connection,$query);
				if($result->num_rows)
					return true;
				else
					return mysqli_error($this->connection);
					
			}

			




			public function getAllOrders()
			{
				$query = "SELECT * FROM user_order uo
							INNER JOIN cart c ON uo.cart_id = c.cart_id
							INNER JOIN cart_product cp ON c.cart_id = cp.cart_id
							INNER JOIN city ON uo.city_id = city.city_id
							INNER JOIN payment_method p ON uo.payment_id = p.payment_id";
				return $result = mysqli_query($this->connection,$query);
			}
        

        
        
        	public function getAllOrdersByUserId($id)
			{
				$query = "SELECT uo.order_id,uo.cart_id ,uo.order_date,uo.delivery_date, uo.shipping_address, uo.billing_address, uo.status  
                FROM user_order uo
							INNER JOIN cart c ON uo.cart_id = c.cart_id							
							INNER JOIN payment_method p ON uo.payment_id = p.payment_id
							WHERE c.user_id=".$id."  ORDER BY order_id DESC ";
				
                 $result = mysqli_query($this->connection,$query);
				if($result){
					return $result;
                }else{
				 return mysqli_error($this->connection);;
            }
            }
        
    

public function getAllUserOrders()
			{
				$query = "SELECT uo.order_id,uo.cart_id ,uo.order_date,uo.delivery_date, uo.shipping_address, uo.billing_address, uo.status  
                FROM user_order uo
							INNER JOIN cart c ON uo.cart_id = c.cart_id							
							INNER JOIN payment_method p ON uo.payment_id = p.payment_id
							ORDER BY order_id DESC ";
				
                 $result = mysqli_query($this->connection,$query);
				if($result){
					return $result;
                }else{
				 return mysqli_error($this->connection);;
            }
            }
        
    




			public function getOrderByOrderId($userid,$orderid)
			{
				$query = " SELECT uo.order_id,uo.cart_id ,uo.order_date,uo.delivery_date, uo.shipping_address, uo.billing_address, uo.status,p.method ,cit.city 
                FROM user_order uo
							INNER JOIN cart c ON uo.cart_id = c.cart_id							
							INNER JOIN payment_method p ON uo.payment_id = p.payment_id
							INNER JOIN city cit ON uo.city_id=cit.city_id 
							WHERE c.user_id=".$userid." AND uo.order_id=".$orderid." ORDER BY order_id DESC  ";
				
                 $result = mysqli_query($this->connection,$query);
				if($result){
					return $result;
                }else{
				 return mysqli_error($this->connection);;
            }
            }				



	public function getUserOrderDetail($orderid)
			{
				$query = " SELECT uo.order_id,uo.cart_id ,uo.order_date,uo.delivery_date, uo.shipping_address, uo.billing_address, uo.status,p.method ,cit.city 
                FROM user_order uo
							INNER JOIN cart c ON uo.cart_id = c.cart_id							
							INNER JOIN payment_method p ON uo.payment_id = p.payment_id
							INNER JOIN city cit ON uo.city_id=cit.city_id 
							WHERE uo.order_id=".$orderid." ORDER BY order_id DESC  ";
				
                 $result = mysqli_query($this->connection,$query);
				if($result){
					return $result;
                }else{
				 return mysqli_error($this->connection);
            }
            }

        
        
        
        public function getUserDataByCartId($cart_id){
          
            $query="SELECT user.* FROM USER,cart WHERE user.user_id=cart.user_id AND cart.cart_id=".$cart_id."";
         $result = mysqli_query($this->connection,$query);
				if($result){
					return $result;
                }else{
				 return mysqli_error($this->connection);
        }
        }

    
public function countOrdersByStatus(){    
    
 $query ="SELECT COUNT(order_id) FROM user_order WHERE STATUS='".$this->getStatus()."' ";   
   $result = mysqli_query($this->connection,$query);
				if($result){
					return $result;
                }else{
				 return mysqli_error($this->connection);      
}

}
        
public function countOrdersSales(){    
    
 $query ="SELECT COUNT(order_id) FROM user_order WHERE STATUS='".$this->getStatus()."' ";   
   $result = mysqli_query($this->connection,$query);
				if($result){
					return $result;
                }else{
				 return mysqli_error($this->connection);      
}

}        

        
        


    }
?>