<?php

namespace App\PostTypes;

use App\PostTypes\BasePostType;
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Custom Post Type pour les préférences de boutique utilisateur
 */
class ShopPreferences extends BasePostType
{
    protected $postType = 'shop_preferences';

    public function __construct()
    {
        add_action('init', [$this, 'register']);
        add_action('acf/init', [$this, 'registerFields']);
        add_action('admin_menu', [$this, 'redirect_to_edit'], 99);
    }

    public function register()
    {
        register_post_type($this->postType, [
            'labels' => [
                'name' => 'Préférences Boutique',
                'singular_name' => 'Préférence Boutique',
                'menu_name' => 'Préférences Boutique',
                'edit_item' => 'Éditer les préférences',
                'view_item' => 'Voir les préférences',
            ],
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => false,
            'show_in_nav_menus' => false,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'post',
            'menu_icon' => 'dashicons-admin-settings',
            'supports' => ['title'],
            'menu_position' => 10,
        ]);

        add_action('init', [$this, 'create_global_post'], 99);
    }

    public function registerFields()
    {
        $fields = new FieldsBuilder('shop_display_settings', [
            'title' => 'Paramètres d\'affichage de la boutique',
        ]);

        $fields
            ->addTab('layout_settings', [
                'label' => 'Mise en page',
            ])
            ->addSelect('default_view', [
                'label' => 'Vue par défaut',
                'instructions' => 'Choisir la vue par défaut pour l\'affichage des produits',
                'choices' => [
                    'grid' => 'Grille',
                    'list' => 'Liste',
                ],
                'default_value' => 'grid',
                'required' => 1,
            ])
            ->addSelect('default_products_per_page', [
                'label' => 'Nombre de produits par page',
                'instructions' => 'Nombre de produits à afficher par page',
                'choices' => [
                    '12' => '12 produits',
                    '24' => '24 produits',
                    '36' => '36 produits',
                    '48' => '48 produits',
                    '60' => '60 produits',
                    '-1' => 'Tous les produits',
                ],
                'default_value' => '24',
                'required' => 1,
            ])
            
            ->addTab('product_card', [
                'label' => 'Cartes produits',
            ])
            ->addGroup('product_card_elements', [
                'label' => 'Éléments des cartes produits',
                'instructions' => 'Configurer quels éléments afficher sur les cartes produits',
                'layout' => 'block',
            ])
                ->addTrueFalse('show_category', [
                    'label' => 'Afficher la catégorie',
                    'instructions' => 'Afficher le nom de la catégorie sur la carte produit',
                    'default_value' => 1,
                    'ui' => 1,
                ])
                ->addTrueFalse('show_rating', [
                    'label' => 'Afficher les notes',
                    'instructions' => 'Afficher les étoiles de notation sur la carte produit',
                    'default_value' => 1,
                    'ui' => 1,
                ])
                ->addTrueFalse('show_price', [
                    'label' => 'Afficher le prix',
                    'instructions' => 'Afficher le prix sur la carte produit',
                    'default_value' => 1,
                    'ui' => 1,
                ])
                ->addTrueFalse('show_add_to_cart', [
                    'label' => 'Afficher le bouton panier',
                    'instructions' => 'Afficher le bouton d\'ajout au panier sur la carte produit',
                    'default_value' => 1,
                    'ui' => 1,
                ])
                ->addTrueFalse('show_description', [
                    'label' => 'Afficher la description courte',
                    'instructions' => 'Afficher un extrait de la description sur la carte produit (mode liste uniquement)',
                    'default_value' => 0,
                    'ui' => 1,
                ])
                ->addTrueFalse('show_sale_badge', [
                    'label' => 'Afficher le badge promo',
                    'instructions' => 'Afficher le badge "En promo" sur les produits en solde',
                    'default_value' => 1,
                    'ui' => 1,
                ])
            ->endGroup()
            
            ->addTab('sorting_filters', [
                'label' => 'Tri et filtres',
            ])
            ->addTrueFalse('show_sorting', [
                'label' => 'Afficher le tri',
                'instructions' => 'Permettre aux utilisateurs de trier les produits',
                'default_value' => 1,
                'ui' => 1,
            ])
            ->addTrueFalse('show_result_count', [
                'label' => 'Afficher le nombre de résultats',
                'instructions' => 'Afficher "Affichage de X résultats"',
                'default_value' => 1,
                'ui' => 1,
            ])
            ->addSelect('default_sorting', [
                'label' => 'Tri par défaut',
                'instructions' => 'Ordre de tri par défaut des produits',
                'choices' => [
                    'menu_order' => 'Tri personnalisé',
                    'popularity' => 'Popularité',
                    'rating' => 'Note moyenne',
                    'date' => 'Plus récents',
                    'price' => 'Prix croissant',
                    'price-desc' => 'Prix décroissant',
                ],
                'default_value' => 'menu_order',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'show_sorting',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
            ]);

        $fields
            ->setLocation('post_type', '==', $this->postType);

        acf_add_local_field_group($fields->build());
    }

        /**
     * Rediriger vers l'édition du post unique quand on clique sur le menu
     */
    public function redirect_to_edit()
    {
        if (isset($_GET['post_type']) && $_GET['post_type'] === $this->postType) {
            // Récupérer le post shop_preferences
            $preferences_post = get_posts([
                'post_type' => $this->postType,
                'numberposts' => 1,
                'post_status' => 'any'
            ]);

            if (!empty($preferences_post)) {
                $edit_url = admin_url('post.php?post=' . $preferences_post[0]->ID . '&action=edit');
                wp_redirect($edit_url);
                exit;
            }
        }
    }

    public function create_global_post()
    {
        $existing = get_posts([
            'post_type' => $this->postType,
            'numberposts' => 1,
            'post_status' => 'any'
        ]);

        if (empty($existing)) {
            wp_insert_post([
                'post_title' => 'Préférences boutique',
                'post_type' => $this->postType,
                'post_status' => 'publish',
                'post_content' => 'Configuration de la boutique'
            ]);
        }
    }

    /**
     * Récupère les paramètres actifs
     */
    public static function getActiveSettings()
    {
        $settings = get_posts([
            'post_type' => 'shop_preferences',
            'posts_per_page' => 1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
        ]);

        if (empty($settings)) {
            return self::getDefaultSettings();
        }

        $post = $settings[0];
        $fields = get_fields($post->ID);

        return [
            'default_view' => $fields['default_view'] ?? 'grid',
            'default_products_per_page' => $fields['default_products_per_page'] ?? '24',
            'product_card_elements' => $fields['product_card_elements'] ?? self::getDefaultCardElements(),
            'show_sorting' => $fields['show_sorting'] ?? true,
            'show_result_count' => $fields['show_result_count'] ?? true,
            'default_sorting' => $fields['default_sorting'] ?? 'menu_order',
        ];
    }

    /**
     * Paramètres par défaut
     */
    public static function getDefaultSettings()
    {
        return [
            'default_view' => 'grid',
            'default_products_per_page' => '24',
            'product_card_elements' => self::getDefaultCardElements(),
            'show_sorting' => true,
            'show_result_count' => true,
            'default_sorting' => 'menu_order',
        ];
    }

    /**
     * Éléments de carte par défaut
     */
    public static function getDefaultCardElements()
    {
        return [
            'show_category' => true,
            'show_rating' => true,
            'show_price' => true,
            'show_add_to_cart' => true,
            'show_description' => false,
            'show_sale_badge' => true,
        ];
    }
}
