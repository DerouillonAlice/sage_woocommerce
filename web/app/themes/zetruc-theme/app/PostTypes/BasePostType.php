<?php

namespace App\PostTypes;

/**
 * Classe de base pour tous les Custom Post Types
 */
abstract class BasePostType
{
    protected $postType;
    protected $taxonomy;

    public function __construct()
    {
        add_action('init', [$this, 'register']);
        add_action('acf/init', [$this, 'registerFields']);
    }

    abstract public function register();
    abstract public function registerFields();

    public static function getAll($args = [])
    {
        $instance = new static();
        $postType = $instance->postType;
        
        $defaultArgs = [
            'post_type' => $postType,
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ];

        $posts = get_posts(array_merge($defaultArgs, $args));

        return collect($posts)->map(function ($post) use ($postType) {
            return static::formatPost($post, $postType);
        })->all();
    }

    /**
     * Récupère un post spécifique par ID
     */
    public static function getById($id)
    {
        $instance = new static();
        $postType = $instance->postType;
        
        $post = get_post($id);
        
        if (!$post || $post->post_type !== $postType) {
            return null;
        }
        
        return static::formatPost($post, $postType);
    }

    /**
     * Récupère les posts par taxonomie
     */
    public static function getByTaxonomy($taxonomy, $term_slug, $args = [])
    {
        $instance = new static();
        $postType = $instance->postType;
        
        $defaultArgs = [
            'post_type' => $postType,
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => [
                [
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $term_slug,
                ],
            ],
        ];

        $posts = get_posts(array_merge($defaultArgs, $args));

        return collect($posts)->map(function ($post) use ($postType) {
            return static::formatPost($post, $postType);
        })->all();
    }

    /**
     * Récupère les posts publiés seulement
     */
    public static function getPublished($args = [])
    {
        $args['post_status'] = 'publish';
        return static::getAll($args);
    }

    /**
     * Récupère un nombre limité de posts (utile pour les extraits)
     */
    public static function getRecent($limit = 3, $args = [])
    {
        $args['posts_per_page'] = $limit;
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
        return static::getAll($args);
    }

    /**
     * Récupère les catégories formatées
     */
    public static function getCategories($args = [])
    {
        $instance = new static();
        $taxonomy = $instance->taxonomy;
        
        if (!$taxonomy) {
            return [];
        }

        $defaultArgs = [
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
        ];

        $terms = get_terms(array_merge($defaultArgs, $args));

        if (is_wp_error($terms)) {
            return [];
        }

        return collect($terms)->all();
    }

    /**
     * Récupère TOUTES les taxonomies d'un CPT automatiquement
     */
    public static function getAllTaxonomies($args = [])
    {
        $instance = new static();
        $postType = $instance->postType;
        
        // Récupère toutes les taxonomies liées à ce CPT
        $taxonomies = get_object_taxonomies($postType, 'objects');
        $result = [];
        
        foreach ($taxonomies as $taxonomy) {
            $defaultArgs = array_merge([
                'taxonomy' => $taxonomy->name,
                'hide_empty' => true,
            ], $args);

            $terms = get_terms($defaultArgs);

            if (!is_wp_error($terms) && !empty($terms)) {
                $result[$taxonomy->name] = [
                    'taxonomy_info' => [
                        'name' => $taxonomy->label,
                        'slug' => $taxonomy->name,
                        'description' => $taxonomy->description,
                    ],
                    'terms' => collect($terms)->all(),
                ];
            }
        }
        
        return $result;
    }

    /**
     * Formate automatiquement un post avec ses champs ACF
     */
    protected static function formatPost($post, $postType)
    {
        $formatted = ['id' => $post->ID];

        // Récupère tous les champs ACF automatiquement
        $fields = get_fields($post->ID);
        
        if ($fields) {
            foreach ($fields as $key => $value) {
                $formatted[$key] = $value;
            }
        }

        return $formatted;
    }
}
