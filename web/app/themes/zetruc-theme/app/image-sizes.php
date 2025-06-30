<?php

/**
 * Register custom image sizes.
 */

namespace App;

add_action('after_setup_theme', function () {
    add_image_size('custom-size', 800, 600, true); 
    add_image_size('banner-size', 1920, 500, true); 
});

