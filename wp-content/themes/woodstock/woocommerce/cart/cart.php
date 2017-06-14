<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<style>
.site_header.with_featured_img,
.site_header.without_featured_img {
	margin-bottom: 70px;
}
</style>

<?php remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<div class="cart_container">
    
    
        <?php do_action( 'woocommerce_before_cart_table' ); ?>
            
        <div class="row">
        <div class="large-12 large-centered columns">
			
		
			<div class="row">
			<div class="large-7 columns">	
		 
				<div class="cart_left_wrapper">
		
					<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
						
						<thead>
							<tr>
								<th class="product-thumbnail-thead"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
								<th class="product-name-thead">&nbsp;</th>
								<th class="product-price-thead">&nbsp;</th>
								<th class="product-quantity-thead">
									<span class="show-for-small-only text-center product_quantity_mobile"><?php esc_html_e( 'Qty', 'woocommerce' ); ?></span>
									<span class="show-for-medium-up"><?php esc_html_e( 'Qty', 'woocommerce' ); ?></span>
								</th>	
								<th class="product-subtotal-thead"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
								<th class="product-remove-thead">&nbsp;</th>

							</tr>
						</thead>
						
						<tbody>
							
							<?php do_action( 'woocommerce_before_cart_contents' ); ?>
					
							<?php
							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
								$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					
								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
									?>
									<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
										
										<td class="product-thumbnail">
											<?php
												$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

												if ( ! $_product->is_visible() )
													echo esc_url($thumbnail);
												else
													printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
											?>
										</td>
					
										<td class="product-name">
											<?php
												if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
												else
													echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );

												// Meta data
												echo WC()->cart->get_item_data( $cart_item );

					               				// Backorder notification
					               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
					               					echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
											?>
										</td>
					
										<td class="product-price">
											<?php
												echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
											?>
										</td>
					
										<td class="product-quantity">
											<?php
												if ( $_product->is_sold_individually() ) {
													$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
												} else {
													$product_quantity = woocommerce_quantity_input( array(
														'input_name'  => "cart[{$cart_item_key}][qty]",
														'input_value' => $cart_item['quantity'],
														'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
														'min_value'   => '0'
													), $_product, false );
												}

												echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
											?>
										</td>
					
										<td class="product-subtotal">
											<?php
												echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
											?>
										</td>
										
										<td class="product-remove">
											<?php
												echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><i class="icon-close-regular"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
											?>
										</td>
										
									</tr>
									<?php
								}
							}
					
							do_action( 'woocommerce_cart_contents' );
							?>
							
							<?php do_action( 'woocommerce_after_cart_contents' ); ?>
							
						</tbody>
					</table>
					
					<?php if ( WC()->cart->coupons_enabled() ) { ?>
						<div class="coupon_code_wrapper">
							
							<h4 class="coupon_code_text"><?php esc_html_e( 'Coupon', 'woocommerce' ) ?></h4>
							
							<div class="coupon_code_wrapper_inner">
	
								<input name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_html_e( 'Coupon code', 'woocommerce' ); ?>" /><input type="submit" class="button apply_coupon" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', 'woocommerce' ); ?>" />
								<?php do_action('woocommerce_cart_coupon'); ?>
	
							</div>
						</div>
					<?php } ?>
					
					<?php do_action( 'woocommerce_after_cart_table' ); ?>
        
				</div><!--.cart_left_wrapper-->
		
            </div><!-- .large-7 -->
       
			<div class="large-5 columns">
			
				<div class="cart_right_wrapper bordered">
			
					<div class="cart-collaterals">
		
						<div class="cart-totals-wrapper">
	
							<?php woocommerce_cart_totals(); ?>
	
						</div>
				
						<div class="cart-buttons">                
							
							<input type="submit" class="button update_cart" name="update_cart" value="<?php esc_html_e( 'Update Cart', 'woocommerce' ); ?>" />               

							<?php do_action('woocommerce_proceed_to_checkout'); ?>
							
							<?php do_action( 'woocommerce_cart_actions' ); ?>

							<?php wp_nonce_field( 'woocommerce-cart') ?>
						
						</div><!--.cart-buttons-->
						
					</div><!-- .cart-collaterals -->
				
				</div><!--.cart_right_wrapper-->
				
			</div><!-- .large-5 -->
			</div><!-- .row -->
			
		</div><!-- .large-9 -->
		</div><!-- .row -->	
    
    
    
    <?php do_action( 'woocommerce_after_cart' ); ?>
    
	
	
	<div class="row">
        <div class="large-12 columns">
	
		<?php do_action('woocommerce_cart_collaterals'); ?>
    
		</div><!-- .large-10 -->
	</div><!-- .row -->	
	

</div><!-- .cart_container-->
</form>