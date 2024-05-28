<?php
	
function add_admin_pages()   
{
   add_menu_page("Google Map","Google Map","manage_options","google-map-page","google_map_method",plugin_dir_url(__FILE__)."images/icon.png",16);
	
    
        add_submenu_page("google-map-page","Google Map Setting","Google Map Setting","manage_options","google-map-setting-page","map_settings_method");
	
    }	
?>

<?php
	function google_map_method()
	{?>
<style> 
     #header h1{
        color: orangered;
        text-align: center;
        color: white;
        text-align: center;
         background-color: orangered;
         padding: 10px;
         border-radius: 10px;
    }
  
         
     h2{
        color: orangered;
        text-align: center;
    }
    
    
    #header h3,p{
        color: black;
        
    }
    
    
    form>h1{
        background-color: black;
        color: red;
        padding: 15px;
       text-align: center;
    }
</style>

	<div id="header">
<h1><b><i><?php bloginfo("name");?></i></b></h1>
<hr/>
<h2><strong><i>About Google Map Plugin</i></strong></h2>
<h3><b><i><u>Google Map Information</u></i></b></h3>        
<p><i><b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?

It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ‘lorem ipsum’ will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)
</b></i></p>        
<h3><b><i><u>Google Map Shortcode</u></i></b></h3>        
<p><i><b>
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ‘lorem ipsum’ will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)<br />
<br />
    
[google-map-shortcode]    
</b></i></p>        
	<?php

	}



	function map_settings_method()
	{
		?>
	<style> 
    #header h1{
        color: orangered;
        text-align: center;
        color: white;
        text-align: center;
         background-color: orangered;
         padding: 10px;
         border-radius: 10px;
    }
  
         
     h2{
        color: orangered;
        text-align: center;
    }
             
        
        
    
    
    #header h3,p{
        color: black;        
    }
        

</style>

	<div id="header">
