<?php 

define( 'WOODSTOCK_WOOCOMMERCE_IS_ACTIVE',	class_exists( 'WooCommerce' ) );
define( 'WOODSTOCK_VISUAL_COMPOSER_IS_ACTIVE',	defined( 'WPB_VC_VERSION' ) );
define( 'WOODSTOCK_REV_SLIDER_IS_ACTIVE',	class_exists( 'RevSlider' ) );
define( 'WOODSTOCK_WPML_IS_ACTIVE',	defined( 'ICL_SITEPRESS_VERSION' ) );
define( 'WOODSTOCK_WISHLIST_IS_ACTIVE',	class_exists( 'YITH_WCWL' ) );
define( 'WOODSTOCK_ACF_IS_ACTIVE',	class_exists( 'ACF' ) );

/*-----------------------------------------------------------------------------------*/
/*	BREADCRUMBS
/*-----------------------------------------------------------------------------------*/

	function woodstock_breadcrumbs() {
		$breadcrumb_output = "";
		
		if ( function_exists('bcn_display') ) {
			$breadcrumb_output .= '<div id="breadcrumbs">'. "\n";
			$breadcrumb_output .= bcn_display(true);
			$breadcrumb_output .= '</div>'. "\n";
		} else if ( function_exists('yoast_breadcrumb') ) {
			$breadcrumb_output .= '<div id="breadcrumbs">'. "\n";
			$breadcrumb_output .= yoast_breadcrumb("","",false);
			$breadcrumb_output .= '</div>'. "\n";
		} else {
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			}
			$breadcrumb_output .= '<div id="breadcrumbs">'. "\n";
			$breadcrumb_output .= do_action('woocommerce_before_main_content_breadcrumb');
			$breadcrumb_output .= '</div>'. "\n";
		}
		
		return $breadcrumb_output;
	}

/*-----------------------------------------------------------------------------------*/
/*	Share
/*-----------------------------------------------------------------------------------*/

function woodstock_share() {
    global $post, $product, $tdl_options;
    if ( (isset($tdl_options['tdl_sharing_options'])) && ($tdl_options['tdl_sharing_options'] == "1" ) ) :
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
?>

<script>
jQuery(document).ready(function($) {
	jQuery('.social-sharing').socialShare({
	    social: '<?php echo implode(',', $tdl_options['tdl_share_select']);?>',
	    animation:'launchpadReverse',
	    blur:true
	});	
});
</script>

    <div class="box-share-master-container" data-name="<?php esc_html_e( 'Share', 'woodstock' )?>">
		<a href="javascript:;" class="social-sharing" data-name="<?php echo get_the_title(); ?>" data-shareimg="<?php echo $image[0]; ?>">
			<i class="fa fa-share-alt"></i>
			<span><?php esc_html_e( 'Share', 'woodstock' )?></span>
		</a>
    </div><!--.box-share-master-container-->

<?php
    endif;
}


/*-----------------------------------------------------------------------------------*/
/*	Main background
/*-----------------------------------------------------------------------------------*/

function woodstock_main_bg_color() {
	global $tdl_options;

	$style = '';
	if ($tdl_options['tdl_layout_type'] != 'fullwidth' && $tdl_options['tdl_background_type'] != 'none') {
		$bg_type = $tdl_options['tdl_background_type'];

		$style = 'style="';
		if ($bg_type == 'color') {
			$style .= 'background-color:' . $tdl_options['tdl_background_color'];
		}
		$style .= '"';
	}

	echo ! isset($bg_cover) ? $style : '';
}

function woodstock_main_bg() {

	global $tdl_options;

	$style = '';
	if ($tdl_options['tdl_layout_type'] != 'fullwidth' && $tdl_options['tdl_background_type'] != 'none') {
		$bg_type = $tdl_options['tdl_background_type'];

		$style = 'style="';
		if ($bg_type == 'color') {
			$style .= 'background-color:' . $tdl_options['tdl_background_color'];
		} elseif ($bg_type == 'custom_back') {
			if (! empty($tdl_options['tdl_background_img']['url'])) {
				$style .= 'background-image:url(' . $tdl_options['tdl_background_img']['url'] . ');' . ($tdl_options['tdl_background_repeat'] ? 'background-repeat:repeat;' : 'background-repeat:no-repeat;background-position:center;background-size:100%;background-size:cover;background-attachment:fixed;');

				$bg_image = '<img class="tdl-page-background" src="' . $tdl_options['tdl_background_img']['url'] . '" alt="" />';
			}
		} elseif ($bg_type == 'pattern_back') {
			$style .= 'background-image:url('. $tdl_options['tdl_pattern_back'] . '); background-repeat:repeat;';
		}
		$style .= '"';

		if ($bg_type != 'color')
			$bg_cover = '<div class="tdl-background-cover' . ($bg_type == 'custom_back' ? ' tdl-image' : '') . '" ' . $style . '></div>';
	}

	if (isset($bg_image)) echo $bg_image;
	if (isset($bg_cover)) echo $bg_cover;
}

