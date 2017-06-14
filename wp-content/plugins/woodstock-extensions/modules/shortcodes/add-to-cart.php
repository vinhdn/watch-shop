<?php

// [custom_add_to_cart]

function shortcode_custom_add_to_cart($atts, $content = null) {
	global $wpdb, $post, $tdl_options;

	if ( empty( $atts ) ) return '';

	extract( shortcode_atts( array(
		'id'         	=> '',
		'quantity'   	=> '1',
		'sku'        	=> '',
		'show_price'	=> 'true',
		'price_color'	=> '#000000',
		'size' 			=> '',
		'style' 		=> '',
		'align' 		=> 'left',
		'text_color'	=> '#000000',
		'bg_color' 		=> '#ffffff',
	), $atts ) );

	if ( ! empty( $id ) ) {
		$product_data = get_post( $id );
	} elseif ( ! empty( $sku ) ) {
		$product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );
		$product_data = get_post( $product_id );
	} else {
		return '';
	}

	$product = wc_setup_product_data( $product_data );

	if ( ! $product ) {
		return '';
	}
	ob_start(); 
	
	$class = "".$size.' '.$style;
	$loaderrandomid = rand();
	?> 
	<style>
	.add_to_cart_inline .button-loader.loader-<?php echo $loaderrandomid; ?>:after {
		border-color: <?php echo $text_color; ?> !important;
		border-right-color: transparent !important;
	}


	.price-field-<?php echo $loaderrandomid ?>.add_to_cart_inline del,
	.price-field-<?php echo $loaderrandomid ?>.add_to_cart_inline ins,
	.price-field-<?php echo $loaderrandomid ?>.add_to_cart_inline .amount {
		color: <?php echo $price_color; ?>;
	}
	</style>
    
    <p class="product woocommerce add_to_cart_inline spinner-circle price-field-<?php echo $loaderrandomid ?>" style="text-align:<?php echo $align; ?>">

		<?php if ( $show_price == 'true' ) : ?>
            	<?php echo $product->get_price_html(); ?>
        <?php endif; ?>
        <span class="add_to_cart_separator"></span>
        <?php
		echo apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( "<a style=\"color: $text_color; background-color: $bg_color;\" href=\"%s\" rel=\"nofollow\" data-product_id=\"%s\" data-product_sku=\"%s\" data-quantity=\"%s\" class=\"$class %s button ajax_add_to_cart product_type_%s\"><span class=\"button-loader loader-$loaderrandomid\"></span><span>%s</span></a>",
				esc_url( $product->add_to_cart_url() ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				esc_attr( $product->get_type() ),
				esc_html( $product->add_to_cart_text() )
			), $product );
		?>

    </p>
	
	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	wc_setup_product_data($post);
	return $content;
}

add_shortcode("custom_add_to_cart", "shortcode_custom_add_to_cart");

