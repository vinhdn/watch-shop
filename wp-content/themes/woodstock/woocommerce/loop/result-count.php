<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $wp_query;
if ( ! woocommerce_products_will_display() )
    return;
?>

<?php 
$tdl_options = woodstock_global_var();
$term = get_queried_object();
$parent_id = empty( $term->term_id ) ? 0 : $term->term_id;
$show_ordering = FALSE;
if ( is_shop() && (get_option('woocommerce_shop_page_display') == '') ) $show_ordering = FALSE;
if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'products') ) $show_ordering = FALSE;
if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_ordering = TRUE;
if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $show_ordering = FALSE;
                    
if ( is_product_category() && (get_option('woocommerce_category_archive_display') == '') ) $show_ordering = FALSE;
if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'products') ) $show_ordering = FALSE;

if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) {
    $term = get_queried_object();
    $parent = get_term($term->parent, get_query_var('taxonomy') ); // get parent term
    $children = get_term_children($term->term_id, get_query_var('taxonomy')); // get children

    if(($parent->term_id!="" && sizeof($children)>0)) {
        // has parent and child
        $show_ordering = TRUE;

    } elseif(($parent->term_id!="") && (sizeof($children)==0)) {
        // has parent, no child
        $show_ordering = FALSE;

    } elseif(($parent->term_id=="") && (sizeof($children)>0)) {
        // no parent, has child
        $show_ordering = TRUE;
    } 
} 

if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $show_ordering = FALSE;
                
if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'products') ) $show_ordering = FALSE;
if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) {
    $term = get_queried_object();
    $parent = get_term($term->parent, get_query_var('taxonomy') ); // get parent term
    $children = get_term_children($term->term_id, get_query_var('taxonomy')); // get children

    if(($parent->term_id!="" && sizeof($children)>0)) {
        // has parent and child
        $show_ordering = TRUE;

    } elseif(($parent->term_id!="") && (sizeof($children)==0)) {
        // has parent, no child
        $show_ordering = FALSE;

    } elseif(($parent->term_id=="") && (sizeof($children)>0)) {
        // no parent, has child
        $show_ordering = TRUE;
    } 
} 


if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') ) $show_ordering = FALSE;
?>

<?php if ( $show_ordering == FALSE): ?>

    <p class="woocommerce-result-count">
        <?php
            $paged    = max( 1, $wp_query->get( 'paged' ) );
            $per_page = $wp_query->get( 'posts_per_page' );
            $total    = $wp_query->found_posts;
            $first    = ( $per_page * $paged ) - $per_page + 1;
            $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

            if ( 1 == $total ) {
                echo esc_html__( 'Showing the single product', 'woodstock' );
            } elseif ( $total <= $per_page ) {
                printf( esc_html__( 'Showing all %d products', 'woodstock' ), $total );
            } else {
                printf( esc_html__( 'Showing %1$d-%2$d of %3$d products', 'woodstock' ), $first, $last, $total );
            }
        ?>
    </p>

    <ul class="shop-ordering">

        <?php $product_display_type = $tdl_options['tdl_product_display_type']; ?>

        <li>
            <div class="shop-layout-opts" data-display-type="<?php echo esc_attr($product_display_type); ?>">
                <a href="#" class="layout-opt tooltip" data-layout="grid" title="<?php esc_html_e('Grid Layout', 'woodstock'); ?>"><i class="grid-icon <?php if ($product_display_type == "grid") {echo 'active';} ?>"></i></a>
                <a href="#" class="layout-opt tooltip" data-layout="list" title="<?php esc_html_e('List Layout', 'woodstock'); ?>"><i class="list-icon <?php if ($product_display_type == "list") {echo 'active';} ?>"></i></a>
            </div>           
        </li>

        <li>

        <?php 

        if ($tdl_options['tdl_product_count']) {
            $per_page = explode(',', $tdl_options['tdl_product_count']);
        } else {
            $per_page = explode(',', '12,24,36');
        }

        $page_count = woodstock_loop_shop_per_page();

        ?> 

            <form class="woocommerce-viewing" method="get">
                <select name="count" class="count">
                    <?php foreach ( $per_page as $count ) : ?>
                        <option value="<?php echo esc_attr( $count ); ?>" <?php selected( $page_count, $count ); ?>><?php echo esc_html( $count ); ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="paged" value=""/>
                <?php
                // Keep query string vars intact
                foreach ( $_GET as $key => $val ) {
                    if ( 'count' === $key || 'submit' === $key || 'paged' === $key ) {
                        continue;
                    }
                    if ( is_array( $val ) ) {
                        foreach( $val as $innerVal ) {
                            echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
                        }
                    } else {
                        echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
                    }
                }
                ?>
            </form>
        </li>
        <li><?php do_action( 'woocommerce_before_shop_loop_catalog_ordering' ); ?></li>
        </ul>

<?php endif; ?>