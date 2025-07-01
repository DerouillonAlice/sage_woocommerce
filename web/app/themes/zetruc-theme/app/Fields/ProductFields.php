<?php

namespace App\Fields;

/**
 * Champs ACF pour le template "Exemple de Page"
 */
class ProductFields
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
            'key' => 'group_product_fields',
            'title' => 'Champs personnalisés produit',
            'fields' => [
                [
                    'key' => 'field_subtitle',
                    'label' => 'Sous-titre',
                    'name' => 'subtitle',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_highlight',
                    'label' => 'Mise en avant',
                    'name' => 'highlight',
                    'type' => 'textarea',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'product',
                    ],
                ],
            ],
        ]);
    }
}