<?php

if ( !function_exists ('woodstock_custom_styles') ) {
function woodstock_custom_styles() {
  global $tdl_options;

  //convert hex to rgb
  function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);
    
    if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    return implode(",", $rgb); // returns the rgb values separated by commas
    //return $rgb; // returns an array with the rgb values
  }

function adjustColorLightenDarken($color_code,$percentage_adjuster = 0) {
    $percentage_adjuster = round($percentage_adjuster/100,2);
    if(is_array($color_code)) {
        $r = $color_code["r"] - (round($color_code["r"])*$percentage_adjuster);
        $g = $color_code["g"] - (round($color_code["g"])*$percentage_adjuster);
        $b = $color_code["b"] - (round($color_code["b"])*$percentage_adjuster);
 
        return array("r"=> round(max(0,min(255,$r))),
            "g"=> round(max(0,min(255,$g))),
            "b"=> round(max(0,min(255,$b))));
    }
    else if(preg_match("/#/",$color_code)) {
        $hex = str_replace("#","",$color_code);
        $r = (strlen($hex) == 3)? hexdec(substr($hex,0,1).substr($hex,0,1)):hexdec(substr($hex,0,2));
        $g = (strlen($hex) == 3)? hexdec(substr($hex,1,1).substr($hex,1,1)):hexdec(substr($hex,2,2));
        $b = (strlen($hex) == 3)? hexdec(substr($hex,2,1).substr($hex,2,1)):hexdec(substr($hex,4,2));
        $r = round($r - ($r*$percentage_adjuster));
        $g = round($g - ($g*$percentage_adjuster));
        $b = round($b - ($b*$percentage_adjuster));
 
        return "#".str_pad(dechex( max(0,min(255,$r)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$g)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$b)) ),2,"0",STR_PAD_LEFT);
    }
}

  ob_start(); 
?>

<!-- ******************************************************************** -->
<!-- Custom CSS Styles -->
<!-- ******************************************************************** -->

<style>

<?php if ( is_page_template( 'page-blank.php' ) ) : ?>
header.l-header,
#site-footer

{
  display:none;
}
<?php endif; ?>


/***************************************************************/
/*  Content Width  *********************************************/
/***************************************************************/
<?php if ( (isset($tdl_options['tdl_maincontent_width'])) && (trim($tdl_options['tdl_maincontent_width']) != "" ) ) : ?>
  .row {
    max-width: <?php echo sprintf("%.3f", $tdl_options['tdl_maincontent_width']/16+2.85714286); ?>rem;  
  }
<?php endif; ?>

<?php if ($tdl_options['tdl_layout_type'] != 'fullwidth' && $tdl_options['tdl_background_type'] != 'none') : ?>
  <?php if ( (isset($tdl_options['tdl_maincontent_width'])) && (trim($tdl_options['tdl_maincontent_width']) != "" ) ) : ?>
  #page-wrap.tdl-boxed {max-width: <?php echo sprintf("%.3f", $tdl_options['tdl_maincontent_width']/16+2.85714286); ?>rem;}
  <?php endif; ?>
<?php endif; ?>

/***************************************************************/
/*  Color Styling  *********************************************/
/***************************************************************/

/* Main Theme Color */

<?php if ( (isset($tdl_options['tdl_main_color'])) && (trim($tdl_options['tdl_main_color']) != "" ) ) : ?>
.woocommerce a.button,
.woocommerce-page a.button,
.woocommerce button.button,
.woocommerce-page button.button,
.woocommerce input.button,
.woocommerce-page input.button,
.woocommerce #respond input#submit,
.woocommerce-page #respond input#submit,
.woocommerce #content input.button,
.woocommerce-page #content input.button,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce #respond input#submit.alt,
.woocommerce #content input.button.alt,
.woocommerce-page a.button.alt,
.woocommerce-page button.button.alt,
.woocommerce-page input.button.alt,
.woocommerce-page #respond input#submit.alt,
.woocommerce-page #content input.button.alt,

.woocommerce #respond input#submit.alt.disabled,
.woocommerce #respond input#submit.alt.disabled:hover,
.woocommerce #respond input#submit.alt:disabled,
.woocommerce #respond input#submit.alt:disabled:hover,
.woocommerce #respond input#submit.alt[disabled]:disabled,
.woocommerce #respond input#submit.alt[disabled]:disabled:hover,
.woocommerce a.button.alt.disabled,
.woocommerce a.button.alt.disabled:hover,
.woocommerce a.button.alt:disabled,
.woocommerce a.button.alt:disabled:hover,
.woocommerce a.button.alt[disabled]:disabled,
.woocommerce a.button.alt[disabled]:disabled:hover,
.woocommerce button.button.alt.disabled,
.woocommerce button.button.alt.disabled:hover,
.woocommerce button.button.alt:disabled,
.woocommerce button.button.alt:disabled:hover,
.woocommerce button.button.alt[disabled]:disabled,
.woocommerce button.button.alt[disabled]:disabled:hover,
.woocommerce input.button.alt.disabled,
.woocommerce input.button.alt.disabled:hover,
.woocommerce input.button.alt:disabled,
.woocommerce input.button.alt:disabled:hover,
.woocommerce input.button.alt[disabled]:disabled,
.woocommerce input.button.alt[disabled]:disabled:hover,
input[type="button"], input[type="reset"], input[type="submit"],

