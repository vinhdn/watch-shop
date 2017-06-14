<?php
/**
 * Order tracking form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;
?>

<style>
	.site_header {
		display: none;
	}
</style>

<?php wc_print_notices(); ?>

<div class="row">
	<div class="large-8 large-centered medium-10 medium-centered columns">
		<div class="track-order-container account-forms">

			<h1 class="entry-title text-center"><?php the_title(); ?></h1>
		
			<p class="track-order-description"><?php esc_html_e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' ); ?></p>
			
			<div class="row">
				
				<div class="large-12 columns">
					<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">
					 
						<p class="form-row form-row-first"><label for="orderid"><?php esc_html_e( 'Order ID', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php esc_html_e( 'Found in your order confirmation email.', 'woocommerce' ); ?>" /></p>
						<p class="form-row form-row-last"><label for="order_email"><?php esc_html_e( 'Billing Email', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php esc_html_e( 'Email you used during checkout.', 'woocommerce' ); ?>" /></p>
						<div class="clear"></div>
					
						<p class="form-row"><input type="submit" class="button" name="track" value="<?php esc_html_e( 'Track', 'woocommerce' ); ?>" /></p>
						<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>
					
					</form>
				</div>
			</div><!-- .row-->
			
		</div><!-- .track-order-container-->
	</div><!-- .large-->
</div><!-- .row-->
