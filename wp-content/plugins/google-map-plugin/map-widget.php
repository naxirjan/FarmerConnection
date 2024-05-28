<?php
class Map_Widget_Class extends WP_Widget
{
     
    public function __construct()
    {?>
        <?php
        $setting = array(
        "description" => "This Will Install Google Map"
        );
        
        parent::__construct('google_map',$name = __("Google Map","Farmer Connection"),$setting);
        
    }
    
    
     public function form($instance){}
    
    
    public function widget($arguments,$instance)
    {
        extract($arguments);
        extract($instance);
        ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDf6UJtqIUabhRfEVpl5kbV8npQTMGKGdI&callback=loadMap&libraries=places"async defer></script>
        <?php 
                if(get_option("map_height_px")=='px' && get_option("map_height_full")!='full')
                {
                    ?>
                            <style type="text/css">
                            #map
                            {
                                height: <?php echo get_option("map_height").get_option("map_height_px");?>
                            }
                        </style>
                    <?php
                    
                }
                else if(get_option("map_height_full")=='full')
                {  ?>
                       
            <script type="text/javascript">
                $(document).ready(function(){
                $("#map").css("height",window.screen.height);
                });
                
            </script>
                    <?php
                }
            ?>    
        <style type="text/css">
		#map
		{
			width: <?php echo get_option("map_width").get_option("map_width_px_per");?>;
            
		}
    </style>
	
        <div class="row alert">
            <hr />
            <div class="col-sm-12 bg-secondary rounded">
                <h1 class="text-center bg-secondary text-warning"><b><i><u><?php echo get_option("map_name");?></u></i></b></h1>
                <div id="map"></div><br />
            </div>
            
            	<script type="text/javascript" language="javascript">
                    var map;
                    function loadMap()
                    {
                            
                        var map_settings = {
                            center: {lat:<?php echo get_option('center_lat');?>,lng:<?php echo get_option('center_lng');?>},
                            zoomControlOptions: {
                            position: google.maps.ControlPosition.<?php echo get_option('map_zoom');?>
                            },
                            zoom: 18,
                            mapTypeId: '<?php echo get_option('map_theme');?>'
                            };

                            map = new google.maps.Map(document.getElementById("map"), map_settings);
                            
                        
                        
                        
                            //Marker
                            
                            var icon = 
                            {
                                url: '<?php  echo get_option("map_marker_icon")?>',
                                scaledSize: new google.maps.Size(40, 40)
                            }
                                
                                
                                
                            var marker = new google.maps.Marker(
                            {
                               position: {lat:<?php echo get_option('map_marker_address_lat');?>,lng:<?php echo get_option('map_marker_address_lng');?>},
                                map: map,
                                icon:icon
                            });     

                            //Marker Info Window
                            var infoWindow = new google.maps.InfoWindow(
                            {
                                content:"<b><span style='color:red;'>Marker Name: </span><span> <?php echo get_option('map_marker_name');?></span><br /><span style='color:red;'>Marker Address: </span><span> <?php echo get_option('map_marker_address');?></span><br /><span style='color:red;'>Latitude: </span><span> <?php echo get_option('map_marker_address_lat');?></span><br /><span style='color:red;'>Longtitude: </span><span> <?php echo get_option('map_marker_address_lng');?></span><br /><span style='color:red;'>Marker Description: </span><span> <?php echo get_option('map_marker_desc');?></span></b>"
                            });
                            
                            //Marker Listener
                            marker.addListener("click", function()
                            {
                                infoWindow.open(map, marker);     
                            });     
                    }
            </script>
	   </div>
       
    <?php
    }
}?>