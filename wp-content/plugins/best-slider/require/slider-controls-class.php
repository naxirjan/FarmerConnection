<?php
class Slider_Controls_Class
{
    public function set_slider_controls()
    {
        
         //Section 1
    add_settings_section("slider-section1-id","<h1>Slider Section 1 Settings</h1>","method_section1_description","slider-setting-page");
    
     //Title Field 1
    add_settings_field("slider-title-field1","Main Heading 1:","method_slider_title_field1","slider-setting-page","slider-section1-id");
   
     //Description Field 1
    add_settings_field("slider-description-field1","Description 1:","method_slider_description_field1","slider-setting-page","slider-section1-id");
   
    
    //Image Field 1
    add_settings_field("slider-image-field1","Slider Image 1:","method_slider_image_field1","slider-setting-page","slider-section1-id");
   
    //Link URL 1
    add_settings_field("slider-link-url-field1","Link URL 1: ","method_slider_link_url_field1","slider-setting-page","slider-section1-id");
    
     //Display Field 1
    add_settings_field("slider-display-field1","Display In Slider? ","method_slider_display_field1","slider-setting-page","slider-section1-id");
    
    
    
    //Setting 1
    register_setting("slider_options_setting","slider_title_fieldname1");
    register_setting("slider_options_setting","slider_description_fieldname1");
    register_setting("slider_options_setting","slider_image_fieldname1");
    register_setting("slider_options_setting","slider_link_url_fieldname1");    
    register_setting("slider_options_setting","slider_display_fieldname1");
    
    
    


        //Section 2
    add_settings_section("slider-section2-id","<h1 >Slider Section 2 Settings</h1>","method_section2_description","slider-setting-page");


     //Title Field 2
    add_settings_field("slider-title-field2","Main Heading 2:","method_slider_title_field2","slider-setting-page","slider-section2-id");

     //Description Field 2
    add_settings_field("slider-description-field2","Description 2:","method_slider_description_field2","slider-setting-page","slider-section2-id");


    //Image Field 2
    add_settings_field("slider-image-field2","Slider Image 2:","method_slider_image_field2","slider-setting-page","slider-section2-id");

    //Image Link URL 2
    add_settings_field("slider-link-url-field2","Link URL 2: ","method_slider_link_url_field2","slider-setting-page","slider-section2-id");
    
    
    
    
   
    
    
    //Display Fields 2
    add_settings_field("slider-display-field2","Display In Slider? ","method_slider_display_field2","slider-setting-page","slider-section2-id");
   

    //Setting 2
    register_setting("slider_options_setting","slider_title_fieldname2");
    register_setting("slider_options_setting","slider_description_fieldname2");
    register_setting("slider_options_setting","slider_image_fieldname2");
    register_setting("slider_options_setting","slider_display_fieldname2");
    register_setting("slider_options_setting","slider_link_url_fieldname2");

 
    
     //Section 3
    add_settings_section("slider-section3-id","<hr /><h1 >Slider Section 3 Settings</h1>","method_section3_description","slider-setting-page");
    
     //Title Field 3
    add_settings_field("slider-title-field3","Main Heading 3:","method_slider_title_field3","slider-setting-page","slider-section3-id");
   
     //Description Field 3
    add_settings_field("slider-description-field3","Description 3:","method_slider_description_field3","slider-setting-page","slider-section3-id");
   
    
    //Image Field 3
    add_settings_field("slider-image-field3","Slider Image 3:","method_slider_image_field3","slider-setting-page","slider-section3-id");
   
    //Image Link URL 3
    add_settings_field("slider-link-url-field3","Link URL 3: ","method_slider_link_url_field3","slider-setting-page","slider-section3-id");
    
    
     //Display Fields 3
    add_settings_field("slider-display-field3","Display In Slider? ","method_slider_display_field3","slider-setting-page","slider-section3-id");
   
    
    //Setting 3
    register_setting("slider_options_setting","slider_title_fieldname3");
    register_setting("slider_options_setting","slider_description_fieldname3");
    register_setting("slider_options_setting","slider_image_fieldname3");
    register_setting("slider_options_setting","slider_display_fieldname3");
    register_setting("slider_options_setting","slider_link_url_fieldname3");
   
    
    //Section 4
    add_settings_section("slider-section4-id","<hr /><h1 >Slider Section 4 Settings</h1>","method_section4_description","slider-setting-page");
    
     //Title Field 4
    add_settings_field("slider-title-field4","Main Heading 4:","method_slider_title_field4","slider-setting-page","slider-section4-id");
   
     //Description Field 4
    add_settings_field("slider-description-field4","Description 4:","method_slider_description_field4","slider-setting-page","slider-section4-id");
   
    
    //Image Field 4
    add_settings_field("slider-image-field4","Slider Image 4:","method_slider_image_field4","slider-setting-page","slider-section4-id");
   
    //Image Link URL 4
    add_settings_field("slider-link-url-field4","Link URL 4: ","method_slider_link_url_field4","slider-setting-page","slider-section4-id");
    
    
     //Display Fields 4
    add_settings_field("slider-display-field4","Display In Slider? ","method_slider_display_field4","slider-setting-page","slider-section4-id");
   
    
    //Setting 4
    register_setting("slider_options_setting","slider_title_fieldname4");
    register_setting("slider_options_setting","slider_description_fieldname4");
    register_setting("slider_options_setting","slider_image_fieldname4");
    register_setting("slider_options_setting","slider_display_fieldname4");
    register_setting("slider_options_setting","slider_link_url_fieldname4");
    
    //Section 5
    add_settings_section("slider-section5-id","<hr /><h1 >Slider Section 5 Settings</h1>","method_section5_description","slider-setting-page");
    
     //Title Field 5
    add_settings_field("slider-title-field5","Main Heading 5:","method_slider_title_field5","slider-setting-page","slider-section5-id");
   
     //Description Field 5
    add_settings_field("slider-description-field5","Description 5:","method_slider_description_field5","slider-setting-page","slider-section5-id");
   
    
    //Image Field 5
    add_settings_field("slider-image-field5","Slider Image 5:","method_slider_image_field5","slider-setting-page","slider-section5-id");
   

     //Image Link URL 5
    add_settings_field("slider-link-url-field5","Link URL 5: ","method_slider_link_url_field5","slider-setting-page","slider-section5-id");
   
    
     //Display Fields 5
    add_settings_field("slider-display-field5","Display In Slider? ","method_slider_display_field5","slider-setting-page","slider-section5-id");
   
    
    //Setting 5
    register_setting("slider_options_setting","slider_title_fieldname5");
    register_setting("slider_options_setting","slider_description_fieldname5");
    register_setting("slider_options_setting","slider_image_fieldname5");
    register_setting("slider_options_setting","slider_display_fieldname5");
    register_setting("slider_options_setting","slider_link_url_fieldname5");
    
    //Section 6
    add_settings_section("slider-section6-id","<hr /><h1 >Slider Section 6 Settings</h1>","method_section6_description","slider-setting-page");
    
     //Title Field 6
    add_settings_field("slider-title-field6","Main Heading 6:","method_slider_title_field6","slider-setting-page","slider-section6-id");
   
     //Description Field 6
    add_settings_field("slider-description-field6","Description 6:","method_slider_description_field6","slider-setting-page","slider-section6-id");
   
    
    //Image Field 6
    add_settings_field("slider-image-field6","Slider Image 6:","method_slider_image_field6","slider-setting-page","slider-section6-id");
   
     //Image Link URL 6
    add_settings_field("slider-link-url-field6","Link URL 6: ","method_slider_link_url_field6","slider-setting-page","slider-section6-id");
   
    
     //Display Fields 6
    add_settings_field("slider-display-field6","Display In Slider? ","method_slider_display_field6","slider-setting-page","slider-section6-id");
   
    
    //Setting 6
    register_setting("slider_options_setting","slider_title_fieldname6");
    register_setting("slider_options_setting","slider_description_fieldname6");
    register_setting("slider_options_setting","slider_image_fieldname6");
    register_setting("slider_options_setting","slider_display_fieldname6");
    register_setting("slider_options_setting","slider_link_url_fieldname6");
    
    //Section 7
    add_settings_section("slider-section7-id","<hr /><h1 >Slider Section 7 Settings</h1>","method_section7_description","slider-setting-page");
    
     //Title Field 7
    add_settings_field("slider-title-field7","Main Heading 7:","method_slider_title_field7","slider-setting-page","slider-section7-id");
   
     //Description Field 7
    add_settings_field("slider-description-field7","Description 7:","method_slider_description_field7","slider-setting-page","slider-section7-id");
   
    
    //Image Field 7
    add_settings_field("slider-image-field7","Slider Image 7:","method_slider_image_field7","slider-setting-page","slider-section7-id");
   
     //Image Link URL 7
    add_settings_field("slider-link-url-field7","Link URL 7: ","method_slider_link_url_field7","slider-setting-page","slider-section7-id");
   
    
     //Display Fields 7
    add_settings_field("slider-display-field7","Display In Slider? ","method_slider_display_field7","slider-setting-page","slider-section7-id");
   
    
    //Setting 7
    register_setting("slider_options_setting","slider_title_fieldname7");
    register_setting("slider_options_setting","slider_description_fieldname7");
    register_setting("slider_options_setting","slider_image_fieldname7");
    register_setting("slider_options_setting","slider_display_fieldname7");
    register_setting("slider_options_setting","slider_link_url_fieldname7");
    
    //Section 8
    add_settings_section("slider-section8-id","<hr /><h1 >Slider Section 8 Settings</h1>","method_section8_description","slider-setting-page");
    
     //Title Field 8
    add_settings_field("slider-title-field8","Main Heading 8:","method_slider_title_field8","slider-setting-page","slider-section8-id");
   
     //Description Field 8
    add_settings_field("slider-description-field8","Description 8:","method_slider_description_field8","slider-setting-page","slider-section8-id");
   
    
    //Image Field 8
    add_settings_field("slider-image-field8","Slider Image 8:","method_slider_image_field8","slider-setting-page","slider-section8-id");
   
     //Image Link URL 8
    add_settings_field("slider-link-url-field8","Link URL 8: ","method_slider_link_url_field8","slider-setting-page","slider-section8-id");
   
    
     //Display Fields 8
    add_settings_field("slider-display-field8","Display In Slider? ","method_slider_display_field8","slider-setting-page","slider-section8-id");
   
    
    //Setting 8
    register_setting("slider_options_setting","slider_title_fieldname8");
    register_setting("slider_options_setting","slider_description_fieldname8");
    register_setting("slider_options_setting","slider_image_fieldname8");
    register_setting("slider_options_setting","slider_display_fieldname8");
    register_setting("slider_options_setting","slider_link_url_fieldname8");
    
    
    //Section 9
    add_settings_section("slider-section9-id","<hr /><h1 >Slider Section 9 Settings</h1>","method_section9_description","slider-setting-page");
    
     //Title Field 9
    add_settings_field("slider-title-field9","Main Heading 9:","method_slider_title_field9","slider-setting-page","slider-section9-id");
   
     //Description Field 9
    add_settings_field("slider-description-field9","Description 9:","method_slider_description_field9","slider-setting-page","slider-section9-id");
   
    
    //Image Field 9
    add_settings_field("slider-image-field9","Slider Image 9:","method_slider_image_field9","slider-setting-page","slider-section9-id");
   
     //Image Link URL 9
    add_settings_field("slider-link-url-field9","Link URL 9: ","method_slider_link_url_field9","slider-setting-page","slider-section9-id");
   
    
     //Display Fields 9
    add_settings_field("slider-display-field9","Display In Slider? ","method_slider_display_field9","slider-setting-page","slider-section9-id");
   
    
    //Setting 9
    register_setting("slider_options_setting","slider_title_fieldname9");
    register_setting("slider_options_setting","slider_description_fieldname9");
    register_setting("slider_options_setting","slider_image_fieldname9");
    register_setting("slider_options_setting","slider_display_fieldname9");
    register_setting("slider_options_setting","slider_link_url_fieldname9");
    
    
    
    //Section 10
    add_settings_section("slider-section10-id","<hr /><h1 >Slider Section 10 Settings</h1>","method_section10_description","slider-setting-page");
    
     //Title Field 10
    add_settings_field("slider-title-field10","Main Heading 10:","method_slider_title_field10","slider-setting-page","slider-section10-id");
   
     //Description Field 10
    add_settings_field("slider-description-field10","Description 10:","method_slider_description_field10","slider-setting-page","slider-section10-id");
   
    
    //Image Field 10
    add_settings_field("slider-image-field10","Slider Image 10:","method_slider_image_field10","slider-setting-page","slider-section10-id");
   
     //Image Link URL 10
    add_settings_field("slider-link-url-field10","Link URL 10: ","method_slider_link_url_field10","slider-setting-page","slider-section10-id");
   
    
     //Display Fields 10
    add_settings_field("slider-display-field10","Display In Slider? ","method_slider_display_field10","slider-setting-page","slider-section10-id");
   
    
    //Setting 10
    register_setting("slider_options_setting","slider_title_fieldname10");
    register_setting("slider_options_setting","slider_description_fieldname10");
    register_setting("slider_options_setting","slider_image_fieldname10");
    register_setting("slider_options_setting","slider_display_fieldname10");
    register_setting("slider_options_setting","slider_link_url_fieldname10");
    
 
    
    
    
    /*General Setting*/
    
    
     //General Setting
    add_settings_section("slider-general-setting-section-id","<hr /><h1 >Slider General Settings Section</h1>","method_general_setting_section_description","slider-setting-page");
   
    
    
    //BG Color Field1
    add_settings_field("slider-bg-color-field1","Backgroud Color: ","method_slider_bg_color_field1","slider-setting-page","slider-general-setting-section-id");
   
    
     //Font Style Field 1
    add_settings_field("slider-font-style-field1","Font Family: ","method_slider_font_style_field1","slider-setting-page","slider-general-setting-section-id");

     //Opacity Duration Display Fields 1
    add_settings_field("slider-opacity-duration-field1","Fade In/Out Opacity & Duration: ","method_slider_opacity_duration_field1","slider-setting-page","slider-general-setting-section-id");
    
     //Slide Up Down Display Fields 1
    add_settings_field("slider-slide-up-down-field1","Slide Up/Down Duration: ","method_slider_slide_up_down_duration_field1","slider-setting-page","slider-general-setting-section-id");

    register_setting("slider_options_setting","slider_bg_color_fieldname1");
    register_setting("slider_options_setting","slider_font_style_fieldname1");
    register_setting("slider_options_setting","slider_opacity_fieldname1");
    register_setting("slider_options_setting","slider_duration_fieldname1");
    register_setting("slider_options_setting","slider_display_opacity_duration_fieldname1");
    register_setting("slider_options_setting","slider_slide_up_down_duration_fieldname1");
    register_setting("slider_options_setting","slider_slide_up_down_duration_display_fieldname1");       
    }
}
?>