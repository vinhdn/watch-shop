<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

   global $woocommerce_loop;
   $tdl_options = woodstock_global_var();
?>

<?php 
$product_display_type = $tdl_options['tdl_product_display_type'];

if ( ( isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'] != "" ) ) {
	$products_per_column = $woocommerce_loop['columns'];
} else {
	if ( ( !isset($tdl_options['tdl_products_per_column']) ) ) {
		$products_per_column = 4;
	} else {
		$products_per_column = $tdl_options['tdl_products_per_column'];
		
        if (isset($_GET["products_per_column"])) $products_per_column = $_GET["products_per_column"];
	}
}

if ($products_per_column == 6) {
	$products_per_column_xlarge = 6;
	$products_per_column_large = 4;
	$products_per_column_medium = 3;
}

if ($products_per_column == 5) {
	$products_per_column_xlarge = 5;
	$products_per_column_large = 4;
	$products_per_column_medium = 3;
}

if ($products_per_column == 4) {
	$products_per_column_xlarge = 4;
	$products_per_column_large = 4;
	$products_per_column_medium = 3;
}

if ($products_per_column == 3) {
	$products_per_column_xlarge = 3;
	$products_per_column_large = 3;
	$products_per_column_medium = 2;
}

if ($products_per_column == 2) {
	$products_per_column_xlarge = 2;
	$products_per_column_large = 2;
	$products_per_column_medium = 2;
}
?>


<ul id="products" class="product-category-list products products-grid small-block-grid-2 medium-block-grid-<?php echo esc_attr($products_per_column_medium); ?> large-block-grid-<?php echo esc_attr($products_per_column_large); ?> xlarge-block-grid-<?php echo esc_attr($products_per_column_xlarge); ?> xxlarge-block-grid-<?php echo esc_attr($products_per_column); ?> columns-<?php echo esc_attr($products_per_column); ?> product-layout-<?php echo esc_attr($product_display_type);?>">