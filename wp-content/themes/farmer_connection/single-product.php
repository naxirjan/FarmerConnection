<?php

get_header();
?>
<p class="text-center">page-product.php</p>
 <div class="row col-sm-12">       
          
<div class="col-sm-5 rounded" style="background-color:#4adfe6;height:620px;">
    <br />
 <img src="<?php echo get_the_post_thumbnail_url($post->ID);?>" class="img-fluid rounded w-100">
    <hr />
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1" ></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2" ></li>
  </ol>
       
<div class="carousel-inner">    
    <?php
    $i=0;
    $images_arr = array();
    $images = get_post_meta($post->ID, 'vdw_gallery_id', true);        
    foreach ($images as $image) {
    $src = wp_get_attachment_image_src($image);    
    ?>
    <div class="carousel-item <?php if($i==0){echo "active";}?>">    
    <a href="<?php echo $src[0];?>"><img class="d-block w-100 rounded" src="<?php echo $src[0];?>" alt="First slide" height="200"> </a>   
    </div>
    <?php
    $i++;    
    }        
    ?>
   
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" >
    <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color:red;"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true" style="background-color:red;"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
  </div>             
<div class="col-sm-7 rounded" style="background-color:#4adfe6;">
        <?php

        if(have_posts())
        {
            while(have_posts())
            {
                the_post();
                $cat = wp_get_object_terms( $post->ID, 'product_cats', array( 'fields' => 'names',"orderby"=>"term_id","order"=>"ASC" ) );
                $get_all_meta_values = get_post_custom($post->ID);
                $price=$get_all_meta_values["price"][0];
                $email=$get_all_meta_values["email"][0];
                $stock = $get_all_meta_values["stock"][0];
                $featured=$get_all_meta_values["is_featured"][0];
                if($featured==1){$featured="Featured";}else{$featured="";}
                
                
         
          $user = new WP_User(get_the_author($post->ID)); 
              
    ?>    
  
   
    <h1 class="text-dark"><b><?php the_title();?></b></h1>
    <p><span class="text-danger"><b><?php echo $cat[0];?></b></span> / <span class="text-dark"><b><?php echo $cat[1];?></b></span></p>
    <hr />
    <h5><span class="badge badge-warning"><?php echo $featured;?></span></h5>
    <h5><b><span class="text-danger">Price:</span> $<?php echo $price;?></b></h5>
    <?php
                if($get_all_meta_values["stock"][0])
                {
                    ?>
                        <small class="text-dark"><b>(Stock:&nbsp;<?php echo $stock;?>)</b></small><br />
                    <?php
                }
    ?>            
    <?php
        if($get_all_meta_values["email"][0])
        {
            ?>
             <h5><b><span class="text-danger">Contact Email: </span><?php echo $email;?></b></h5>
            <?php
        }        
   
    if($user->roles[0]=='administrator'){?>  
    <br />
     <input type="number" class="form-control w-50" id="quantity" value="1" min="1" max="10" required/><br />
     <button class="btn btn-success" id="btn-add-cart"><b>Add to Cart</b></button>
     <?php
        }            
     ?>
     <input type="hidden" id="product_id" value="<?php echo $post->ID;?>" />
     <input type="hidden" id="product_name" value="<?php the_title();?>" />
     <input type="hidden" id="price" value="<?php echo $price;?>" />
     <input type="hidden" id="hidden" value="<?php echo get_template_directory_uri();?>/ajax-shop.php"/>
<?php        
    }
    wp_reset_postdata();
     ?>
          <script>
                $(document).ready(function(){
                    
                    $( "#btn-add-cart" ).click(function() {
                        product_id = $("#product_id").val();
                        product_name = $("#product_name").val();
                        quantity = $("#quantity").val();
                        price = $("#price").val();
                        url = $("#hidden").val();    

                        jQuery.ajax({
                            type: "post",
                            url: url,
                            data:"action=add_cart&product_id="+product_id+"&product_name="+product_name+"&quantity="+quantity+"&price="+price,
                            success: function(data){
                                $("#controls_invalid").css({fontWeight:"bold",fontStyle:"italic"});
                                $("#alert").html("&times;");
                                $("#close").addClass("alert alert-success alert-dismissible fade show");
                                
                                $("#controls_invalid").html(data);
                               
                                }   
                        });//jQuery
                        
                     });
              
                
                
                            $( "#close" ).click(function() {
                            window.location.href="<?php echo get_the_permalink($post->ID);?>";
                            });
                           
                });
              
              
     </script>
    <br />
    <?php            
}
?>
<br /><br />
    
<div id="close" class=" alert-dismissible fade show" role="alert">
 <span id="controls_invalid"></span> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    
  </button>
