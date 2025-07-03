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
                // Onglet Principal
                [
                    'key' => 'field_tab_principal',
                    'label' => 'Informations générales',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                
                // Groupe Titre + Description
                [
                    'key' => 'field_group_main_info',
                    'label' => 'Informations principales',
                    'name' => 'main_info',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_title',
                            'label' => 'Titre de la page panier',
                            'name' => 'title',
                            'type' => 'text',
                            'default_value' => 'Mon panier',
                        ],
                        [
                            'key' => 'field_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'textarea',
                            'rows' => 3,
                            'default_value' => 'Vérifiez vos articles avant de procéder au paiement',
                        ],
                    ],
                ],
                
                // Groupe Actions Panier
                [
                    'key' => 'field_group_cart_actions',
                    'label' => 'Actions du panier',
                    'name' => 'cart_actions',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_continue_shopping_text',
                            'label' => 'Texte "Continuer mes achats"',
                            'name' => 'continue_shopping_text',
                            'type' => 'text',
                            'default_value' => 'Continuer mes achats',
                        ],
                        [
                            'key' => 'field_update_cart_text',
                            'label' => 'Texte "Mettre à jour le panier"',
                            'name' => 'update_cart_text',
                            'type' => 'text',
                            'default_value' => 'Mettre à jour le panier',
                        ],
                        [
                            'key' => 'field_cart_table_title',
                            'label' => 'Titre du tableau des articles',
                            'name' => 'cart_table_title',
                            'type' => 'text',
                            'default_value' => 'Articles dans votre panier',
                        ],
                    ],
                ],

                // Onglet Panier Vide
                [
                    'key' => 'field_tab_empty_cart',
                    'label' => 'Panier vide',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                
                [
                    'key' => 'field_group_empty_cart',
                    'label' => 'Configuration panier vide',
                    'name' => 'empty_cart',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_empty_cart_icon',
                            'label' => 'Icône (classe FontAwesome)',
                            'name' => 'icon',
                            'type' => 'text',
                            'default_value' => 'fas fa-shopping-cart',
                            'instructions' => 'Exemple: fas fa-shopping-cart, fas fa-shopping-bag, etc.',
                        ],
                        [
                            'key' => 'field_empty_cart_title',
                            'label' => 'Titre panier vide',
                            'name' => 'title',
                            'type' => 'text',
                            'default_value' => 'Votre panier est vide',
                        ],
                        [
                            'key' => 'field_empty_cart_message',
                            'label' => 'Message panier vide',
                            'name' => 'message',
                            'type' => 'textarea',
                            'rows' => 2,
                            'default_value' => 'Ajoutez des articles à votre panier pour continuer vos achats',
                        ],
                        [
                            'key' => 'field_empty_cart_button_text',
                            'label' => 'Texte du bouton',
                            'name' => 'button_text',
                            'type' => 'text',
                            'default_value' => 'Continuer mes achats',
                        ],
                    ],
                ],

                // Onglet Panier avec Contenu
                [
                    'key' => 'field_tab_filled_cart',
                    'label' => 'Panier avec contenu',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                
                [
                    'key' => 'field_group_filled_cart',
                    'label' => 'Configuration panier avec contenu',
                    'name' => 'filled_cart',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_quantity_label',
                            'label' => 'Label quantité',
                            'name' => 'quantity_label',
                            'type' => 'text',
                            'default_value' => 'Quantité :',
                        ],
                        [
                            'key' => 'field_unit_price_label',
                            'label' => 'Label prix unitaire',
                            'name' => 'unit_price_label',
                            'type' => 'text',
                            'default_value' => 'Prix unitaire :',
                        ],
                        [
                            'key' => 'field_remove_item_tooltip',
                            'label' => 'Tooltip suppression article',
                            'name' => 'remove_item_tooltip',
                            'type' => 'text',
                            'default_value' => 'Supprimer cet article',
                        ],
                        [
                            'key' => 'field_show_product_images',
                            'label' => 'Afficher les images produits',
                            'name' => 'show_product_images',
                            'type' => 'true_false',
                            'default_value' => 1,
                        ],
                        [
                            'key' => 'field_show_product_variations',
                            'label' => 'Afficher les variations produits',
                            'name' => 'show_product_variations',
                            'type' => 'true_false',
                            'default_value' => 1,
                        ],
                    ],
                ],

                // Onglet Coupons
                [
                    'key' => 'field_tab_coupons',
                    'label' => 'Coupons de réduction',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                
                [
                    'key' => 'field_group_coupons',
                    'label' => 'Configuration des coupons',
                    'name' => 'coupons',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_coupon_toggle_text',
                            'label' => 'Texte du bouton coupon',
                            'name' => 'toggle_text',
                            'type' => 'text',
                            'default_value' => 'Avez-vous un code promo ?',
                        ],
                        [
                            'key' => 'field_coupon_icon',
                            'label' => 'Icône coupon (classe FontAwesome)',
                            'name' => 'icon',
                            'type' => 'text',
                            'default_value' => 'fas fa-ticket-alt',
                        ],
                        [
                            'key' => 'field_coupon_placeholder',
                            'label' => 'Placeholder du champ coupon',
                            'name' => 'placeholder',
                            'type' => 'text',
                            'default_value' => 'Code promo',
                        ],
                        [
                            'key' => 'field_coupon_button_text',
                            'label' => 'Texte du bouton appliquer',
                            'name' => 'button_text',
                            'type' => 'text',
                            'default_value' => 'Appliquer',
                        ],
                        [
                            'key' => 'field_coupon_help_text',
                            'label' => 'Texte d\'aide',
                            'name' => 'help_text',
                            'type' => 'textarea',
                            'rows' => 2,
                            'default_value' => 'Saisissez votre code promo pour bénéficier d\'une réduction.',
                        ],
                        [
                            'key' => 'field_coupon_enabled',
                            'label' => 'Activer la section coupons',
                            'name' => 'enabled',
                            'type' => 'true_false',
                            'default_value' => 1,
                            'instructions' => 'Désactivez pour masquer complètement la section coupons',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page',
                        'operator' => '==',
                        'value' => wc_get_page_id('cart'),
                    ],
                ],
            ],
        ]);
    }
}
