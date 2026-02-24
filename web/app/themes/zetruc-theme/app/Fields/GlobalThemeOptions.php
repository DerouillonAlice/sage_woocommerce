<?php

namespace App\Fields;

defined('ABSPATH') || exit;

/**
 * GlobalThemeOptions
 *
 * Page d'options ACF Pro universelle pour Sage/Bedrock.
 * - Crée une page d'options WP (ACF).
 *
 * @package App\Fields
 */
class GlobalThemeOptions
{
    /**
     * Préfixe de clés ACF (évite collisions inter-sites).
     * @var string
     */
    private string $k = 'gto_'; // global theme options

    /**
     * Slug du menu d'options.
     * @var string
     */
    private string $menu_slug = 'theme-options';

    /**
     * Text domain.
     * @var string
     */
    private string $td = 'app';

    public function __construct()
    {
        add_action('acf/init', [$this, 'register_options_page']);
        add_action('acf/init', [$this, 'register_fields']);
    }

    /**
     * Crée la page d'options (ACF Pro)
     */
    public function register_options_page(): void
    {
        if (!function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page([
            'page_title' => __('Paramètres globaux du site', $this->td),
            'menu_title' => __('Paramètres du site', $this->td),
            'menu_slug'  => $this->menu_slug,
            'capability' => 'edit_posts',
            'icon_url'   => 'dashicons-admin-settings',
            'position'   => 10,
            'redirect'   => false,
            'autoload'   => true,
        ]);
    }

    /**
     * Déclare le groupe de champs (ACF Pro)
     */
    public function register_fields(): void
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        $k = fn(string $suffix) => $this->k . $suffix;

        acf_add_local_field_group([
            'key'                   => $k('group'),
            'title'                 => __('Paramètres globaux du site', $this->td),
            'fields'                => [

                // === Onglet : Informations générales ===
                [
                    'key'       => $k('tab_general'),
                    'label'     => __('Informations générales', $this->td),
                    'type'      => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key'           => $k('footer_address'),
                    'label'         => __('Adresse', $this->td),
                    'name'          => 'footer_address',
                    'type'          => 'wysiwyg',
                    'instructions'  => __('Adresse complète de l\'entreprise', $this->td),
                    'rows'          => 3,
                    'toolbar'       => 'basic',
                    'media_upload'  => 0,
                ],
                [
                    'key'          => $k('footer_phone'),
                    'label'        => __('Téléphone', $this->td),
                    'name'         => 'footer_phone',
                    'type'         => 'text',
                    'instructions' => __('Numéro de téléphone principal', $this->td),
                ],
                [
                    'key'          => $k('footer_email'),
                    'label'        => __('Email', $this->td),
                    'name'         => 'footer_email',
                    'type'         => 'email',
                    'instructions' => __('Adresse email principale', $this->td),
                ],

                // === Onglet : Réseaux Sociaux ===
                [
                    'key'       => $k('tab_social'),
                    'label'     => __('Réseaux Sociaux', $this->td),
                    'type'      => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key'           => $k('social_facebook'),
                    'label'         => __('Facebook', $this->td),
                    'name'          => 'social_facebook',
                    'type'          => 'url',
                    'instructions'  => __('URL de la page Facebook', $this->td),
                    'default_value' => 'https://facebook.com/',
                ],
                [
                    'key'           => $k('social_twitter'),
                    'label'         => __('Twitter', $this->td),
                    'name'          => 'social_twitter',
                    'type'          => 'url',
                    'instructions'  => __('URL du profil Twitter', $this->td),
                    'default_value' => 'https://twitter.com/',
                ],
                [
                    'key'           => $k('social_instagram'),
                    'label'         => __('Instagram', $this->td),
                    'name'          => 'social_instagram',
                    'type'          => 'url',
                    'instructions'  => __('URL du profil Instagram', $this->td),
                    'default_value' => 'https://instagram.com/',
                ],
                [
                    'key'           => $k('social_linkedin'),
                    'label'         => __('LinkedIn', $this->td),
                    'name'          => 'social_linkedin',
                    'type'          => 'url',
                    'instructions'  => __('URL du profil LinkedIn', $this->td),
                    'default_value' => 'https://linkedin.com/',
                ],

                // === Onglet : Page Contact ===
                [
                    'key'       => $k('tab_contact'),
                    'label'     => __('Page Contact', $this->td),
                    'type'      => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key'           => $k('contact_shortcode'),
                    'label'         => __('Shortcode formulaire de contact', $this->td),
                    'name'          => 'contact_form_shortcode',
                    'type'          => 'text',
                    'instructions'  => __('Collez ici le shortcode (Contact Form 7, Gravity Forms, etc.)', $this->td),
                ],
            ],
            'location'              => [[[
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => $this->menu_slug,
            ]]],
            'menu_order'            => 0,
            'position'              => 'normal',
            'style'                 => 'seamless',
            'label_placement'       => 'top',
            'instruction_placement' => 'label',
            'active'                => true,
            'show_in_rest'          => 0,
        ]);
    }
}
