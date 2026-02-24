<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

add_filter('sage-woocommerce/templates', function ($paths) {
    $paths[] = WP_PLUGIN_DIR . '/woocommerce-subscriptions/templates/';
    return $paths;
});


/**
 * Désactiver les styles globaux WordPress injectés automatiquement.
 * Ils seront réenregistrés dans un layer CSS personnalisé.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('global-styles');
    wp_deregister_style('global-styles');
}, 10);

/**
 * Réenregistrer les styles globaux WordPress dans un layer CSS.
 * Cela permet à Tailwind de reprendre correctement la priorité.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    $stylesheet = wp_get_global_stylesheet();
    
    if (empty($stylesheet)) {
        return;
    }

    wp_register_style('global-styles', false);
    wp_add_inline_style('global-styles', "@layer global-block-styles { $stylesheet }");
    wp_enqueue_style('global-styles');

    wp_add_global_styles_for_blocks();
}, 11);