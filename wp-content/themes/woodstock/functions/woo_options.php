<?php 

if ( WOODSTOCK_WOOCOMMERCE_IS_ACTIVE ) {

/******************************************************************************/
/*******Show Woocommerce Cart Widget Everywhere *******************************/
/******************************************************************************/

	if ( ! function_exists('woodstock_woocommerce_widget_cart_everywhere') ) :
	function woodstock_woocommerce_widget_cart_everywhere() { 
	    return false; 
	};
	add_filter( 'woocommerce_widget_cart_is_hidden', 'woodstock_woocommerce_widget_cart_everywhere', 10, 1 );
	endif;
	
}

/******************************************************************************/
/******* Disable WooCommerce Select 2 *****************************************/
/******************************************************************************/


add_action( 'wp_enqueue_scripts', 'woodstock_dequeue_stylesandscripts_select2', 100 );

function woodstock_dequeue_stylesandscripts_select2() {
    if ( class_exists( 'woocommerce' ) ) {
        wp_dequeue_style( 'select2' );
        wp_deregister_style( 'select2' );

        wp_dequeue_script( 'select2');
        wp_deregister_script('select2');

    } 
} 


// Adding custom attributes in menu 

add_filter('woocommerce_attribute_show_in_nav_menus', 'woodstock_wc_reg_for_menus', 1, 2);

function woodstock_wc_reg_for_menus( $register, $name = '' ) {
	global $product, $woocommerce; 
     if ( $name == 'pa_os' ) $register = true;
     return $register;
}

/******************************************************************************/
/* WooCommerce Number of Related Products *************************************/
/******************************************************************************/

function woocommerce_output_related_products() {
	global $product, $woocommerce; 
	$atts = array(
		'posts_per_page' => '12',
		'orderby'        => 'rand'
	);
	woocommerce_related_products($atts);
}


/******************************************************************************/
/* WooCommerce Wrap Oembed Stuff **********************************************/
/******************************************************************************/
add_filter('embed_oembed_html', 'woodstock_embed_oembed_html', 99, 4);
function woodstock_embed_oembed_html($html, $url, $attr, $post_id) {
	return '<div class="video-container">' . $html . '</div>';
}

/******************************************************************************/
/*  Remove Default Woocommerce Breadcrumbs  ***********************************/
/******************************************************************************/

add_action( 'init', 'woodstock_remove_wc_breadcrumbs' );
function woodstock_remove_wc_breadcrumbs() {
	global $product, $woocommerce; 
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}


/******************************************************************************/
/* Product Availability *******************************************************/
/******************************************************************************/

function woodstock_availability() {
	global $product, $tdl_options;
	$availability = $product->get_availability();
	$stock_status = $availability['class'];
		
	if( $stock_status == 'out-of-stock' ) {
		if (isset($tdl_options['tdl_out_of_stock_text'])) {
			$label = esc_html($tdl_options['tdl_out_of_stock_text']);
		} else {
			$label = esc_html__('Out of stock', 'woocommerce');
		}		
		$label_class = 'not-available';
	} else {
		$label = esc_html__( 'In Stock', 'woodstock' ) ;
		$label_class = 'available';
	}

	echo apply_filters( 'woodstock_loop_stock_availability_html',
		sprintf( '<div class="availability"><label>%s</label><span class="%s">%s</span></div>',
				esc_html__( 'Availability: ', 'woodstock' ),
		$label_class,
		$label
		),
	$product );
}


/******************************************************************************/
/* WooCommerce Update Number of Items in the cart *****************************/
/******************************************************************************/
// $oraksoft_js_data_watc = array();
// $oraksoft_js_data_watc['cart_url'] => $woocommerce->cart->get_cart_url();

add_action('woocommerce_ajax_added_to_cart', 'woodstock_ajax_added_to_cart');
function woodstock_ajax_added_to_cart() {

	add_filter('add_to_cart_fragments', 'woodstock_shopping_bag_items_number');
	function woodstock_shopping_bag_items_number( $fragments ) 
	{
		global $woocommerce;
		ob_start(); ?>

		<script>
		(function($){
			$('.shop-bag').trigger('click');
		})(jQuery);
		</script>
		
		<span class="bag-items-number"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count, 'woodstock' ), WC()->cart->cart_contents_count ); ?></span>

		<?php
		$fragments['.bag-items-number'] = ob_get_clean();
		ob_start(); ?>
		
        <span class="shopbag_items_number"><?php echo WC()->cart->cart_contents_count; ?></span>

		<?php
		$fragments['.shopbag_items_number'] = ob_get_clean();
		ob_start(); ?>
		
		<?php echo WC()->cart->get_cart_total(); ?>	

		<?php
		$fragments['.shop-bag .overview .amount'] = ob_get_clean();
		return $fragments;

	}
}

