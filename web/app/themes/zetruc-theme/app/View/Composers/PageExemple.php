<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use App\PostTypes\CustomPost;

class PageExemple extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'page-exemple',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'custom_posts' => CustomPost::getAll(),
            'custom_posts_categories' => CustomPost::getCategories(),
            'recent_posts' => CustomPost::getRecent(3),
        ];
    }
}