<h1><b><i><?php bloginfo("name");?></i></b></h1>
<hr/>
</div>       
	<div>
		<p><?php settings_errors(); ?></p>
		<form action="options.php" method="post">
			<?php 
			settings_fields("setting_options");

			do_settings_sections("google-map-setting-page");//parameter is page slug
			submit_button();

			?>
			
		</form>
	</div>
	<?php


	}


	function add_map_option_settings()
	{
        add_settings_section("map-section","<h2><b>Google Map & Marker Settings</b></h2>","map_section_method","google-map-setting-page");
		//Map 
        add_settings_field("map-name","Map Name:","map_name_field","google-map-setting-page","map-section");
        add_settings_field("map-width","Map Width:","map_width_field","google-map-setting-page","map-section");
        add_settings_field("map-height","Map Height:","map_height_field","google-map-setting-page","map-section");
        add_settings_field("map-zoom","Zoom Control:","map_zoom_field","google-map-setting-page","map-section");
        add_settings_field("map-center","Map Center:","map_center_field","google-map-setting-page","map-section");
        add_settings_field("map-theme","Google Map Theme:","map_theme_field","google-map-setting-page","map-section");
        //Marker
        add_settings_field("map-marker-name","Marker Name:","map_marker_name_field","google-map-setting-page","map-section");
        add_settings_field("map-marker-desc","Marker Description:","map_marker_desc_field","google-map-setting-page","map-section");
        add_settings_field("map-marker-icon","Icon:","map_marker_icon_field","google-map-setting-page","map-section");
        add_settings_field("map-marker-address","Address:","map_marker_address_field","google-map-setting-page","map-section");
      	add_settings_field("map-marker-address-lat","Latitude:","map_marker_address_lat_field","google-map-setting-page","map-section");
      	add_settings_field("map-marker-address-lng","Longtitude:","map_marker_address_lng_field","google-map-setting-page","map-section");
      	
    	//Map Name
        register_setting("setting_options","map_name");
        //Map Width
        register_setting("setting_options","map_width");
        //Map Width px / %
        register_setting("setting_options","map_width_px_per");
        //Map Height
        register_setting("setting_options","map_height");
        //Map Height px
        register_setting("setting_options","map_height_px");
        //Map Height full/screen height
        register_setting("setting_options","map_height_full");
        //Zoom Control
        register_setting("setting_options","map_zoom");
        //Map Center 
        register_setting("setting_options","map_center");
        //Map Center Longtitude
        register_setting("setting_options","center_lat");
        //Map Center Longtitude
        register_setting("setting_options","center_lng");
        //Map Theme
        register_setting("setting_options","map_theme");
        //Marker Name
        register_setting("setting_options","map_marker_name");
        //marker Desc
        register_setting("setting_options","map_marker_desc");
        //Marker Icon
        register_setting("setting_options","map_marker_icon");
        //Marker Address
        register_setting("setting_options","map_marker_address");
        //Marker Address Latitude
        register_setting("setting_options","map_marker_address_lat");
        //Marker Address Longitude
        register_setting("setting_options","map_marker_address_lng");
        
        
			
    }


	function map_section_method()
	{
	?>
    <center>	<p><b>Add Settings Related To Google Map</b></p>	
    </center>
    <hr />     
     <?php
	}	


    //Map
	function map_name_field()
	{
	?><span class="dashicons dashicons-editor-help"></span>		
	<input type="text" name="map_name" id="map_name" class="regular-text" value="<?php  if(get_option(
		'map_name')!==null)echo get_option('map_name'); ?>" />
	<?php	
	}

    function map_width_field()
	{
	?>	<span class="dashicons dashicons-editor-help"></span>	
	<input type="number" name="map_width" id="map_width" class="regular-text" value="<?php  if(get_option(
		'map_width')!==null)echo get_option('map_width'); ?>" />
    &nbsp;&nbsp;&nbsp;&nbsp;     
    <input type="radio" name="map_width_px_per" id="map_width_px" value="px" <?php if(get_option('map_width_px_per')=='px'){ echo "checked";}?>  /> <b>Px</b>
    &nbsp;&nbsp;&nbsp;&nbsp; 

    <input type="radio" name="map_width_px_per" id="map_width_per" value="%" <?php if(get_option('map_width_px_per')=='%'){ echo "checked";}?>  />
   <b>Percents</b>
        
	<?php	
	}

    function map_height_field()
	{
	?>
<!--    <script>
        
    $(document).ready(function(){
     $('#map_height_full').on('click',function(){
        
         if($(this.checked)){
          $('#map_height').prop("disabled",true);
        }
         else {
           $('#map_height').prop("disabled",false);   
         }
    });  
        
        
    });   
    </script>-->    
    <span class="dashicons dashicons-editor-help"></span>		
	<input type="number" name="map_height" id="map_height" class="regular-text" value="<?php  if(get_option(
		'map_height')!==null)echo get_option('map_height'); ?>" />
    &nbsp;&nbsp;&nbsp;&nbsp;     
    <input type="radio" name="map_height_px" id="map_height_px" value="px" <?php if(get_option('map_height_px')=='px'){ echo "checked";}?>  /><b> Px</b>
    &nbsp;&nbsp;&nbsp;&nbsp; 

    <input type="checkbox" name="map_height_full" id="map_height_full" value="full" <?php if(get_option('map_height_full')=='full'){ echo "checked";}?>  />
   <b>Adapt Map To Screen Height</b>
        
        
        
	<?php	
	}

    function map_zoom_field()
	{
	?><span class="dashicons dashicons-editor-help"></span>	
	<select class="regular-text" name="map_zoom" id="map_zoom"> 
    <option value="BOTTOM_RIGHT">Default</option>    
    <?php
    $controls = array("Default","LEFT_TOP","LEFT_CENTER","LEFT_BOTTOM","RIGHT_TOP","RIGHT_CENTER","RIGHT_BOTTOM","TOP_LEFT","TOP_CENTER","TOP_RIGHT","BOTTOM_LEFT","BOTTOM_CENTER");
    for($i=0;$i<=11; $i++){
    ?>
    <option value="<?php if($controls[$i]=='Default'){echo 'BOTTOM_RIGHT';}else{echo $controls[$i];}?>" <?php if(get_option("map_zoom")==$controls[$i]){ echo "selected";} ?>><?php echo $controls[$i];?></option> 
	<?php	
    }
    }

	function map_center_field()
	{
	?><span class="dashicons dashicons-editor-help"></span>&nbsp;&nbsp;Address<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	<input type="text" name="map_center" id="map_center" class="regular-text" value="<?php  if(get_option(
		'map_center')!==null)echo get_option('map_center'); ?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>Latitude</label>
    <input type="text" name="center_lat" id="center_lat"  value="<?php  if(get_option(
		'center_lat')!==null)echo get_option('center_lat'); ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
      <label>Longtitude</label>
    <input type="text" name="center_lng" id="center_lng"  value="<?php  if(get_option(
		'center_lng')!==null)echo get_option('center_lng'); ?>" />
       
	<?php	
	}

     function map_theme_field()
	{
	?>
    <span class="dashicons dashicons-editor-help"></span>	
	<select class="regular-text" name="map_theme" id="map_theme">    
    <?php
    $themes = array("terrain","satellite","hybird","roadmap");
    for($i=0;$i<=3; $i++){
    ?>
    <option value="<?php echo $themes[$i];?>" <?php if(get_option("map_theme")==$themes[$i]){ echo "selected";} ?>><?php echo $themes[$i];?></option> 
	<?php	
    }
    }

    //Marker
    function map_marker_name_field()
	{
	?> 
        <hr />    
        <span class="dashicons dashicons-editor-help"></span>		
	<input type="text" name="map_marker_name" id="map_marker_name" class="regular-text" value="<?php  if(get_option(
		'map_marker_name')!==null)echo get_option('map_marker_name'); ?>" />
	<?php	
	}
    
    function map_marker_desc_field()
	{
	?> 
        <style>
            .wp-editor-container{
             width: 70%;   
            }
        </style>
        <span class="dashicons dashicons-editor-help"></span>
    <?php
        
        $settings = array("media_buttons"=>false,"textarea_rows"=>5);
        $content = get_option('map_marker_desc');
        $editor_id = 'map_marker_desc';
        wp_editor($content, $editor_id, $settings);
     }

    function map_marker_icon_field()
	{
      ?>
        <p> <span class="dashicons dashicons-editor-help"></span>	
           
            <input  type="button" value="Upload Icon" class="upload_image_button" style="border:1px solid black;font-weight:bold;width:200px;" />
            <input type="hidden" name="map_marker_icon" id="map_marker_icon" value="<?php echo get_option('map_marker_icon');?>"  class="regular-text" /><br />
             <?php
            if(get_option('map_marker_icon')){
            ?> 
            <img src="<?php  echo get_option('map_marker_icon')?>"  width="50" height="50"  />
            <?php    
            }
            ?>
               
        </p>

    <?php
    }

    function map_marker_address_field()
	{
	?><span class="dashicons dashicons-editor-help"></span> 
	<input type="text" name="map_marker_address" id="map_marker_address" class="regular-text" value="<?php  if(get_option(
		'map_marker_address')!==null)echo get_option('map_marker_address'); ?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       
	<?php	
	}

    function map_marker_address_lat_field()
	{
	?><span class="dashicons dashicons-editor-help"></span> 
	    <input type="text" name="map_marker_address_lat" id="map_marker_address_lat"  class="regular-text" value="<?php  if(get_option(
		'map_marker_address_lat')!==null)echo get_option('map_marker_address_lat'); ?>" />
    <?php	
	}
    
    function map_marker_address_lng_field()
	{
	?><span class="dashicons dashicons-editor-help"></span> 
	<input type="text" name="map_marker_address_lng" id="map_marker_address_lng" class="regular-text"  value="<?php  if(get_option(
		'map_marker_address_lng')!==null)echo get_option('map_marker_address_lng'); ?>" />
       
	<?php	
	}?>