/******************************************************************************/
/****** WOO GET PRODUCT PER PAGE **********************************************/
/******************************************************************************/

	add_filter('loop_shop_per_page', 'woodstock_loop_shop_per_page');


	// get product count per page
	function woodstock_loop_shop_per_page() {
		global $tdl_options;

	    parse_str($_SERVER['QUERY_STRING'], $params);

	    // replace it with theme option
	    if ($tdl_options['tdl_product_count']) {
	        $per_page = explode(',', $tdl_options['tdl_product_count']);
	    } else {
	        $per_page = explode(',', '12,24,36');
	    }
	 
	    $item_count = !empty($params['count']) ? $params['count'] : $per_page[0];

	    return $item_count;
	}


/******************************************************************************/
/****** WOO REMOVE PRODUCT FROM CART ******************************************/
/******************************************************************************/


	if ( ! function_exists('woodstock_cart_product_remove')){
		function woodstock_cart_product_remove() {

    		global $wpdb, $woocommerce;

			$id = 0; 
			$variation_id = 0;
			
            if ( ! empty( $_REQUEST['product_id'] ) ) {
                $id = $_REQUEST['product_id'];
            }
            
            if ( ! empty( $_REQUEST['variation_id'] ) ) {
                $variation_id = $_REQUEST['variation_id'];
            }
                                                
            $cart = $woocommerce->cart;
            
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            	
            	    if ( ($cart_item['product_id'] == $id && $variation_id <= 0) || ($cart_item['variation_id'] == $variation_id && $variation_id > 0 ) ){
            	   		$cart->set_quantity($cart_item_key,0);	
					}           
		
            }
            if ( $woocommerce->tax_display_cart == 'excl' ) {
				$totalamount  = wc_price($woocommerce->cart->get_total());
			} else {
				$totalamount  = wc_price($woocommerce->cart->cart_contents_total + $woocommerce->cart->tax_total);
			} 	
   			
   			echo $totalamount;

			die();
    	}

    	add_action( 'wp_ajax_tdl_cart_product_remove', 'woodstock_cart_product_remove' );
		add_action( 'wp_ajax_nopriv_tdl_cart_product_remove', 'woodstock_cart_product_remove' );
	}

/******************************************************************************/
/****** WISHLIST / COMPARE BUTTONS ********************************************/
/******************************************************************************/	

if( ! function_exists ( 'woodstock_loop_action_buttons' ) ) {
	function woodstock_loop_action_buttons() {
		?>
		
		<div class="prod-plugins">
			<ul>
				<?php


					echo '<li>'.do_shortcode('[yith_wcwl_add_to_wishlist]').'</li>';

					echo '<li>'.do_shortcode('[yith_compare_button]').'</li>';

				?>
			</ul>
		</div>

		<?php
	}
}

// Wishlist Topbar/Mobile Menu Button

if( ! function_exists ( 'woodstock_wishlist_topbar' ) ) {
	function woodstock_wishlist_topbar() {
		global $yith_wcwl, $tdl_options;
		?>
	<?php if (in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>			

		<?php if ( (isset($tdl_options['tdl_topbar_wishlist'])) && (trim($tdl_options['tdl_topbar_wishlist']) == "1" ) ) : ?>
			<?php if (class_exists('YITH_WCWL')) : ?>
			<li class="wishlist-link"><a href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>" class="acc-link"><i class="wishlist-icon"></i><?php esc_html_e('Wishlist', 'woodstock'); ?></a></li>
			<?php endif; ?>  
		<?php endif; ?>

	<?php endif; ?> 
		<?php
	}
}


/******************************************************************************/
/****** PRODUCT SHORT TITLE ****************************************************/
/******************************************************************************/	

// WordPress Hack by Knowtebook.com
// Shorten any text you want
if ( ! function_exists( 'woodstock_short_title' ) ) :
	function woodstock_short_title($text) {
	// Change to the number of characters you want to display

	$chars_limit = 30;
	$chars_text = strlen($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));

	// If the text has more characters that your limit,
	//add ... so the user knows the text is actually longer

	if ($chars_text > $chars_limit)
	{
	$text = $text."...";
	}

	return $text;
	}
endif; // woodstock_short_title

/******************************************************************************/
/****** PRODUCT NAVIGATION ****************************************************/
/******************************************************************************/

