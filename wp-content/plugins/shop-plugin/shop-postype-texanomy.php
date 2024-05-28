<?php      
function shop_posttype_texonomy(){
        /*Products Service  Custom Post Type*/
        register_post_type("product",array(
            "labels"       =>array(
            "name"           =>__("Products","Farmer Connection"),
            "singular_name"  =>__("Product","Farmer Connection"),
            "add_new_item"   =>__("Add Product","Farmer Connection"),
            "edit_item"      =>__("Edit Product","Farmer Connection"),
            "all_items"      =>__("All Products","Farmer Connection"),
            "add_new"        =>__("Add New Product","Farmer Connection")),
            "public"       =>true,
            "has_archive"  =>true,
            "menu_icon"    =>"dashicons-info",
            "supports"    =>array("title","editor","thumbnail","comments","excerpt","author"),
            "capability_type" => array("product","products"),    
            'map_meta_cap'    => true,
    ));
        
        register_taxonomy("product_cats","product",array(
    "labels"    =>array(
            "name"=>__("Categories"),
            "singular_name" =>__("Category","Farmer Connection"),
            "add_new_item"  =>__("Add New Category","Farmer Connection"),
            "edit_item"     =>__("Edit Category","Farmer Connection"),
            "all_items"     =>__("All Categories","Farmer Connection")),
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
        'assign_terms' => 'edit_product'
        ),
    ));  
    
    //Setting Consultant Caps for product-base
    $farmer_role = get_role('farmer');
    $farmer_role->add_cap('edit_product'); 
    $farmer_role->add_cap('edit_products'); 
    $farmer_role->add_cap('publish_products'); 
    $farmer_role->add_cap('read_product'); 
    $farmer_role->add_cap('delete_product');
    $farmer_role->add_cap('edit_published_products');
    $farmer_role->add_cap('delete_published_products');
    $farmer_role->add_cap("upload_files");
  
    //Setting Admin Caps for product-base
    $admin_role = get_role("administrator");
    $admin_role->add_cap('edit_product'); 
    $admin_role->add_cap('edit_products'); 
    $admin_role->add_cap('edit_others_products');
    $admin_role->add_cap('delete_others_products'); 
    $admin_role->add_cap('publish_products'); 
    $admin_role->add_cap('read_product'); 
    $admin_role->add_cap('read_private_products'); 
    $admin_role->add_cap('delete_product');
    $admin_role->add_cap('delete_products');
    $admin_role->add_cap('edit_published_products');
    $admin_role->add_cap('delete_published_products'); 
}
?>