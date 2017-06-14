<?php

function wstock_socials($atts, $content = null) {	
	global $tdl_options;
	extract(shortcode_atts(array(
		"items_align" => 'left',
        "font_size"   => '',
        "color"       => '',
	), $atts));
    ob_start();
    ?>

    <div class="site-social-icons-shortcode" <?php if ($color != '') { ?>style="color:<?php echo $color; ?>"<?php } ?>>

        <ul class="<?php echo $items_align; ?>" <?php if ($font_size != '') { ?>style="font-size:<?php echo $font_size; ?>"<?php } ?>>
            <?php if ( (isset($tdl_options['facebook_link'])) && (trim($tdl_options['facebook_link']) != "" ) ) { ?><li class="site-social-icons-facebook"><a  target="_blank" href="<?php echo $tdl_options['facebook_link']; ?>"><i class="fa fa-facebook"></i><span>Facebook</span></a></li><?php } ?>
            <?php if ( (isset($tdl_options['twitter_link'])) && (trim($tdl_options['twitter_link']) != "" ) ) { ?><li class="site-social-icons-twitter"><a target="_blank" href="<?php echo $tdl_options['twitter_link']; ?>"><i class="fa fa-twitter"></i><span>Twitter</span></a></li><?php } ?>
            <?php if ( (isset($tdl_options['pinterest_link'])) && (trim($tdl_options['pinterest_link']) != "" ) ) { ?><li class="site-social-icons-pinterest"><a target="_blank" href="<?php echo $tdl_options['pinterest_link']; ?>"><i class="fa fa-pinterest"></i><span>Pinterest</span></a></li><?php } ?>
            <?php if ( (isset($tdl_options['linkedin_link'])) && (trim($tdl_options['linkedin_link']) != "" ) ) { ?><li class="site-social-icons-linkedin"><a target="_blank" href="<?php echo $tdl_options['linkedin_link']; ?>"><i class="fa fa-linkedin"></i><span>LinkedIn</span></a></li><?php } ?>
            <?php if ( (isset($tdl_options['googleplus_link'])) && (trim($tdl_options['googleplus_link']) != "" ) ) { ?><li class="site-social-icons-googleplus"><a target="_blank" href="<?php echo $tdl_options['googleplus_link']; ?>"><i class="fa fa-google-plus"></i><span>Google+</span></a></li><?php } ?>
            <?php if ( (isset($tdl_options['rss_link'])) && (trim($tdl_options['rss_link']) != "" ) ) { ?><li class="site-social-icons-rss"><a target="_blank" href="<?php echo $tdl_options['rss_link']; ?>"><i class="fa fa-rss"></i><span>RSS</span></a></li><?php } ?>
            <?php if ( (isset($tdl_options['tumblr_link'])) && (trim($tdl_options['tumblr_link']) != "" ) ) { ?><li class="site-social-icons-tumblr"><a target="_blank" href="<?php echo $tdl_options['tumblr_link']; ?>"><i class="fa fa-tumblr"></i><span>Tumblr</span></a></li><?php } ?>
            <?php if ( (isset($tdl_options['instagram_link'])) && (trim($tdl_options['instagram_link']) != "" ) ) { ?><li class="site-social-icons-instagram"><a target="_blank" href="<?php echo $tdl_options['instagram_link']; ?>"><i class="fa fa-instagram"></i><span>Instagram</span></a></li><?php } ?>
            <?php if ( (isset($tdl_options['youtube_link'])) && (trim($tdl_options['youtube_link']) != "" ) ) { ?><li class="site-social-icons-youtube"><a target="_blank" href="<?php echo $tdl_options['youtube_link']; ?>"><i class="fa fa-youtube-play"></i><span>Youtube</span></a></li><?php } ?>
            <?php if ( (isset($tdl_options['vimeo_link'])) && (trim($tdl_options['vimeo_link']) != "" ) ) { ?><li class="site-social-icons-vimeo"><a target="_blank" href="<?php echo $tdl_options['vimeo_link']; ?>"><i class="fa fa-vimeo-square"></i><span>Vimeo</span></a></li><?php } ?>
        </ul>
    </div>
    
    <?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("social-media", "wstock_socials");