<?php
/**
 * Product loop sale flash
 *
 * @author 	Vivek R @ WPSTuffs.com
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post, $product;
$tdl_options = woodstock_global_var();
?>

<?php if ( $tdl_options['tdl_sale_percentages'] ) { ?>

	<?php if ($product->is_on_sale() && $product->product_type == 'variable') : ?>

		<span class="ribbon onsale">
	              	<?php 
				$available_variations = $product->get_available_variations();								
				$maximumper = 0;
				for ($i = 0; $i < count($available_variations); ++$i) {
					$variation_id=$available_variations[$i]['variation_id'];
					$variable_product1= new WC_Product_Variation( $variation_id );
					$regular_price = $variable_product1 ->regular_price;
					$sales_price = $variable_product1 ->sale_price;
					$percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),1) ;
						if ($percentage > $maximumper) {
							$maximumper = $percentage;
						}
					}
					echo sprintf( esc_html__('%s Off', 'woodstock' ), $maximumper . '%' ); ?>
	     </span><!-- end onsale -->

	<?php elseif($product->is_on_sale() && $product->product_type == 'simple') : ?>
		
		<span class="ribbon onsale">
		             <?php 
					$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
					echo sprintf( esc_html__('%s Off', 'woodstock' ), $percentage . '%' ); ?>
		</span><!-- end onsale -->

	<?php endif; ?>

<?php } else { ?>
	<?php if ( $product->is_on_sale() ) : ?>

		<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="ribbon onsale">'.esc_attr($tdl_options['tdl_salebadge_text']).'</span>', $post, $product ); ?>

	<?php endif; ?>
<?php } ?>

            <?php 

				if ( (isset($tdl_options['tdl_newbadge'])) && ($tdl_options['tdl_newbadge'] == 1) ) {
			
					$postdate 		= get_the_time( 'Y-m-d' );			// Post date
					$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
					$newness 		= $tdl_options['tdl_newbadge_date']; 	// Newness in days

				if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) { // If the product was published within the newness time frame display the new badge
					  echo '<span class="ribbon newbadge">'.esc_attr($tdl_options['tdl_newbadge_text']).'</span>';
					}				
				}
            ?>



