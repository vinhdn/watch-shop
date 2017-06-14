<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php
	if ( is_user_logged_in() || 'no' == get_option( 'woocommerce_enable_checkout_login_reminder' ) ) return;

	$info_message  = apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'woocommerce' ) );
	$info_message .= ' <a href="#" class="showlogin">' . esc_html__( 'Click here to login', 'woocommerce' ) . '</a>';
?>

<div class="checkout_login">
	<div class="row">
		<div class="large-12 columns"><?php wc_print_notice( $info_message, 'notice' ); ?></div>
	</div>	

	<div class="row">
		<div class="large-7 large-centered columns">
	
			<?php
				woocommerce_login_form(
					array(
						'message'  => __( 'If you have shopped with us before, please enter your details in the boxes below. <br />If you are a new customer please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
						'redirect' => get_permalink( wc_get_page_id( 'checkout' ) ),
						'hidden'   => true
					)
				);
			?>
			
			<div class="notice-border-container">
			</div>
	
		</div>
	</div>
	
</div><!-- .checkout_login-->