/*-----------------------------------------------------------------------------------*/
/*	WPML dropdown
/*-----------------------------------------------------------------------------------*/

	function woodstock_language_and_currency() { 
		global $tdl_options;
		?>

		<?php if ( (isset($tdl_options['tdl_topbar_wpml'])) && (trim($tdl_options['tdl_topbar_wpml']) == "1" ) ) : ?>
            <div class="language-and-currency">
                
                <?php if (function_exists('icl_get_languages')) { ?>
                
                    <?php $additional_languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str'); ?>
                    
                    <select class="topbar-language-switcher">
                        <option><?php echo ICL_LANGUAGE_NAME; ?></option>
                        <?php
                                
                        if (count($additional_languages) > 1) {
                            foreach($additional_languages as $additional_language){
                              if(!$additional_language['active']) $langs[] = '<option value="'.$additional_language['url'].'">'.$additional_language['native_name'].'</option>';
                            }
                            echo join(', ', $langs);
                        }
                        
                        ?>
                    </select>
                
                <?php } ?>
                
                <?php if (class_exists('woocommerce_wpml')) { ?>
                    <?php do_action('currency_switcher', array('format' => '%code% (%symbol%)','switcher_style' => 'dropdown')); ?>
                <?php } ?>
                
            </div><!--.language-and-currency-->
        <?php endif; ?>	

	<?php }

	function woodstock_mob_language_and_currency() { 
		global $tdl_options;
		?>
	
		        <?php if ( (isset($tdl_options['tdl_topbar_wpml'])) && (trim($tdl_options['tdl_topbar_wpml']) == "1" ) ) : ?>
		            <div class="mob-language-and-currency">
		                
		                <?php if (function_exists('icl_get_languages')) { ?>
		                
		                    <?php $additional_languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str'); ?>
		                    
		                    <select class="topbar-language-switcher">
		                        <option><?php echo ICL_LANGUAGE_NAME; ?></option>
		                        <?php
		                                
		                        if (count($additional_languages) > 1) {
		                            foreach($additional_languages as $additional_language){
		                              if(!$additional_language['active']) $langs[] = '<option value="'.$additional_language['url'].'">'.$additional_language['native_name'].'</option>';
		                            }
		                            echo join(', ', $langs);
		                        }
		                        
		                        ?>
		                    </select>
		                
		                <?php } ?>
		                
		                <?php if (class_exists('woocommerce_wpml')) { ?>
		                    <?php do_action('currency_switcher', array('format' => '%code% (%symbol%)','switcher_style' => 'dropdown')); ?>
		                <?php } ?>
		                
		            </div><!--.language-and-currency-->
		        <?php endif; ?>
	<?php }

/*-----------------------------------------------------------------------------------*/
/*	Add Fresco to Galleries
/*-----------------------------------------------------------------------------------*/

add_filter( 'wp_get_attachment_link', 'woodstock_sant_prettyadd', 10, 6);
function woodstock_sant_prettyadd ($content, $id, $size, $permalink, $icon, $text) {
    if ($permalink) {
    	return $content;    
    }
    $content = preg_replace("/<a/","<span class=\"fresco\" data-fresco-group=\"\"", $content, 1);
    return $content;
}

