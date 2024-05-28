<?php

class Custom_Posts_Texanomies_Class
{
    
    
    
    
    
    
    public function custom_post_types()
    {
         
/*        if( current_user_can( 'administrator' ) ){}*/
        
        
        /*Team Custom Post Type*/
    register_post_type("my_team",array(
    "labels"       =>array(
            "name"           =>__("Team Posts","Farmer Connection"),
            "singular_name"  =>__("Team Post","Farmer Connection"),
            "add_new_item"    =>__("Add Team Post","Farmer Connection"),
            "edit_item"      =>__("Edit Team Post","Farmer Connection"),
            "all_items"      =>__("All Team Posts","Farmer Connection"),
            "add_new"        =>__("Add New Team Post","Farmer Connection")),
    "public"       =>true,
    "has_archive"  =>true,
    "menu_icon"    =>"dashicons-groups",
    "supports"    =>array("title","editor","thumbnail"),    
    ));
    
        
        
    /*Customer Testomonails Custom Post Type*/
    register_post_type("testimonail",array(
    "labels"       =>array(
            "name"           =>__("Testimonails","Farmer Connection"),
            "singular_name"  =>__("Testimonail","Farmer Connection"),
            "add_new_item"    =>__("Add Testimonail","Farmer Connection"),
            "edit_item"      =>__("Edit Testimonail","Farmer Connection"),
            "all_items"      =>__("All Testimonails","Farmer Connection"),
            "add_new"        =>__("Add New Testimonail","Farmer Connection")),
    "public"       =>true,
    "has_archive"  =>true,
    "menu_icon"    =>"dashicons-format-status",
    "supports"    =>array("title","editor","thumbnail"),    
    ));
       
        
      /*Agriculture Blog Custom Post Type*/
    register_post_type("agri_blog",array(
    "labels"       =>array(
            "name"           =>__("Agricutures","Farmer Connection"),
            "singular_name"  =>__("Agricuture","Farmer Connection"),
            "add_new_item"   =>__("Add Agricuture","Farmer Connection"),
            "edit_item"      =>__("Edit Agricuture","Farmer Connection"),
            "all_items"      =>__("All Agricutures","Farmer Connection"),
            "add_new"        =>__("Add New Agricuture","Farmer Connection")),
    "public"       =>true,
    "has_archive"  =>true,
    "menu_icon"    =>"dashicons-palmtree",
    "supports"    =>array("title","editor","thumbnail","comments"),    
    ));
        
        
            
        
     /*Discussion Forum  Custom Post Type*/
    register_post_type("forum",array(
    "labels"       =>array(
            "name"           =>__("Discussions","Farmer Connection"),
            "singular_name"  =>__("Discussion","Farmer Connection"),
            "add_new_item"   =>__("Add Discussion","Farmer Connection"),
            "edit_item"      =>__("Edit Discussion","Farmer Connection"),
            "all_items"      =>__("All Discussions","Farmer Connection"),
            "add_new"        =>__("Add New Discussion","Farmer Connection")),
    "public"       =>true,
    "has_archive"  =>true,
    "menu_icon"    =>"dashicons-format-chat",
    "supports"    =>array("title","editor","thumbnail","comments"),
    ));
         
        
        
  
        
        
    
            /*Discussion Forum  Custom Post Type*/
    register_post_type("knowledge",array(
    "labels"       =>array(
            "name"           =>__("Knowledges","Farmer Connection"),
            "singular_name"  =>__("Knowledge Post","Farmer Connection"),
            "add_new_item"   =>__("Add Knowledge Post","Farmer Connection"),
            "edit_item"      =>__("Edit Knowledge Post","Farmer Connection"),
            "all_items"      =>__("All Knowledge Posts","Farmer Connection"),
            "add_new"        =>__("Add New Knowledge Post","Farmer Connection")),
            "public"       =>true,
            "has_archive"  =>true,
            "menu_icon"    =>"dashicons-info",
            "supports"    =>array("title","editor","thumbnail","comments","excerpt","author"),
            "capability_type" => array("knowledge","knowledges"),    
            'map_meta_cap'    => true,
           
    ));
         
        
        
        /*Consultancy Service  Custom Post Type*/
    register_post_type("consultancy",array(
    "labels"       =>array(
            "name"           =>__("Consultancies","Farmer Connection"),
            "singular_name"  =>__("Consultancy Post","Farmer Connection"),
            "add_new_item"   =>__("Add Consultancy Post","Farmer Connection"),
            "edit_item"      =>__("Edit Consultancy Post","Farmer Connection"),
            "all_items"      =>__("All Consultancy Posts","Farmer Connection"),
            "add_new"        =>__("Add New Consultancy Post","Farmer Connection")),
            "public"       =>true,
            "has_archive"  =>true,
            "menu_icon"    =>"dashicons-editor-help",
            "supports"    =>array("title","editor","thumbnail","comments","excerpt","author"),
         
         ));
        
  
        
        
/*        'capabilities' => array(
                'read_post' => 'read_knowledge',
                'edit_post' => 'edit_knowledge',
                'delete_post' => 'delete_knowledge',
                'publish_posts' => 'publish_knowledges',
                'edit_posts' => 'edit_knowledges',
                'delete_posts' => 'delete_knowledges',  
                'edit_others_posts' => 'edit_others_knowledges',
                'delete_others_posts' => 'delete_others_knowledges',
                'read_private_posts' => 'read_private_knowledges'),   
   */
    
    }
    
