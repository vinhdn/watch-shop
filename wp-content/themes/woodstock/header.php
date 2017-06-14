<?php

if (isset($post))
	$page_id = $post->ID;
else
	$page_id = 0;

$tdl_options = woodstock_global_var();
$logo_description = isset($tdl_options['tdl_logo_description']) && $tdl_options['tdl_logo_description'];

if(function_exists('is_woocommerce') && (is_shop() || is_product_category() || is_product_tag()))
$page_id = get_option('woocommerce_shop_page_id');
$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php esc_html(bloginfo( 'charset' )); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_html(bloginfo( 'pingback_url' )); ?>">


    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ): ?>
    <!-- ******************************************************************** -->
    <!-- * Favicon ********************************************************** -->
    <!-- ******************************************************************** -->    	

	    <?php
		if ( (isset($tdl_options['tdl_favicon_image']['url'])) && (trim($tdl_options['tdl_favicon_image']['url']) != "" ) ) {
	        
	        if (is_ssl()) {
	            $favicon_image_img = str_replace("http://", "https://", $tdl_options['tdl_favicon_image']['url']);		
	        } else {
	            $favicon_image_img = $tdl_options['tdl_favicon_image']['url'];
	        }
		?>
	    
	    <link rel="shortcut icon" href="<?php echo esc_url($favicon_image_img); ?>" />
	       
	    <?php } ?>

    <?php endif; ?>

	<?php
		if (is_singular() && get_option('thread_comments'))
			wp_enqueue_script('comment-reply');

		wp_head();
	?>

</head>

<body <?php body_class(); ?> <?php echo woodstock_main_bg_color(); ?>>

	<?php if ( (isset($tdl_options['tdl_page_loader'])) && (trim($tdl_options['tdl_page_loader']) == "1" ) ) : ?>
		<div id="wstock-loader-wrapper">
			<div class="wstock-loader-section">
				<div class="wstock-loader-<?php echo esc_attr($tdl_options['tdl_page_loader_spinner']); ?>"></div>
			</div>
		</div>
	<?php endif; ?>

	<div id="off-container" class="off-container">

	<div class="off-drop">
    <div class="off-drop-after"></div>	
    <div class="off-content">
    
 	<?php echo woodstock_main_bg() ?>

	<div id="page-wrap" class="
	<?php
		echo ($tdl_options['tdl_layout_type'] != 'fullwidth') ? 'tdl-boxed ' : '';
		echo ($tdl_options['tdl_layout_type'] == 'float_box') ? 'tdl-floating-boxed ' : '';
		echo esc_attr($tdl_options['tdl_maincontent_color_scheme']);
	?>">

	<div class="boxed-layout <?php echo esc_attr($tdl_options['tdl_header_searchboxdrop_color_scheme']);?> <?php echo esc_attr($tdl_options['tdl_sidebarnav_color_scheme']); ?>">
               
        <?php if ( isset($tdl_options['main_header_layout']) ) : ?>
								
			<?php if ( $tdl_options['main_header_layout'] == "1" ) : ?>
				<?php get_template_part( 'header', 'default' ); ?>
	        <?php elseif ( $tdl_options['main_header_layout'] == "2" ) : ?>
	        	<?php get_template_part( 'header', 'centered' ); ?>
			<?php endif; ?>	                                
	        <?php else : ?>                          
	            <?php get_template_part( 'header', 'default' ); ?>
        <?php endif; ?>
       