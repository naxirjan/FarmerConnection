<?php
	get_header();
?>   
<p class="text-center">Category-forest.php</p>
    <?php
    if(have_posts())
    {
    ?> 
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2 class="alert alert-success text-center">
                <?php
                if(is_category())
                {
                echo "Category Archive:- ";
                echo single_cat_title(); }elseif(is_tag())
                {
                 echo "Tag Archive:- ";
                echo single_tag_title();     
                }elseif(is_author())
                {
                the_post();
                echo "Author Archive:- ";
                echo get_the_author();
                rewind_posts();    

                }elseif(is_day())
                {
                 echo "Daily Archive:- ";
                echo get_the_date();     
                }elseif(is_month())
                {
                 echo "Monthly Archive:- ";
                echo get_the_date("F");     
                }elseif(is_year())
                {
                 echo "Yearly Archive:- ";
                echo get_the_date("Y");     
                }

                ?>


            </h2>    
                <?php    
                while(have_posts()){
                the_post();
                get_template_part("posts");
                echo "<br />";    
                }
                ?>
        </div>
        <div class="col-sm-3"></div>
</div>
    <?php				        
    }
    get_footer();
?>

