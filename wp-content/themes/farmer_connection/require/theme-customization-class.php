<?php

class theme_customization_class
{
    
    
    
    
    
    public function set_section_site_colors($wp_customize)
    {
        
       
          /*Section Colors */
        
        /* Main Section*/
        $wp_customize->add_section("site_colors_section",array(
        "title"    => __("Website Colors","Farmer Connection"),
        "priority" => 20,
        ));
        
        /*Header Text Color Setting*/
        $wp_customize->add_setting("site_header_text_color_setting",array(
        "default"   =>"#000",
        "transport" =>"refresh",   
        ));
        /*Body Text Color Control*/
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,"site_header_text_color_control",array(
        "label"=>__("Header Text Color:","Farmer Connection"),
        "section"=>"site_colors_section",
        "settings"=>"site_header_text_color_setting",    
        )));
     
        
         /*Body Background Color Setting*/
        $wp_customize->add_setting("site_body_bg_color_setting",array(
        "default"   =>"#a8a8a8",
        "transport" =>"refresh",   
        ));
        /*Body Background Color Control*/
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,"site_body_bg_color_control",array(
        "label"=>__("Site Background Color:","Farmer Connection"),
        "section"=>"site_colors_section",
        "settings"=>"site_body_bg_color_setting",    
        )));
        
        
        
        /*Link-Color Setting*/
        $wp_customize->add_setting("site_link_color_setting",array(
        "default"    => "#26ebf2",
        "transport"  => "refresh",    
        ));
        
        /*link-Color Control*/
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,"link_color_control",array(
        "label"     => __("Site Links Color:","Farmer Connection"),
        "section"   => "site_colors_section",
        "settings"   => "site_link_color_setting",
        
        )));
        
        
        /*Header Background Color Setting*/
        $wp_customize->add_setting("site_header_background_color_setting",array(
        "default"   =>"#fff",
        "transport" =>"refresh",   
        ));
        /*Active-Link-Color Control*/
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,"site_header_background_color_control",array(
        "label"=>__("Header Background Color:","Farmer Connection"),
        "section"=>"site_colors_section",
        "settings"=>"site_header_background_color_setting",    
        )));

        
         /*Button Background Color Setting*/
        $wp_customize->add_setting("site_search_button_bg_color_setting",array(
        "default"   =>"#fff",
        "transport" =>"refresh",   
        ));
        /*Button Background Color Control*/
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,"site_search_button_control1",array(
        "label"=>__("Button Background Color:","Farmer Connection"),
        "section"=>"site_colors_section",
        "settings"=>"site_search_button_bg_color_setting",    
        )));
        
        
         /*Button Font Color Setting*/
        $wp_customize->add_setting("site_search_button_font_color_setting",array(
        "default"   =>"#fff",
        "transport" =>"refresh",   
        ));
        /*Button Font Color Control*/
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,"site_search_button_control2",array(
        "label"=>__("Button Text Color:","Farmer Connection"),
        "section"=>"site_colors_section",
        "settings"=>"site_search_button_font_color_setting",    
        )));
        
       /*Section Colors */
      
        
    }
    
    
    public function set_section_who_we_are($wp_customize,$my_posts_list)
    {
        
         /* Main Section Who we are*/
        $wp_customize->add_section("who_we_section",array(
        "title"    => __("Lovely Team","Farmer Connection"),
        "priority" => 20,
        ));
        
        /*Checkbox*/
        /*Who We Checkbox Setting*/
        $wp_customize->add_setting("who_we_div_setting",array(
        "default"   =>"yes",
        "transport" =>"refresh",   
        ));
        
        /*Who We Checkbox Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"enable_team_control",array(
        "label"    =>__("Enable Team:","Farmer Connection"),
        "section"  =>"who_we_section",
        "settings" =>"who_we_div_setting",
        "type"     =>"checkbox",
        )));
        
        
        /*Dropdown*/
        /*Who We team title & Desc Setting*/
        $wp_customize->add_setting("who_we_team_title_desc_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Who We team title & Desc Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"who_we_team_title_desc_control",array(
        "label"=>__("Select Page For Lovely Team Title & Description:","Farmer Connection"),
        "section"=>"who_we_section",
        "settings"=>"who_we_team_title_desc_setting",
        "type"=>"dropdown-pages"
        )));
        
        
        /*Dropdown*/
        /*Who We Post 1 Setting*/
        $wp_customize->add_setting("who_we_post1_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Who We Post 1 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"who_we_post1_control",array(
        "label"=>__("Select Lovely Team Post 1 with Featured Image:","Farmer Connection"),
        "section"=>"who_we_section",
        "settings"=>"who_we_post1_setting",
        "type"=>"select",
        "choices" =>$my_posts_list,
          
        )));
        
        
       
        /*Who We Post 1 Desgination Setting*/
        $wp_customize->add_setting("who_we_post1_desig_setting",array(
        "default"   =>"Enter The Designation",
        "transport" =>"refresh",   
        ));
        /*Who We Post 1 Desgination Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"who_we_post1_desig_control",array(
        "label"=>__("Select Designation:","Farmer Connection"),
        "section"=>"who_we_section",
        "settings"=>"who_we_post1_desig_setting",
        "description" =>"Designation Like Creative Director, Web Developer, Server Administrator, UI/UX Design"    
        )));
        
        
        /*Dropdown*/
        /*Who We Post 2 Setting*/
        $wp_customize->add_setting("who_we_post2_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Who We Post 2 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"who_we_post2_control",array(
        "label"=>__("Select Lovely Team Post 2 with Featured Image:","Farmer Connection"),
        "section"=>"who_we_section",
        "settings"=>"who_we_post2_setting",
        "type"=>"select",
        "choices" => $my_posts_list
         
        )));
        
        
        /*Dropdown*/
        /*Who We Post 2 Desgination Setting*/
        $wp_customize->add_setting("who_we_post2_desig_setting",array(
        "default"   =>"Enter The Designation",
        "transport" =>"refresh",   
        ));
        /*Who We Post 2 Desgination Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"who_we_post2_desig_control",array(
        "label"=>__("Select Designation:","Farmer Connection"),
        "section"=>"who_we_section",
        "settings"=>"who_we_post2_desig_setting",
        "description" =>"Designation Like Creative Director, Web Developer, Server Administrator, UI/UX Design"    
        )));
        
        
        
        /*Dropdown*/
        /*Who We Post 3 Setting*/
        $wp_customize->add_setting("who_we_post3_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Who We Post 3 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"who_we_post3_control",array(
        "label"=>__("Select Lovely Team Post 3 with Featured Image:","Farmer Connection"),
        "section"=>"who_we_section",
        "settings"=>"who_we_post3_setting",
        "type"=>"select",
        "choices" => $my_posts_list
         
        )));
        
        
        /*Dropdown*/
        /*Who We Post 3 Desgination Setting*/
        $wp_customize->add_setting("who_we_post3_desig_setting",array(
        "default"   =>"Enter The Designation",
        "transport" =>"refresh",   
        ));
        /*Who We Post 3 Desgination Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"who_we_post3_desig_control",array(
        "label"=>__("Select Designation:","Farmer Connection"),
        "section"=>"who_we_section",
        "settings"=>"who_we_post3_desig_setting",
        "description" =>"Designation Like Creative Director, Web Developer, Server Administrator, UI/UX Design"    
        )));
        
        
         /*Dropdown*/
        /*Who We Post 4 Setting*/
        $wp_customize->add_setting("who_we_post4_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Who We Post 4 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"who_we_post4_control",array(
        "label"=>__("Select Lovely Team Post 4 with Featured Image:","Farmer Connection"),
        "section"=>"who_we_section",
        "settings"=>"who_we_post4_setting",
        "type"=>"select",
        "choices" => $my_posts_list
           
        )));
        
        
        /*Dropdown*/
        /*Who We Post 4 Desgination Setting*/
        $wp_customize->add_setting("who_we_post4_desig_setting",array(
        "default"   =>"Enter The Designation",
        "transport" =>"refresh",   
        ));
        /*Who We Post 4 Desgination Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"who_we_post4_desig_control",array(
        "label"=>__("Select Designation:","Farmer Connection"),
        "section"=>"who_we_section",
        "settings"=>"who_we_post4_desig_setting",
        "description" =>"Designation Like Creative Director, Web Developer, Server Administrator, UI/UX Design"    
        )));
       
        
        
    }
    
    
    public function set_section_future_history_policy($wp_customize)
    {
      
          $wp_customize->add_section("about_section",array(
        "title"    => __("About Section","Farmer Connection"),
        "priority" => 30,
        ));
        
        
        /*Dropdown*/
        /*About Our Future Setting*/
        $wp_customize->add_setting("about_future_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*About Our Future Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"about_future_control",array(
        "label"=>__("Select Pages From the dropdown for front page about section","Farmer Connection"),
        "section"=>"about_section",
        "settings"=>"about_future_setting",
        "type"=>"dropdown-pages"
        )));
        
        
        /*Dropdown*/
        /*About Our History*/
        $wp_customize->add_setting("about_history_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*About Our History Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"about_history_control",array(
        "section"=>"about_section",
        "settings"=>"about_history_setting",
        "type"=>"dropdown-pages"
        )));
        
        /*Dropdown*/
        /*About Our Policy Setting*/
        $wp_customize->add_setting("about_policy_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*About Our Policy Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"about_policy_control",array(
        "section"=>"about_section",
        "settings"=>"about_policy_setting",
        "type"=>"dropdown-pages"
        )));
      
        
        
        /*Checkbox Display About Section*/
        /*About Show Section Checkbox Setting*/
        $wp_customize->add_setting("about_show_section_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        
        /*About Show Section Checkbox Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"about_show_section_control",array(
        "label"    =>__("Uncheck To Show This About Section","Farmer Connection"),
        "section"  =>"about_section",
        "settings" =>"about_show_section_setting",
        "type"     =>"checkbox",
        )));
        
    } 
    
    
    public function set_section_feedback($wp_customize,$my_posts_list)
    {
        
        
       /* Main Section Feedback*/
        $wp_customize->add_section("feedback_section",array(
        "title"    => __("Customer Testimonails Section","Farmer Connection"),
        "priority" => 40,
        ));
        
        
        /*Checkbox Display Feedback Section*/
        /*Feedback Show Section Checkbox Setting*/
        $wp_customize->add_setting("feedback_show_section_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        )); 
        /*Feedback Show Section Checkbox Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_show_section_control",array(
        "label"    =>__("Enable Testimonails","Farmer Connection"),
        "section"  =>"feedback_section",
        "settings" =>"feedback_show_section_setting",
        "type"     =>"checkbox",
        )));
    
         /*Feedback Testimonail Title Setting*/
        $wp_customize->add_setting("feedback_testimonail_type_setting",array(
        "default"   =>"Enter Type Testimonail Title",
        "transport" =>"refresh",   
        ));
        /*Feedback Testimonail Title  Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_testimonail_type_control",array(
        "label"=>__("Type Testimonail Title:","Farmer Connection"),
        "section"=>"feedback_section",
        "settings"=>"feedback_testimonail_type_setting",
        )));
        
        
         /*Dropdown*/
        /*Feedback Post 1 Setting*/
        $wp_customize->add_setting("feedback_post_1_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Feedback Post 1 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_post_1_control",array(
        "label" =>__("Select Testimonail Post 1","farmer Connection"),    
        "section"=>"feedback_section",
        "settings"=>"feedback_post_1_setting",
        "type"=>"select",
        "choices" => $my_posts_list    
        )));
    
         /*Feedback company Name 1 Setting*/
        $wp_customize->add_setting("feedback_companyname_1_setting",array(
        "default"   =>"Enter Company Name 1",
        "transport" =>"refresh",   
        ));
        /*Feedback company Name 1 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_companyname_1_control",array(
        "label"=>__("Enter Designation or Company Name 1","Farmer Connection"),
        "section"=>"feedback_section",
        "settings"=>"feedback_companyname_1_setting",
        )));
        
        
         /*Dropdown*/
        /*Feedback Post 2 Setting*/
        $wp_customize->add_setting("feedback_post_2_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Feedback Post 2 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_post_2_control",array(
        "label" =>__("Select Testimonail Post 2","farmer Connection"),     
        "section"=>"feedback_section",
        "settings"=>"feedback_post_2_setting",
        "type"=>"select",
        "choices" => $my_posts_list    
        )));
    
         /*Feedback company Name 2 Setting*/
        $wp_customize->add_setting("feedback_companyname_2_setting",array(
        "default"   =>"Enter Company Name 2",
        "transport" =>"refresh",   
        ));
        /*Feedback company Name 2 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_companyname_2_control",array(
        "label"=>__("Enter Designation or Company Name 2","Farmer Connection"),
        "section"=>"feedback_section",
        "settings"=>"feedback_companyname_2_setting",
        )));
        
        
         /*Dropdown*/
        /*Feedback Post 3 Setting*/
        $wp_customize->add_setting("feedback_post_3_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Feedback Post 3 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_post_3_control",array(
        "label" =>__("Select Testimonail Post 3","farmer Connection"),     
        "section"=>"feedback_section",
        "settings"=>"feedback_post_3_setting",
        "type"=>"select",
        "choices" => $my_posts_list    
        )));
    
         /*Feedback company Name 3 Setting*/
        $wp_customize->add_setting("feedback_companyname_3_setting",array(
        "default"   =>"Enter Company Name 3",
        "transport" =>"refresh",   
        ));
        /*Feedback company Name 3 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_companyname_3_control",array(
        "label"=>__("Enter Designation or Company Name 3","Farmer Connection"),
        "section"=>"feedback_section",
        "settings"=>"feedback_companyname_3_setting",
        )));
        
        
        /*Dropdown*/
        /*Feedback Post 4 Setting*/
        $wp_customize->add_setting("feedback_post_4_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Feedback Post 4 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_post_4_control",array(
        "label" =>__("Select Testimonail Post 4","farmer Connection"),     
        "section"=>"feedback_section",
        "settings"=>"feedback_post_4_setting",
        "type"=>"select",
        "choices" => $my_posts_list    
        )));
    
         /*Feedback company Name 4 Setting*/
        $wp_customize->add_setting("feedback_companyname_4_setting",array(
        "default"   =>"Enter Company Name 4",
        "transport" =>"refresh",   
        ));
        /*Feedback company Name 4 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_companyname_4_control",array(
        "label"=>__("Enter Designation or Company Name 4","Farmer Connection"),
        "section"=>"feedback_section",
        "settings"=>"feedback_companyname_4_setting",
        )));
        
        
        /*Dropdown*/
        /*Feedback Post 5 Setting*/
        $wp_customize->add_setting("feedback_post_5_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Feedback Post 5 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_post_5_control",array(
        "label" =>__("Select Testimonail Post 5","farmer Connection"),     
        "section"=>"feedback_section",
        "settings"=>"feedback_post_5_setting",
        "type"=>"select",
        "choices" => $my_posts_list    
        )));
    
         /*Feedback company Name 5 Setting*/
        $wp_customize->add_setting("feedback_companyname_5_setting",array(
        "default"   =>"Enter Company Name 5",
        "transport" =>"refresh",   
        ));
        /*Feedback company Name 5 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_companyname_5_control",array(
        "label"=>__("Enter Designation or Company Name 5","Farmer Connection"),
        "section"=>"feedback_section",
        "settings"=>"feedback_companyname_5_setting",
        )));
        
        
        
        
        /*Dropdown*/
        /*Feedback Post 6 Setting*/
        $wp_customize->add_setting("feedback_post_6_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Feedback Post 6 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_post_6_control",array(
        "label" =>__("Select Testimonail Post 6","farmer Connection"),     
        "section"=>"feedback_section",
        "settings"=>"feedback_post_6_setting",
        "type"=>"select",
        "choices" => $my_posts_list    
        )));
    
         /*Feedback company Name 6 Setting*/
        $wp_customize->add_setting("feedback_companyname_6_setting",array(
        "default"   =>"Enter Company Name 6",
        "transport" =>"refresh",   
        ));
        /*Feedback company Name 6 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_companyname_6_control",array(
        "label"=>__("Enter Designation or Company Name 6","Farmer Connection"),
        "section"=>"feedback_section",
        "settings"=>"feedback_companyname_6_setting",
        )));
        
        
        /*Dropdown*/
        /*Feedback Post 7 Setting*/
        $wp_customize->add_setting("feedback_post_7_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Feedback Post 7 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_post_7_control",array(
        "label" =>__("Select Testimonail Post 7","farmer Connection"),     
        "section"=>"feedback_section",
        "settings"=>"feedback_post_7_setting",
        "type"=>"select",
        "choices" => $my_posts_list    
        )));
    
         /*Feedback company Name 7 Setting*/
        $wp_customize->add_setting("feedback_companyname_7_setting",array(
        "default"   =>"Enter Company Name 7",
        "transport" =>"refresh",   
        ));
        /*Feedback company Name 7 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_companyname_7_control",array(
        "label"=>__("Enter Designation or Company Name 7","Farmer Connection"),
        "section"=>"feedback_section",
        "settings"=>"feedback_companyname_7_setting",
        )));
        
        
        /*Dropdown*/
        /*Feedback Post 8 Setting*/
        $wp_customize->add_setting("feedback_post_8_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Feedback Post 8 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_post_8_control",array(
        "label" =>__("Select Testimonail Post 8","farmer Connection"),     
        "section"=>"feedback_section",
        "settings"=>"feedback_post_8_setting",
        "type"=>"select",
        "choices" => $my_posts_list    
        )));
    
         /*Feedback company Name 8 Setting*/
        $wp_customize->add_setting("feedback_companyname_8_setting",array(
        "default"   =>"Enter Company Name 8",
        "transport" =>"refresh",   
        ));
        /*Feedback company Name 8 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_companyname_8_control",array(
        "label"=>__("Enter Designation or Company Name 8","Farmer Connection"),
        "section"=>"feedback_section",
        "settings"=>"feedback_companyname_8_setting",
        )));
        

        /*Dropdown*/
        /*Feedback Post 9 Setting*/
        $wp_customize->add_setting("feedback_post_9_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Feedback Post 9 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_post_9_control",array(
        "label" =>__("Select Testimonail Post 9","farmer Connection"),     
        "section"=>"feedback_section",
        "settings"=>"feedback_post_9_setting",
        "type"=>"select",
        "choices" => $my_posts_list    
        )));
    
         /*Feedback company Name 9 Setting*/
        $wp_customize->add_setting("feedback_companyname_9_setting",array(
        "default"   =>"Enter Company Name 9",
        "transport" =>"refresh",   
        ));
        /*Feedback company Name 9 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_companyname_9_control",array(
        "label"=>__("Enter Designation or Company Name 9","Farmer Connection"),
        "section"=>"feedback_section",
        "settings"=>"feedback_companyname_9_setting",
        )));
        
        
        /*Dropdown*/
        /*Feedback Post 10 Setting*/
        $wp_customize->add_setting("feedback_post_10_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Feedback Post 10 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_post_10_control",array(
        "label" =>__("Select Testimonail Post 10","farmer Connection"),     
        "section"=>"feedback_section",
        "settings"=>"feedback_post_10_setting",
        "type"=>"select",
        "choices" => $my_posts_list    
        )));
    
         /*Feedback company Name 10 Setting*/
        $wp_customize->add_setting("feedback_companyname_10_setting",array(
        "default"   =>"Enter Company Name 10",
        "transport" =>"refresh",   
        ));
        /*Feedback company Name 10 Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"feedback_companyname_10_control",array(
        "label"=>__("Enter Designation or Company Name 10","Farmer Connection"),
        "section"=>"feedback_section",
        "settings"=>"feedback_companyname_10_setting",
        )));
        
          
        
        
        
    }
    
    
    public function set_section_footer_area($wp_customize)
    {
       $wp_customize->add_section("footer_section",array(
        "title"    => __("Footer Area Section","Farmer Connection"),
        "priority" => 50,
        ));
        
        
        /*Footer Latest News Title Setting*/
        $wp_customize->add_setting("news_title_setting",array(
        "default"   =>"Enter Latest News Title",
        "transport" =>"refresh",   
        ));
        /*Footer Latest News Title Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"news_title_control",array(
        "label"=>__("Add Title For Latest News Feed","Farmer Connection"),
        "section"=>"footer_section",
        "settings"=>"news_title_setting",
        )));
        
        
        /*Footer About Us Title Setting*/
        $wp_customize->add_setting("aboutus_title_setting",array(
        "default"   =>"Enter About Us Title",
        "transport" =>"refresh",   
        ));
        /*Footer About Us Title Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"aboutus_control",array(
        "label"=>__("Add Title For About Us","Farmer Connection"),
        "section"=>"footer_section",
        "settings"=>"aboutus_title_setting",
        )));
        
        
        /*Footer About Us Desc Setting*/
        $wp_customize->add_setting("aboutus_desc_setting",array(
        "default"   =>"Enter About Us Description",
        "transport" =>"refresh",   
        ));
        /*Footer About Us Desc Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"aboutus_desc_control",array(
        "label"=>__("About Description","Farmer Connection"),
        "section"=>"footer_section",
        "settings"=>"aboutus_desc_setting",
        "type"    =>"textarea"    
        )));
        
        
        /*Footer Contact Title Setting*/
        $wp_customize->add_setting("contact_title_setting",array(
        "default"   =>"Enter Contact Info",
        "transport" =>"refresh",   
        ));
        /*Footer Contact Title Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"contact_title_control",array(
        "label"=>__("Add Title For Footer Contact Info","Farmer Connection"),
        "section"=>"footer_section",
        "settings"=>"contact_title_setting",
        )));
        
        
        /*Footer Contact No Setting*/
        $wp_customize->add_setting("contact_no_setting",array(
        "default"   =>"",
        "transport" =>"refresh",   
        ));
        /*Footer Contact No Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"contact_no_control",array(
        "label"=>__("Add Contact Number Here","Farmer Connection"),
        "section"=>"footer_section",
        "settings"=>"contact_no_setting",
        "type"    =>"number"    
        )));
        
        
        /*Footer Contact Email Setting*/
        $wp_customize->add_setting("contact_email_setting",array(
        "default"   =>"Enter Your Email",
        "transport" =>"refresh",   
        ));
        /*Footer Contact Email Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"contact_email_control",array(
        "label"=>__("Add Contact Email Here","Farmer Connection"),
        "section"=>"footer_section",
        "settings"=>"contact_email_setting",
        "type"    =>"email"    
        )));
        
        
        /*Footer Contact Address Setting*/
        $wp_customize->add_setting("contact_address_setting",array(
        "default"   =>"Enter Your Address",
        "transport" =>"refresh",   
        ));
        /*Footer Contact Address Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"contact_address_control",array(
        "label"=>__("Add Contact Address Here","Farmer Connection"),
        "section"=>"footer_section",
        "settings"=>"contact_address_setting",
        "type"    =>"textarea"    
        )));
        
        
        /*Checkbox*/
        /*Footer Show Section Setting*/
        $wp_customize->add_setting("footer_show_section_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Footer Show Section Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"footer_show_section_control",array(
        "label"=>__("Check To Show Footer","Farmer Connection"),
        "section"=>"footer_section",
        "settings"=>"footer_show_section_setting",
        "type"    =>"checkbox"    
        )));
          
        
        
    }
    
    
    public function set_section_agriculture_blog($wp_customize,$categories)
    {
        
        
       /* Main Section Agriculture Blog*/
        $wp_customize->add_section("agriculture_section",array(
        "title"    => __("Agriculture Blog Section","Farmer Connection"),
        "priority" => 50,
        ));
        
        
        
        /*Checkbox*/
        /*Agriculture Show Blog Setting*/
        $wp_customize->add_setting("agro_show_blog_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        
        /*Agriculture Show Blog Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"agro_show_blog_control",array(
        "label"    =>__("Enable Blog:","Farmer Connection"),
        "section"  =>"agriculture_section",
        "settings" =>"agro_show_blog_setting",
        "type"     =>"checkbox",
        )));
        
        
        /*Dropdown*/
        /*Agriculture Blog Page Setting*/
        $wp_customize->add_setting("agro_blog_page_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Agriculture Blog Page Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"agro_blog_page_control",array(
        "label" =>__("Select Page For Blog Heading & Description","farmer Connection"),     
        "section"=>"agriculture_section",
        "settings"=>"agro_blog_page_setting",
        "type"=>"dropdown-pages",         
        )));
        
        
        /*Dropdown*/
        /*Agriculture Categories Setting*/
        $wp_customize->add_setting("branches_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Agriculture Categories Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"branches_control",array(
        "label" =>__("Select Category|Brach for Blog","farmer Connection"),     
        "section"=>"agriculture_section",
        "settings"=>"branches_setting",
        "type"=>"select",
        "choices" =>$categories    
        )));
        
        
         
        /*Agriculture Categories|Texanomy No Posts Setting*/
        $wp_customize->add_setting("branches_no_post_setting",array(
        "default"   =>0,
        "transport" =>"refresh",   
        ));
        /*Agriculture Categories|Texanomy No Posts Control*/
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,"branches_no_post_control",array(
        "label" =>__("Number Of Posts To Show","farmer Connection"),     
        "section"=>"agriculture_section",
        "settings"=>"branches_no_post_setting",
        "type"=>"number",
        "description" =>"input: 3, 4, 5, 6, 7, 8, 9",
        )));
        //"input_attrs" => array( 'min' => 1, 'max' => 9, 'step'  => 2),
          
        
        
    }
    
    
}



?>