<?php


class Archive_Widgets_Class extends WP_Widget
{
    
       public function __construct()
        {
    
            $setting = array(
            "description" => "This Will Show Archive Posts For Custom Post Type");
            parent::__construct('widget_archive',$name = __("Archive(Custom Post Type)","Farmer Connection"),$setting);
        }
    
    
        
        public function form($instance)
        {
            if($instance)
            {
                extract($instance);
            }
                ?>


                     <label for="<?php echo $this->get_field_id('archive_title');?>"><b>Title:</b></label>
                    <input type="text" class="widefat" id="<?php echo $this->get_field_id('archive_title');?>" name="<?php echo $this->get_field_name('archive_title');?>" value="<?php if(isset($archive_title)){echo esc_attr($archive_title);}?>" min="1" max="10"/>
                    <br />
                    <br />
                    
                    <?php
                                               
                    $get_cpt_args = array(
                        'public'   => true,
                        '_builtin' => false
                    );
            
                    $post_types = get_post_types( $get_cpt_args, 'object' ); // use 'names' if you want to get only 
                    ?>    
                    <label for="<?php echo $this->get_field_id('archive_posttype');?>"><b>Post Type:</b></label>
                    <select class="widefat" id="<?php echo $this->get_field_id('archive_posttype');?>" name="<?php echo $this->get_field_name('archive_posttype');?>">
                    <option value="0">Select Post Type</option>
                    <?php
                    if(isset($post_types)){
                    foreach($post_types as $post_type){
                    ?>    
                    <option value="<?php echo $post_type->name;?>" <?php if($archive_posttype == $post_type->name){echo "selected";} ?>>
                    <?php echo $post_type->label;?>    
                    </option> 
                    <?php
                    }
                    }
                    ?>    
                </select>
                <br />
                <br />
                
                    
                <input  type="checkbox"  id="<?php echo $this->get_field_id('archive_display_dropdown');?>" name="<?php echo $this->get_field_name('archive_display_dropdown');?>" value="yes"  <?php if($archive_display_dropdown=='yes'){ echo "checked";}?>/>
                <label for="<?php echo $this->get_field_id('archive_display_dropdown');?>"><b>Display as Dropdown</b></label>
                <br />

                    
                <input  type="checkbox"  id="<?php echo $this->get_field_id('archive_post_count');?>" name="<?php echo $this->get_field_name('archive_post_count');?>" value="yes" <?php if($archive_post_count=='yes'){ echo "checked";}?> />
                <label for="<?php echo $this->get_field_id('archive_post_count');?>"><b>Show post count</b></label>
                <br /><br />
               
<?php
    }
    
  
      
    public function widget($arguments,$instance)
    {
    
        
        extract($arguments);
        extract($instance);
        
        
        
        
       
       if($archive_post_count=="yes" && ! $archive_display_dropdown=="yes"){
            echo "<ul id='archive-widget'>";
            echo "<h3> Archives</h3><hr />";  
            
            $defaults = array(
            'type' => 'monthly', 
            'limit' => '',
            'format' => 'li', 
            'before' => '',
            'after' => '<br />', 
            'show_post_count' => true,
            'echo' => 0, 
            'order' => 'DESC',
            'post_type' => $archive_posttype
            );
            $archives = wp_get_archives($defaults);
            echo $archives;
            echo "</ul><br />";
        }
         else{                
           ?>
                <div id='archive-widget_div' class="bg-dark col-sm-3 text-center rounded">
                <h3 class="text-warning"><b><i><?php echo $archive_title;?></i></b></h3><hr /> 
                <p>    
                <select class="widefat" id="<?php echo $this->get_field_id('archive_posttype');?>" name="<?php echo $this->get_field_name('archive_posttype');?>" onchange="document.location.href=this.options[this.selectedIndex].value;">
                    <option value="0">Select The Month</option>
                   
                    <?php
                     
                    if($archive_post_count=="yes" && $archive_display_dropdown=="yes"){
                        $show_count = true;
                    }else{
                        $show_post=false;
                    }
                       
                    $defaults = array(
                    'type' => 'monthly', 
                    'limit' => '',
                    'format' => 'option', 
                    'before' => '',
                    'after' => '', 
                    'show_post_count' => $show_count,
                    'echo' => 0, 
                    'order' => 'DESC',
                    'post_type' => $archive_posttype
                    );
                    $archives = wp_get_archives($defaults);
                    echo $archives;?>     
                </select>
                </p> 
                </div>
               
          <?php    
        }
        
                
    }
}

?>