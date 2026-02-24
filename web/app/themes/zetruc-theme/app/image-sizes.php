<?php

/**
 * Register custom image sizes.
 */

namespace App;

add_action('after_setup_theme', function () {
    add_image_size('banner', 1920, 480, false); 
    add_image_size('thumbnail', 150, 150, false);
    add_image_size('medium', 300, 200, false);
    add_image_size('large', 1024, 768, false);
    add_image_size('icon', 100, 100, false);
});