#minicart-offcanvas .widget_shopping_cart .buttons a.view_cart,
.woocommerce #minicart-offcanvas .widget_shopping_cart .buttons a.view_cart,
.select2-drop.orderby-drop .select2-results .select2-highlighted,
.select2-drop.count-drop .select2-results .select2-highlighted,
#button_offcanvas_sidebar_left, #button_offcanvas_sidebar_left i,
.woocommerce .products a.button, .woocommerce-page .products a.button,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce-page .widget_price_filter .price_slider_amount .button,
.my_account_container table.shop_table tbody td.order-actions .account_view_link,
.my_account_container .my_address_wrapper .shipping_billing_wrapper .edit-link a,
.entry-meta .edit-link a,
.widget_calendar tbody tr > td a,
.vc_grid-container-wrapper .vc_grid .vc_btn3
 {
  background: <?php echo esc_html($tdl_options['tdl_main_color']) ?>;
 }

 #jckqv .button {
    background: <?php echo esc_html($tdl_options['tdl_main_color']) ?> !important;
 }

.woocommerce .star-rating span:before,
.woocommerce-page .star-rating span:before,
#jckqv .woocommerce-product-rating .star-rating span::before,
.arthref .icon-container .share-title  h4,
.woocommerce p.stars a:hover::before,
.woocommerce p.stars.selected a:not(.active)::before,
.woocommerce p.stars.selected a.active::before,
.woocommerce p.stars:hover a::before,
.woocommerce .widget_layered_nav ul li.chosen a::before,
.woocommerce .widget_layered_nav_filters ul li a::before {
  color:<?php echo esc_html($tdl_options['tdl_main_color']) ?>;
 }

 .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
 .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle {
  border-color: <?php echo esc_html($tdl_options['tdl_main_color']) ?>;
 }


/* Links */ 
a {
  color:<?php echo esc_html($tdl_options['tdl_color_link']) ?>;
 }

a:hover,
a:focus  {
  color:<?php echo adjustColorLightenDarken($tdl_options['tdl_color_link'],-15) ?>;
  }


/* Main Color Hover */
#minicart-offcanvas .widget_shopping_cart .buttons a.view_cart:hover,
.woocommerce .products a.button:hover, .woocommerce-page .products a.button:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
.woocommerce a.button:hover,
.woocommerce-page a.button:hover,
.woocommerce button.button:hover,
.woocommerce-page button.button:hover,
.woocommerce input.button:hover,
.woocommerce-page input.button:hover,
.woocommerce #respond input#submit:hover,
.woocommerce-page #respond input#submit:hover,
.woocommerce #content input.button:hover,
.woocommerce-page #content input.button:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce #respond input#submit.alt:hover,
.woocommerce #content input.button.alt:hover,
.woocommerce-page a.button.alt:hover,
.woocommerce-page button.button.alt:hover,
.woocommerce-page input.button.alt:hover,
.woocommerce-page #respond input#submit.alt:hover,
.woocommerce-page #content input.button.alt:hover,
.my_account_container table.shop_table tbody td.order-actions .account_view_link:hover,
.my_account_container .my_address_wrapper .shipping_billing_wrapper .edit-link a:hover,
input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover,
.entry-meta .edit-link a:hover,
.widget_calendar tbody tr > td a:hover,
.vc_grid-container-wrapper .vc_grid .vc_btn3:hover
{
  background-color:<?php echo adjustColorLightenDarken($tdl_options['tdl_main_color'],-15) ?>;
}

 #jckqv .button:hover {
    background: <?php echo adjustColorLightenDarken($tdl_options['tdl_main_color'],-15) ?> !important;
 }

<?php endif; ?>

/* Content background */

<?php if ( (isset($tdl_options['tdl_content_bgcolor'])) && (trim($tdl_options['tdl_content_bgcolor']) != "" ) ) : ?>
body,
#page-wrap,
#archive-categories .category-box,
#products li.product-item figure.product-inner:hover,
#content .widget_product_categories .product-categories li.cat-parent > a .child-indicator,
.woocommerce #content .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce-page #content .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce .quantity .qty-plus, .woocommerce .quantity .qty-minus,
.product_navigation .nav-fillslide div,
.product_navigation .nav-fillslide .icon-wrap::before,
#products li.product-item,
#page-wrap.tdl-boxed .boxed-layout,
.slide-from-right,
.single-product-infos .variation-select select option {
  background-color: <?php echo esc_html($tdl_options['tdl_content_bgcolor']) ?>;
}

