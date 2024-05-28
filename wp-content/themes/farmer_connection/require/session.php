<?php
if(!is_user_logged_in())
{
     ?>
    <script type="text/javascript">
        window.location.href="<?php echo home_url();?>/signin";
    </script>
    <?php         
}


?>