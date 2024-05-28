<?php
    get_header();

		if(have_posts())
        {
            echo "Child Index.php";
			while(have_posts())
            {
            the_post();
            get_template_part("posts");
            ?>
            <br />						            
            <?php				
            }
        }
		else
		{
            ?>
            <p>No Posts Were Found!...</p>
            <?php
		}
	get_footer();
	?>