/*-----------------------------------------------------------------------------------*/
/*	Ajax Search
/*-----------------------------------------------------------------------------------*/

	if (!function_exists('woodstock_ajaxsearch')) {
		function woodstock_ajaxsearch() {
			global $tdl_options;

			$header_search_pt = $tdl_options['tdl_header_search_pt'];
			$header_search_type = "search-on";
			$search_term = trim($_POST['s']);
			$search_query_args = array(
				's' => $search_term,
				'post_type' => $header_search_pt,
				'post_status' => 'publish',
				'suppress_filters' => false,
				'numberposts' => -1
			);
			$search_query_args = http_build_query($search_query_args);
			$search_results = get_posts( $search_query_args );
			$count = count($search_results);
			$shown_results = 5;


			$search_results_ouput = "";

			if (!empty($search_results)) {

				$sorted_posts = $post_type = array();

                foreach ( $search_results as $search_result ) {
                    $sorted_posts[ $search_result->post_type ][] = $search_result;
                    // Check we don't already have this post type in the post_type array
                    if ( empty( $post_type[ $search_result->post_type ] ) ) {
                        // Add the post type object to the post_type array
                        $post_type[ $search_result->post_type ] = get_post_type_object( $search_result->post_type );
                    }
                }

				$i = 0;

				foreach ($sorted_posts as $key => $type) {
                    $search_results_ouput .= '<div class="search-result-pt">';				

				if ( $header_search_pt != "any" ) {
					if ($header_search_type == "fs-search-on") {
				        if(isset($post_type[$key]->labels->name)) {
				            $search_results_ouput .= "<h3>".$post_type[$key]->labels->name."</h3>";
				        } else if(isset($key)) {
				            $search_results_ouput .= "<h3>".$key."</h3>";
				        } else {
				            $search_results_ouput .= "<h3>".esc_html__("Other", "woodstock")."</h3>";
				        }
				    }					
				} else {
                    if ( isset( $post_type[ $key ]->labels->name ) ) {
                        $search_results_ouput .= "<h5>" . $post_type[ $key ]->labels->name . "</h5>";
                    } else if ( isset( $key ) ) {
                        $search_results_ouput .= "<h5>" . $key . "</h5>";
                    } else {
                        $search_results_ouput .= "<h5>" . esc_html__( "Other", "woodstock" ) . "</h5>";
                    }
				}

			        foreach ($type as $post) {

			        	$post_title = get_the_title($post->ID);
			        	$post_date = get_the_time(get_option('date_format'), $post->ID);
			        	$post_permalink = get_permalink($post->ID);

			        	$image = get_the_post_thumbnail( $post->ID, 'woodstock-thumb-square' );

			        	if ($image) {
			        		$search_results_ouput .= '<div class="search-result has-img">';
			        		$search_results_ouput .= '<div class="search-item-img"><a href="'.$post_permalink.'">'.$image.'</div>';
			        	} else {
			        		$search_results_ouput .= '<div class="search-result">';
			        	}
						
						$search_results_ouput .= '<a href="'.$post_permalink.'" class="search-result-link"></a>';
						
			            $search_results_ouput .= '<div class="search-item-content">';

			            if ($header_search_type == "fs-search-on") {
			            	$search_results_ouput .= '<h4><a href="'.$post_permalink.'">'.$post_title.'</a></h4>';
			            } else {
			            	$search_results_ouput .= '<h4><a href="'.$post_permalink.'">'.$post_title.'</a></h4>';
			            }

			            if (get_post_type($post) == "product") {
			            	$product = new WC_Product( $post->ID );
			            	// $search_results_ouput .= apply_filters( 'woocommerce_short_description', $post->post_excerpt );
				            $search_results_ouput .= $product->get_price_html();

				            if (!$product->is_in_stock()) {
				            	$search_results_ouput .= '<span class="search-out-stock">'.esc_html__("Out of Stock", "woocommerce").'</span>';
				            }

			            } else {
			            	$search_results_ouput .= '<time>'.$post_date.'</time>';
			            }

			            $search_results_ouput .= '</div>';

			            $search_results_ouput .= '</div>';

			        	$i++;
			        	if ($i == $shown_results) break;
			        }

			       $search_results_ouput .= '</div>';
			        if ($i == $shown_results) break;
			    }

			    if ($count > 1) {
			    	$search_link = get_search_link( $search_term );
			    	
			    	if (strpos($search_link,'?') !== false) {
			    		$search_link .= '&post_type='. $header_search_pt;
			    	} else {
			    		$search_link .= '?post_type='. $header_search_pt;
			    	}
			    	if ($header_search_type == "fs-search-on") {
				    	$search_results_ouput .= '<a href="'.$search_link.'" class="all-results">'.sprintf(esc_html__("View all %d results", "woodstock"), $count).'</a>';
			    	} else {
			    		$search_results_ouput .= '<a href="'.$search_link.'" class="all-results">'.sprintf(esc_html__("View all %d results", "woodstock"), $count).'</a>';
			    	}
			    }

			} else {

				$search_results_ouput .= '<div class="no-search-results">';
				$search_results_ouput .= '<h5>'.esc_html__("No results", "woodstock").'</h5>';
				$search_results_ouput .= '<p>'.esc_html__("No search results could be found, please try another query.", "woodstock").'</p>';
				$search_results_ouput .= '</div>';

			}

			echo $search_results_ouput;
			die();
		}
		add_action('wp_ajax_tdl_ajaxsearch', 'woodstock_ajaxsearch');
		add_action('wp_ajax_nopriv_tdl_ajaxsearch', 'woodstock_ajaxsearch');
	}

