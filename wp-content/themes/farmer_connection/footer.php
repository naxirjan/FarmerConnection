
<?php 
if(get_theme_mod('footer_show_section_setting'))
{
?>
<!--Contact - Latest News - About -->
<div class="jumbotron bg-white">
    <div class="row">    
        
        <!--Contact US-->
        <div class="col-sm-4  rounded bg-dark">
            <br />
           <h4 class="text-warning">
               
                   <i>
                       <?php 
                            if(get_theme_mod('contact_title_setting'))
                            {
                                echo "<b>".get_theme_mod('contact_title_setting')."</b>";
                            }
                            else{
                                echo '<b><i><u>Contact Us Title Here</u></i></b>';
                            }
                       ?>
                        
                    </i>   
              
            </h4>
            <span style="border-top:2px solid yellow;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <br />
            <p class="text-white">
                <?php 
                    if(get_theme_mod('contact_address_setting'))
                    {
                        echo get_theme_mod('contact_address_setting');
                    }
                    else
                    {
                        echo 'Contact Us Address Here';
                    }?>
            </p>
            <p class="text-white">Cell: 
                <?php 
                    if(get_theme_mod('contact_no_setting'))
                    {
                        echo get_theme_mod('contact_no_setting');
                    }
                    else
                    {
                        echo 'Contact Us No Here';
                    }
                ?>
            </p>
            <p class="text-white">Email: 
                <?php 
                    if(get_theme_mod('contact_email_setting'))
                    {
                        echo get_theme_mod('contact_email_setting');
                    }
                    else{
                        echo 'Contact Us Email Here';
                    }
                ?> 
            </p>
            <br /><br />
        </div>
        <!--Latest News-->
        <div class="col-sm-4 rounded  bg-dark" style="border-left:1px dashed white;" >
            <br />
           <h4 class="text-warning"><b><i><?php 
                    if(get_theme_mod('news_title_setting'))
                    {
                        echo get_theme_mod('news_title_setting');
                    }
                    else{
                        echo 'LATEST NEWS TITLE HERE';
                    }
                ?></i></b></h4>
            <span style="border-top:2px solid yellow;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <br />
           
            <?php
                $args = array( 'numberposts' => '5' );
                $recent_posts = wp_get_recent_posts( $args );
                if($recent_posts){
                foreach( $recent_posts as $recent ){
                    echo '<p><a  href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </p>';
                }
               
                }
                else
                {
                    echo "No Latest Posts Were Found!...";
                }
             wp_reset_postdata(); 
            ?>
          
            
            <br />
        </div>
        <!--About Us-->
        <div class="col-sm-4  rounded bg-success" style="border-left:1px dashed white;" id="footer_divs">
            <br />
           <h4 class="text-dark"><b><i><?php if(get_theme_mod('aboutus_title_setting')){echo get_theme_mod('aboutus_title_setting');}else{echo "ABOUT US TITLE HERE";} ?></i></b></h4>
            <span style="border-top:2px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <br />
            <p class="text-white"><?php if(get_theme_mod('aboutus_desc_setting')){echo get_theme_mod('aboutus_desc_setting');}else{echo "ABout Us Description Here";} ?></p>            
            <br />
        </div>
    </div>     
</div>

<?php
}
?>




<div class="row alert">    
    <?php
      if(is_active_sidebar("footer_area_1")){
    dynamic_sidebar("footer_area_1");
    }   
    ?>
    </div> 



<script>

$(document).ready(function(){
    
    var liked = $("#set").val();
    
    $('.like__btn').on('click', function(){
        
     var liked = $("#set").val();
      updated_likes = parseInt($('.like__number').html()) + 1;
           
      $(".unlike__btn").css("display","block");        
   
    });
    
});


</script>

</div>
<?php

wp_footer();
?>
</body>
</html>

