<?php

get_header();
?>





<p class="text-center">page-shop.php</p>


<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-5 rounded" style="background-color:#4adfe6;">
        <form role="search"  action="<?php echo home_url("/");?>">
        <label><b>Search Here:</b></label>
        <input type="search" class="search-field bg-dark text-center form-control field-group" placeholder="<?php echo esc_attr_x("Enter the word to search","placeholder")?>" value="<?php echo get_search_query()?>" name="s" title="<?php esc_attr_x("Enter the word to search","label")?>" /> 
        <input type="hidden" name="post_type" value="product" />  <br />  
        <p class="text-center"><input type="submit" class="search-submit btn-submit btn  btn-dark" value="<?php echo esc_attr_x("Search","submit button")?>"/> </p>    
          </form>
    </div>&nbsp;
    <div class="col-sm-5 rounded text-center" style="background-color:#4adfe6;"><h1 class="text-dark"><b>Online Purchasing</b></h1>
    <h4 class="text-dark"></h4>
    <p class="badge badge-danger">Buy Our Best Products Here Online<br /></p><br />
    <p class="badge badge-light">Or Do Businees At Your Home By Selling Your Produce Here!..</p>    
    </div>
    <div class="col-sm-1"></div>
</div>



<div class="album py-5 bg-light">
     
            
      
      <div class="container-fluid" id="products_result">  
      
          
      <div class="row" >    
    
         <div class="col-sm-3 rounded" style="background-color:#4adfe6;"><br />
            <h2 class="alert bg-dark text-light text-center">Categories</h2> 
           <div id="accordion">
  <?php
        $i=0;       
       $taxonomy = 'product_cats';
    $postType = 'product';
    $terms = get_terms(['taxonomy' => $taxonomy, 'orderby' => 'term_id', 'parent' => 0, 'hide_empty' => false]);
    foreach($terms as $term){
    $i++;    
    ?>        
    <div class="card">
    <div class="card-header" id="heading<?php echo $i;?>">
      <h5 class="mb-0 text-center">
        <button class="btn  btn-link btn-sm  collapsed" data-toggle="collapse" data-target="#collapse<?php echo $i;?>" aria-expanded="false" aria-controls="collapse<?php echo $i;?>">
            <h4><?php echo $term->name;?></h4>
        </button>
      </h5>
    </div>

    <div id="collapse<?php echo $i;?>" class="collapse" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordion">
      <div class="card-body">
       <?php
         $childTerms = get_terms(['taxonomy' => $taxonomy, 'orderby' => 'term_id', 'parent' => $term->term_id, 'hide_empty' => false]);

        foreach($childTerms as $childTerm)
        {
        ?>
           <a id="search" cat_id="<?php echo $childTerm->term_id;?>"><h5 class="text-center btn-outline-info rounded"><?php echo $childTerm->name ?></h5></a>
        <?php  
        }
        ?>
      </div>
    </div>
  </div>
   <?php
    }
    ?>    
               
               
</div>
           <hr />
         </div>    
          
                     
     <?php
                
$product_posts = new WP_Query(array(
"post_type" =>"product",
"post_status" =>'publish',    
"posts_per_page" =>10,
));


    if($product_posts->have_posts()){
     ?>
          
            <style>
                .box-shadow h3,span,p,a{
                    font-style: italic;
                }    
            </style> 
                
          <?php
    while($product_posts->have_posts()){
    $product_posts->the_post();    
    $get_all_meta_values = get_post_custom($post->ID);
    $price=$get_all_meta_values["price"][0];
    $email=$get_all_meta_values["email"][0];
    $featured =$email=$get_all_meta_values["is_featured"][0];    
    $stock = $get_all_meta_values["stock"][0]; 
        
           
        $cat = wp_get_object_terms( $post->ID, 'product_cats', array( 'fields' => 'names',"orderby"=>"term_id","order"=>"ASC" ) );
     
          ?>  
            <div class="col-md-3 rounded ">
              <div class="card mb-3 box-shadow rounded bg-light">
                  
                <img class="card-img-top" src="<?php echo get_the_post_thumbnail_url($post->ID);?>"  data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                <div class="card-body " >
                    <span class="text-danger"><b><?php echo $cat[0];?></b></span>/
                    <span class="text-info"><b><?php echo $cat[1];?></b></span>
                   
                    <?php if($featured==1)
                    {
                        ?>
                            <span class="badge badge-warning float-right">Featured</span>
                        <?php
                    }
                    ?>
                    <hr />
                    <h3><a href="<?php echo get_the_permalink($post->ID);?>"><?php the_title();?></a></h3>
                    <b><span class="text-info">Price:&nbsp;</span><span class="text-dark">$<?php echo $price;?></span></b><br />
                    <?php
                        if($stock)
                        {
                            ?>
                               <b> <span class="text-info">In Stock:&nbsp;</span><span class="text-dark">(<?php echo $stock;?>)</span></b><br />
                            <?php    
                        }
                    ?>
                    <?php
                    if(!empty($get_all_meta_values["email"][0])){
                    ?>
                    <b><span class="text-info">Contact:&nbsp;</span><span class="text-dark"><?php echo $get_all_meta_values["email"][0];?></span></b>
                   
                    <?php
                    }
                    ?>    
                    <hr/>
                  <div class="text-center">
                    <div class="btn-group align-items-center">
                      <a href="<?php echo get_the_permalink($post->ID);?>" class="btn  btn-success"><b>Quick View</b></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    <?php   
    } 
    wp_reset_postdata();    
}
    else{
?>
<h4>No Products Were Found </h4>
<?php
}
                
?>  
        </div>      
    
    </div>      

        <input type="hidden" id="hidden" value="<?php echo get_template_directory_uri();?>/ajax-shop.php" />
        <script>
                $(document).ready(function(){
                    $(document).on("click","#search",function(){
                       cat_id =  $(this).attr("cat_id");
                        url = $("#hidden").val();
                        jQuery.ajax({
                            type: "post",
                            url: url,
                            data:"action=search&cat_id="+cat_id,
                            success: function(data){
                                $("#products_result").html(data);
                                }   
                        });//jQuery
                        
                    });
                });
              
              
     </script>
  

</div>


  
<?php
get_footer();

?>