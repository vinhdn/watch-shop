<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 3.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	
	global $post, $product;
	$tdl_options = woodstock_global_var();

    $modal_class = "";
	$zoom_class = "";
	$plus_button = "";
	$video_content = get_field('tdl_video_review');


	if (get_option('woocommerce_enable_lightbox') == "yes") {
        $modal_class = "fresco";
		$zoom_class = "";
		$plus_button = '<span class="product_image_zoom_button"><i class="fa fa-expand"></i></span>';		
    }
	
	if ( (isset($tdl_options['tdl_product_gallery_zoom'])) && ($tdl_options['tdl_product_gallery_zoom'] == "1" ) ) {
		$modal_class = "fresco";
		$zoom_class = "easyzoom el_zoom";
		if (get_option('woocommerce_enable_lightbox') == "yes") {
		$plus_button = '<span class="product_image_zoom_button" data-fresco-group="product-gallery"><i class="fa fa-expand"></i></span>';	
		}
	}	
	
?>

<?php
    
//Featured
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$thumbnail_post    = get_post( $post_thumbnail_id );
$image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
$image_src 					= wp_get_attachment_image_src( $post_thumbnail_id, 'shop_thumbnail' );
$image_data_src				= wp_get_attachment_image_src( $post_thumbnail_id, 'shop_single' );
$image_data_src_original 	= wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$image_link  				= wp_get_attachment_url( $post_thumbnail_id );
$image_link_button  		= esc_url($image_link);
$image       				= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
$image_original				= get_the_post_thumbnail( $post->ID, 'full' );
$attachment_count   		= count( $product->get_gallery_image_ids() );

echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="featured_img_temp">%s</div>', $image ), $post->ID );



?>

<div class="images single-images">

	<?php if ( has_post_thumbnail() ) { ?>
    
    <div class="product_images">
        
        <div id="product-images-carousel" class="owl-carousel owl-theme woocommerce-product-gallery__wrapper"  data-slider-id="1">
    
			<?php

            //Featured
			
			?>
			
			<div class="<?php echo esc_attr($zoom_class); ?> woocommerce-product-gallery__image">

		<?php if ($zoom_class == "easyzoom el_zoom") { ?>
			<?php if (get_option('woocommerce_enable_lightbox') == "yes") { ?> 
            	<a data-fresco-group="product-gallery" data-fresco-options="fit: 'width'" class="<?php echo esc_attr($modal_class); ?>" href="<?php echo esc_url($image_link); ?>">

            <?php } else {	?>
            	<a href="<?php echo esc_url($image_link); ?>">
            <?php }	?>
        <?php }	?>
            
					<?php echo $image; ?>
					<?php echo $plus_button; ?>

		<?php if ($zoom_class == "easyzoom el_zoom") { ?>		
            	</a>
        <?php }	?>
         	           
            </div>
            
			
			<?php
            
			//Thumbs
            
            $attachment_ids = $product->get_gallery_image_ids();
            
            if ( $attachment_ids ) {
                
                foreach ( $attachment_ids as $attachment_id ) {
        
                    $image_link = wp_get_attachment_url( $attachment_id );
        
                    if (!$image_link) continue;
        
                    $image_title       			= esc_attr( get_the_title( $attachment_id ) );
                    $image_src         			= wp_get_attachment_image_src( $attachment_id, 'woodstock_shop_single_small_thumbnail' );
					$image_data_src    			= wp_get_attachment_image_src( $attachment_id, 'shop_single' );
					$image_data_src_original 	= wp_get_attachment_image_src( $attachment_id, 'full' );
					$image_link        			= wp_get_attachment_url( $attachment_id );
				    $image		      			= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
					
					?>                    
								
					<div class="<?php echo esc_attr($zoom_class); ?>">

				<?php if ($zoom_class == "easyzoom el_zoom") { ?>
					<?php if (get_option('woocommerce_enable_lightbox') == "yes") { ?>
                    	<a data-fresco-group="product-gallery" data-fresco-options="fit: 'width'" class="<?php echo esc_attr($modal_class); ?>" href="<?php echo esc_url($image_link); ?>">
		            <?php } else {	?>
		            	<a href="<?php echo esc_url($image_link); ?>">
		            <?php }	?>
		        <?php }	?>

                    <img data-src="<?php echo esc_url($image_data_src[0]); ?>" class="owl-lazy" alt="<?php echo esc_html($image_title); ?>">
							<?php echo $plus_button; ?>

				<?php if ($zoom_class == "easyzoom el_zoom") { ?>
					</a>
				<?php }	?>
				
                    </div>

                    
                	<?php
				
                }
                
            }
            
            ?>
                
    	</div>

	<?php if ($video_content) : ?>
		<a href="<?php echo esc_attr($video_content); ?>" title="<?php esc_html_e('Video', 'woodstock'); ?>" data-fresco-group="product-gallery" data-fresco-options="fit: 'width', width: 1920, height: 1080" class="product_video_button fresco tooltip"><i class="fa fa-play"></i></a>		
	<?php endif; ?> 

    </div><!-- /.product_images -->

	<?php

    } else {
    
        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
    
    }
	
    ?>

</div>