    public function custom_texanomies()
    {
        
        
        /*Custom Taxonomies*/
    /*Department / Team Custom Taxonomy*/    
    register_taxonomy("department","my_team",array(
    "labels"    =>array(
            "name"=>__("Departments"),
            "singular_name" =>__("Department","Farmer Connection"),
            "add_new_item"  =>__("Add New Department","Farmer Connection"),
            "edit_item"     =>__("Edit Department","Farmer Connection"),
            "all_items"     =>__("All Departments","Farmer Connection"),
            "add_new"       =>__("Add New Department","Farmer Connection")
    
    )    
    ));
        
    /*Agriculture Custom Taxonomy*/    
    register_taxonomy("branch","agri_blog",array(
    "labels"    =>array(
            "name"=>__("Branches"),
            "singular_name" =>__("Branch","Farmer Connection"),
            "add_new_item"  =>__("Add New Branch","Farmer Connection"),
            "edit_item"     =>__("Edit Branch","Farmer Connection"),
            "all_items"     =>__("All Branches","Farmer Connection"),
            "add_new"       =>__("Add New Branch","Farmer Connection")
    
    )    
    ));
        
        
       /*Discussion Forum Custom Taxonomy*/    
    register_taxonomy("forum_cats","forum",array(
    "labels"    =>array(
            "name"=>__("Categories"),
            "singular_name" =>__("Category","Farmer Connection"),
            "add_new_item"  =>__("Add New Category","Farmer Connection"),
            "edit_item"     =>__("Edit Category","Farmer Connection"),
            "all_items"     =>__("All Categories","Farmer Connection"),
            "add_new"       =>__("Add New Category","Farmer Connection")
    
    )    
    ));  
    
        
                /*Knowledge Forum Category Custom Taxonomy*/    
                register_taxonomy("knowledge_cats","knowledge",array(
                "labels"    =>array(
                        "name"=>__("Categories"),
                        "singular_name" =>__("Category","Farmer Connection"),
                        "add_new_item"  =>__("Add New Category","Farmer Connection"),
                        "edit_item"     =>__("Edit Category","Farmer Connection"),
                        "all_items"     =>__("All Categories","Farmer Connection"),
                        "add_new"       =>__("Add New Category","Farmer Connection")),
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud'     => true,
                'hierarchical'      => true,      
                'public' => true,    
                'capabilities' => array (
                    'manage_terms' => 'manage_options', //by default only admin
                    'edit_terms' => 'manage_options',
                    'delete_terms' => 'manage_options',
                    'assign_terms' => 'edit_knowledge'
                    ),
                   
                ));
        
            /*Knowledge Forum Tags Custom Taxonomy*/    
                register_taxonomy("knowledge_tags","knowledge",array(
                "labels"    =>array(
                        "name"=>__("Tags"),
                        "singular_name" =>__("Tag","Farmer Connection"),
                        "add_new_item"  =>__("Add New Tag","Farmer Connection"),
                        "edit_item"     =>__("Edit Tag","Farmer Connection"),
                        "all_items"     =>__("All Tags","Farmer Connection"),
                        "add_new"       =>__("Add New Tag","Farmer Connection")),
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud'     => true,
                'hierarchical'      => true,      
                'public' => true,    
                'capabilities' => array (
                    'manage_terms' => 'manage_options', //by default only admin
                    'edit_terms' => 'manage_options',
                    'delete_terms' => 'manage_options',
                    'assign_terms' => 'edit_knowledge'
                    ),
                   
                ));
        
        
        /*Knowledge Forum Tags Custom Taxonomy*/    
                register_taxonomy("consult_cats","consultancy",array(
                "labels"    =>array(
                        "name"=>__("Categories"),
                        "singular_name" =>__("Categories","Farmer Connection"),
                        "add_new_item"  =>__("Add New Category","Farmer Connection"),
                        "edit_item"     =>__("Edit Category","Farmer Connection"),
                        "all_items"     =>__("All Categories","Farmer Connection"),
                        "add_new"       =>__("Add New Category","Farmer Connection")),
                
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud'     => true,    
                
                /*'hierarchical'      => true,      
                   
                'capabilities' => array (
                    'manage_terms' => 'manage_options', //by default only admin
                    'edit_terms' => 'manage_options',
                    'delete_terms' => 'manage_options',
                    'assign_terms' => 'edit_knowledge'
                    ),*/
                   
                ));
        
        
    
        
     
    }//Function
}//Class
?>