.bordered::before, .bordered::after {
    background: -webkit-linear-gradient(45deg, rgba(0,0,0,0.03) 0, rgba(0,0,0,0.03) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 100%), linear-gradient(-45deg, rgba(0,0,0,0.03) 0, rgba(0,0,0,0.03) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 100%), <?php echo esc_html($tdl_options['tdl_content_bgcolor']) ?>;
    background: -moz-linear-gradient(45deg, rgba(0,0,0,0.03) 0, rgba(0,0,0,0.03) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 100%), linear-gradient(-45deg, rgba(0,0,0,0.03) 0, rgba(0,0,0,0.03) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 100%), <?php echo esc_html($tdl_options['tdl_content_bgcolor']) ?>;
    background: linear-gradient(45deg, rgba(0,0,0,0.03) 0, rgba(0,0,0,0.03) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 100%), linear-gradient(-45deg, rgba(0,0,0,0.03) 0, rgba(0,0,0,0.03) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 100%), <?php echo esc_html($tdl_options['tdl_content_bgcolor']) ?>; 
    background-position: 50% 50%;
    -webkit-background-size: 20px 20px;
    background-size: 20px 20px;
}

.mc-dark .bordered::before, .mc-dark .bordered::after {
    background: -webkit-linear-gradient(45deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 100%), linear-gradient(-45deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 100%), <?php echo esc_html($tdl_options['tdl_content_bgcolor']) ?>;
    background: -moz-linear-gradient(45deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 100%), linear-gradient(-45deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 100%), <?php echo esc_html($tdl_options['tdl_content_bgcolor']) ?>;
    background: linear-gradient(45deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 100%), linear-gradient(-45deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 100%), <?php echo esc_html($tdl_options['tdl_content_bgcolor']) ?>;

    background-position: 50% 50%;
    -webkit-background-size: 20px 20px;
    background-size: 20px 20px;
}

#products li.product-item:hover,
#content .widget_product_categories .product-categories li {
  border-color: <?php echo esc_html($tdl_options['tdl_content_bgcolor']) ?>;
}

.product-item:hover .product_after_shop_loop {
  border-top-color: <?php echo esc_html($tdl_options['tdl_content_bgcolor']) ?>; 
}
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_product_border'])) && (trim($tdl_options['tdl_product_border']) != 'no-border' ) ) : ?>
  #products li.product-item {
    margin-right: -1px;
    margin-bottom: -1px;
    border: 1px solid <?php echo esc_html($tdl_options['tdl_product_border_color']) ?>;
  }
<?php endif; ?>


/* Top Bar Colors */

.main-navigation ul ul,
.main-navigation ul ul li:first-child ul
{
/*  <?php if ( (isset($tdl_options['tdl_topbar_color_scheme'])) && (trim($tdl_options['tdl_topbar_color_scheme']) != "light" ) ) : ?>
  border-top: 1px solid rgba(255,255,255,0.05);
  <?php else: ?>
  border-top: 1px solid rgba(0,0,0,0.05);
  <?php endif; ?>*/
}

<?php if ( (isset($tdl_options['tdl_topbar_background_color'])) && (trim($tdl_options['tdl_topbar_background_color']) != "" ) ) : ?>
#header-top-bar
{
  background: rgba(<?php echo hex2rgb($tdl_options['tdl_topbar_background_color']); ?>,<?php echo esc_html($tdl_options['tdl_topbar_background_opacity'])/100; ?>);
}
<?php endif; ?>

<?php $border_opacity = (!empty($tdl_options['tdl_topbar_border_opacity'])) ? $tdl_options['tdl_topbar_border_opacity'] : '0';?>

