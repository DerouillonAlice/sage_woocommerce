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

add_filter('sage-woocommerce/template', function ($template, $template_name, $args) {
    $blade_templates = [
        'cart',
        'checkout',
        'myaccount',
        'order-received',
    ];

    foreach ($blade_templates as $blade_template) {
        if (strpos($template_name, $blade_template) !== false) {
            $possible = locate_template("woocommerce/{$blade_template}.blade.php");
            if ($possible) {
                return $possible;
            }
        }
    }
    return $template;
}, 20, 3);