
jQuery(document).ready(function ($) {
    $(document).on("click", "#set_views", function (e) {
      e.preventDefault();
     post_id = $(this).attr("views_post_id");
     url = $(this).attr("href");    
    
    
    jQuery.ajax({
        type: "post",
        url: ajax_var.url,
        data: "action=post-views&nonce="+ajax_var.nonce+"&post_views=&post_id="+post_id,
        success: function(count){
            window.location.href=url;
            }   
    });    
    });
 });    
   