#header-top-bar
  { 
    border-bottom: <?php echo esc_html($tdl_options['tdl_topbar_border']['border-bottom']) ?> <?php echo esc_html($tdl_options['tdl_topbar_border']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_topbar_border']['border-color']); ?>,<?php echo esc_html($border_opacity)/100; ?>);
  }

/* Top Bar Dropdown Background Color */

<?php if ( (isset($tdl_options['tdl_topbar_dropdown_background_color'])) && (trim($tdl_options['tdl_topbar_dropdown_background_color']) != "" ) ) : ?>
#header-top-bar .main-navigation ul ul, .select2-drop.topbar, .select2-drop.topbar .select2-results
{
  background: rgba(<?php echo hex2rgb($tdl_options['tdl_topbar_dropdown_background_color']); ?>,<?php echo esc_html($tdl_options['tdl_topbar_dropdown_background_opacity'])/100; ?>) !important;
}
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_topbar_drop_color_scheme'])) && (trim($tdl_options['tdl_topbar_drop_color_scheme']) != "tbd_light" ) ) : ?>
.select2-drop.topbar, .select2-drop.topbar .select2-results, .select2-drop.topbar .select2-results .select2-result-label
{
    color: #fff !important;
}
<?php endif; ?>


/***************************************************************/
/*  Header Colors  *********************************************/
/***************************************************************/

/* Header Styling */

.l-header 
  { 
    background-color: <?php echo esc_html($tdl_options['tdl_header_background_color']['background-color']) ?>;
<?php if ( (isset($tdl_options['tdl_header_background_color']['background-image'])) && (trim($tdl_options['tdl_header_background_color']['background-image']) != "" ) ) : ?>    
    background-image: url("<?php echo esc_html($tdl_options['tdl_header_background_color']['background-image']) ?>");
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_header_background_color']['background-repeat'])) && (trim($tdl_options['tdl_header_background_color']['background-repeat']) != "" ) ) : ?> 
    background-repeat: <?php echo esc_html($tdl_options['tdl_header_background_color']['background-repeat']) ?>;
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_header_background_color']['background-position'])) && (trim($tdl_options['tdl_header_background_color']['background-position']) != "" ) ) : ?> 
    background-position: <?php echo esc_html($tdl_options['tdl_header_background_color']['background-position']) ?>;
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_header_background_color']['background-size'])) && (trim($tdl_options['tdl_header_background_color']['background-size']) != "" ) ) : ?> 
    background-size: <?php echo esc_html($tdl_options['tdl_header_background_color']['background-size']) ?>;
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_header_background_color']['background-attachment'])) && (trim($tdl_options['tdl_header_background_color']['background-attachment']) != "" ) ) : ?> 
    background-attachment: <?php echo esc_html($tdl_options['tdl_header_background_color']['background-attachment']) ?>;
<?php endif; ?>
  }


/* Search Styling */

<?php $searchbox_background_opacity = (!empty($tdl_options['tdl_header_searchbox_background_opacity'])) ? $tdl_options['tdl_header_searchbox_background_opacity'] : '0';?>

<?php if ( (isset($tdl_options['tdl_header_searchbox_background_color'])) && (trim($tdl_options['tdl_header_searchbox_background_color']) != "" ) ) : ?>
.l-search .ajax-search-wrap input.ajax-search-input
  { 
    background-color: rgba(<?php echo hex2rgb($tdl_options['tdl_header_searchbox_background_color']); ?>,<?php echo esc_html($searchbox_background_opacity)/100; ?>);
  }
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_header_searchbox_background_opacity'])) && (trim($tdl_options['tdl_header_searchbox_background_opacity']) < 1 ) ) : ?>

.l-search .ajax_autosuggest_form_wrapper .ajax_autosuggest_submit,
.l-search .ajax_autosuggest_form_wrapper .ajax_autosuggest_submit:hover,
.l-search .ajax_autosuggest_form_wrapper .ajax_autosuggest_submit:active,
.l-search .ajax_autosuggest_form_wrapper .ajax_autosuggest_submit:visited,
.l-search .widget_product_search input.search-field,
.l-search .widget_search input.search-field,
.l-search .widget_product_search .search-but-added,
.l-search .widget_search .search-but-added
  { 
    background-color: transparent;
  }
<?php endif; ?>

/* Search Box Ajax DropDown Background Color */

<?php $searchboxdrop_bgcolor_opacity = (!empty($tdl_options['tdl_header_searchboxdrop_bgcolor_opacity'])) ? $tdl_options['tdl_header_searchboxdrop_bgcolor_opacity'] : '0';?>

<?php if ( (isset($tdl_options['tdl_header_searchboxdrop_bgcolor_scheme'])) && (trim($tdl_options['tdl_header_searchboxdrop_bgcolor_scheme']) != "" ) ) : ?>

.ajax-search-results
  { 
    background-color: rgba(<?php echo hex2rgb($tdl_options['tdl_header_searchboxdrop_bgcolor_scheme']); ?>,<?php echo esc_html($searchboxdrop_bgcolor_opacity)/100; ?>);
  }


<?php endif; ?>

<?php $searchbox_border_opacity = (!empty($tdl_options['tdl_header_searchbox_border_opacity'])) ? $tdl_options['tdl_header_searchbox_border_opacity'] : '0';?>

.l-search .widget_product_search input.search-field, .l-search .widget_search input.search-field,
.l-search .ajax-search-wrap input.ajax-search-input
  { 
    border-left: <?php echo esc_html($tdl_options['tdl_header_searchbox_border_color']['border-left']) ?> <?php echo esc_html($tdl_options['tdl_header_searchbox_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_searchbox_border_color']['border-color']); ?>,<?php echo esc_html($searchbox_border_opacity)/100; ?>);
    border-right: <?php echo esc_html($tdl_options['tdl_header_searchbox_border_color']['border-right']) ?> <?php echo esc_html($tdl_options['tdl_header_searchbox_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_searchbox_border_color']['border-color']); ?>,<?php echo esc_html($searchbox_border_opacity)/100; ?>);
    border-top: <?php echo esc_html($tdl_options['tdl_header_searchbox_border_color']['border-top']) ?> <?php echo esc_html($tdl_options['tdl_header_searchbox_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_searchbox_border_color']['border-color']); ?>,<?php echo esc_html($searchbox_border_opacity)/100; ?>);
    border-bottom: <?php echo esc_html($tdl_options['tdl_header_searchbox_border_color']['border-bottom']) ?> <?php echo esc_html($tdl_options['tdl_header_searchbox_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_searchbox_border_color']['border-color']); ?>,<?php echo esc_html($searchbox_border_opacity)/100; ?>);
  }


.l-search .ajax-search-wrap input.ajax-search-input::-webkit-input-placeholder,
.l-search .ajax-search-wrap input.ajax-search-input:-moz-placeholder,
.l-search .ajax-search-wrap input.ajax-search-input::-moz-placeholder,
.l-search .ajax-search-wrap input.ajax-search-input:-ms-input-placeholder
 {
  color: <?php echo esc_html($tdl_options['tdl_header_searchbox_input_color']) ?>;
}

.l-search .ajax-search-wrap input.ajax-search-input {
  color: <?php echo esc_html($tdl_options['tdl_header_searchbox_input_color']) ?>;
}

/* Customer Support Styling */

