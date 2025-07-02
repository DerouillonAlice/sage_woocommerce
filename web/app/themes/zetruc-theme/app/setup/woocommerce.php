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