</div>
    
   <hr />
      <ul class="nav nav-pills nav-fill mb-3" id="tabs_2" role="tablist">
    <li class="nav-item alert-dark">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tabs_2_1" role="tab" aria-controls="home" aria-selected="true">
            <span class="d-none d-sm-block mt-3"><b>DETAILS</b></span>
        </a>
    </li>
    <li class="nav-item alert-dark">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tabs_2_2" role="tab" aria-controls="profile" aria-selected="false">
            <span class="d-none d-sm-block mt-3"><b>REVIEWS</b></span>
        </a>
    </li>
    <li class="nav-item alert-dark">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tabs_2_3" role="tab" aria-controls="contact" aria-selected="false">
            <span class="nav-link-icon d-block"></span>
            <span class="d-none d-sm-block mt-3"><b>RETURN POLICY</b></span>
        </a>
    </li>       
</ul>
        <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="tabs_2_1" role="tabpanel" aria-labelledby="home-tab">
        <p><b><?php the_content();?></b></p>
    </div>
    <div class="tab-pane fade" id="tabs_2_2" role="tabpanel" aria-labelledby="profile-tab">
        <script>
 $(document).ready(function(){
     
     $("#comment").addClass("form-control").css("height","100");
     $("#comments>h3").addClass("btn btn-info");
     $("#reply-title").addClass("btn btn-dark");
     $(".logged-in-as a").addClass("badge badge-warning text-dark");
     $("#submit").addClass("btn btn-success");
     $(".comment-form-comment label").addClass("badge badge-dark").html("Enter Your Discussion Reply Here");
     
     
 });

</script>
        <p><?php 
        
        if(is_single($post->ID) && comments_open($post->ID))
 				{
 					comments_template();	
 				}
        
        ?></p>
    </div>

    <div class="tab-pane fade" id="tabs_2_3" role="tabpanel" aria-labelledby="contact-tab">
        <h3><span class=" bg-dark text-light rounded">&nbsp;7 Days Replacement Only&nbsp;</span></h3>
        <span>                            
        If your product is defective / damaged or incorrect / incomplete at the time of delivery, then call  our customer service on +92 313 3006640 to log a replacement request within 7 days of delivery. 
        <br />  
        For device-related issues after usage please contact the service center listed on the warranty card included with your product or alternatively check our Brand Contact List for more details.
          </span>                          
        <hr />
        <h3><span class=" bg-dark text-light rounded">&nbsp;Conditions For Returns&nbsp;</span></h3>                         <span>The product must be unused, unworn, unwashed and without any flaws.
        The return will not be processed if the freebies (Mobile network voucher, Voucher, Accessories or any other bundled product) is used or tempered.<br/>
        The product must include the original tags, user manual, warranty cards, freebies and accessories.
        The product must be returned in the original and undamaged manufacturer packaging / box. 
        If the product was delivered in a second layer of Daraz packaging, it must be returned in the same condition with return shipping label attached. 
        </span>
        <hr />
        <h3><span class=" bg-dark text-light rounded">&nbsp;Conditions For Multiple Orders Delivery&nbsp;</span></h3>                         <span>The product must be unused, unworn, unwashed and without any flaws.
        The return will not be processed if the freebies (Mobile network voucher, Voucher, Accessories or any other bundled product) is used or tempered.<br/>
        The product must include the original tags, user manual, warranty cards, freebies and accessories.
        The product must be returned in the original and undamaged manufacturer packaging / box. 
        If the product was delivered in a second layer of Daraz packaging, it must be returned in the same condition with return shipping label attached.<br /> 
        </span>
             
    </div>
</div>        
    
    
    
    
    
    
</div>    
</div>

    <?php    
$products = get_posts(array(
  'post_type' => 'product',
  'numberposts' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'product_cats',
      'field' => 'name',
      'terms' => $cat[0], // Where term_id of Term 1 is "1".
      'include_children' => false,
    )
  )
));
  
      if($products){  
    ?>
    <hr />
<div class="text-center">
<h2 class="btn btn-lg    btn-dark text-center">Related Products</h2>
</div>
<div class="row" style="background-color:#4adfe6;">
<div class="col-sm-1"></div>  

<?php
    //print_r($products);
foreach($products as $product)
{
    if($product->ID!=$post->ID){
    $price = get_post_meta($product->ID,"price",true);
        
    ?>
    
    <div class="col-sm-2 bg-light text-center rounded">
        <br />
        <p class="text-center"><img src="<?php echo get_the_post_thumbnail_url($product->ID);?>" width="100" height="100" /></p>
         <h4 class="text-center text-info"><a href="<?php echo get_the_permalink($product->ID);?>"><?php echo $product->post_title;?></a></h4>
        <span><b>Price:</b>&nbsp;$<?php echo $price;?></span>
        <br /><br />
    </div>  &nbsp;  
    <?php    
    }
    
}
    ?>      
    
    <div class="col-sm-1"></div>    
    </div>
    <?php
    }
    
get_footer();

?>