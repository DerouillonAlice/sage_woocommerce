<?php

namespace App\Fields;

/**
 * Champs ACF pour le template "Exemple de Page"
 */
class CheckoutFields
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
            'key' => 'group_checkout_fields',
            'title' => 'Champs pour panier',
            'fields' => [
                [
                    'key' => 'field_contenu_principal',
                    'label' => 'Titre principal',
                    'name' => 'titre_principal',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_contenu_secondaire',
                    'label' => 'Contenu secondaire',
                    'name' => 'contenu_secondaire',
                    'type' => 'wysiwyg',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page',
                        'operator' => '==',
                        'value' => '8',
                    ],
                ],
            ],
        ]);
    }
}