/*-----------------------------------------------------------------------------------*/
/*	Post Get URL
/*-----------------------------------------------------------------------------------*/

function woodstock_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/*-----------------------------------------------------------------------------------*/
/*	Post Meta
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woodstock_post_header_entry' ) ) :
function woodstock_post_header_entry( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'woodstock' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark" class="entry-date"><time datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( esc_html__( 'Permalink to %s', 'woodstock' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;


	if ( comments_open() ) :
	  echo '<p>';
	  comments_popup_link( 
    	esc_html__( 'No comments yet', 'woodstock' ), 
    	esc_html__( '1 Comment', 'woodstock' ), 
    	esc_html__( '% Comments', 'woodstock' ),
    	'comments-link',
    	esc_html__( 'Comments are off for this post', 'woodstock' )
);
	  echo '</p>';
	endif;
}
endif;


/*-----------------------------------------------------------------------------------*/
/*	Blog Meta
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woodstock_entry_meta' ) ) :
function woodstock_entry_meta() {
	
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'woodstock' ) . '</span>';

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( esc_html__( ' This entry was posted by ', 'woodstock' ) . '<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'woodstock' ), get_the_author() ) ),
			get_the_author()
		);
	}
	
	/*if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		woodstock_post_header_entry();*/

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( ', ' );
	if ( $categories_list ) {
		echo esc_html__( ' in ', 'woodstock' ) . $categories_list . '';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		echo esc_html__( ' and tagged ', 'woodstock' ) . $tag_list . '';
	}
}
endif;


/*-----------------------------------------------------------------------------------*/
/*	Blog Gallery
/*-----------------------------------------------------------------------------------*/


if ( ! is_admin() ) {

function woodstock_grab_ids_from_gallery() {
			
	global $post;
    
    if ( !isset($post) ) return;
    
	$attachment_ids = array();
	$pattern = get_shortcode_regex();
	$ids = array();
	
	if (preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) ) {   //finds the "gallery" shortcode and puts the image ids in an associative array at $matches[3]
		//$count = count($matches[3]); //in case there is more than one gallery in the post.
		$count = 1;
		for ($i = 0; $i < $count; $i++){
			$atts = shortcode_parse_atts( $matches[3][$i] );
			if ( isset( $atts['ids'] ) ){
				$attachment_ids = explode( ',', $atts['ids'] );
				$ids = array_merge($ids, $attachment_ids);
			}
		}
	}
	
	return $ids;
	
}
add_action( 'wp', 'woodstock_grab_ids_from_gallery' );

}

