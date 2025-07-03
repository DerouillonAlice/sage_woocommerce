<?php

namespace App\Fields;

/**
 * Champs ACF pour le template "Home"
 */
class HomePageFields
{
    public function __construct()
    {
        add_action('acf/init', [$this, 'register']);
    }

    public function register()
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        acf_add_local_field_group([
            'key' => 'group_home_page_fields',
            'title' => 'Champs pour page home',
            'fields' => [
                // Bannière principale
                [
                    'key' => 'field_home_banner',
                    'label' => 'Bannière principale',
                    'name' => 'home_banner',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_home_banner_image',
                            'label' => 'Image',
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'large',
                        ],
                        [
                            'key' => 'field_home_banner_title',
                            'label' => 'Titre',
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_home_banner_text',
                            'label' => 'Texte',
                            'name' => 'text',
                            'type' => 'textarea',
                        ],
                        [
                            'key' => 'field_home_banner_button',
                            'label' => 'Texte du bouton',
                            'name' => 'button_text',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_home_banner_button_url',
                            'label' => 'URL du bouton',
                            'name' => 'button_url',
                            'type' => 'url',
                        ],
                    ],
                ],  
                // Produits à la une 
                [
                    'key' => 'field_featured_products',
                    'label' => 'Produits à la une',
                    'name' => 'featured_products',
                    'type' => 'relationship',
                    'post_type' => ['product'],
                    'max' => 3,
                    'min' => 1,
                    'return_format' => 'id',
                    'instructions' => 'Sélectionnez jusqu’à 3 produits à mettre en avant sur la page d’accueil.',
                    'filters' => ['search'],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-home.blade.php',
                    ],
                ],
            ],
        ]);
    }
}
