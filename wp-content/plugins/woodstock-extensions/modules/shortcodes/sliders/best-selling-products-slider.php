<?php

// [best_selling_products_slider]
function shortcode_best_selling_products_slider($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'title' => '',
		'per_page'  => '12',
		'columns'  => '4',
		'layout'  => 'listing',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>

    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
     <div class="woocommerce shortcode_products_slider">
         <div id="products-carousel" class="products-carousels-<?php echo $sliderrandomid ?>">

		<?php 
		if ($title != '') {
			echo '<h2 class="carousel-title">' . $title . '</h2>';
		}
		?>	
            <?php
			
			$args = array(
				'post_type' 			=> 'product',
				'post_status' 			=> 'publish',
				'ignore_sticky_posts'   => 1,
				'posts_per_page'		=> $per_page,
				'meta_key' 		 		=> 'total_sales',
				'orderby' 		 		=> 'meta_value_num',
				'meta_query' 			=> array(
					array(
						'key' 		=> '_visibility',
						'value' 	=> array( 'catalog', 'visible' ),
						'compare' 	=> 'IN'
					)
				)
			);
            
            $products = new WP_Query( $args );
            
            if ( $products->have_posts() ) : ?>
                        
            <ul id="products" class="products products-grid product-layout-grid owl-carousel owl-theme">            
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
            
                    <?php wc_get_template_part( 'content', 'product' ); ?>
        
                <?php endwhile; // end of the loop. ?>
            </ul>
                
            <?php
            
            endif;
            
            ?>
        </div>
    </div>
    
    <?php } ?>
    
    <script>
    jQuery(document).ready(function($) {

        "use strict";

        var owl = $('.products-carousels-<?php echo $sliderrandomid ?> #products');
        owl.owlCarousel({
            items:<?php echo $columns; ?>,
            lazyLoad:true,
            dots:false,
            responsiveClass:true,
            nav:true,
            navText: [
                "",
                ""
            ],
            responsive:{
                0:{
                    items:<?php if ($columns == 1) {
                        echo '1';
                    } else {
                        echo '2';
                    }; ?>,
                    nav:false,
                    dots:true,
                },
                600:{
                    items:<?php if ($columns == 1) {
                        echo '1';
                    } else {
                        echo '3';
                    }; ?>,
                    nav:false,
                    dots:true,
                },
                1000:{
                    items:<?php if ($columns == 1) {
                        echo '1';
                    } else {
                        echo '4';
                    }; ?>,
                    nav:true,
                },
                1200:{
                    items:<?php echo $columns; ?>,
                    nav:true,
                }
            }
        });
    
    });
    </script>

	<?php
    wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("best_selling_products_slider", "shortcode_best_selling_products_slider");

