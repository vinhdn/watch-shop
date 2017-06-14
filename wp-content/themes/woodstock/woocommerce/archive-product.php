<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$tdl_options = woodstock_global_var();
get_header('shop'); 


//woocommerce_before_main_content
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


//woocommerce_before_shop_loop
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action( 'woocommerce_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );


// Sidebar Settings
$shop_has_sidebar = false;

$shop_sidebar = $tdl_options['tdl_sidebar_listing'];
$title_color = $tdl_options['tdl_title_color_scheme'];
$default_image_header = $tdl_options['tdl_default_header_bg']['url'];

if (is_active_sidebar('widgets-product-listing')) {if ($shop_sidebar == 3) {$shop_has_sidebar = false;} else {$shop_has_sidebar = true;}}
    else {$shop_has_sidebar = false;}

if ($shop_sidebar == 1) {$shop_sidebar = 'left-sidebar';} else if ($shop_sidebar == 2) {$shop_sidebar = 'right-sidebar';} else {$shop_sidebar = 'full-width';};
if (isset($_GET["shop_sidebar"])) $shop_sidebar = $_GET["shop_sidebar"];

$no_parallax = "";
if ((isset($tdl_options['tdl_shop_header_parallax'])) && ($tdl_options['tdl_shop_header_parallax'] == 0)) {
    $no_parallax = ' without_parallax';
}
?>

<div id="primary" class="content-area shop-page<?php echo esc_attr($shop_has_sidebar) ? ' '. esc_attr($shop_sidebar):'';?>">

    <!-- Shop Header -->

    <?php 
        if (is_shop()) {
            $page_id = wc_get_page_id('shop');
            $page_title_option = get_field('tdl_hide_title', $page_id);
            $header_content_type = get_field('tdl_page_header_content_type', $page_id);
            $custom_header = get_field('tdl_page_custom_header', $page_id);
            $image_header = get_field('tdl_page_image_header', $page_id);
            $image_header = $image_header['url'];

            if ($header_content_type == 'none') {
                if ($default_image_header) {
                    $header_content_type = 'image';
                    $image_header = $default_image_header;
                } 
            }

            $title_align = get_field('tdl_page_align_select', $page_id);
            $subtitle = get_field('tdl_subtitle', $page_id);
            if (get_field('tdl_align_select', $page_id)) {
                $title_align = get_field('tdl_align_select', $page_id);
            } else {
                $title_align = $tdl_options['tdl_title_align'];
            }
                       
        } else {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $header_content_type = get_field('tdl_header_content_type', $term);
            $custom_header = get_field('tdl_custom_header', $term);
            $image_header = get_field('tdl_image_header', $term);

            $image_header = $image_header['url'];
            
            if ($header_content_type == 'none' or $header_content_type == false) {
                
                if ($default_image_header) {
                    $header_content_type = 'image';
                    $image_header = $default_image_header;
                } 
            }

            if ($header_content_type == 'hide' or $header_content_type == false) {
                $page_title_option = 0;
            } else {
                $page_title_option = 1;
            }


            if (get_field('tdl_align_select', $term)) {
                $title_align = get_field('tdl_align_select', $term);
            } else {
                $title_align = $tdl_options['tdl_title_align'];
            }
        } 
        
     ?>

    <?php if ( $page_title_option == 1 ): ?>
        
        <?php 
        if ($header_content_type !== false && $header_content_type != 'none') {
            if ($header_content_type == 'image')    
                echo '<div class="site_header with_featured_img' . $no_parallax . '" style="background-image:url(' . $image_header . ')">';                                     
            else if ($header_content_type == 'custom') 
                echo '<div class="site_header"><div class="tdl-shop-header-custom">' . $custom_header . '</div>';
        }  else 
                echo '<div class="site_header without_featured_img ' . $title_color . '">';
         ?>


    <?php if ($header_content_type != 'custom'): ?>
        <div class="site_header_overlay"></div>

        <div class="row">
            <div class="large-12 <?php echo esc_attr( $title_align );?> large-centered columns">
                    <?php 
                    if ((isset($tdl_options['tdl_shop_breadcrumb'])) && ($tdl_options['tdl_shop_breadcrumb'] == "1"))
                        {
                        // BREADCRUMBS
                        echo woodstock_breadcrumbs();
                        }
                    ?>

                    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>   
                        <h1 class="page-title on-shop"><?php woocommerce_page_title(); ?></h1>

                        <?php if ( is_shop() ) : ?>
                            <?php if ( !is_search() ) : ?>
                                <?php if ( esc_attr( $subtitle ) ) : ?>
                                    <div class="term-description"><p><?php echo esc_attr( $subtitle ); ?></p></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php do_action( 'woocommerce_archive_description' ); ?>
                        <?php endif; ?>

                    <?php endif; ?>




                    
            </div><!-- .large-12 -->

        </div><!-- .row -->
    <?php endif; ?>
    </div><!-- .site_header -->


                     <?php 
                    // Find the category + category parent, if applicable
                    $term           = get_queried_object();
                    $parent_id      = empty( $term->term_id ) ? 0 : $term->term_id;
                    $categories     = get_terms('product_cat', array('hide_empty' => 1, 'parent' => $parent_id));
                    ?>
                    
                    <?php
                
                    $show_categories = FALSE;
                
                    if ( is_shop() && (get_option('woocommerce_shop_page_display') == '') ) $show_categories = FALSE;
                    if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'products') ) $show_categories = FALSE;
                    if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_categories = FALSE;
                    if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $show_categories = TRUE;
                    
                    if ( is_product_category() && (get_option('woocommerce_category_archive_display') == '') ) $show_categories = FALSE;
                    if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'products') ) $show_categories = FALSE;
                    if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_categories = FALSE;
                    if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $show_categories = TRUE;
                
                    if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'products') ) $show_categories = FALSE;
                    if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $show_categories = FALSE;
                    if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') ) $show_categories = TRUE;
                    
                    if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_categories = FALSE;
                    
                    //echo "Shop Page Display: " . get_option('woocommerce_shop_page_display') . "<br />";                        
                    //echo "Default Category Display: " . get_option('woocommerce_category_archive_display') . "<br />";
                    //echo "Display type (edit product category): " . get_woocommerce_term_meta($term->term_id, 'display_type', true) . "<br />";
                
                    ?>
                
        <?php if ($show_categories == TRUE) : ?>
            <?php if ($categories) : ?>

                <!-- Shop Categories Area -->  

                <div id="archive-categories" <?php if ($header_content_type == 'custom') {echo 'class="custom-header-content"';}; ?> >
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="category-box">                            
                                    
                                <ul class="list_shop_categories <?php if ($tdl_options['main_header_layout'] == 2) {echo 'cat-center';}; ?> ">
                                           
                                    <?php $cat_counter = 0; ?>
                                           
                                    <?php foreach($categories as $category) : ?>

                                        <li class="category_item">
                                            <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

                                            <?php if( $catalog_icon = get_field('tdl_catalog_icon', 'product_cat_'.$category->term_id) ): ?>
                                                <div class="caterory-thumb">
                                                    <img src="<?php echo esc_url($catalog_icon['url']) ?>" alt="">
                                                </div>
                                            <?php endif; ?>

                                                <div class="category-item-desc">
                                                    <h4><?php echo esc_html($category->name); ?></h4>
                                                    <span class="cat-count">
                                                        <?php echo sprintf (_n( '%d item', '%d items', $category->count , 'woodstock'), $category->count ); ?>
                                                    </span>
                                                </div>
                                            </a>   
                                            </li>
                                   
                                    <?php endforeach; ?>
                                           
                                </ul><!-- .list_shop_categories-->
                             </div>
                        </div>
                    </div>
                </div>                       
            <?php endif; ?>
        <?php endif; ?>                   

