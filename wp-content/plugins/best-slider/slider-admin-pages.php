<?php
    require_once("require/slider-controls-class.php");

	function add_slider_admin_pages()   
	{
        
        
   add_menu_page("Best Slider","Best Slider","manage_options","slider-main-page","slider_method",plugin_dir_url(__FILE__)."images/icon.png",16);
	
    
        add_submenu_page("slider-main-page","Best Slider Setting","Best Slider Setting","manage_options","slider-setting-page","slider_settings_method");
	
    }
?>

<?php
	function slider_method()
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
<h2><strong><i>About Best Slider Plugin</i></strong></h2>
<h3><b><i><u>Best Slider Information</u></i></b></h3>        
<p><i><b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?

It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ‘lorem ipsum’ will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)
</b></i></p>        
<h3><b><i><u>Best Slider Shortcode</u></i></b></h3>        
<p><i><b>
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ‘lorem ipsum’ will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)<br />
<br />
    
[best-slider-shortcode]    
</b></i></p>        
	<?php

	}



	function slider_settings_method()
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
			settings_fields("slider_options_setting");

			do_settings_sections("slider-setting-page");//parameter is page slug
			submit_button();

			?>
			
		</form>
	</div>
	<?php


	}

    //This will be called in plugin file
	function add_slider_options_settings()
	{
        //Creating Slider Controls Class Obj
        $slider_controls_obj = new Slider_Controls_Class;
        $slider_controls_obj->set_slider_controls();
    }



    function method_general_setting_section_description()
    {
        ?>
            <p><strong style="color:red">Here You Can Set General Settings Of Slider</strong></p>
        <?php
    }
    
    
            //Section 1
        //Section 1 Description
        function method_section1_description()
        {
            ?>
            <p><strong style="color:red">Here You Can Set The Settings Of Slider Image One</strong></p>
            <?php
        }

        //Title Field 1 Function
        function method_slider_title_field1()
        {
          ?>
        <input type="text" name="slider_title_fieldname1" id="slider_title_fieldname1" value="<?php echo get_option('slider_title_fieldname1');?>"  class="regular-text" />

        <?php    
        }

        //Description Field 1 Function
        function method_slider_description_field1()
        {
        ?>
        <textarea name="slider_description_fieldname1" id="slider_description_fieldname1" class="regular-text" rows="5"><?php echo get_option("slider_description_fieldname1");?></textarea>
        <?php

        }

        //Image Field 1 Function
        function method_slider_image_field1()
        {?>
        <p>
        <input type="text" name="slider_image_fieldname1" id="slider_image_fieldname1" value="<?php echo get_option('slider_image_fieldname1');?>"  class="regular-text" />
        <br />
        <input type="button" value="Upload Slider Image 1" class="upload_image_button" />
        <br />
        <?php
        if(get_option('slider_image_fieldname1')){
        ?> 

         <img src="<?php  echo get_option('slider_image_fieldname1')?>"  width="200" height="150"  /> 

        <?php    
        }
        ?>
        </p>

        <?php
        }

        //Link URL Field 1 Function
        function method_slider_link_url_field1()
        {?>
        <p>
        <input type="url" name="slider_link_url_fieldname1" id="slider_link_url_fieldname1" value="<?php echo get_option('slider_link_url_fieldname1');?>"  class="regular-text" />
        </p>
        <?php
        }

        //Display Radios 1 Function
        function method_slider_display_field1()
        {
        ?>
         <input type="radio" name="slider_display_fieldname1" id="slider_display_yes_fieldname1" value="yes" <?php if(get_option('slider_display_fieldname1')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_display_fieldname1" id="slider_display_no_fieldname1" value="no" <?php if(get_option('slider_display_fieldname1')=='no'){ echo "checked";}?>  />
        No

        <?php
        }


        //Add BG Color 1 Function
        function method_slider_bg_color_field1()
        {
        ?>

        <input class="jscolor" type="text" name="slider_bg_color_fieldname1" id="slider_bg_color_fieldname1" value="<?php  echo get_option('slider_bg_color_fieldname1'); ?>"  class="regular-text" />
        <?php
        }




        function method_slider_font_style_field1()
        {
            ?>
             <select class="regular-text" name="slider_font_style_fieldname1" id="slider_font_style_fieldname1">
            <option value="0">--Select Font Style--</option>     
            <?php
            $fonts = array("Arial","Times New Roman","Arial Black","Segoe UI","Calibri");
            for($i=0;$i<=4; $i++){
            ?>
            <option value="<?php echo $fonts[$i];?>" <?php if(get_option("slider_font_style_fieldname1")==$fonts[$i]){ echo "selected";} ?>><?php echo $fonts[$i];?></option> 
            <?php
        }
        ?>
        </select>
        <?php
        }



        function method_slider_opacity_duration_field1()
        {
            ?>
        <small>Opacity:</small>  <input type="text" name="slider_opacity_fieldname1" id="slider_opacity_fieldname1" value="<?php echo get_option('slider_opacity_fieldname1');?>"  class="regular-text" placeholder="Enter Opacity"/><br />

        <small>Duration:</small><input type="number" name="slider_duration_fieldname1" id="slider_duration_fieldname1" value="<?php echo get_option('slider_duration_fieldname1');?>"  class="regular-text" placeholder="Enter Duration"/>
        <br /><br /><strong>Display ?</strong> 
        <input type="radio" name="slider_display_opacity_duration_fieldname1" id="slider_display_bg_color_yes_fieldname1" value="yes" <?php if(get_option('slider_display_opacity_duration_fieldname1')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_display_opacity_duration_fieldname1" id="slider_display_bg_color_no_fieldname1" value="no" <?php if(get_option('slider_display_opacity_duration_fieldname1')=='no'){ echo "checked";}?>  />
        No 


        <?php
        }



        function  method_slider_slide_up_down_duration_field1()
        {
           ?>     
        <input type="number" name="slider_slide_up_down_duration_fieldname1" id="slider_slide_up_down_duration_fieldname1" value="<?php echo get_option('slider_slide_up_down_duration_fieldname1');?>"  class="regular-text" placeholder="Enter Duration"/>
        <br /><br /><strong>Display ?</strong> &nbsp;
        <input type="radio" name="slider_slide_up_down_duration_display_fieldname1" id="slider_slide_up_down_duration_display_yes_fieldname1" value="yes" <?php if(get_option('slider_slide_up_down_duration_display_fieldname1')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_slide_up_down_duration_display_fieldname1" id="slider_slide_up_down_duration_display_no_fieldname1" value="no" <?php if(get_option('slider_slide_up_down_duration_display_fieldname1')=='no'){ echo "checked";}?>  />
        No 
        <?php  
        }

        //Section 1


        //Section 2
        //Section 2 Description
        function method_section2_description()
        {
            ?>
            <p><strong style="color:red">Here You Can Set The Settings Of Slider Image Two</strong></p>
            <?php
        }

        //Title Field 2 Function
        function method_slider_title_field2()
        {
          ?>
        <input type="text" name="slider_title_fieldname2" id="slider_title_fieldname2" value="<?php echo get_option('slider_title_fieldname2');?>"  class="regular-text" />

        <?php    
        }

        //Description Field 2 Function
        function method_slider_description_field2()
        {
        ?>
        <textarea name="slider_description_fieldname2" id="slider_description_fieldname2" class="regular-text" rows="5"><?php echo get_option("slider_description_fieldname2");?></textarea>
        <?php

        }

            //Image Field 2 Function
            function method_slider_image_field2()
            {?>
            <p>
            <input type="text" name="slider_image_fieldname2" id="slider_image_fieldname2" value="<?php echo get_option('slider_image_fieldname2');?>"  class="regular-text" />
            <br />
            <input type="button" value="Upload Slider Image 2" class="upload_image_button" />
            <br />
            <?php
            if(get_option('slider_image_fieldname2')){
            ?> 

             <img src="<?php  echo get_option('slider_image_fieldname2')?>"  width="200" height="150"  /> 

            <?php    
            }
            ?>
            </p>

        <?php
        }

        //Link URL Field 2 Function
        function method_slider_link_url_field2()
        {?>
        <p>
        <input type="url" name="slider_link_url_fieldname2" id="slider_link_url_fieldname2" value="<?php echo get_option('slider_link_url_fieldname2');?>"  class="regular-text" />
        </p>
        <?php
        }

        //Display Radios 2 Function
        function method_slider_display_field2()
        {
        ?>
         <input type="radio" name="slider_display_fieldname2" id="slider_display_yes_fieldname2" value="yes" <?php if(get_option('slider_display_fieldname2')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_display_fieldname2" id="slider_display_no_fieldname2" value="no" <?php if(get_option('slider_display_fieldname2')=='no'){ echo "checked";}?>  />
        No
        <?php
        }

        //Section 2




        //Section 3
        //Section 3 Description
        function method_section3_description()
        {
            ?>
            <p><strong style="color:red">Here You Can Set The Settings Of Slider Image Three</strong></p>
            <?php
        }

        //Title Field 3 Function
        function method_slider_title_field3()
        {
          ?>
        <input type="text" name="slider_title_fieldname3" id="slider_title_fieldname3" value="<?php echo get_option('slider_title_fieldname3');?>"  class="regular-text" />

        <?php    
        }

        //Description Field 3 Function
        function method_slider_description_field3()
        {
        ?>
        <textarea name="slider_description_fieldname3" id="slider_description_fieldname3" class="regular-text" rows="5"><?php echo get_option("slider_description_fieldname3");?></textarea>
        <?php

        }


        //Image Field 3 Function
        function method_slider_image_field3()
        {?>
        <p>
        <input type="text" name="slider_image_fieldname3" id="slider_image_fieldname3" value="<?php echo get_option('slider_image_fieldname3');?>"  class="regular-text" />
        <br />
        <input type="button" value="Upload Slider Image 3" class="upload_image_button" />
        <br />
        <?php
        if(get_option('slider_image_fieldname3')){
        ?> 

         <img src="<?php  echo get_option('slider_image_fieldname3')?>"  width="200" height="150"  /> 

        <?php    
        }
        ?>
        </p>

        <?php
        }



        //Link URL Field 3 Function
        function method_slider_link_url_field3()
        {?>
        <p>
        <input type="url" name="slider_link_url_fieldname3" id="slider_link_url_fieldname3" value="<?php echo get_option('slider_link_url_fieldname3');?>"  class="regular-text" />
        </p>
        <?php
        }

        //Display Radios 3 Function
        function method_slider_display_field3()
        {
        ?>
         <input type="radio" name="slider_display_fieldname3" id="slider_display_yes_fieldname3" value="yes" <?php if(get_option('slider_display_fieldname3')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_display_fieldname3" id="slider_display_no_fieldname3" value="no" <?php if(get_option('slider_display_fieldname3')=='no'){ echo "checked";}?>  />
        No
        <?php
        }
        //Section 3





        //Section 4
        //Section 4 Description
        function method_section4_description()
        {
            ?>
            <p><strong style="color:red">Here You Can Set The Settings Of Slider Image One</strong></p>
            <?php
        }

        //Title Field 4 Function
        function method_slider_title_field4()
        {
          ?>
        <input type="text" name="slider_title_fieldname4" id="slider_title_fieldname4" value="<?php echo get_option('slider_title_fieldname4');?>"  class="regular-text" />

        <?php    
        }

        //Description Field 4 Function
        function method_slider_description_field4()
        {
        ?>
        <textarea name="slider_description_fieldname4" id="slider_description_fieldname4" class="regular-text" rows="5"><?php echo get_option("slider_description_fieldname4");?></textarea>
        <?php

        }

        //Image Field 4 Function
        function method_slider_image_field4()
        {?>
        <p>
        <input type="text" name="slider_image_fieldname4" id="slider_image_fieldname4" value="<?php echo get_option('slider_image_fieldname4');?>"  class="regular-text" />
        <br />
        <input type="button" value="Upload Slider Image 4" class="upload_image_button" />
        <br />
        <?php
        if(get_option('slider_image_fieldname4')){
        ?> 

         <img src="<?php  echo get_option('slider_image_fieldname4')?>"  width="200" height="150"  /> 

        <?php    
        }
        ?>
        </p>

        <?php
        }

        //Link URL Field 4 Function
        function method_slider_link_url_field4()
        {?>
        <p>
        <input type="url" name="slider_link_url_fieldname4" id="slider_link_url_fieldname4" value="<?php echo get_option('slider_link_url_fieldname4');?>"  class="regular-text" />
        </p>
        <?php
        }


        //Display Radios 4 Function
        function method_slider_display_field4()
        {
        ?>
         <input type="radio" name="slider_display_fieldname4" id="slider_display_yes_fieldname4" value="yes" <?php if(get_option('slider_display_fieldname4')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_display_fieldname4" id="slider_display_no_fieldname4" value="no" <?php if(get_option('slider_display_fieldname4')=='no'){ echo "checked";}?>  />
        No
        <?php
        }
        //Section 4




            //Section 5
        //Section 5 Description
        function method_section5_description()
        {
        ?>
            <p><strong style="color:red">Here You Can Set The Settings Of Slider Image One</strong></p>
        <?php
        }

        //Title Field 5 Function
        function method_slider_title_field5()
        {
          ?>
        <input type="text" name="slider_title_fieldname5" id="slider_title_fieldname5" value="<?php echo get_option('slider_title_fieldname5');?>"  class="regular-text" />

        <?php    
        }

        //Description Field 5 Function
        function method_slider_description_field5()
        {
        ?>
        <textarea name="slider_description_fieldname5" id="slider_description_fieldname5" class="regular-text" rows="5"><?php echo get_option("slider_description_fieldname5");?></textarea>
        <?php

        }

        //Image Field 5 Function
        function method_slider_image_field5()
        {?>
        <p>
        <input type="text" name="slider_image_fieldname5" id="slider_image_fieldname5" value="<?php echo get_option('slider_image_fieldname5');?>"  class="regular-text" />
        <br />
        <input type="button" value="Upload Slider Image 5" class="upload_image_button" />
        <br />
        <?php
        if(get_option('slider_image_fieldname5')){
        ?> 

         <img src="<?php  echo get_option('slider_image_fieldname5')?>"  width="200" height="150"  /> 

        <?php    
        }
        ?>
        </p>

        <?php
        }


        //Link URL Field 5 Function
        function method_slider_link_url_field5()
        {?>
        <p>
        <input type="url" name="slider_link_url_fieldname5" id="slider_link_url_fieldname5" value="<?php echo get_option('slider_link_url_fieldname5');?>"  class="regular-text" />
        </p>
        <?php
        }

        //Display Radios 5 Function
        function method_slider_display_field5()
        {
        ?>
         <input type="radio" name="slider_display_fieldname5" id="slider_display_yes_fieldname5" value="yes" <?php if(get_option('slider_display_fieldname5')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_display_fieldname5" id="slider_display_no_fieldname5" value="no" <?php if(get_option('slider_display_fieldname5')=='no'){ echo "checked";}?>  />
        No
        <?php
        }
        //Section 5



           //Section 6
        //Section 6 Description
        function method_section6_description()
        {
            ?>
            <p><strong style="color:red">Here You Can Set The Settings Of Slider Image One</strong></p>
            <?php
        }

        //Title Field 6 Function
        function method_slider_title_field6()
        {
          ?>
        <input type="text" name="slider_title_fieldname6" id="slider_title_fieldname6" value="<?php echo get_option('slider_title_fieldname6');?>"  class="regular-text" />

        <?php    
        }

        //Description Field 6 Function
        function method_slider_description_field6()
        {
        ?>
        <textarea name="slider_description_fieldname6" id="slider_description_fieldname6" class="regular-text" rows="5"><?php echo get_option("slider_description_fieldname6");?></textarea>
        <?php

        }

        //Image Field 6 Function
        function method_slider_image_field6()
        {?>
        <p>
        <input type="text" name="slider_image_fieldname6" id="slider_image_fieldname6" value="<?php echo get_option('slider_image_fieldname6');?>"  class="regular-text" />
        <br />
        <input type="button" value="Upload Slider Image 6" class="upload_image_button" />
        <br />
        <?php
        if(get_option('slider_image_fieldname6')){
        ?> 

         <img src="<?php  echo get_option('slider_image_fieldname6')?>"  width="200" height="150"  /> 

        <?php    
        }
        ?>
        </p>

        <?php
        }


        //Link URL Field 6 Function
        function method_slider_link_url_field6()
        {?>
        <p>
        <input type="url" name="slider_link_url_fieldname6" id="slider_link_url_fieldname6" value="<?php echo get_option('slider_link_url_fieldname6');?>"  class="regular-text" />
        </p>
        <?php
        }


        //Display Radios 6 Function
        function method_slider_display_field6()
        {
        ?>
         <input type="radio" name="slider_display_fieldname6" id="slider_display_yes_fieldname6" value="yes" <?php if(get_option('slider_display_fieldname6')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_display_fieldname6" id="slider_display_no_fieldname6" value="no" <?php if(get_option('slider_display_fieldname6')=='no'){ echo "checked";}?>  />
        No
        <?php
        }
        //Section 6



           //Section 7
        //Section 7 Description
        function method_section7_description()
        {
            ?>
            <p><strong style="color:red">Here You Can Set The Settings Of Slider Image One</strong></p>
            <?php
        }

        //Title Field 7 Function
        function method_slider_title_field7()
        {
          ?>
        <input type="text" name="slider_title_fieldname7" id="slider_title_fieldname7" value="<?php echo get_option('slider_title_fieldname7');?>"  class="regular-text" />

        <?php    
        }

        //Description Field 7 Function
        function method_slider_description_field7()
        {
        ?>
        <textarea name="slider_description_fieldname7" id="slider_description_fieldname7" class="regular-text" rows="5"><?php echo get_option("slider_description_fieldname7");?></textarea>
        <?php

        }

        //Image Field 7 Function
        function method_slider_image_field7()
        {?>
        <p>
        <input type="text" name="slider_image_fieldname7" id="slider_image_fieldname7" value="<?php echo get_option('slider_image_fieldname7');?>"  class="regular-text" />
        <br />
        <input type="button" value="Upload Slider Image 7" class="upload_image_button" />
        <br />
        <?php
        if(get_option('slider_image_fieldname7')){
        ?> 

         <img src="<?php  echo get_option('slider_image_fieldname7')?>"  width="200" height="150"  /> 

        <?php    
        }
        ?>
        </p>

        <?php
        }


        //Link URL Field 7 Function
        function method_slider_link_url_field7()
        {?>
        <p>
        <input type="url" name="slider_link_url_fieldname7" id="slider_link_url_fieldname7" value="<?php echo get_option('slider_link_url_fieldname7');?>"  class="regular-text" />
        </p>
        <?php
        }


        //Display Radios 7 Function
        function method_slider_display_field7()
        {
        ?>
         <input type="radio" name="slider_display_fieldname7" id="slider_display_yes_fieldname7" value="yes" <?php if(get_option('slider_display_fieldname7')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_display_fieldname7" id="slider_display_no_fieldname7" value="no" <?php if(get_option('slider_display_fieldname7')=='no'){ echo "checked";}?>  />
        No
        <?php
        }
        //Section 7



           //Section 8
        //Section 8 Description
        function method_section8_description()
        {
            ?>
            <p><strong style="color:red">Here You Can Set The Settings Of Slider Image One</strong></p>
            <?php
        }

        //Title Field 8 Function
        function method_slider_title_field8()
        {
          ?>
        <input type="text" name="slider_title_fieldname8" id="slider_title_fieldname8" value="<?php echo get_option('slider_title_fieldname8');?>"  class="regular-text" />

        <?php    
        }

        //Description Field 8 Function
        function method_slider_description_field8()
        {
        ?>
        <textarea name="slider_description_fieldname8" id="slider_description_fieldname8" class="regular-text" rows="5"><?php echo get_option("slider_description_fieldname8");?></textarea>
        <?php

        }

        //Image Field 8 Function
        function method_slider_image_field8()
        {?>
        <p>
        <input type="text" name="slider_image_fieldname8" id="slider_image_fieldname8" value="<?php echo get_option('slider_image_fieldname8');?>"  class="regular-text" />
        <br />
        <input type="button" value="Upload Slider Image 8" class="upload_image_button" />
        <br />
        <?php
        if(get_option('slider_image_fieldname8')){
        ?> 

         <img src="<?php  echo get_option('slider_image_fieldname8')?>"  width="200" height="150"  /> 

        <?php    
        }
        ?>
        </p>

        <?php
        }


        //Link URL Field 8 Function
        function method_slider_link_url_field8()
        {?>
        <p>
        <input type="url" name="slider_link_url_fieldname8" id="slider_link_url_fieldname8" value="<?php echo get_option('slider_link_url_fieldname8');?>"  class="regular-text" />
        </p>
        <?php
        }


        //Display Radios 8 Function
        function method_slider_display_field8()
        {
        ?>
         <input type="radio" name="slider_display_fieldname8" id="slider_display_yes_fieldname8" value="yes" <?php if(get_option('slider_display_fieldname8')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_display_fieldname8" id="slider_display_no_fieldname8" value="no" <?php if(get_option('slider_display_fieldname8')=='no'){ echo "checked";}?>  />
        No
        <?php
        }
        //Section 8



           //Section 9
        //Section 9 Description
        function method_section9_description()
        {
            ?>
            <p><strong style="color:red">Here You Can Set The Settings Of Slider Image One</strong></p>
            <?php
        }

        //Title Field 9 Function
        function method_slider_title_field9()
        {
          ?>
        <input type="text" name="slider_title_fieldname9" id="slider_title_fieldname9" value="<?php echo get_option('slider_title_fieldname9');?>"  class="regular-text" />

        <?php    
        }

        //Description Field 9 Function
        function method_slider_description_field9()
        {
        ?>
        <textarea name="slider_description_fieldname9" id="slider_description_fieldname9" class="regular-text" rows="5"><?php echo get_option("slider_description_fieldname9");?></textarea>
        <?php

        }

        //Image Field 9 Function
        function method_slider_image_field9()
        {?>
        <p>
        <input type="text" name="slider_image_fieldname9" id="slider_image_fieldname9" value="<?php echo get_option('slider_image_fieldname9');?>"  class="regular-text" />
        <br />
        <input type="button" value="Upload Slider Image 9" class="upload_image_button" />
        <br />
        <?php
        if(get_option('slider_image_fieldname9')){
        ?> 

         <img src="<?php  echo get_option('slider_image_fieldname9')?>"  width="200" height="150"  /> 

        <?php    
        }
        ?>
        </p>

        <?php
        }



        //Link URL Field 9 Function
        function method_slider_link_url_field9()
        {?>
        <p>
        <input type="url" name="slider_link_url_fieldname9" id="slider_link_url_fieldname9" value="<?php echo get_option('slider_link_url_fieldname9');?>"  class="regular-text" />
        </p>
        <?php
        }


        //Display Radios 9 Function
        function method_slider_display_field9()
        {
        ?>
         <input type="radio" name="slider_display_fieldname9" id="slider_display_yes_fieldname9" value="yes" <?php if(get_option('slider_display_fieldname9')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_display_fieldname9" id="slider_display_no_fieldname9" value="no" <?php if(get_option('slider_display_fieldname9')=='no'){ echo "checked";}?>  />
        No
        <?php
        }
        //Section 9


           //Section 10
        //Section 10 Description
        function method_section10_description()
        {
            ?>
            <p><strong style="color:red">Here You Can Set The Settings Of Slider Image One</strong></p>
            <?php
        }

        //Title Field 10 Function
        function method_slider_title_field10()
        {
          ?>
        <input type="text" name="slider_title_fieldname10" id="slider_title_fieldname10" value="<?php echo get_option('slider_title_fieldname10');?>"  class="regular-text" />

        <?php    
        }

        //Description Field 10 Function
        function method_slider_description_field10()
        {
        ?>
        <textarea name="slider_description_fieldname10" id="slider_description_fieldname10" class="regular-text my-color-picker" rows="5"><?php echo get_option("slider_description_fieldname10");?></textarea>
        <?php

        }

        //Image Field 10 Function
        function method_slider_image_field10()
        {?>
        <p>
        <input type="text" name="slider_image_fieldname10" id="slider_image_fieldname10" value="<?php echo get_option('slider_image_fieldname10');?>"  class="regular-text" />
        <br />
        <input type="button" value="Upload Slider Image 10" class="upload_image_button" />
        <br />
        <?php
        if(get_option('slider_image_fieldname10')){
        ?> 

         <img src="<?php  echo get_option('slider_image_fieldname10')?>"  width="200" height="150"  /> 

        <?php    
        }
        ?>
        </p>

        <?php
        }



        //Link URL Field 10 Function
        function method_slider_link_url_field10()
        {?>
        <p>
        <input type="url" name="slider_link_url_fieldname10" id="slider_link_url_fieldname10" value="<?php echo get_option('slider_link_url_fieldname10');?>"  class="regular-text" />
        </p>
        <?php
        }


        //Display Radios 10 Function
        function method_slider_display_field10()
        {
        ?>
         <input type="radio" name="slider_display_fieldname10" id="slider_display_yes_fieldname10" value="yes" <?php if(get_option('slider_display_fieldname10')=='yes'){ echo "checked";}?>  /> Yes
        &nbsp;&nbsp;&nbsp;&nbsp;     
        <input type="radio" name="slider_display_fieldname10" id="slider_display_no_fieldname10" value="no" <?php if(get_option('slider_display_fieldname10')=='no'){ echo "checked";}?>  />
        No
        <?php
        }?>