<?php


class Search_Widgets_Class extends WP_Widget
{
    
       public function __construct()
        {
    
            $setting = array(
            "description" => "This Will Show Search Results For Custom Post Type");
            parent::__construct('widget_search',$name = __("Search(Custom Post Type)","Farmer Connection"),$setting);
        }
    
    
        
        public function form($instance)
        {
            if($instance)
            {
                extract($instance);
            }

                ?>
                    <label for="<?php echo $this->get_field_id('search_title');?>"><b>Title:</b></label>
                    <input type="text" class="widefat" id="<?php echo $this->get_field_id('search_title');?>" name="<?php echo $this->get_field_name('search_title');?>" value="<?php if(isset($search_title)){echo esc_attr($search_title);}?>" />
                    <br />
                    <br />
                    
                    <?php
                    $get_cpt_args = array(
                        'public'   => true,
                        '_builtin' => false
                    );
            
                    $post_types = get_post_types( $get_cpt_args, 'object' ); // use 'names' if you want to get only 
                    ?>    
                    <label for="<?php echo $this->get_field_id('search_posttype');?>"><b>Post Type:</b></label>
                    <select class="widefat" id="<?php echo $this->get_field_id('search_posttype');?>" name="<?php echo $this->get_field_name('search_posttype');?>">
                    <option value="0">Select Post Type</option>
                    <?php
                    if(isset($post_types)){
                    foreach($post_types as $post_type){
                    ?>    
                    <option value="<?php echo $post_type->name;?>" <?php if($search_posttype == $post_type->name){echo "selected";} ?>>
                    <?php echo $post_type->label;?>    
                    </option> 
                    <?php
                    }
                    }
                    ?>    
                </select>
                <br />
                <br />    

        <?php
    }
    
  
      
    public function widget($arguments,$instance)
    {
      
        extract($arguments);
        extract($instance); 
       ?>
        <div class="bg-secondary col-sm-3 rounded">
            <h3 class="text-warning text-center"><b><i><?php echo $search_title;?></i></b></h3>
            <hr />
            <form role="search" class="search-form" action="<?php echo home_url("/");?>" >
                <span class="badge badge-light"><b><i>Search For:</i></b></span>
                <p class="text-center">
                    <br />
                    <label>
                    <input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x("Enter the word to search","placeholder")?>" value="<?php echo get_search_query()?>" name="s" title="<?php esc_attr_x("Enter the word to search","label")?>" />  
                    <input type="hidden" name="post_type" id="post_type" value="<?php echo $search_posttype;?>" />
                    </label>      
                    <input type="submit" class="search-submit btn-submit btn btn-sm btn-success" value="<?php echo esc_attr_x("Search","submit button")?>" />     
                </p> 
            </form>
           
        </div>
        <?php                    
    }


}

?>