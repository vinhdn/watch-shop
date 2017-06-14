<?php 

/*-----------------------------------------------------------------------------------*/
/*	CONTACT AREA WIDGETS
/*-----------------------------------------------------------------------------------*/

// [follow]
function followShortcode($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'twitter' => '',
		'facebook' => '',
		'googleplus' => '',
		'pinterest' => '',
		'vimeo' => '',
		'youtube' => '',
		'flickr' => '',
		'skype' => '',
		'behance' => '',
		'dribbble' => '',
		'tumblr' => '',
		'linkedin' => '',
		'github' => '',
		'vine' => '',
		'instagram' => '',
		'dropbox' => '',
		'rss' => '',
		'email' => '',
		'stumbleupon' => '',
		'paypal' => '',
		'foursquare' => '',
		'soundcloud' => '',
		'spotify' => '',
		'vk' => '',
		'android' => '',
		'apple' => '',
		'windows' => ''		
	), $atts));
	ob_start();
	?>

    <ul class="social-icons">

    	<?php if($facebook){?>
			<li class="facebook"><a href="<?php echo $facebook; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Facebook','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($twitter){?>
			<li class="twitter"><a href="<?php echo $twitter; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Twitter','woodstock') ?>"></a></li>
		<?php }?>
    	<?php if($googleplus){?>
			<li class="googleplus"><a href="<?php echo $googleplus; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Google Plus','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($pinterest){?>
			<li class="pinterest"><a href="<?php echo $pinterest; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Pinterest','woodstock') ?>"></a></li>
		<?php }?>
    	<?php if($vimeo){?>
			<li class="vimeo"><a href="<?php echo $vimeo; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Vimeo','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($youtube){?>
			<li class="youtube"><a href="<?php echo $youtube; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on YouTube','woodstock') ?>"></a></li>
		<?php }?>
    	<?php if($flickr){?>
			<li class="flickr"><a href="<?php echo $flickr; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Flickr','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($skype){?>
			<li class="skype"><a href="<?php echo $skype; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Skype','woodstock') ?>"></a></li>
		<?php }?>
    	<?php if($behance){?>
			<li class="behance"><a href="<?php echo $behance; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Behance','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($dribbble){?>
			<li class="dribbble"><a href="<?php echo $dribbble; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Dribbble','woodstock') ?>"></a></li>
		<?php }?>
    	<?php if($tumblr){?>
			<li class="tumblr"><a href="<?php echo $tumblr; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Tumblr','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($linkedin){?>
			<li class="linkedin"><a href="<?php echo $linkedin; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Linkedin','woodstock') ?>"></a></li>
		<?php }?>
    	<?php if($github){?>
			<li class="github"><a href="<?php echo $github; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Github','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($vine){?>
			<li class="vine"><a href="<?php echo $vine; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Vine','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($instagram){?>
			<li class="instagram"><a href="<?php echo $instagram; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Instagram','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($dropbox){?>
			<li class="dropbox"><a href="<?php echo $dropbox; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Dropbox','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($rss){?>
			<li class="rss"><a href="<?php echo $rss; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on RSS','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($email){?>
			<li class="email"><a href="<?php echo $email; ?>" rel="nofollow" target="_blank" title="<?php _e('Email Us','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($stumbleupon){?>
			<li class="stumbleupon"><a href="<?php echo $stumbleupon; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Stumbleupon','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($paypal){?>
			<li class="paypal"><a href="<?php echo $paypal; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Paypal','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($foursquare){?>
			<li class="foursquare"><a href="<?php echo $foursquare; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Foursquare','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($soundcloud){?>
			<li class="soundcloud"><a href="<?php echo $soundcloud; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Soundcloud','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($spotify){?>
			<li class="spotify"><a href="<?php echo $spotify; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Spotify','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($vk){?>
			<li class="vk"><a href="<?php echo $vk; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Vkontakte','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($android){?>
			<li class="android"><a href="<?php echo $android; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Android','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($apple){?>
			<li class="apple"><a href="<?php echo $apple; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Apple','woodstock') ?>"></a></li>
		<?php }?>
		<?php if($windows){?>
			<li class="windows"><a href="<?php echo $windows; ?>" rel="nofollow" target="_blank" title="<?php _e('Follow us on Microsoft','woodstock') ?>"></a></li>
		<?php }?>
     </ul>
    <div class="after-clear"></div>	

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("follow", "followShortcode");

// Contact
function ContactShortcode($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'city' => '',
		'phone' => '',
		'address' => '',
		'email' => ''	
	), $atts));
	ob_start();
	?>

    <div class="contact-item">

    	<?php if($city){?>
    		<span class="town"><?php echo $city; ?></span>
		<?php }?>

    	<?php if($phone){?>
    		<span class="phone"><?php echo $phone; ?></span>
		<?php }?>

    	<?php if($address){?>
    		<span class="address"><?php echo $address; ?></span>
		<?php }?>

    	<?php if($email){?>
    		<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
		<?php }?>

     </div>
    <div class="after-clear"></div>	

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("contact", "ContactShortcode");

// Divider
function DividerShortcode($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'city' => '',
		'phone' => '',
		'address' => '',
		'email' => ''	
	), $atts));
	ob_start();
	?>

    <hr />


	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("divider", "DividerShortcode");

?>