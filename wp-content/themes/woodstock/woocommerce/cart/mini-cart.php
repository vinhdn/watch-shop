<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="minicart_title">
	<a href="#" class="close-icon"></a>

	<div class="l-header-shop">	
		<span class="shopbag_items_number"><?php echo WC()->cart->cart_contents_count; ?></span>	    		
		<i class="icon-shop"></i>
	</div>

	
	<h2 class="cart-title">
	<?php if ( is_user_logged_in() ) { ?>
		<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="cart-myaccount-link"><?php esc_html_e('My Account', 'woocommerce'); ?></a>	
	<?php } else { ?>
		<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="cart-login-link"><?php esc_html_e( 'Login', 'woodstock' ); ?></a>
	<?php } ?>
	<?php esc_html_e( 'Shopping Cart', 'woodstock' ); ?>
</h2>

</div>


<?php if ( ! WC()->cart->is_empty() ) : ?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				$variation_id_class = '';

				if ( $cart_item['variation_id'] > 0 )
                        $variation_id_class = ' product-var-id-' .  $cart_item['variation_id'];

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					?>

					<tr class="bag-product clearfix  product-id-<?php echo $cart_item['product_id']; ?><?php echo esc_attr($variation_id_class); ?>">                        
                        <td class="product-thumbnail"><a href="<?php echo get_permalink( $product_id ); ?>"><?php echo $thumbnail; ?></a></td>  
                        <td class="product-name">                        
                            <h4><a href="<?php echo get_permalink( $product_id ); ?>"><?php echo $product_name; ?></a></h4>                    
                            <?php echo WC()->cart->get_item_data( $cart_item ); ?>   
                            <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                        </td>
                        
                        <td class="product-remove">
							<a href="%s" class="remove-product remove" data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-product-id="<?php echo $cart_item['product_id'];?>"   data-variation-id="<?php echo $cart_item['variation_id'];?>" data-product-qty="<?php echo $cart_item['quantity'];?>" title="<?php echo esc_html__( 'Remove this item', 'woocommerce' ); ?>"><i class="icon-close-regular"></i></a>
                        </td>
                    </tr>


					<?php
				}
			}
		?>

	</table><!-- end product list -->

<?php else : ?>
	

	<div class="cart-empty-offcanvas-banner offcanvas-empty-banner">
		<span id="empty-cart-offcanvas-box"></span>
	</div>
	
	<p class="cart-empty-text offcanvas-empty-text"><?php esc_html_e( 'Your cart is currently empty.', 'woocommerce' ); ?></p>

<?php endif; ?>


<?php if ( ! WC()->cart->is_empty() ) : ?>

	<p class="total"><strong class="subtotal_name"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="buttons">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button view_cart wc-forward"><?php esc_html_e( 'View Cart', 'woocommerce' ); ?></a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward"><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></a>
	</p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