<?php if ( (isset($tdl_options['tdl_header_customer_bar_bgcolor'])) && (trim($tdl_options['tdl_header_customer_bar_bgcolor']) != "" ) ) : ?>
.contact-info
  { 
    background-color: rgba(<?php echo hex2rgb($tdl_options['tdl_header_customer_bar_bgcolor']); ?>,<?php echo esc_html($tdl_options['tdl_header_customer_bar_bgcolor_opacity'])/100; ?>);
    border-left: <?php echo esc_html($tdl_options['tdl_header_customer_bar_border_color']['border-left']) ?> <?php echo esc_html($tdl_options['tdl_header_customer_bar_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_customer_bar_border_color']['border-color']); ?>,<?php echo esc_html($tdl_options['tdl_header_customer_bar_border_opacity'])/100; ?>);
    border-right: <?php echo esc_html($tdl_options['tdl_header_customer_bar_border_color']['border-right']) ?> <?php echo esc_html($tdl_options['tdl_header_customer_bar_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_customer_bar_border_color']['border-color']); ?>,<?php echo esc_html($tdl_options['tdl_header_customer_bar_border_opacity'])/100; ?>);
    border-top: <?php echo esc_html($tdl_options['tdl_header_customer_bar_border_color']['border-top']) ?> <?php echo esc_html($tdl_options['tdl_header_customer_bar_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_customer_bar_border_color']['border-color']); ?>,<?php echo esc_html($tdl_options['tdl_header_customer_bar_border_opacity'])/100; ?>);
    border-bottom: <?php echo esc_html($tdl_options['tdl_header_customer_bar_border_color']['border-bottom']) ?> <?php echo esc_html($tdl_options['tdl_header_customer_bar_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_customer_bar_border_color']['border-color']); ?>,<?php echo esc_html($tdl_options['tdl_header_customer_bar_border_opacity'])/100; ?>);
  }
<?php endif; ?>

/* Customer Support DropDown Background Color */

<?php if ( (isset($tdl_options['tdl_header_customerdrop_bgcolor_scheme'])) && (trim($tdl_options['tdl_header_customerdrop_bgcolor_scheme']) != "" ) ) : ?>
.contact-info .inside-area .inside-area-content
  { 
    background-color: rgba(<?php echo hex2rgb($tdl_options['tdl_header_customerdrop_bgcolor_scheme']); ?>,<?php echo esc_html($tdl_options['tdl_header_customerdrop_bgcolor_opacity'])/100; ?>);
  }
<?php endif; ?>

/* Mobile Menu Button Styling */

<?php if ( (isset($tdl_options['tdl_header_mobmenu_bgcolor'])) && (trim($tdl_options['tdl_header_mobmenu_bgcolor']) != "" ) ) : ?>
.mobile-menu-button a
  { 
    background-color: rgba(<?php echo hex2rgb($tdl_options['tdl_header_mobmenu_bgcolor']); ?>,<?php echo esc_html($tdl_options['tdl_header_mobmenu_bgcolor_opacity'])/100; ?>);
    border-left: <?php echo esc_html($tdl_options['tdl_header_mobmenu_border_color']['border-left']) ?> <?php echo esc_html($tdl_options['tdl_header_mobmenu_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_mobmenu_border_color']['border-color']); ?>,<?php echo esc_html($tdl_options['tdl_header_mobmenu_border_opacity'])/100; ?>);
    border-right: <?php echo esc_html($tdl_options['tdl_header_mobmenu_border_color']['border-right']) ?> <?php echo esc_html($tdl_options['tdl_header_mobmenu_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_mobmenu_border_color']['border-color']); ?>,<?php echo esc_html($tdl_options['tdl_header_mobmenu_border_opacity'])/100; ?>);
    border-top: <?php echo esc_html($tdl_options['tdl_header_mobmenu_border_color']['border-top']) ?> <?php echo esc_html($tdl_options['tdl_header_mobmenu_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_mobmenu_border_color']['border-color']); ?>,<?php echo esc_html($tdl_options['tdl_header_mobmenu_border_opacity'])/100; ?>);
    border-bottom: <?php echo esc_html($tdl_options['tdl_header_mobmenu_border_color']['border-bottom']) ?> <?php echo esc_html($tdl_options['tdl_header_mobmenu_border_color']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_header_mobmenu_border_color']['border-color']); ?>,<?php echo esc_html($tdl_options['tdl_header_mobmenu_border_opacity'])/100; ?>);
  }
<?php endif; ?>

/* Main Menu Styling */

