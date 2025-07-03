<?php

/**
 * WooCommerce setup
 */

namespace App\Setup;

/**
 * Add WooCommerce theme support
 */
add_action('after_setup_theme', function () {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}, 20);



add_action('plugins_loaded', function () {
    // Check if WooCommerce is active and loaded
    if (class_exists('WooCommerce')) {
        // Force re-load of textdomain correctly
        remove_action('plugins_loaded', [WC(), 'load_plugin_textdomain']);
        add_action('init', [WC(), 'load_plugin_textdomain'], 0);
    }
});
/**
 * Init-related actions/hooks that depend on WooCommerce
 */
add_action('init', function () {
    if (!class_exists('WooCommerce')) {
        return;
    }

    // Remove default sale badge
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

    // Hide sorting/result count if needed
    if (is_admin()) {
        return;
    }

    $shop_settings = \App\PostTypes\ShopPreferences::getActiveSettings();

    if (!$shop_settings['show_sorting']) {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    }

    if (!$shop_settings['show_result_count']) {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    }
});

/**
 * Enqueue PhotoSwipe assets only on product pages
 */
add_action('wp_enqueue_scripts', function () {
    if (!function_exists('is_product') || !is_product()) {
        return;
    }

    if (!class_exists('WooCommerce')) {
        return;
    }

    wp_enqueue_style(
        'photoswipe',
        WC()->plugin_url() . '/assets/css/photoswipe/photoswipe.min.css',
        [],
        WC()->version
    );

    wp_enqueue_style(
        'photoswipe-default-skin',
        WC()->plugin_url() . '/assets/css/photoswipe/default-skin/default-skin.min.css',
        ['photoswipe'],
        WC()->version
    );

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
 * Customize WooCommerce gallery classes
 */
add_filter('woocommerce_single_product_image_gallery_classes', function ($classes) {
    $classes[] = 'woocommerce-product-gallery--with-photoswipe';
    return $classes;
});


/**
 * Set default products per page from admin settings
 */
add_action('pre_get_posts', function ($query) {
    if (!class_exists('WooCommerce')) {
        return;
    }

    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category() || is_product_tag())) {
        $shop_settings = \App\PostTypes\ShopPreferences::getActiveSettings();
        $per_page = intval($shop_settings['default_products_per_page']);

        $query->set('posts_per_page', $per_page === -1 ? -1 : $per_page);
    }
});

/**
 * Set default catalog order from admin settings
 */
add_filter('woocommerce_default_catalog_orderby', function () {
    $shop_settings = \App\PostTypes\ShopPreferences::getActiveSettings();
    return $shop_settings['default_sorting'] ?? 'menu_order';
});

/**
 * Add custom body classes for product card settings
 */
add_filter('body_class', function ($classes) {
    if (is_shop() || is_product_category() || is_product_tag()) {
        $shop_settings = \App\PostTypes\ShopPreferences::getActiveSettings();
        $card_elements = $shop_settings['product_card_elements'];

        $classes[] = 'shop-view-' . $shop_settings['default_view'];

        foreach ($card_elements as $option => $value) {
            $classes[] = $option . '-' . ($value ? 'yes' : 'no');
        }
    }

    return $classes;
});

/**
 * Auto-update cart when quantity changes
 */
add_action('wp_head', function () {
    if (function_exists('is_cart') && is_cart()) {
        echo <<<HTML
<style>
.woocommerce button[name="update_cart"],
.woocommerce input[name="update_cart"] {
    display: none;
}
</style>
HTML;
    }
});

add_action('wp_footer', function () {
    if (function_exists('is_cart') && is_cart()) {
        echo <<<HTML
<script>
jQuery(function($) {
    let timeout;
    $('.woocommerce').on('change', 'input.qty', function(){
        if (timeout !== undefined) {
            clearTimeout(timeout);
        }
        timeout = setTimeout(function() {
            $("[name='update_cart']").trigger("click");
        }, 1000);
    });
});
</script>
HTML;
    }
});