if ( ! function_exists( 'woodstock_product_nav' ) ) :
function woodstock_product_nav($nav_id) {

	global $wp_query, $post, $tdl_options;
    // get categories
    $terms = wp_get_post_terms( $post->ID, 'product_cat' );
    foreach ( $terms as $term ) $cats_array[] = $term->term_id;

    // get all posts in current categories
    $postlist_args = array('posts_per_page' => -1, 'orderby' => 'menu_order title', 'order'	=> 'ASC', 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $cats_array
        )));

    $postlist = get_posts( $postlist_args );

	// get ids of posts retrieved from get_posts
	
	$ids = array();
	
	foreach ($postlist as $thepost) {
	   $ids[] = $thepost->ID;
	}
	
	// get and echo previous and next post in the same taxonomy        
	
	$thisindex = array_search($post->ID, $ids);
	
	$previd = "";
	$nextid = "";
	
	if (isset($ids[$thisindex-1])) $previd = $ids[$thisindex-1];
	
	if (isset($ids[$thisindex+1])) $nextid = $ids[$thisindex+1];

	if (defined('ICL_SITEPRESS_VERSION')) {
		$product_prev_link = get_permalink(icl_object_id($previd, 'product', true));
		$product_next_link = get_permalink(icl_object_id($nextid, 'product', true));
	} else {
		$product_prev_link = get_permalink($previd);
		$product_next_link = get_permalink($nextid);
	}
 
?>

	<nav id="<?php echo esc_attr( $nav_id ); ?>" class="nav-fillslide">
		<?php if ( !empty($previd) ) : ?>
			<a class="prev" href="<?php echo esc_attr($product_prev_link); ?>">
				<span class="icon-wrap"><i class="icon-woodstock-icons-43"></i></span>
				<div>
					
					<?php if ( $tdl_options['tdl_category_listing'] !== 'none') { ?>
	            		<?php $product = new WC_Product($previd); 
	            		$product_cats = strip_tags(wc_get_product_category_list ($product->get_id(), '|||', '', '')); 
		            ?>
						<span><?php list($firstpart) = explode('|||', $product_cats); echo esc_attr($firstpart); ?></span>
					<?php } ?>

					<h4><?php echo woodstock_short_title(get_the_title($previd)); ?></h4>
					<?php $product_nav_img_prev = wp_get_attachment_image_src( get_post_thumbnail_id($previd), 'shop_thumbnail' ); ?>
					<img src="<?php echo esc_url($product_nav_img_prev[0]); ?>" alt="<?php echo get_the_title($previd); ?>"/>
				</div>
			</a>			
		<?php endif; ?>

		<?php if ( !empty($nextid) ) : ?>
			<a class="next" href="<?php echo esc_attr($product_next_link); ?>">
				<span class="icon-wrap"><i class="icon-woodstock-icons-44"></i></span>
				<div>
					<?php if ( $tdl_options['tdl_category_listing'] !== 'none') { ?>
	            		<?php $product = new WC_Product($nextid); 
	            		$product_cats = strip_tags(wc_get_product_category_list ($product->get_id(), '|||', '', ''));
		            ?>
						<span><?php list($firstpart) = explode('|||', $product_cats); echo esc_attr($firstpart); ?></span>
					<?php } ?>
					<h4><?php echo woodstock_short_title(get_the_title($nextid)); ?></h4>
					<?php $product_nav_img_next = wp_get_attachment_image_src( get_post_thumbnail_id($nextid), 'shop_thumbnail' ); ?>
					<img src="<?php echo esc_url($product_nav_img_next[0]); ?>" alt="<?php echo get_the_title($nextid); ?>"/>
				</div>
			</a>			
		<?php endif; ?>
	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->


<?php	
	wp_reset_query();
}
endif; // woodstock_product_nav


/******************************************************************************/
/* WooCommerce Add data-src & lazyOwl to Thumbnails ***************************/
/******************************************************************************/

function woocommerce_get_product_thumbnail( $size = 'woodstock_product_small_thumbnail', $placeholder_width = 0, $placeholder_height = 0  ) {
	global $post;

	if ( has_post_thumbnail() ) {
		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_catalog' );
		return get_the_post_thumbnail( $post->ID, $size, array('data-src' => $image_src[0], 'class' => 'lazyOwl') );
	} elseif ( wc_placeholder_img_src() ) {
		return wc_placeholder_img( $size );
	}
}

function woocommerce_subcategory_thumbnail( $category ) {
	$small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', 'woodstock_product_small_thumbnail' );
	$thumbnail_size  		= apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
	$dimensions    			= wc_get_image_size( $small_thumbnail_size );
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

	if ( $thumbnail_id ) {
		$image_small = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
		$image_small = $image_small[0];
		$image = wp_get_attachment_image_src( $thumbnail_id, $thumbnail_size  );
		$image = $image[0];
	} else {
		$image = $image_small = wc_placeholder_img_src();
		
	}

	if ( $image_small )
		echo '<img data-src="' . esc_url( $image ) . '" class="lazyOwl" src="' . esc_url( $image_small ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_url( $dimensions['height'] ) . '" />';
}



 ?>