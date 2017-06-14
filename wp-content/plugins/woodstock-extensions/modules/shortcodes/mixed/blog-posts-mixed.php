<?php

// [products_mixed]
function shortcode_blog_posts_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
		"posts" => '9',
		"category" => '',
		'layout'  => 'listing'
	), $atts));
	ob_start();

    if ($layout == "listing") {
		if ($title != '') {
			echo '<h2 class="shortcode_title">' . $title . '</h2>';
		}    	
		echo do_shortcode('[from_the_blog_listing posts="'.$posts.'" category="'.$category.'"]');
	} else {
        echo do_shortcode('[from_the_blog title="'.$title.'" posts="'.$posts.'" category="'.$category.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("blog_posts_mixed", "shortcode_blog_posts_mixed");