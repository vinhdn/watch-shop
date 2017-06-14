<?php

//Include shortcodes
include_once 'shortcodes/product-categories.php';
include_once 'shortcodes/socials.php';
include_once 'shortcodes/from-the-blog.php';
include_once 'shortcodes/from-the-blog-listing.php';
include_once 'shortcodes/separator.php';
include_once 'shortcodes/spacing.php';
include_once 'shortcodes/banner.php';
include_once 'shortcodes/google-map.php';
include_once 'shortcodes/wc-mod-product.php';
include_once 'shortcodes/add-to-cart.php';
include_once 'shortcodes/header-contact.php';

//Mixed shortcodes
include_once 'shortcodes/mixed/recent-products-mixed.php';
include_once 'shortcodes/mixed/featured-products-mixed.php';
include_once 'shortcodes/mixed/sale-products-mixed.php';
include_once 'shortcodes/mixed/best-selling-products-mixed.php';
include_once 'shortcodes/mixed/top-rated-products-mixed.php';
include_once 'shortcodes/mixed/product-category-mixed.php';
include_once 'shortcodes/mixed/products-mixed.php';
include_once 'shortcodes/mixed/products-by-attribute-mixed.php';
include_once 'shortcodes/mixed/blog-posts-mixed.php';

//Sliders shortcodes
include_once 'shortcodes/sliders/recent-products-slider.php';
include_once 'shortcodes/sliders/featured-products-slider.php';
include_once 'shortcodes/sliders/sale-products-slider.php';
include_once 'shortcodes/sliders/best-selling-products-slider.php';
include_once 'shortcodes/sliders/top-rated-products-slider.php';
include_once 'shortcodes/sliders/product-category-slider.php';
include_once 'shortcodes/sliders/products-slider.php';
include_once 'shortcodes/sliders/products-by-attribute-slider.php';


/******************************************************************************/
/*************************** Visual Composer **********************************/
/******************************************************************************/

if (class_exists('WPBakeryVisualComposerAbstract')) {
	
	add_action( 'init', 'visual_composer_stuff' );
	function visual_composer_stuff() {
	
		//enable vc on post types
		if(function_exists('vc_set_default_editor_post_types')) vc_set_default_editor_post_types( array('post','page','product') );
		
		// Modify and remove existing shortcodes from VC
		include_once 'shortcodes/visual-composer/custom_vc.php';
		
		// VC Templates
		$vc_templates_dir = 'shortcodes/visual-composer/vc_templates/';
		vc_set_shortcodes_templates_dir($vc_templates_dir);		

		
		// Add new Shop shortcodes to VC
		if (class_exists('WooCommerce')) {
			include_once 'shortcodes/visual-composer/wc-recent-products.php';
			include_once 'shortcodes/visual-composer/wc-featured-products.php';
			include_once 'shortcodes/visual-composer/wc-products-by-category.php';
			include_once 'shortcodes/visual-composer/wc-products-by-attribute.php';
			include_once 'shortcodes/visual-composer/wc-product-by-id-sku.php';
			include_once 'shortcodes/visual-composer/wc-products-by-ids-skus.php';
			include_once 'shortcodes/visual-composer/wc-sale-products.php';
			include_once 'shortcodes/visual-composer/wc-top-rated-products.php';
			include_once 'shortcodes/visual-composer/wc-best-selling-products.php';
			include_once 'shortcodes/visual-composer/wc-add-to-cart-button.php';
			include_once 'shortcodes/visual-composer/wc-add-to-cart-button-custom.php';
			include_once 'shortcodes/visual-composer/wc-product-categories.php';
		}

		// Add new shortcodes to VC
		include_once 'shortcodes/visual-composer/blog-posts.php';
		include_once 'shortcodes/visual-composer/social-media-profiles.php';
		include_once 'shortcodes/visual-composer/banner.php';
		include_once 'shortcodes/visual-composer/google-map.php';
		
		// Remove vc_teaser
		if (is_admin()) :
			function remove_vc_teaser() {
				remove_meta_box('vc_teaser', '' , 'side');
			}
			add_action( 'admin_head', 'remove_vc_teaser' );
		endif;
	
	}

}

add_action( 'vc_before_init', 'wstock_vcSetAsTheme' );
function wstock_vcSetAsTheme() {
    vc_set_as_theme( $disable_updater = true );
}