<?php if ( (isset($tdl_options['tdl_mainnav_bgcolor'])) && (trim($tdl_options['tdl_mainnav_bgcolor']) != "" ) ) : ?>
.l-nav
  { 
    background-color: rgba(<?php echo hex2rgb($tdl_options['tdl_mainnav_bgcolor']); ?>,<?php echo esc_html($tdl_options['tdl_mainnav_bgcolor_opacity'])/100; ?>);
    border-top: <?php echo esc_html($tdl_options['tdl_mainnav_border']['border-top']) ?> <?php echo esc_html($tdl_options['tdl_mainnav_border']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_mainnav_border']['border-color']); ?>,<?php echo esc_html($tdl_options['tdl_mainnav_border_opacity'])/100; ?>);
    border-bottom: <?php echo esc_html($tdl_options['tdl_mainnav_border']['border-top']) ?> <?php echo esc_html($tdl_options['tdl_mainnav_border']['border-style']) ?> rgba(<?php echo hex2rgb($tdl_options['tdl_mainnav_border']['border-color']); ?>,<?php echo esc_html($tdl_options['tdl_mainnav_border_opacity'])/100; ?>);
  }
<?php endif; ?>


<?php 
$mainnavdrop_bgcolor = (!empty($tdl_options['tdl_mainnavdrop_bgcolor'])) ? $tdl_options['tdl_mainnavdrop_bgcolor'] : '#ffffff';
$mainnavdrop_bgcolor_opacity = (!empty($tdl_options['tdl_mainnavdrop_bgcolor_opacity'])) ? $tdl_options['tdl_mainnavdrop_bgcolor_opacity'] : '100';
?>

nav#nav ul ul.sub-menu,
#page_header_wrap .tdl-megamenu-wrapper
  { 
    background-color: rgba(<?php echo hex2rgb($mainnavdrop_bgcolor); ?>,<?php echo esc_html($mainnavdrop_bgcolor_opacity)/100; ?>);
  }


/* Stocky Header Styling */

<?php if ( (isset($tdl_options['tdl_sticky_background_color'])) && (trim($tdl_options['tdl_sticky_background_color']) != "" ) ) : ?>
#header-st,
#header-st.sticky-header-not-top
  { 
    background-color: rgba(<?php echo hex2rgb($tdl_options['tdl_sticky_background_color']); ?>,<?php echo esc_html($tdl_options['tdl_sticky_bgcolor_opacity'])/100; ?>);
  }
<?php endif; ?>

/* Sticky Header Menu Styling */

<?php if ( (isset($tdl_options['tdl_stickydrop_bgcolor'])) && (trim($tdl_options['tdl_stickydrop_bgcolor']) != "" ) ) : ?>
#header-st nav#st-nav ul ul.sub-menu,
#header-st .tdl-megamenu-wrapper
  { 
    background-color: rgba(<?php echo hex2rgb($tdl_options['tdl_stickydrop_bgcolor']); ?>,<?php echo esc_html($tdl_options['tdl_stickydrop_bgcolor_opacity'])/100; ?>);
  }

#header-st .tdl-megamenu-wrapper .sub-menu {background-color: transparent !important;}
<?php endif; ?>

/*  Default Main Title Area Styling  */

<?php if ( (isset($tdl_options['tdl_page_title_bgcolor'])) && (trim($tdl_options['tdl_page_title_bgcolor']) != "" ) ) : ?>
.site_header.without_featured_img
  { 
    background-color: <?php echo esc_html($tdl_options['tdl_page_title_bgcolor']);?>;
  }
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_blog_title_bgcolor'])) && (trim($tdl_options['tdl_blog_title_bgcolor']) != "" ) ) : ?>
.blog-content-area .site_header.without_featured_img
  { 
    background-color: <?php echo esc_html($tdl_options['tdl_blog_title_bgcolor']);?>;
  }
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_title_bgcolor'])) && (trim($tdl_options['tdl_title_bgcolor']) != "" ) ) : ?>
.shop-page .site_header.without_featured_img, .site_header.woo-pages.without_featured_img
  { 
    background-color: <?php echo esc_html($tdl_options['tdl_title_bgcolor']);?>;
  }
<?php endif; ?>

/***************************************************************/
/*  Footer Colors  *********************************************/
/***************************************************************/

<?php if ( (isset($tdl_options['tdl_footer_bgcolor'])) && (trim($tdl_options['tdl_footer_bgcolor']) != "" ) ) : ?>
footer#site-footer { 
  background-color: <?php echo esc_html($tdl_options['tdl_footer_bgcolor']);?>;
}

footer#site-footer .f-copyright {
  background-color: <?php echo adjustColorLightenDarken($tdl_options['tdl_footer_bgcolor'],8) ?>;
}
<?php endif; ?>


/***************************************************************/
/*  Fonts  *****************************************************/
/***************************************************************/

.woocommerce a.button,
.woocommerce-page a.button,
.woocommerce button.button,
.woocommerce-page button.button,
.woocommerce input.button,
.woocommerce-page input.button,
.woocommerce #respond input#submit,
.woocommerce-page #respond input#submit,
.woocommerce #content input.button,
.woocommerce-page #content input.button,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce #respond input#submit.alt,
.woocommerce #content input.button.alt,
.woocommerce-page a.button.alt,
.woocommerce-page button.button.alt,
.woocommerce-page input.button.alt,
.woocommerce-page #respond input#submit.alt,
.woocommerce-page #content input.button.alt,
.ajax-search-results .all-results
  { 
    font-family: <?php echo esc_html($tdl_options['tdl_h4_heading_font']['font-family']); ?>;
  }


