<?php

// [google_map]

vc_map(array(
   "name"			=> "Google Map",
   "category"		=> 'Content',
   "description"	=> "Map block",
   "base"			=> "google_map",
   "class"			=> "",
   "icon"			=> "google_map",

   
   "params" 	=> array(
		
		    array(
		      "type" => "textfield",
		      "heading" => __("Map height", "js_composer"),
		      "param_name" => "size",
		      "admin_label" 	=> true,
		      "class" 		=> "hide_in_vc_editor",
		      "description" => __('Enter map height in pixels. Example: 200. <span>As of June 2016, a Google map API key is needed to allow this element to display. Please See the Theme Options panel > General Settings > Google map API key.</span>', "js_composer"),
		      "value" 		=> "400px"
		    ),
		
		    array(
		      "type" => "textfield",
		      "heading" => __("Latitude", "js_composer"),
		      "param_name" => "map_center_lat",
		      "admin_label" 	=> true,
		      "class" 		=> "hide_in_vc_editor",
		      "description" => __("Please enter the latitude for the maps center point. You can use <a href='http://universimmedia.pagesperso-orange.fr/geo/loc.htm' target='_blank'>this service</a> to get coordinates of your location", "js_composer"),
		      "value" 		=> "40.2846472"
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => __("Longitude", "js_composer"),
		      "param_name" => "map_center_lng",
		      "admin_label" 	=> true,
		      "class" 		=> "hide_in_vc_editor",
		      "description" => __("Please enter the longitude for the maps center point.", "js_composer"),
		      "value" 		=> "-75.6968276"
		    ),
		    
		  	array(
		      "type" => "textfield",
		      "heading" => __("Map Zoom", "js_composer"),
		      "param_name" => "zoom",
		      "admin_label" 	=> true,
		      "class" 		=> "hide_in_vc_editor",
		      'save_always' => true,
		      "description" => __("Zoom level when focus the marker. 0-20", "js_composer"),
		      "value" 		=> "7"
		    ),
		    array(
		      "type" => 'checkbox',
		      "heading" => __("Eanble Zoom In/Out", "js_composer"),
		      "param_name" => "enable_zoom",
		      "class" 		=> "hide_in_vc_editor",
		      "description" => __("Do you want users to be able to zoom in/out on the map?", "js_composer"),
		      "value" => Array(__("Yes, please", "js_composer") => true),
		    ),
		    
		    array(
		      "type" => "attach_image",
		      "heading" => __("Marker Image", "js_composer"),
		      "param_name" => "marker_image",
		      "class" 		=> "hide_in_vc_editor",
		      "value" => "",
		      "description" => __("Select image from media library.", "js_composer")
		    ),
		    array(
		      "type" => 'checkbox',
		      "heading" => __("Marker Animation", "js_composer"),
		      "param_name" => "marker_animation",
		      "class" 		=> "hide_in_vc_editor",
		      "description" => __("This will cause your markers to do a quick bounce as they load in.", "js_composer"),
		      "value" => Array(__("Yes, please", "js_composer") => true),
		    ),
		    
		    array(
		      "type" => 'checkbox',
		      "heading" => __("Greyscale Color", "js_composer"),
		      "param_name" => "map_greyscale",
		      "class" 		=> "hide_in_vc_editor",
		      "description" => __("Toggle a greyscale color scheme (will also unlock further custom options)", "js_composer"),
		      "value" => Array(__("Yes, please", "js_composer") => true),
		    ),
		    array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => "Map Extra Color",
				"param_name" => "map_color",
				"admin_label" 	=> true,
				"class" 		=> "hide_in_vc_editor",
				"value" => "#a8e8e2",
				"dependency" => Array('element' => "map_greyscale", 'not_empty' => true),
				"description" => "Use this to define a main color that will be used in combination with the greyscale option for your map"
			),
			array(
		      "type" => 'checkbox',
		      "heading" => __("Ultra Flat Map", "js_composer"),
		      "param_name" => "ultra_flat",
		      "class" 		=> "hide_in_vc_editor",
		      "dependency" => Array('element' => "map_greyscale", 'not_empty' => true),
		      "description" => __("This removes street/landmark text & some extra details for a clean look", "js_composer"),
		      "value" => Array(__("Yes, please", "js_composer") => true),
		    ),
		    array(
		      "type" => 'checkbox',
		      "heading" => __("Dark Color Scheme", "js_composer"),
		      "param_name" => "dark_color_scheme",
		      "class" 		=> "hide_in_vc_editor",
		      "dependency" => Array('element' => "map_greyscale", 'not_empty' => true),
		      "description" => __("Enable this option for a dark colored map (This will override the extra color choice)", "js_composer"),
		      "value" => Array(__("Yes, please", "js_composer") => true),
		    ),
			
		    array(
		      "type" => "textarea",
		      "heading" => __("Map Marker Locations", "js_composer"),
		      "param_name" => "map_markers",
		      "class" 		=> "hide_in_vc_editor",
		      "description" => __("Please enter the the list of locations you would like with a latitude|longitude|description format. <br/> Divide values with linebreaks (Enter). Example: <br/> 40.692784|-73.978763|Our Location <br/> 39.946814|-75.143038|Our Location #2", "js_composer")
		    ),

   )
   
));