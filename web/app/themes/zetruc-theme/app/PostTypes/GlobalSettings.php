<?php

namespace App\PostTypes;

/**
 * Custom Post Type pour les paramètres globaux
 */
class GlobalSettings
{
    private $global_fields = [
        'footer_address' => [
            'label' => 'Adresse',
            'type' => 'textarea',
            'rows' => 3,
        ],
        'footer_phone' => [
            'label' => 'Téléphone',
            'type' => 'text',
        ],
        'footer_email' => [
            'label' => 'Email',
            'type' => 'email',
        ],
        'social_facebook' => [
            'label' => 'Facebook URL',
            'type' => 'url',
        ],
        'social_twitter' => [
            'label' => 'Twitter URL',
            'type' => 'url',
        ],
        'social_linkedin' => [
            'label' => 'LinkedIn URL',
            'type' => 'url',
        ],
        'social_instagram' => [
            'label' => 'Instagram URL',
            'type' => 'url',
        ],
        'footer_about_title' => [
            'label' => 'Titre section "À propos"',
            'type' => 'text',
            'default_value' => 'À propos',
        ],
        'footer_about_content' => [
            'label' => 'Contenu section "À propos"',
            'type' => 'textarea',
            'rows' => 4,
        ],
    ];

    public function __construct()
    {
        add_action('init', [$this, 'register']);
        add_action('acf/init', [$this, 'register_acf_fields']);
        add_action('acf/save_post', [$this, 'save_to_options'], 20);
        add_action('wp', [$this, 'share_with_views']);
        add_action('admin_menu', [$this, 'redirect_to_edit'], 99);
    }

    public function register()
    {
        register_post_type('global', [
            'labels' => [
                'name' => 'Paramètres globaux',
                'singular_name' => 'Paramètre global',
                'menu_name' => 'Paramètres globaux'
            ],
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 10,
            'menu_icon' => 'dashicons-admin-settings',
            'supports' => ['title'],
        ]);

        add_action('init', [$this, 'create_global_post'], 99);
    }

    /**
     * Enregistrer les champs ACF
     */
    public function register_acf_fields()
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        $acf_fields = [];
        foreach ($this->global_fields as $name => $config) {
            $acf_fields[] = array_merge([
                'key' => 'field_' . $name,
                'name' => $name,
            ], $config);
        }

        acf_add_local_field_group([
            'key' => 'group_global_settings',
            'title' => 'Paramètres globaux',
            'fields' => $acf_fields,
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'global',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
        ]);
    }

    /**
     * Rediriger vers l'édition du post unique quand on clique sur le menu
     */
    public function redirect_to_edit()
    {
        if (isset($_GET['post_type']) && $_GET['post_type'] === 'global') {
            // Récupérer le post global
            $global_post = get_posts([
                'post_type' => 'global',
                'numberposts' => 1,
                'post_status' => 'any'
            ]);

            if (!empty($global_post)) {
                $edit_url = admin_url('post.php?post=' . $global_post[0]->ID . '&action=edit');
                wp_redirect($edit_url);
                exit;
            }
        }
    }

    public function create_global_post()
    {
        $existing = get_posts([
            'post_type' => 'global',
            'numberposts' => 1,
            'post_status' => 'any'
        ]);

        if (empty($existing)) {
            wp_insert_post([
                'post_title' => 'Paramètres du site',
                'post_type' => 'global',
                'post_status' => 'publish',
                'post_content' => 'Configuration globale du site'
            ]);
        }
    }

    /**
     * Sauvegarder les champs ACF comme options WordPress
     */
    public function save_to_options($post_id)
    {
        if (get_post_type($post_id) !== 'global') {
            return;
        }

        foreach (array_keys($this->global_fields) as $field) {
            $value = get_field($field, $post_id);
            update_option($field, $value);
        }
    }

    /**
     * Partager les options avec toutes les vues Blade
     */
    public function share_with_views()
    {
        if (function_exists('view')) {
            $shared_data = [];
            
            // Partager automatiquement tous les champs
            foreach (array_keys($this->global_fields) as $field) {
                $shared_data[$field] = get_option($field);
            }
              
            view()->share($shared_data);
        }
    }
}