/***************************************************************/
/*  Header *****************************************************/
/***************************************************************/
   
    <?php
    
    if ( (isset($tdl_options['tdl_site_logo_noretina']['url'])) && (trim($tdl_options['tdl_site_logo_noretina']['url']) != "" ) ) {
      
      if (is_ssl()) {
        $site_logo = str_replace("http://", "https://", $tdl_options['tdl_site_logo_noretina']['url']);    
      } else {
        $site_logo = $tdl_options['tdl_site_logo_noretina']['url'];
      }
      
      //$site_logo_size = getimagesize($site_logo);
      //$site_logo_width = $site_logo_size[0];
      //$site_logo_height = $site_logo_size[1];
    ?>

    .header-main-section .l-logo  {
      height:auto;
      border:0;
      padding:0;
    }

     .header-main-section .header-tools, .header-centered .search-area {
      padding-top: <?php echo ($tdl_options['tdl_site_logo_height']-55)/2?>px;
    }   
    
    <?php if ( (isset($tdl_options['tdl_site_logo_height'])) && (trim($tdl_options['tdl_site_logo_height']) != "" ) ) { ?>
      .header-main-section .l-logo  img {
        height:<?php echo esc_html($tdl_options['tdl_site_logo_height']); ?>px;
        width:auto;
      }
      <?php } ?>

    <?php } else { ?> 
    .header-main-section .l-logo {text-align: <?php echo esc_html($tdl_options['td_logo_font_align']);?>;}
    <?php } ?>

    

    <?php if ( (isset($tdl_options['tdl_header_padding'])) && (trim($tdl_options['tdl_header_padding']) != "" ) ) { ?>
    .header-main-section {
      padding-top:<?php echo esc_html($tdl_options['tdl_header_padding']); ?>px;
      padding-bottom:<?php echo esc_html($tdl_options['tdl_header_padding']); ?>px;
    }
    <?php } ?>

/***************************************************************/
/*  Page Loader Colors *****************************************/
/***************************************************************/

  <?php if ( (isset($tdl_options['tdl_page_loader'])) && (trim($tdl_options['tdl_page_loader']) == "1" ) ) : ?>


    #wstock-loader-wrapper {
        background:  <?php echo esc_html($tdl_options['tdl_page_loader_bg']); ?>;
      }

    .wstock-loader-1 {
      background-color: <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
    }

    .wstock-loader-2 {
      border-top: 0.3em solid rgba(<?php echo hex2rgb($tdl_options['tdl_page_loader_color']);?>,.3);
      border-right: 0.3em solid rgba(<?php echo hex2rgb($tdl_options['tdl_page_loader_color']);?>,.3);
      border-bottom: 0.3em solid rgba(<?php echo hex2rgb($tdl_options['tdl_page_loader_color']);?>,.3);
      border-left: 0.3em solid <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
    }

    .wstock-loader-3 {border-top-color: <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;} 
    .wstock-loader-3:before {
      border-top-color: <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
      opacity: 0.5;
      }

    .wstock-loader-3:after {
      border-top-color: <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
      opacity: 0.2;
      }

    .wstock-loader-4 {
      border: 3px solid <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
    }
    .wstock-loader-4:before, .wstock-loader-4:after {
      background-color: <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
    }
  <?php endif; ?>

/***************************************************************/
/*  Sticky Header ***********************************************/
/***************************************************************/

<?php if ( (isset($tdl_options['tdl_sticky_menu'])) && (trim($tdl_options['tdl_sticky_menu']) == "1" ) ) : ?>
  <?php if ( (isset($tdl_options['tdl_sticky_menu_hide'])) && (trim($tdl_options['tdl_sticky_menu_hide']) == "1" ) ) : ?>
  #header-st {
    -webkit-animation-duration: 0.3s;
       -moz-animation-duration: 0.3s;
         -o-animation-duration: 0.3s;
            animation-duration: 0.3s;
    -webkit-animation-fill-mode: both;
       -moz-animation-fill-mode: both;
         -o-animation-fill-mode: both;
            animation-fill-mode: both;
  }
  <?php endif; ?> 

  <?php if ( (isset($tdl_options['tdl_sticky_menu_mobile'])) && (trim($tdl_options['tdl_sticky_menu_mobile']) == false ) ) : ?>
    @media only screen and (max-width: 74.94em) {
        #header-st.sticky-header-not-top {
          display: none; }
    }
  <?php endif; ?> 
<?php endif; ?> 


/***************************************************************/
/*  Custom Icons ***********************************************/
/***************************************************************/

/*  Search Icon  */
.l-search button.ajax-search-submit:after,
.woocommerce-product-search:after,
.widget_search .search-form:after
 {
    content: "\<?php echo esc_html($tdl_options['tdl_header_search_icon']); ?>";
    color: <?php echo esc_html($tdl_options['tdl_header_search_icon_color']); ?>;
  } 

/*  Spinners Color  */

.l-search .ajax-loading.spinner-bounce .spinner,
.l-search .ajax-loading.spinner-bounce .spinner:before,
.l-search .ajax-loading.spinner-bounce .spinner:after
 {
  background-color: <?php echo esc_html($tdl_options['tdl_header_search_icon_color']); ?>;
  } 

.l-search .ajax-loading.spinner-circle .spinner
 {
  border-color: <?php echo esc_html($tdl_options['tdl_header_search_icon_color']); ?>;
  border-right-color: transparent;
  } 