/*-----------------------------------------------------------------------------------*/
/*	Blog Navigation
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woodstock_content_nav' ) ) :
function woodstock_content_nav( $nav_id ) {
	global $wp_query, $post, $tdl_options;
    
    $blog_with_sidebar = "";
    if ( (isset($tdl_options['tdl_single_blog_layout'])) && ($tdl_options['tdl_single_blog_layout'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];

	
	$blog_masonry = "";
	if ( (isset($tdl_options['tdl_blog_layout'])) && ($tdl_options['tdl_blog_layout'] == "2" ) ) :
		$blog_masonry = "yes";
	endif;
	
	
	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr($nav_class); ?>">

        <div class="row">
        
			<?php if ( $blog_masonry == "yes" && !is_single() ) : ?>
            <div class="large-12 columns">
        	<?php elseif ( $blog_with_sidebar == "yes" ) : ?>
            <div class="large-12 columns">
        	<?php else : ?>
            <div class="large-8 large-centered columns without-sidebar">
        	<?php endif; ?>
        
				<?php if ( is_single() ) : // navigation links for single posts ?>
        
                    <div class="row">
                        
                        <div class="large-6 columns nav-left">
                            <?php previous_post_link( '<div class="nav-previous">%link', '<div class="nav-previous-title">'.esc_html__( "Previous Reading", "woodstock" ).'</div>%title</div>' ); ?>
                        </div><!-- .columns -->
                        
                        <div class="large-6 columns nav-right">
                            <?php next_post_link( '<div class="nav-next">%link', '<div class="nav-next-title">'.esc_html__( "Next Reading", "woodstock" ).'</div> %title</div>' ); ?>
                        </div><!-- .columns -->
                        
                    </div><!-- .row -->
            
				<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
            
					<div class="archive-navigation">
						<div class="row">
							
							<div class="small-6 columns text-left">
								<?php if ( get_next_posts_link() ) : ?>
								<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'woodstock' ) ); ?></div>
								<?php endif; ?>
							</div>
							
							<div class="small-6 columns text-right">
								<?php if ( get_previous_posts_link() ) : ?>
								<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'woodstock' ) ); ?></div>
							<?php endif; ?>
							</div>
						
						</div>
					</div>
				
                <?php endif; ?>
            
            </div><!-- .columns -->
        
        </div><!-- .row -->

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // woodstock_content_nav


/*-----------------------------------------------------------------------------------*/
/*	Blog Comments
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woodstock_comment' ) ) :
function woodstock_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'woodstock' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'woodstock' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<div class="comment-content">
				
				<div class="comment-author-avatar">
					<?php echo get_avatar( $comment, 140 ); ?>
				</div><!-- .comment-author-avatar -->
				
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'woodstock' ); ?></p>
				<?php endif; ?>
				
				<?php printf( esc_html__( '%s', 'woodstock' ), sprintf( '<h3 class="comment-author">%s</h3>', get_comment_author_link() ) ); ?>
                
                <div class="comment-metadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                        <time datetime="<?php comment_time( 'c' ); ?>">
                            <?php printf( esc_html__( '%1$s at %2$s', 'woodstock' ), get_comment_date(), get_comment_time() ); ?>
                        </time>
                    </a>
                </div><!-- .comment-metadata -->

				<div class="comment-text"><?php comment_text(); ?></div><!-- .comment-text -->
                
                <?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<span class="comment-reply"><i class="fa fa-reply"></i>',
						'after'     => '</span>',
					) ) );
				?>
				
				<?php edit_comment_link( esc_html__( 'Edit', 'woodstock' ), '<span class="comment-edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>' ); ?>
                
			</div><!-- .comment-content -->
            
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for woodstock_comment()

/*-----------------------------------------------------------------------------------*/
/*	Import Settings
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'wbc_importer_label_text' ) ) {
	/**
	 * Filter for changing importer label/tab for redux section in options panel
	 * when not setting in Redux config file.
	 *
	 * @param [string] $title label above demos
	 *
	 * @return [string] return no html
	 */
	function wbc_importer_label_text( $label_text ) {
		$label_text = 'Demo Importer';
		return $label_text;
	}
	// Uncomment the below
	add_filter( 'wbc_importer_label', 'wbc_importer_label_text', 10 );
}

/************************************************************************
* Extended Example:
* Way to set menu, import revolution slider, and set home page.
*************************************************************************/
if ( !function_exists( 'wbc_extended_example' ) ) {
	function wbc_extended_example( $demo_active_import , $demo_directory_path ) {
		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		/************************************************************************
		* Import slider(s) for the current demo being imported
		*************************************************************************/
		if ( class_exists( 'RevSlider' ) ) {
			//If it's demo3 or demo5
			$wbc_sliders_array = array(
				'electronics' => 'homepage-slider.zip', //Set slider zip name
				'watch' => 'watch-homepage.zip', 
			);
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}		

		/************************************************************************
		* Setting Menus
		*************************************************************************/
		// If it's demo1 - demo6

		$wbc_menu_array = array( 'electronics','watch');

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$primary_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
			$top_menu = get_term_by( 'name', 'Top Bar Navigation', 'nav_menu' );
			$footer_menu = get_term_by( 'name', 'Footer Navigation', 'nav_menu' );
			$account_menu = get_term_by( 'name', 'My Account Navigation', 'nav_menu' );
		    if ( isset( $primary_menu->term_id ) && isset( $top_menu->term_id ) && isset( $footer_menu->term_id ) && isset( $account_menu->term_id ) ) {
		        set_theme_mod( 'nav_menu_locations', array(
					
					'top-bar-navigation'  => $top_menu->term_id,
					'footer-navigation'     => $footer_menu->term_id,
					'myaccount-navigation'     => $account_menu->term_id,
					'main_navigation' => $primary_menu->term_id,
		            )
		        );
		    }
		}

		/************************************************************************
		* Set HomePage
		*************************************************************************/
		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'electronics' => 'Homepage',
			'watch' => 'Homepage',
		);
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}
	}
	// Uncomment the below
	add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 10, 2 );
}

 ?>