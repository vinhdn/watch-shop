<?php

// [banner]

vc_map(array(
   "name"			=> "Banner",
   "category"		=> 'Content',
   "description"	=> "Place Banner",
   "base"			=> "banner",
   "class"			=> "",
   "icon"			=> "banner",

   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Title",
			"param_name"	=> "title",
			"value"			=> "Freeshipping On All Orders Over $75",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Subtitle",
			"param_name"	=> "subtitle",
			"admin_label"	=> FALSE,
			"value"			=> "Shop Now",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "URL",
			"param_name"	=> "link_url",
			"value"			=> "",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Title Color",
			"param_name"	=> "title_color",
			"value"			=> "#ffffff",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Subtitle Color",
			"param_name"	=> "subtitle_color",
			"value"			=> "#ffffff",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Inner Stroke Thickness",
			"param_name"	=> "inner_stroke",
			"value"			=> "0px",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Inner Stroke Color",
			"param_name"	=> "inner_stroke_color",
			"value"			=> "#ffffff",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Background Color",
			"param_name"	=> "bg_color",
			"value"			=> "#000000",
		),
		
		array(
			"type"			=> "attach_image",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Background Image",
			"param_name"	=> "bg_image",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Height",
			"param_name"	=> "height",
			"value"			=> "300px",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Separator Padding",
			"param_name"	=> "sep_padding",
			"value"			=> "5px",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Separator Color",
			"param_name"	=> "sep_color",
			"value"			=> "rgba(255,255,255,0.01)",
		),

   )
   
));