<?php


class Tag_Widgets_Class extends WP_Widget
{
    
       public function __construct()
        {
    
            $setting = array(
            "description" => "This Will Show Tags For Custom Post Type");
            parent::__construct('widget_tag',$name = __("Tag Cloud(Custom Post Type)","Farmer Connection"),$setting);
        }
    
    
        
        public function form($instance)
        {
            if($instance)
            {
                extract($instance);
            }

                ?>
                    <label for="<?php echo $this->get_field_id('tag_title');?>"><b>Title:</b></label>
                    <input type="text" class="widefat" id="<?php echo $this->get_field_id('tag_title');?>" name="<?php echo $this->get_field_name('tag_title');?>" value="<?php if(isset($tag_title)){echo esc_attr($tag_title);}?>" />
                    <br />
                    <br />
                    <?php
                    $args = array(
                    'public'   => true,
                    '_builtin' => false
                    ); 
                    $output = 'objects'; // or objects
                    $operator = 'and'; // 'and' or 'or'
                    $taxonomies = get_taxonomies( $args, $output, $operator ); 
                    ?>    
                    <label for="<?php echo $this->get_field_id('tag_texanomy');?>"><b>Post Type:</b></label>
                    <select class="widefat" id="<?php echo $this->get_field_id('tag_texanomy');?>" name="<?php echo $this->get_field_name('tag_texanomy');?>">
                    <option value="0">Select Post Type</option>
                    <?php
                    if(isset($taxonomies)){
                    foreach($taxonomies as $taxonomy){
                    ?>    
                    <option value="<?php echo $taxonomy->name;?>" <?php if($tag_texanomy == $taxonomy->name){echo "selected";} ?>>
                    <?php echo $taxonomy->label;?>    
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
   
        $cloud_args = array(
    'smallest'                  => 12,
    'largest'                   => 22,
    'unit'                      => 'px',
    'taxonomy'                  => $tag_texanomy,
  );
         
       ?>
        <div class="bg-dark col-sm-3 rounded" id="tag_cloud" >
            <h3 class="text-warning text-center"><b><i><?php echo $tag_title; ?></i></b></h3>
          <hr />
           
       <?php
         wp_tag_cloud($cloud_args);  
            ?>
             
        </div>
        <?php    
                
    }
}

?>