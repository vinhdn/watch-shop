<?php

// [from_the_blog]
function shortcode_from_the_blog($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		"posts" => '9',
		"category" => ''
	), $atts));
	ob_start();
	?> 

    <script>
    jQuery(document).ready(function($) {

        "use strict";

        var owl = $('#from-the-blog-<?php echo $sliderrandomid ?>');
        owl.owlCarousel({
            items:3,
            // lazyLoad:true,
            dots:false,
            responsiveClass:true,
            nav:true,
            navText: [
                "",
                ""
            ],
            responsive:{
                0:{
                    items:1,
                    nav:false,
                },
                600:{
                    items:2,
                    nav:false,
                },
                1000:{
                    items:3,
                    nav:true,
                },
                1200:{
                    items:3,
                    nav:true,
                }
            }
        });
    
    });
    </script>
    
    
	<div class="row">
    <div class="from-the-blog-wrapper">
			<?php 
				if ($title != '') {
					echo '<h2 class="carousel-title">' . $title . '</h2>';
				}
			?>		
        <div id="from-the-blog-<?php echo $sliderrandomid ?>" class="owl-carousel">
					
			<?php
    
            $args = array(
                'post_status' => 'publish',
                'post_type' => 'post',
                'category_name' => $category,
                'posts_per_page' => $posts
            );
            
            $recentPosts = new WP_Query( $args );
            
            if ( $recentPosts->have_posts() ) : ?>
                        
                <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
            
                    <?php $post_format = get_post_format(get_the_ID()); ?>
                    
                    <div class="from_the_blog_item <?php echo $post_format ? $post_format: 'standard'; ?> <?php if ( !has_post_thumbnail()) : ?>no_thumb<?php endif; ?>">
                        
						<a class="from_the_blog_img_link" href="<?php the_permalink() ?>">
							
                                 <div class="from_the_blog_content_desc">
                                    <h3><?php echo get_the_title(); ?></h3>
                                    <div class="blog-slider-meta">
                                        <span class="blog-slider-date"><?php echo get_the_time('d'); ?> <?php echo get_the_time('F'); ?> <?php echo get_the_time('Y'); ?></span>  
                                        <span class="blog-slider-comments"><?php comments_number(__('No comments yet', 'woodstock'), __('1 comment', 'woodstock'), __('% comments', 'woodstock') );?> </span>

                                    </div>               
                                </div> 
                                							
							<?php if ( has_post_thumbnail()) :
								$image_id = get_post_thumbnail_id();
								$image_url = wp_get_attachment_image_src($image_id,'large', true);
							?>
                                <span class="from_the_blog_overlay"></span>
								<span class="from_the_blog_img" style="background-image: url(<?php echo $image_url[0]; ?> );"></span>
								<span class="with_thumb_icon"></span>                               
							<?php else : ?>
								<span class="from_the_blog_noimg"></span>
								<span class="no_thumb_icon"></span>
							<?php endif;  ?>

							
						</a>
                        

                        
                    </div>
        
                <?php endwhile; // end of the loop. ?>
                
            <?php

            endif;
            
            ?> 
              
        </div>
	</div>
    </div>
	
	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("from_the_blog", "shortcode_from_the_blog");