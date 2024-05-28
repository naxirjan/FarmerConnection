<style>
    #comments li{
        list-style-type: none;
    }
</style>
<div id="comments">
	<?php
		$total_comments = get_comments_number($post->ID);
	?>
	<h3><?php echo $total_comments; ?>Replies For "<?php echo get_the_title($post->ID); ?>"</h3>
	<?php

		$settings = array(
			"style" => "li",
			"max_depth" => "7",
			"reverse_top_level" => true,
		);

		if (have_comments())
		{
			wp_list_comments($settings);
		}
	?>
	<?php comment_form(); ?>
</div>

	
	
	
