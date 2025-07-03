<?php

/**
 * WooCommerce setup
 */

namespace App\Setup;

use function Roots\asset;

/**
 * Add WooCommerce support
 */
add_action('after_setup_theme', function () {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
});

/**
 * Enqueue PhotoSwipe scripts and styles
 */
add_action('wp_enqueue_scripts', function () {
    if (!is_product()) {
        return;
    }

    // PhotoSwipe Core CSS
    wp_enqueue_style(
        'photoswipe',
        WC()->plugin_url() . '/assets/css/photoswipe/photoswipe.min.css',
        [],
        WC()->version
    );

    // PhotoSwipe Default Skin CSS
    wp_enqueue_style(
        'photoswipe-default-skin',
        WC()->plugin_url() . '/assets/css/photoswipe/default-skin/default-skin.min.css',
        ['photoswipe'],
        WC()->version
    );

    // PhotoSwipe Scripts
    wp_enqueue_script(
        'photoswipe',
        WC()->plugin_url() . '/assets/js/photoswipe/photoswipe.min.js',
        [],
        WC()->version,
        true
    );

    wp_enqueue_script(
        'photoswipe-ui-default',
        WC()->plugin_url() . '/assets/js/photoswipe/photoswipe-ui-default.min.js',
        ['photoswipe'],
        WC()->version,
        true
    );
}, 15);

/**
 * Customize WooCommerce gallery
 */
add_filter('woocommerce_single_product_image_gallery_classes', function ($classes) {
    $classes[] = 'woocommerce-product-gallery--with-photoswipe';
    return $classes;
});

/**
 * Add hidden PhotoSwipe markup to footer
 */
add_action('wp_footer', function () {
    if (is_product()) {
        wc_get_template('single-product/photoswipe.php');
    }
});

/**
 * Customization hooks for shop page using admin settings
 */

/**
 * Apply default products per page from admin settings
 */
add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category() || is_product_tag())) {
        $shop_settings = \App\PostTypes\ShopPreferences::getActiveSettings();
        $per_page = intval($shop_settings['default_products_per_page']);
        
        if ($per_page === -1) {
            $query->set('posts_per_page', -1);
        } else {
            $query->set('posts_per_page', $per_page);
        }
    }
});

/**
 * Apply default sorting from admin settings
 */
add_filter('woocommerce_default_catalog_orderby', function () {
    $shop_settings = \App\PostTypes\ShopPreferences::getActiveSettings();
    return $shop_settings['default_sorting'] ?? 'menu_order';
});

/**
 * Hide/show sorting dropdown based on admin settings
 */
add_action('init', function () {
    $shop_settings = \App\PostTypes\ShopPreferences::getActiveSettings();
    
    if (!$shop_settings['show_sorting']) {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    }
    
    if (!$shop_settings['show_result_count']) {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    }
});

/**
 * Add CSS classes to body for shop customization
 */
add_filter('body_class', function ($classes) {
    if (is_shop() || is_product_category() || is_product_tag()) {
        $shop_settings = \App\PostTypes\ShopPreferences::getActiveSettings();
        $card_elements = $shop_settings['product_card_elements'];
        
        $classes[] = 'shop-view-' . $shop_settings['default_view'];
        
        // Ajouter des classes pour les options d'affichage
        foreach ($card_elements as $option => $value) {
            $classes[] = $option . '-' . ($value ? 'yes' : 'no');
        }
    }
    
    return $classes;
});
