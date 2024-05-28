<?php
get_header();		


if(isset($_REQUEST['post_type']) && $_REQUEST['post_type']=="product")
{
    ?>
    
    <p class="text-center">page-shop-search.php</p>
 <form role="search"  action="<?php echo home_url("/");?>">
        <label>
        <input type="search" class="search-field form-control field-group" placeholder="<?php echo esc_attr_x("Enter the word to search","placeholder")?>" value="<?php echo get_search_query()?>" name="s" title="<?php esc_attr_x("Enter the word to search","label")?>" /> 
        <input type="hidden" name="post_type" value="product" />    
        </label>      
        <input type="submit" class="search-submit btn-submit btn  btn-success" value="<?php echo esc_attr_x("Search","submit button")?>"/>     
          </form> 
 
    <div class="album py-5 bg-light">
      <div class="container-fluid" id="products_result">  
          <div class="row" >    
              <div class="col-sm-3">
                 <h3 class="bg-info text-light text-center">Categories</h3> 
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
                
/*
$product_posts = new WP_Query(array(
"post_type" =>"product",
"posts_per_page" =>3,
));
*/


    if(have_posts()){
     
    while(have_posts()){
    the_post();    
    $get_all_meta_values = get_post_custom($post->ID);
    $price=$get_all_meta_values["price"][0];
    $email=$get_all_meta_values["email"][0];
    $featured =$email=$get_all_meta_values["is_featured"][0];    
     $stock = $get_all_meta_values["stock"][0]; 
        
        $cat = wp_get_object_terms( $post->ID, 'product_cats', array( 'fields' => 'names',"orderby"=>"term_id","order"=>"ASC" ) );
        
                ?>  
   <style>
                .box-shadow h3,span,p,a{
                    font-style: italic;
                }    
            </style> 
                
            <div class="col-md-3">
              <div class="card mb-3 box-shadow">
                  
                <img class="card-img-top" src="<?php echo get_the_post_thumbnail_url($post->ID);?>"  data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                <div class="card-body">
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
                               <b> <span class="text-info">In Stock:&nbsp;</span><span class="text-dark"><?php echo $stock;?></span></b><br />
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
<h4 class="alert alert-warning text-center"><b>No Products Were Found </b></h4>
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
}

else if(isset($_REQUEST['post_type']) && $_REQUEST['post_type']=="consultancy"){
?>
<br />

    <div class="row">
        <div class="col-sm-1 "></div>
        <div class="col-sm-3 bg-light"><h3 class="text-center"><b><i>Consulatancy Service</i></b></h3></div>&nbsp;
         <div  class="col-sm-7 bg-light text-center">
          <form role="search" class="search-form" action="<?php echo home_url("/");?>" >
        <label>
        <input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x("Enter the word to search","placeholder")?>" value="<?php echo get_search_query()?>" name="s" title="<?php esc_attr_x("Enter the word to search","label")?>" style="border-radius:20px;" /> 
        <input type="hidden" name="post_type" value="consultancy" />    
        </label>      
        <input type="submit" class="search-submit btn-submit btn btn-success" value="<?php echo esc_attr_x("Search","submit button")?>" style="border-radius:20px;"/>     
          </form></div>
            
    </div>
    <hr />
<h3 class="alert alert-warning text-center">Searching Is In Process!...</h3>
<?php    
}



else if(isset($_REQUEST['post_type']) && $_REQUEST['post_type']=="post"){
    
if(have_posts())
{
?>
<br />
<div class="row">
    <div class="col-sm-3"></div>    
    <div class="col-sm-6 text-center">
        <b><i>   
        <h3 class="bg-success text-white" style="border-radius:30px;padding:5px;">
        <span>Search Results For:&nbsp;<?php the_search_query();?></span></h3>
        </i></b>    
    </div>    
    <div class="col-sm-3"></div>    
</div>    
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
    <br />    
    <?php
    while(have_posts())
    {
       the_post(); 
        
        if(get_post_format()=="aside" OR 
           get_post_format()=="audio" OR 
           get_post_format()=="video" OR 
           get_post_format()=="image" OR  
           get_post_format()=="gallery"OR 
           get_post_format()=="link" OR 
           get_post_format()=="quote" OR
           get_post_format()=="status" OR  
           get_post_format()=="chat")
        {
            get_template_part("post",get_post_format());
            echo "<br />";    
        }
        else if($post->post_type=="consultancy")
        {
            get_template_part("consultancy-search-posts");
        }
        else{
            get_template_part("posts");    
            echo "<br />";
        }
    }
    ?>
    </div>
    <div class="col-sm-2"></div>
</div>      
<?php
}
else
{
?>
<hr />
<h3 class="text-center alert alert-danger"><b>No Result Were Found!...Please try Again</b></h3>
<?php
}
    
}

?>
<script>
$(document).ready(function(){
   
    $(".menu ul li").hide();
});
</script>
<?php
get_footer();
?>