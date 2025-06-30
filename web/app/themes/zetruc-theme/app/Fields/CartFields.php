<?php

namespace App\Fields;

/**
 * Champs ACF pour le template "Exemple de Page"
 */
class CartFields
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
            'key' => 'group_cart_fields',
            'title' => 'Champs pour panier',
            'fields' => [
                [
                    'key' => 'field_contenu_principal',
                    'label' => 'Contenu principal',
                    'name' => 'contenu_principal',
                    'type' => 'wysiwyg',
                ] 
            ],
            'location' => [
                [
                    [
                        'param' => 'page',
                        'operator' => '==',
                        'value' => '7',
                    ],
                ],
            ],
        ]);
    }
}
