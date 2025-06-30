<?php

namespace App\Fields;

/**
 * Champs ACF pour le template "Exemple de Page"
 */
class ExemplePageFields
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
            'key' => 'group_exemple_page_fields',
            'title' => 'Champs pour page exemple',
            'fields' => [
                [
                    'key' => 'field_titre_hero',
                    'label' => 'Titre Hero',
                    'name' => 'titre_hero',
                    'type' => 'text',
                    'required' => true,
                ],
                [
                    'key' => 'field_sous_titre_hero',
                    'label' => 'Sous-titre Hero',
                    'name' => 'sous_titre_hero',
                    'type' => 'textarea',
                    'rows' => 3,
                ],
                [
                    'key' => 'field_bouton_texte',
                    'label' => 'Texte du bouton',
                    'name' => 'bouton_texte',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_bouton_lien',
                    'label' => 'Lien du bouton',
                    'name' => 'bouton_lien',
                    'type' => 'url',
                ],
                [
                    'key' => 'field_contenu_principal',
                    'label' => 'Contenu principal',
                    'name' => 'contenu_principal',
                    'type' => 'wysiwyg',
                ],
                [
                    'key' => 'field_section_titre',
                    'label' => 'Titre de section',
                    'name' => 'section_titre',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_section_contenu',
                    'label' => 'Contenu de section',
                    'name' => 'section_contenu',
                    'type' => 'wysiwyg',
                ],
                [
                    'key' => 'field_section_image',
                    'label' => 'Image de section',
                    'name' => 'section_image',
                    'type' => 'image',
                    'return_format' => 'url',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-exemple.blade.php',
                    ],
                ],
            ],
        ]);
    }
}
