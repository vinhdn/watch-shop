<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<style>
.site_header.with_featured_img,
.site_header.without_featured_img {
	margin-bottom: 50px;
}
</style>

<div class="row">
	<div class="large-12 large-centered columns">
	
		<div class="my_account_container">

            <div class="myaccount_user">
			
				<?php wc_print_notices(); ?>

				<?php /**
				 * My Account navigation.
				 * @since 2.6.0
				 */
				do_action( 'woocommerce_account_navigation' ); ?>

				<div class="woocommerce-MyAccount-content">
					<?php
						/**
						 * My Account content.
						 * @since 2.6.0
						 */
						do_action( 'woocommerce_account_content' );
					?>
				</div>
			<div class="clearfix"></div>
            </div>

            <div class="clearfix"></div>

		</div><!-- .my_account_container-->
	</div><!-- .large-8-->
</div><!-- .row-->
