<?php

// [product_category_mixed]
function shortcode_product_category_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'category' => '',
		'per_page'  => '12',
		'columns'  => '4',
		'layout'  => 'listing',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();

    if ($layout == "listing") {
		if ($title != '') {
			echo '<h2 class="shortcode_title">' . $title . '</h2>';
		}
		echo do_shortcode('[product_category category="'.$category.'" per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
	} else {
		echo do_shortcode('[product_category_slider title="'.$title.'" category="'.$category.'" per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("product_category_mixed", "shortcode_product_category_mixed");