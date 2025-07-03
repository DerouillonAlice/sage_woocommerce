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
        'footer_quick_links_title' => [
            'label' => 'Titre "Liens rapides"',
            'type' => 'text',
            'default_value' => 'Liens rapides',
        ],
        'footer_customer_service_title' => [
            'label' => 'Titre "Service client"',
            'type' => 'text',
            'default_value' => 'Service client',
        ],
        'footer_copyright_text' => [
            'label' => 'Texte copyright',
            'type' => 'text',
            'default_value' => 'Tous droits réservés.',
        ],
        // Liens URL
        'footer_about_link_url' => [
            'label' => 'Lien "À propos"',
            'type' => 'link',
        ],
        'footer_contact_link_url' => [
            'label' => 'Lien "Contact"',
            'type' => 'link',
        ],
        'footer_delivery_link_url' => [
            'label' => 'Lien "Livraison"',
            'type' => 'link',
        ],
        'footer_returns_link_url' => [
            'label' => 'Lien "Retours"',
            'type' => 'link',
        ],
        'footer_faq_link_url' => [
            'label' => 'Lien "FAQ"',
            'type' => 'link',
        ],
        'footer_legal_mentions_link_url' => [
            'label' => 'Lien "Mentions légales"',
            'type' => 'link',
        ],
        'footer_privacy_policy_link_url' => [
            'label' => 'Lien "Politique de confidentialité"',
            'type' => 'link',
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

        // Onglet Informations générales
        $general_fields = [
            [
                'key' => 'field_general_tab',
                'label' => 'Informations générales',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_footer_address',
                'label' => 'Adresse',
                'name' => 'footer_address',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_footer_phone',
                'label' => 'Téléphone',
                'name' => 'footer_phone',
                'type' => 'text',
            ],
            [
                'key' => 'field_footer_email',
                'label' => 'Email',
                'name' => 'footer_email',
                'type' => 'email',
            ],
            [
                'key' => 'field_footer_about_title',
                'label' => 'Titre section "À propos"',
                'name' => 'footer_about_title',
                'type' => 'text',
                'default_value' => 'À propos',
            ],
            [
                'key' => 'field_footer_about_content',
                'label' => 'Contenu section "À propos"',
                'name' => 'footer_about_content',
                'type' => 'textarea',
                'rows' => 4,
            ],
        ];

        // Onglet Réseaux sociaux
        $social_fields = [
            [
                'key' => 'field_social_tab',
                'label' => 'Réseaux sociaux',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_social_facebook',
                'label' => 'Facebook URL',
                'name' => 'social_facebook',
                'type' => 'url',
            ],
            [
                'key' => 'field_social_twitter',
                'label' => 'Twitter URL',
                'name' => 'social_twitter',
                'type' => 'url',
            ],
            [
                'key' => 'field_social_linkedin',
                'label' => 'LinkedIn URL',
                'name' => 'social_linkedin',
                'type' => 'url',
            ],
            [
                'key' => 'field_social_instagram',
                'label' => 'Instagram URL',
                'name' => 'social_instagram',
                'type' => 'url',
            ],
        ];

        // Onglet Navigation
        $navigation_fields = [
            [
                'key' => 'field_navigation_tab',
                'label' => 'Navigation',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_footer_quick_links_title',
                'label' => 'Titre "Liens rapides"',
                'name' => 'footer_quick_links_title',
                'type' => 'text',
                'default_value' => 'Liens rapides',
            ],
            [
                'key' => 'field_footer_customer_service_title',
                'label' => 'Titre "Service client"',
                'name' => 'footer_customer_service_title',
                'type' => 'text',
                'default_value' => 'Service client',
            ],
            [
                'key' => 'field_footer_about_link_url',
                'label' => 'Lien "À propos"',
                'name' => 'footer_about_link_url',
                'type' => 'link',
            ],
            [
                'key' => 'field_footer_contact_link_url',
                'label' => 'Lien "Contact"',
                'name' => 'footer_contact_link_url',
                'type' => 'link',
            ],
            [
                'key' => 'field_footer_delivery_link_url',
                'label' => 'Lien "Livraison"',
                'name' => 'footer_delivery_link_url',
                'type' => 'link',
            ],
            [
                'key' => 'field_footer_returns_link_url',
                'label' => 'Lien "Retours"',
                'name' => 'footer_returns_link_url',
                'type' => 'link',
            ],
            [
                'key' => 'field_footer_faq_link_url',
                'label' => 'Lien "FAQ"',
                'name' => 'footer_faq_link_url',
                'type' => 'link',
            ],
        ];

        // Onglet Mentions légales
        $legal_fields = [
            [
                'key' => 'field_legal_tab',
                'label' => 'Mentions légales',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_footer_copyright_text',
                'label' => 'Texte copyright',
                'name' => 'footer_copyright_text',
                'type' => 'text',
                'default_value' => 'Tous droits réservés.',
            ],
            [
                'key' => 'field_footer_legal_mentions_link_url',
                'label' => 'Lien "Mentions légales"',
                'name' => 'footer_legal_mentions_link_url',
                'type' => 'link',
            ],
            [
                'key' => 'field_footer_privacy_policy_link_url',
                'label' => 'Lien "Politique de confidentialité"',
                'name' => 'footer_privacy_policy_link_url',
                'type' => 'link',
            ],
        ];

        // Combiner tous les champs
        $all_fields = array_merge($general_fields, $social_fields, $navigation_fields, $legal_fields);

        acf_add_local_field_group([
            'key' => 'group_global_settings',
            'title' => 'Paramètres globaux',
            'fields' => $all_fields,
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

