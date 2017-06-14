<?php $tdl_options = woodstock_global_var();?>

<header id="page_header_wrap" class="l-header header-centered">

	    <?php if ( (isset($tdl_options['tdl_topbar_switch'])) && ($tdl_options['tdl_topbar_switch'] == "1" ) ) : ?>                        
	    	<?php get_template_part( 'header', 'topbar' ); ?> 					
	    <?php endif; ?>

	<div class="header-main-section row">

				
				<div class="search-area">
<?php if ( (isset($tdl_options['tdl_header_search_bar'])) && ($tdl_options['tdl_header_search_bar'] == "1") ) : ?>
			        <div class="l-search">

					<?php
					$ajax_url = admin_url( 'admin-ajax.php' );
					$header_search_type = $tdl_options['tdl_header_ajax_search'];
					$header_search_pt = $tdl_options['tdl_header_search_pt'];				
					?> 

			        <?php if ($header_search_type == 1) { ?>
						<div class="ajax-search-wrap search-wrap ajaxsrch" data-ajaxurl="<?php echo esc_url($ajax_url); ?>">
							<div class="ajax-loading <?php echo esc_attr($tdl_options['tdl_header_ajax_loader']); ?>"><div class="spinner"></div></div>
								<form method="get" class="ajax-search-form" action="<?php echo home_url() ?>/">
								<?php if ( $header_search_pt != "any" ) { ?>
									<input type="hidden" name="post_type" value="<?php echo esc_attr($header_search_pt); ?>" />
								<?php } ?>
									<input class="ajax-search-input" type="text" placeholder="<?php esc_attr_e( 'Search', 'woodstock' ) ?>" name="s" autocomplete="off" />
									<button class="ajax-search-submit" type="submit"></button>
								</form>
							<div class="ajax-search-results <?php echo esc_attr($tdl_options['tdl_header_searchboxdrop_color_scheme']); ?>"></div>
						</div>			        
			        <?php } else { ?>
			        	<div class="ajax-search-wrap search-wrap" data-ajaxurl="">
			        		<form method="get" class="ajax-search-form" action="<?php echo home_url() ?>/">
								<?php if ( $header_search_pt != "any" ) { ?>
									<input type="hidden" name="post_type" value="<?php echo esc_attr($header_search_pt); ?>" />
								<?php } ?>
									<input class="ajax-search-input" type="text" placeholder="<?php esc_attr_e( 'Search', 'woodstock' ) ?>" name="s" autocomplete="off" />
									<button class="ajax-search-submit" type="submit"></button>
							</form>		        	
			        	</div>
			        <?php } ?>					

			        </div>
			        <?php endif; ?>				
				</div>
			

			<div class="l-logo">

		            <?php
		                if ( (isset($tdl_options['tdl_site_logo_noretina']['url'])) && (trim($tdl_options['tdl_site_logo_noretina']['url']) != "" ) ) {
		                    if (is_ssl()) {
		                        $site_logo = str_replace("http://", "https://", $tdl_options['tdl_site_logo_noretina']['url']);		
		                    } else {
		                        $site_logo = $tdl_options['tdl_site_logo_noretina']['url'];
		                    }
		            ?>
		    
		                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="site-logo" src="<?php echo esc_url($site_logo); ?>" title="<?php esc_html(bloginfo( 'description' )); ?>" alt="<?php esc_html(bloginfo( 'name' )); ?>" /></a>
		                    
		            <?php } else { ?>

		       			<a class="logo site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h1><?php esc_html(bloginfo( 'name' )); ?></h1></a>
		                    
			                <?php if (isset($tdl_options['tdl_logo_description']) && $tdl_options['tdl_logo_description'] == 1) {?>
			                	<small><?php echo esc_html(get_bloginfo('description')); ?></small>              
							<?php } ?>
	                    
		            <?php } ?>
		                    
		        </div><!-- .site-branding -->
		                
					<?php
		                if ( (isset($tdl_options['tdl_site_logo_retina']['url'])) && (trim($tdl_options['tdl_site_logo_retina']['url']) != "" ) ) {
						?>
						<script>
						//<![CDATA[
							
							// Set pixelRatio to 1 if the browser doesn't offer it up.
							var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;
							
							logo_image = new Image();
							
							jQuery(window).load(function(){
								
								if (pixelRatio > 1) {
									jQuery('.site-logo').each(function() {
										
										var logo_image_width = jQuery(this).width();
										var logo_image_height = jQuery(this).height();
										
										jQuery(this).css("width", logo_image_width);
										jQuery(this).css("height", logo_image_height);

										jQuery(this).attr('src', '<?php echo esc_url($tdl_options['tdl_site_logo_retina']['url']) ?>');
									});
								};
							
							});
							
						//]]>
						</script>
					<?php } ?>		    	


		<div class="header-tools">
			<ul>

			<li class="mobile-menu-button <?php echo esc_attr($tdl_options['tdl_header_mobmenu_color_scheme']); ?>"><a><i class="mobile-menu-icon"></i><span class="mobile-menu-text"><?php esc_attr_e( 'Menu', 'woodstock' ) ?></span></a></li>

			<?php if ( (isset($tdl_options['tdl_header_customer_bar'])) && ($tdl_options['tdl_header_customer_bar'] == "1") ) : ?>
				<li class="contact-area  <?php echo esc_attr($tdl_options['tdl_header_customer_bar_color_scheme']); ?>  <?php echo esc_attr($tdl_options['tdl_header_customerdrop_color_scheme']); ?>">
			    	<!-- Contact Section -->

						<div class="contact-info">
							<div class="inside-content">
								<?php if ( (isset($tdl_options['tdl_header_contactbox_icon'])) && ($tdl_options['tdl_header_contactbox_icon'] != "none") ) : ?>
									<span class="contact-info-icon"></span>
								<?php endif; ?>								
			 					<span class="contact-info-title">
									<?php if ( isset($tdl_options['tdl_header_customer_bar_subtitle']) ) : ?>                        
										<span class="contact-info-subtitle"><?php echo esc_attr($tdl_options['tdl_header_customer_bar_subtitle']); ?></span>					
									<?php endif; ?>	
									<?php echo esc_attr($tdl_options['tdl_header_customer_bar_title']); ?>		 								 										
			 					</span>

			 					<?php if ( (isset($tdl_options['tdl_header_customer_bar_text'])) && (trim($tdl_options['tdl_header_customer_bar_text']) != "" ) ) : ?>
								<span class="contact-info-arrow"></span> 

								<div class="inside-area">
									<div class="inside-area-content">
									<?php echo do_shortcode($tdl_options['tdl_header_customer_bar_text']); ?>
									<div class="after-clear"></div>		
									</div>
								</div>
								<?php endif; ?>
							</div>
						</div>
				</li>
			<?php endif; ?>
			
			<?php if (class_exists('WooCommerce')) : ?>
			<?php if ( (isset($tdl_options['tdl_catalog_mode'])) && ($tdl_options['tdl_catalog_mode'] == 0) ) : ?>
				<!-- Shop Section -->
				<li class="shop-bag <?php echo esc_attr($tdl_options['tdl_header_shopcart_color_scheme']); ?>">
					<a>
						<div class="l-header-shop">	
							<span class="shopbag_items_number"><?php echo WC()->cart->cart_contents_count; ?></span>	    		
							<i class="icon-shop"></i>
							<div class="overview">
								<span class="bag-items-number"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count, 'woodstock' ), WC()->cart->cart_contents_count ); ?></span>
								<?php echo WC()->cart->get_cart_total(); ?>	
							</div>
						</div>
					</a>				
				</li>
			<?php endif; ?>
			<?php endif; ?>

			</ul>		
		</div>
		    	
	</div>	

		<!-- Main Navigation -->

	<?php if( function_exists( 'ubermenu' ) ): ?>
		<div id="site-nav">
			<div class="nav-container row">
				<?php 
					wp_nav_menu(array(
						'theme_location'  => 'main_navigation',
						'fallback_cb'     => false,
						'container'       => false,
						'items_wrap'      => '%3$s',
					));
				?>	
			</div>	
		</div>
	<?php else: ; ?>	
		<div id="site-nav" class="l-nav h-nav <?php echo esc_attr($tdl_options['tdl_mainnav_color_scheme']); ?>  <?php echo esc_attr($tdl_options['tdl_mainnavdrop_color_scheme']); ?>">
			<div class="nav-container row">
 				<nav id="nav" class="nav-holder">
					<ul class="navigation menu tdl-navbar-nav mega_menu">
						<?php echo woodstock_mega_menu();?>
					</ul>	
				</nav> 
			</div>
		</div>	<!-- End Main Navigation -->		
	<?php endif; ?>	

			
</header>