.l-search .ajax-loading.spinner-dots .spinner:after
 {
  background: rgba(<?php echo hex2rgb($tdl_options['tdl_header_search_icon_color']); ?>,0.5);
  box-shadow: -13px 0 0 0 <?php echo esc_html($tdl_options['tdl_header_search_icon_color']); ?>, 13px 0 0 0 <?php echo esc_html($tdl_options['tdl_header_search_icon_color']); ?>;
  animation: alter 1s ease-in-out infinite;
  } 

  @keyframes alter {
    0%, 100% {
      background-color: rgba(<?php echo hex2rgb($tdl_options['tdl_header_search_icon_color']); ?>,0.5);
      box-shadow: -13px 0 0 0 <?php echo esc_html($tdl_options['tdl_header_search_icon_color']); ?>, 13px 0 0 0 <?php echo esc_html($tdl_options['tdl_header_search_icon_color']); ?>;
    }
    50% {
      background-color: rgba(<?php echo hex2rgb($tdl_options['tdl_header_search_icon_color']); ?>,0.5);
      box-shadow: 0 0 0 0 <?php echo esc_html($tdl_options['tdl_header_search_icon_color']); ?>, 0 0 0 0 <?php echo esc_html($tdl_options['tdl_header_search_icon_color']); ?>;
    }
  }


/*  Search Custom Icon  */

<?php if ( (isset($tdl_options['tdl_header_search_custom_icon']['url'])) && ($tdl_options['tdl_header_search_custom_icon']['url'] != "") ) : ?>
.l-search button.ajax-search-submit:after {

  content: " ";
  background: url("<?php echo esc_url($tdl_options['tdl_header_search_custom_icon']['url']); ?>") !important;
}

<?php endif; ?> 

/*  Customer Support Icon  */

.contact-info .contact-info-icon::after {
    content: "\<?php echo esc_html($tdl_options['tdl_header_contactbox_icon']); ?>";
    color: <?php echo esc_html($tdl_options['tdl_header_customer_bar_icon_color']); ?>;
} 

<?php if ( (isset($tdl_options['tdl_header_customer_bar_icon']['url'])) && ($tdl_options['tdl_header_customer_bar_icon']['url'] != "") ) : ?>
.contact-info .contact-info-icon::after
{content: "";}

.contact-info .contact-info-icon
{
  background: url("<?php echo esc_url($tdl_options['tdl_header_customer_bar_icon']['url']); ?>") no-repeat 50% 50%;
}
<?php endif; ?> 

/*  Shopping Cart Icon  */

.l-header-shop .icon-shop::before {
    content: "\<?php echo esc_html($tdl_options['tdl_header_shopcart_icon']); ?>";
    color: <?php echo esc_html($tdl_options['tdl_header_shopcart_icon_color']); ?>;
}

.l-header-shop .shopbag_items_number {
  color: <?php echo esc_html($tdl_options['tdl_header_shopcart_icon_color']); ?>;
  border-color: <?php echo esc_html($tdl_options['tdl_header_shopcart_icon_color']); ?>;
  background-color: <?php echo esc_html($tdl_options['tdl_header_background_color']['background-color']); ?>;
} 

.l-header-shop:hover .shopbag_items_number {
  color: <?php echo esc_html($tdl_options['tdl_header_background_color']['background-color']); ?>;
  background-color: <?php echo esc_html($tdl_options['tdl_header_shopcart_icon_color']); ?>;
}

/*  Sticky Header Shopping Cart Icon  */

#header-st .l-header-shop .shopbag_items_number {
  background: <?php echo esc_html($tdl_options['tdl_sticky_background_color']); ?>;
} 

#header-st .l-header-shop:hover .shopbag_items_number {
  color: <?php echo esc_html($tdl_options['tdl_sticky_background_color']); ?>;
}

<?php if ( $tdl_options['tdl_header_shopcart_icon'] == 'e606'  ) : ?>
.l-header-shop .shopbag_items_number {
  left: 10px;
  top: 5px;
}
<?php endif; ?> 

<?php if ( (isset($tdl_options['tdl_header_shopcart_custom_icon']['url'])) && ($tdl_options['tdl_header_shopcart_custom_icon']['url'] != "") ) : ?>
.l-header-shop .icon-shop::before
{content: "";}

.l-header-shop .icon-shop
{
  display: inline-block;
  margin-top: 5px;
  width: 45px;
  height: 45px;
  background: url("<?php echo esc_url($tdl_options['tdl_header_shopcart_custom_icon']['url']); ?>") no-repeat 50% 50%;
}
<?php endif; ?> 




/*========== Custom CSS ==========*/

<?php if ( (isset($tdl_options['tdl_custom_css'])) && (trim($tdl_options['tdl_custom_css']) != "" ) ) : ?>
  <?php echo esc_html($tdl_options['tdl_custom_css']) ?>
<?php endif; ?>

</style>



<?php
$content = ob_get_clean();
$content = str_replace(array("\r\n", "\r"), "\n", $content);
$lines = explode("\n", $content);
$new_lines = array();
foreach ($lines as $i => $line) { if(!empty($line)) $new_lines[] = trim($line); }
echo implode($new_lines);
} //function
} //if

add_filter( 'wp_head', 'woodstock_custom_styles', 100 );