<?php endif; ?>


    <?php if ( $shop_sidebar != "full-width" ) : ?>
        <?php if (is_active_sidebar( 'widgets-product-listing')) : ?>
            <!-- Shop Sidebar Button --> 
            <div id="button_offcanvas_sidebar_left"><i class="sidebar-icon"></i></div>
        <?php endif; ?>
    <?php endif; ?>  

    <!-- Shop Content Area -->  
                
        <div class="before_main_content">
            <?php do_action( 'woocommerce_before_main_content'); ?>
        </div> 


        <div id="content" class="site-content" role="main">
            <div class="row">

                    <div class="catalog_top"> 
                        <?php do_action( 'woocommerce_before_shop_loop' ); ?>
                    </div>

                        <?php if ( $shop_sidebar != "full-width" ) : ?>
                           
                           <div class="xlarge-2 large-3 columns show-for-large-up sidebar-pos">
                               <div class="shop_sidebar wpb_widgetised_column">
                                    <?php if ( is_active_sidebar( 'widgets-product-listing' ) ) { ?>
                                        <?php dynamic_sidebar( 'widgets-product-listing' ); ?>
                                    <?php } ?>
                               </div>
                           </div>
                           
                           <div class="xlarge-10 large-9 columns content-pos">
                           
                       <?php else : ?>
                       
                           <div class="large-12 columns">
                           
                       <?php endif; ?>

                             <?php 
                            // Find the category + category parent, if applicable
                            $term           = get_queried_object();
                            $parent_id      = empty( $term->term_id ) ? 0 : $term->term_id;
                            $categories     = get_terms('product_cat', array('hide_empty' => 1, 'parent' => $parent_id));
                            ?>
                    
                            <?php                                         
                            $show_categories = FALSE;
            
                            if ( is_shop() && (get_option('woocommerce_shop_page_display') == '') ) $show_categories = FALSE;
                            if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'products') ) $show_categories = FALSE;
                            if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_categories = TRUE;
                            if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $show_categories = FALSE;
                            
                            if ( is_product_category() && (get_option('woocommerce_category_archive_display') == '') ) $show_categories = FALSE;
                            if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'products') ) $show_categories = FALSE;
                            if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_categories = TRUE;
                            if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $show_categories = FALSE;
            
                            if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'products') ) $show_categories = FALSE;
                            if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $show_categories = TRUE;
                            if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') ) $show_categories = FALSE;
                            
                            if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_categories = FALSE;
                            
                            //echo "Shop Page Display: " . get_option('woocommerce_shop_page_display') . "<br />";                        
                            //echo "Default Category Display: " . get_option('woocommerce_category_archive_display') . "<br />";
                            //echo "Display type (edit product category): " . get_woocommerce_term_meta($term->term_id, 'display_type', true) . "<br />";
                        
                            ?>

                            <!-- Shop Order Bar -->

                            <div class="top_bar_shop">

                                <div class="catalog-ordering">
                                    <?php if ( have_posts() ) : ?>
                                            <?php do_action( 'woocommerce_before_shop_loop_result_count' ); ?>
                                    <?php endif; ?>
                                </div> <!--catalog-ordering-->
                                <div class="clearfix"></div>
                            </div><!-- .top_bar_shop-->                            
                            
                            <?php if (!is_paged()) : //show categories only on first page ?>
                                <?php if ($show_categories == TRUE) : ?>
                                    <?php if ($categories) : ?>

                                    <?php 

                                    if ( ( isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'] != "" ) ) {
                                        $categories_per_column = $woocommerce_loop['columns'];
                                    } else {
                                        if ( ( !isset($tdl_options['tdl_categories_per_column']) ) ) {
                                            $categories_per_column = 4;
                                        } else {
                                            $categories_per_column = $tdl_options['tdl_categories_per_column'];
                                            
                                            if (isset($_GET["categories_per_row"])) $categories_per_column = $_GET["categories_per_row"];
                                        }
                                    }

                                    if ($categories_per_column == 6) {
                                        $categories_per_column_xlarge = 6;
                                        $categories_per_column_large = 4;
                                        $categories_per_column_medium = 3;
                                    }

                                    if ($categories_per_column == 5) {
                                        $categories_per_column_xlarge = 5;
                                        $categories_per_column_large = 4;
                                        $categories_per_column_medium = 3;
                                    }

                                    if ($categories_per_column == 4) {
                                        $categories_per_column_xlarge = 4;
                                        $categories_per_column_large = 4;
                                        $categories_per_column_medium = 3;
                                    }

                                    if ($categories_per_column == 3) {
                                        $categories_per_column_xlarge = 3;
                                        $categories_per_column_large = 3;
                                        $categories_per_column_medium = 2;
                                    }

                                    if ($categories_per_column == 2) {
                                        $categories_per_column_xlarge = 2;
                                        $categories_per_column_large = 2;
                                        $categories_per_column_medium = 2;
                                    }
                                    ?>


                                    <ul id="products" class="product-category-list small-block-grid-1 medium-block-grid-<?php echo esc_attr($categories_per_column_medium); ?> large-block-grid-<?php echo esc_attr($categories_per_column_large); ?> xlarge-block-grid-<?php echo esc_attr($categories_per_column_xlarge); ?> xxlarge-block-grid-<?php echo esc_attr($categories_per_column); ?> columns-<?php echo esc_attr($categories_per_column); ?>">

                                        <?php $cat_number = count($categories); ?>
                                                                            
                                        <?php foreach($categories as $category) : ?>
                                                                                
                                        <?php                        
                                            $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
                                            $image = wp_get_attachment_url( $thumbnail_id );
                                        ?>
                                                                        
                                                             
                                        <li class="category_grid_item">
                                            <div class="category_grid_box">
                                                <span class="category_item_bkg" style="background-image:url(<?php echo esc_url($image); ?>)"></span>
                                                <a class="category_item" href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
                                                    <span class="category_name">
                                                        <h3><?php echo esc_html($category->name); ?></h3>
                                                        <span><?php echo sprintf (_n( '%d item', '%d items', $category->count, 'woodstock' ), $category->count ); ?></span>
                                                    </span>
                                                </a>
                                            </div>                                           
                                        </li>
                                                                                
                                        <?php endforeach; ?>
                                    </ul>                                           


                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php              
                            $show_products = TRUE;
                            if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_products = FALSE;
                            // if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_products = FALSE;

                            if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) {
                                $term = get_queried_object();
                                $parent = get_term($term->parent, get_query_var('taxonomy') ); // get parent term
                                $children = get_term_children($term->term_id, get_query_var('taxonomy')); // get children


                                if(($parent->term_id!="" && sizeof($children)>0)) {

                                    // has parent and child
                                    $show_products = FALSE;

                                }elseif(($parent->term_id!="") && (sizeof($children)==0)) {

                                    // has parent, no child
                                    $show_products = TRUE;

                                }elseif(($parent->term_id=="") && (sizeof($children)>0)) {

                                    // no parent, has child
                                    $show_products = FALSE;

                                } 
                            } 

                          

                            if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $show_products = FALSE;
                            
                            if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_products = TRUE;       
                            ?>

                            <?php if ($show_products == TRUE) : ?>
                    
                                <?php if ( have_posts() ) : ?>
                                    
                                    <?php do_action( 'woocommerce_before_shop_loop' ); ?>
                        
                                        <div class="active_filters_ontop"><?php the_widget( 'WC_Widget_Layered_Nav_Filters', 'title=' ); ?></div>
                                            <?php woocommerce_product_loop_start(); ?>            
                                                <?php while ( have_posts() ) : the_post(); ?>                            
                                                    <?php wc_get_template_part( 'content', 'product' ); ?>                            
                                                <?php endwhile; // end of the loop. ?>                            
                                            <?php woocommerce_product_loop_end(); ?>
                                            

                                    <div class="woocommerce-after-shop-loop-wrapper">
                                        <?php do_action( 'woocommerce_after_shop_loop' ); ?>
                                    </div>
                                    
                                <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
                                
                                    <?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
                        
                                <?php endif; ?>
                            
                            <?php endif; ?>
                            

                            <?php do_action('woocommerce_after_main_content'); ?>

                            
                            </div><!-- .large-9 or .large-12 -->
                    

            </div><!-- .row -->
        </div><!-- #content --> 



</div><!-- #primary -->

<?php get_footer('shop'); ?>