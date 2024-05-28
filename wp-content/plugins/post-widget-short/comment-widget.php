<?php


class Comment_Widgets_Class extends WP_Widget
{
    
       public function __construct()
        {
    
            $setting = array(
            "description" => "This Will Show Recent Comments For Custom Post Type");
            parent::__construct('widget_comment',$name = __("Recent Comments(Custom Post Type)","Farmer Connection"),$setting);
        }
    
    
        
        public function form($instance)
        {
            if($instance)
            {
                extract($instance);
            }

                ?>
                    <label for="<?php echo $this->get_field_id('comment_title');?>"><b>Title:</b></label>
                    <input type="text" class="widefat" id="<?php echo $this->get_field_id('comment_title');?>" name="<?php echo $this->get_field_name('comment_title');?>" value="<?php if(isset($comment_title)){echo esc_attr($comment_title);}?>" />
                    <br />
                    <br />
                    <?php
                    $get_cpt_args = array(
                        'public'   => true,
                        '_builtin' => false
                    );
            
                    $post_types = get_post_types( $get_cpt_args, 'object' ); // use 'names' if you want to get only 
                    ?>    
                    <label for="<?php echo $this->get_field_id('comment_posttype');?>"><b>Post Type:</b></label>
                    <select class="widefat" id="<?php echo $this->get_field_id('comment_posttype');?>" name="<?php echo $this->get_field_name('comment_posttype');?>">
                    <option value="0">Select Post Type</option>
                    <?php
                    if(isset($post_types)){
                    foreach($post_types as $post_type){
                    ?>    
                    <option value="<?php echo $post_type->name;?>" <?php if($comment_posttype == $post_type->name){echo "selected";} ?>>
                    <?php echo $post_type->label;?>    
                    </option> 
                    <?php
                    }
                    }
                    ?>    
                </select>
                <br />
                <br />
                
                <label for="<?php echo $this->get_field_id('comment_no_comments');?>"><b>Number Of Comments To Show</b></label>
                <input  type="text"  id="<?php echo $this->get_field_id('comment_no_comments');?>" name="<?php echo $this->get_field_name('comment_no_comments');?>" value="<?php if(isset($comment_no_comments)){echo esc_attr($comment_no_comments);}?>"/>
                <br />

               
               
<?php
    }
    
  
      
        public function widget($arguments,$instance)
    {
    
        
        extract($arguments);
        extract($instance);
        
        $args = array(
            'parent' => 0,    
            'post_type' => $comment_posttype,
            'number' => $comment_no_comments,
            'orderby' => 'date',
            'order' => 'DESC'
          );
        $comments = get_comments($args);
        ?>
        <div class="bg-secondary col-sm-3 rounded">
            <h3 class="text-warning text-center"><b><i><?php echo $comment_title;?></i></b></h3>
            <hr />
        <ul>    
        <?php
        foreach($comments as $comment)
        {
            //$comment->comment_content;
            //$comment->comment_author
            ?>
            <li  style="list-style-type:none;">
                <small class="badge badge-warning">
                    <a href="author/<?php echo get_comment_author_link($comment->comment_ID);?>">
                        <b><i><?php echo $comment->comment_author;?>: On
                            </i>
                        </b>
                    </a>
                </small>
                <br />
                <span class="badge badge-dark">
                    <a href="<?php echo get_the_permalink($comment->comment_post_ID);?>">
                        <b><i><?php echo get_the_title($comment->comment_post_ID);?>
                            </i>
                        </b>
                    </a>
                </span>
                <hr />
            </li>
            <?php
        }
        ?>
        </ul>    
        </div>
        <?php    
                
    }
}

?>