<?php






	get_header();
		if(have_posts()){
        ?> 
<p class="text-center">date.php</p>
<div id="archive_title">
         <h2 >
          <span>Date</span><br />
        <span>
        <b>Date Is:</b>  <?php echo get_the_date();?>
        
            </span>    
        </h2>    
    </div> 
    <?php    
			while(have_posts()){
	the_post();
 get_template_part("posts");
?>

			
<br />						
				<?php				
				}}
	
		get_footer();
	?>

