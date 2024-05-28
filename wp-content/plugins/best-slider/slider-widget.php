<?php
/*Creating Widget Class*/
class Slider__Widget_Class extends WP_Widget
{
    
    
    public function __construct()
    {
        
        
        $setting = array(
        "description" => "This Will Show Best Slider"
        );
        
        parent::__construct('wp_best_slider',$name = __("Best Slider","Wordepress Multilevel Dropdown Menu"),$setting);
    }
    
    
    public function form($instance)
    {
       
    }
    
    
    public function widget($arguments,$instance){
        extract($arguments);
        extract($instance);
         ?>
    


    <div class="jumbotron" style="background-color:#<?php echo get_option("slider_bg_color_fieldname1");?>">

    <div class="col-sm-12 text-center"  style="position:static;font-family:<?php if(get_option("slider_font_style_fieldname1")!="0"){echo get_option("slider_font_style_fieldname1");} ?>">

            <?php

            $images = array();
            $titles = array();
            $descriptions = array();
            $links = array();


            //Setting main Image In Slider
            if(get_option("slider_display_fieldname1")=="yes")
            {
                ?>  
            <img  class="img-fluid" id ="imgDisplay" src="<?php echo get_option("slider_image_fieldname1"); ?>">
            <h2 id="titles"><?php echo get_option("slider_title_fieldname1"); ?></h2> 
            <p id="description"><?php echo get_option("slider_description_fieldname1"); ?></p>
            <h4  id="links"><a  href="<?php echo get_option("slider_link_url_fieldname1"); ?>"><?php echo get_option("slider_link_url_fieldname1"); ?></a></h4>
            <?php   
            }
            else if(get_option("slider_display_fieldname1")=="yes")
            {
                  ?>  
            <img  class="img-fluid"  id ="imgDisplay" src="<?php echo get_option("slider_image_fieldname2"); ?>">
            <h2 id="titles"><?php echo get_option("slider_title_fieldname2"); ?></h2> 
            <p id="description"><?php echo get_option("slider_description_fieldname2"); ?></p>
           <h4 id="links"><a href="<?php echo get_option("slider_link_url_fieldname2"); ?>"><?php echo get_option("slider_link_url_fieldname2"); ?></a></h4>

            <?php  

            }
            else if(get_option("slider_display_fieldname3")=="yes")
            {
                  ?>  
            <img   class="img-fluid" id ="imgDisplay" src="<?php echo get_option("slider_image_fieldname3"); ?>">
            <h2 id="titles"><?php echo get_option("slider_title_fieldname3"); ?></h2> 
            <p id="description"><?php echo get_option("slider_description_fieldname3"); ?></p>
            <h4 id="links"><a href="<?php echo get_option("slider_link_url_fieldname3"); ?>"><?php echo get_option("slider_link_url_fieldname3"); ?></a></h4>

        <?php  

            }
            else if(get_option("slider_display_fieldname4")=="yes")
            {
            ?>  
            <img  class="img-fluid"  id ="imgDisplay" src="<?php echo get_option("slider_image_fieldname4"); ?>">
            <h2 id="titles"><?php echo get_option("slider_title_fieldname4") ?></h2> 
            <p id="description"><?php echo get_option("slider_description_fieldname4"); ?></p>
            <h4 id="links"><a href="<?php echo get_option("slider_link_url_fieldname4"); ?>"><?php echo get_option("slider_link_url_fieldname4"); ?></a></h4>

            <?php            
            }
             else if(get_option("slider_display_fieldname5")=="yes")
            {
                  ?>  
            <img  class="img-fluid"  id ="imgDisplay" src="<?php echo get_option("slider_image_fieldname5"); ?>">
            <h2 id="titles"><?php echo get_option("slider_title_fieldname5"); ?></h2> 
            <p id="description"><?php echo get_option("slider_description_fieldname5"); ?></p>
            <h4 id="links"><a href="<?php echo get_option("slider_link_url_fieldname5"); ?>"><?php echo get_option("slider_link_url_fieldname5"); ?></a></h4>

            <?php            
            }
            else if(get_option("slider_display_fieldname6")=="yes")
            {
            ?>  
            <img  class="img-fluid"  id ="imgDisplay" src="<?php echo get_option("slider_image_fieldname6"); ?>">
            <h2 id="titles"><?php echo get_option("slider_title_fieldname6"); ?></h2> 
            <p id="description"><?php echo get_option("slider_description_fieldname6"); ?></p>
            <h4 id="links"><a href="<?php echo get_option("slider_link_url_fieldname6"); ?>"><?php echo get_option("slider_link_url_fieldname6"); ?></a></h4>

            <?php            
            }
            else if(get_option("slider_display_fieldname7")=="yes")
            {
                  ?>  
            <img  class="img-fluid"  id ="imgDisplay" src="<?php echo get_option("slider_image_fieldname7"); ?>">
            <h2 id="titles"><?php echo get_option("slider_title_fieldname7"); ?></h2> 
            <p id="description"><?php echo get_option("slider_description_fieldname7"); ?></p>
           <h4 id="links"><a href="<?php echo get_option("slider_link_url_fieldname7"); ?>"><?php echo get_option("slider_link_url_fieldname7"); ?></a></h4>
            <?php            
            }
            else if(get_option("slider_display_fieldname8")=="yes")
            {
            ?>  
            <img  class="img-fluid"  id ="imgDisplay" src="<?php echo get_option("slider_image_fieldname8"); ?>">
            <h2 id="titles"><?php echo get_option("slider_title_fieldname8"); ?></h2> 
            <p id="description"><?php echo get_option("slider_description_fieldname8"); ?></p>
           <h4 id="links"><a href="<?php echo get_option("slider_link_url_fieldname8"); ?>"><?php echo get_option("slider_link_url_fieldname8"); ?></a></h4>

            <?php            
            }
            else if(get_option("slider_display_fieldname9")=="yes")
            {
                  ?>  
            <img   class="img-fluid" id ="imgDisplay" src="<?php echo get_option("slider_image_fieldname9"); ?>">
            <h2 id="titles"><?php echo get_option("slider_title_fieldname9"); ?></h2> 
            <p id="description"><?php echo get_option("slider_description_fieldname9"); ?></p>
            <h4 id="links"><a href="<?php echo get_option("slider_link_url_fieldname9"); ?>"><?php echo get_option("slider_link_url_fieldname9"); ?></a></h4>

            <?php            
            }
            else if(get_option("slider_display_fieldname10")=="yes")
            {
            ?>  
            <img class="img-fluid"   id ="imgDisplay" src="<?php echo get_option("slider_image_fieldname10") ;?>">
            <h2 id="titles"><?php echo get_option("slider_title_fieldname10"); ?></h2> 
            <p id="description"><?php echo get_option("slider_description_fieldname10"); ?>
            </p>
           <h4 id="links"><a href="<?php echo get_option("slider_link_url_fieldname10"); ?>">
               <?php echo get_option("slider_link_url_fieldname10"); ?></a></h4>

        <?php            
            }
        
        
        
        for($i=1; $i<=10; $i++)
        {            
        if(get_option("slider_display_fieldname".$i)=="yes"){
        $images[] = get_option("slider_image_fieldname".$i);
        $titles[] = get_option("slider_title_fieldname".$i);
        $descriptions[] = get_option("slider_description_fieldname".$i);
        $links[] = get_option("slider_link_url_fieldname".$i);    
        }
        }          
        ?>
      
    
    <script type="text/javascript" language="javascript">
    var index=-1;
        
    var array_images = new Array();        
    var array_titles= new Array(); 
    var array_description= new Array();
    var array_links= new Array();
    var slide_up_down_duration;
    var fade_in_out_opacity; 
    var fade_in_out_duration;    
    
    var showFade=false;
    var showSlide=false;    
        
        <?php
        
       
        
    if(get_option("slider_display_opacity_duration_fieldname1")=="yes")
	{
	?>
		  showFade=true;
		  fade_in_out_opacity = "<?php echo get_option('slider_opacity_fieldname1'); ?>";
		  fade_in_out_duration = "<?php echo get_option('slider_duration_fieldname1'); ?>";
	<?php
	}

	if(get_option("slider_slide_up_down_duration_display_fieldname1")=="yes")
	{
	?>
		 showSlide=true;
		 slide_up_down_duration = "<?php echo get_option('slider_slide_up_down_duration_fieldname1'); ?>";
	<?php
	}    
        
      
    foreach($images as $key => $image){
    ?>
    array_images.push('<?php echo $image;?>');    
    <?php    
    }    
    ?>
        
    <?php    
    foreach($titles as $key => $title){
    ?>
    array_titles.push('<?php echo $title;?>');    
    <?php    
    }    
    ?>
        
    <?php    
    foreach($descriptions as $key => $description){
    ?>
    array_description.push('<?php echo $description;?>');    
    <?php    
    }    
    ?>
        
     <?php    
    foreach($links as $key => $link){
    ?>
    array_links.push('<?php echo $link;?>');    
    <?php    
    }    
    ?>
        
        
    var image_length = array_images.length;
    var image_id = document.getElementById("imgDisplay");
    var set_interval_id=null;    
    var stop=false;    
    var count=0;    

        
        
        
        function setAnim()
        {
            if(showSlide===true)
            {           
                count++;

                if(count==3 || count==6 || count==9)
                {
                    $("#imgDisplay").slideToggle(slide_up_down_duration);
                }


                if(count==9)
                {
                    count=0;
                }   



}


            if(showFade==true)
            {               
               $("#imgDisplay").fadeTo(fade_in_out_duration,fade_in_out_opacity);
                $("#imgDisplay").fadeTo(1000,1);
}            
        }         
        
    
        
        function Change_Images() { 
        if(index < image_length-1)
        {
        index++;               
        }
        else{
        index=0;                
        }
        image_id.src =  array_images[index];       
        $("#titles").html(array_titles[index]);
        $("#description").html(array_description[index]);
        $("#links a").html(array_links[index]);
        //$("#imgDisplay").fadeTo(fade_in_out_duration,fade_in_out_opacity);
        //$("#imgDisplay").fadeTo(fade_in_out_duration,1); 
        setAnim();    
        }

   
$(document).ready(function(){
      
//set opacity    

//Stat Slider    
set_interval_id=setInterval("Change_Images()", 1000);    
    
//Description    
$("#description").addClass("bg-dark text-white rounded").css("padding","20px"); 
    
//Image     
$("#imgDisplay").css({width:"100%",height:"500",border:"4px solid black"}).addClass("rounded");
  
//Title  
$("#titles").addClass("bg-warning").css("padding:10px;");    
      
$("#links a").addClass("badge badge-warning");    
    

    
//Buttons    
//$("input:button").css("width","250");      
$("#start").prop("disabled",true);
  
    
/*Start Slider*/    
$("#start").click(function(){
set_interval_id=setInterval("Change_Images()", 1000);
    stop=true;

$(this).prop("disabled",true);
$("#stop").prop("disabled",false);
    
    
    
}) ;  
                
/*Stop Slider*/                
 $("#stop").click(function(){
					
     clearInterval(set_interval_id);
    $("img").fadeIn();     
     stop=false; 

     $(this).prop("disabled",true);
$("#start").prop("disabled",false);
     
     
     showFade=false;
     showSlide=false;
 }) ;                
    
    
    
/*Next Image*/
 $("#next").click(function(){

     if(index < image_length-1){
index++;          
}
     else{
index=0;                
}
image_id.src = array_images[index];
$("#titles").html(array_titles[index]);
$("#description").html(array_description[index]);
$("#links a").html(array_links[index]);
//$("#imgDisplay").fadeTo(fade_in_out_duration,fade_in_out_opacity);
//$("#imgDisplay").fadeTo(fade_in_out_duration,1);
  
    setAnim();
     
clearInterval(set_interval_id);
 }) ;                
    
    
    
    
/*Previous Image*/
 $("#previous").click(function(){
     if(index > 0)
 {
 index--;
 }
 else
 {
 index = image_length-1;
 }
 image_id.src = array_images[index];                    
$("#titles").html(array_titles[index]);
$("#description").html(array_description[index]);
$("#links a").html(array_links[index]);
//$("#imgDisplay").fadeTo(fade_in_out_duration,fade_in_out_opacity);
//$("#imgDisplay").fadeTo(fade_in_out_duration,1);
  setAnim();   
     clearInterval(set_interval_id);
 }) ;     
    
    
    
//Mouse Enter    
$("#imgDisplay").mouseenter(function(){
      $("img").fadeIn(); 
clearInterval(set_interval_id);
 stop=true; 
$("#stop").prop("disabled",true);
$("#start").prop("disabled",false);         
   });
    
    
    
 //Mouse Leave
$("#imgDisplay").mouseleave(function(){
    if(stop===true){
 set_interval_id=setInterval("Change_Images()", 2000);   
    }
setAnim();
    
     $("#stop").prop("disabled",false);
$("#start").prop("disabled",true);    
});    
});    
</script>

<div class="text-center bg-dark rounded" id="div_fix">
<br />
<input type="button" class="btn  btn-primary" name="btn-previous" value="<<< Previous"  id="previous">
<input type="button" name="btn-start" class="btn  btn-success" value="Start"  id="start"> 
<input type="button" name="btn-stop" class="btn  btn-danger" value="Stop"  id="stop"> 
<input type="button" name="btn-next" class="btn  btn-primary" value="Next >>>"  id="next">
<br /><br /> 
</div>   
</div>	
    </div>
<?php
}
}
?>