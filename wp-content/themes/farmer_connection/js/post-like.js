
jQuery(document).ready(function() {
 
    jQuery(".post-like a").click(function(){
     
        heart = jQuery(this);
        
        current_user_id = $(this).attr('current_user_id');
        // Retrieve post ID from data attribute
        post_id = heart.data("post_id");
         
        // Ajax call
                    jQuery.ajax({
                        type: "post",
                        url: ajax_var.url,
                        data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id+"&current_user_id="+current_user_id,
                        success: function(count){
                            // If vote successful
                            if(count !="already")
                            {
                                heart.addClass("voted");
                                heart.siblings(".count").text(count);
                                $("#msg").html('<span class="alert alert-success"> <b><i>Thank you, to like the post :)</i></b> </span>');
                            }   
                        }
                    });

                    return false;
                });
            });