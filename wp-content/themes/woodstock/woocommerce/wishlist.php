<?php
/**
 * Wishlist pages template; load template parts basing on the url
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.5
 */

global $wpdb, $woocommerce;

?>

<div class="row">
	<div class="large-10 columns large-centered">
		<div id="yith-wcwl-messages"></div>

		<?php yith_wcwl_get_template( 'wishlist-' . $template_part . '.php', $atts ) ?>
	</div>
</div>