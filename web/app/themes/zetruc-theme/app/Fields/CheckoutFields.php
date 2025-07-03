<?php

namespace App\Fields;

/**
 * Champs ACF pour le template Checkout
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
            'title' => 'Champs pour le checkout',
            'fields' => [
                // Onglet Principal
                [
                    'key' => 'field_tab_checkout_main',
                    'label' => 'Informations générales',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                
                // Groupe En-tête
                [
                    'key' => 'field_group_checkout_header',
                    'label' => 'En-tête de la page',
                    'name' => 'checkout_header',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_checkout_title',
                            'label' => 'Titre de la page checkout',
                            'name' => 'title',
                            'type' => 'text',
                            'default_value' => 'Finaliser votre commande',
                        ],
                        [
                            'key' => 'field_checkout_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'textarea',
                            'rows' => 2,
                            'default_value' => 'Vérifiez vos informations et procédez au paiement en toute sécurité',
                        ],
                    ],
                ],

                // Onglet Sections
                [
                    'key' => 'field_tab_checkout_sections',
                    'label' => 'Sections du formulaire',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                
                // Groupe Informations client
                [
                    'key' => 'field_group_customer_info',
                    'label' => 'Informations client',
                    'name' => 'customer_info',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_billing_title',
                            'label' => 'Titre section facturation',
                            'name' => 'billing_title',
                            'type' => 'text',
                            'default_value' => 'Informations de facturation',
                        ],
                        [
                            'key' => 'field_billing_icon',
                            'label' => 'Icône facturation (FontAwesome)',
                            'name' => 'billing_icon',
                            'type' => 'text',
                            'default_value' => 'fas fa-user',
                            'instructions' => 'Exemple: fas fa-user, fas fa-address-card, etc.',
                        ],
                        [
                            'key' => 'field_shipping_title',
                            'label' => 'Titre section livraison',
                            'name' => 'shipping_title',
                            'type' => 'text',
                            'default_value' => 'Adresse de livraison',
                        ],
                        [
                            'key' => 'field_shipping_icon',
                            'label' => 'Icône livraison (FontAwesome)',
                            'name' => 'shipping_icon',
                            'type' => 'text',
                            'default_value' => 'fas fa-shipping-fast',
                            'instructions' => 'Exemple: fas fa-shipping-fast, fas fa-truck, etc.',
                        ],
                    ],
                ],

                // Groupe Récapitulatif commande
                [
                    'key' => 'field_group_order_summary',
                    'label' => 'Récapitulatif de commande',
                    'name' => 'order_summary',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_summary_title',
                            'label' => 'Titre du récapitulatif',
                            'name' => 'title',
                            'type' => 'text',
                            'default_value' => 'Récapitulatif de votre commande',
                        ],
                        [
                            'key' => 'field_summary_icon',
                            'label' => 'Icône récapitulatif (FontAwesome)',
                            'name' => 'icon',
                            'type' => 'text',
                            'default_value' => 'fas fa-clipboard-list',
                            'instructions' => 'Exemple: fas fa-clipboard-list, fas fa-receipt, etc.',
                        ],
                    ],
                ],

                // Onglet Messages
                [
                    'key' => 'field_tab_checkout_messages',
                    'label' => 'Messages et notifications',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                
                // Groupe Messages
                [
                    'key' => 'field_group_checkout_messages',
                    'label' => 'Messages système',
                    'name' => 'messages',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_login_required_message',
                            'label' => 'Message connexion requise',
                            'name' => 'login_required',
                            'type' => 'textarea',
                            'rows' => 2,
                            'default_value' => 'Vous devez être connecté pour finaliser votre commande.',
                        ],
                        [
                            'key' => 'field_login_button_text',
                            'label' => 'Texte bouton connexion',
                            'name' => 'login_button_text',
                            'type' => 'text',
                            'default_value' => 'Se connecter',
                        ],
                        [
                            'key' => 'field_register_button_text',
                            'label' => 'Texte bouton inscription',
                            'name' => 'register_button_text',
                            'type' => 'text',
                            'default_value' => 'Créer un compte',
                        ],
                    ],
                ],

                // Onglet Options avancées
                [
                    'key' => 'field_tab_checkout_advanced',
                    'label' => 'Options avancées',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                
                // Groupe Options d'affichage
                [
                    'key' => 'field_group_display_options',
                    'label' => 'Options d\'affichage',
                    'name' => 'display_options',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        
                        [
                            'key' => 'field_sticky_summary',
                            'label' => 'Récapitulatif collant (sticky)',
                            'name' => 'sticky_summary',
                            'type' => 'true_false',
                            'default_value' => 1,
                            'instructions' => 'Le récapitulatif reste visible lors du défilement',
                        ],
                    ],
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
