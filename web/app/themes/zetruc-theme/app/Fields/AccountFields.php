<?php

namespace App\Fields;

/**
 * Champs ACF pour la page "Mon compte"
 */
class AccountFields
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
            'key' => 'group_myaccount_fields',
            'title' => 'Champs pour Mon compte',
            'fields' => [
                // Section Titre principal
                [
                    'key' => 'field_account_main_title',
                    'label' => 'Titre principal',
                    'name' => 'account_main_title',
                    'type' => 'text',
                    'default_value' => 'Mon compte',
                    'instructions' => 'Titre affiché en haut de la page mon compte.',
                ],
                
                // Section Navigation
                [
                    'key' => 'field_account_nav_tab',
                    'label' => 'Navigation - Onglets',
                    'name' => 'account_nav_tab',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_account_dashboard_label',
                    'label' => 'Label "Tableau de bord"',
                    'name' => 'account_dashboard_label',
                    'type' => 'text',
                    'default_value' => 'Tableau de bord',
                ],
                [
                    'key' => 'field_account_orders_label',
                    'label' => 'Label "Commandes"',
                    'name' => 'account_orders_label',
                    'type' => 'text',
                    'default_value' => 'Mes commandes',
                ],
                [
                    'key' => 'field_account_downloads_label',
                    'label' => 'Label "Téléchargements"',
                    'name' => 'account_downloads_label',
                    'type' => 'text',
                    'default_value' => 'Téléchargements',
                ],
                [
                    'key' => 'field_account_addresses_label',
                    'label' => 'Label "Adresses"',
                    'name' => 'account_addresses_label',
                    'type' => 'text',
                    'default_value' => 'Adresses',
                ],
                [
                    'key' => 'field_account_details_label',
                    'label' => 'Label "Détails du compte"',
                    'name' => 'account_details_label',
                    'type' => 'text',
                    'default_value' => 'Détails du compte',
                ],
                [
                    'key' => 'field_account_logout_label',
                    'label' => 'Label "Déconnexion"',
                    'name' => 'account_logout_label',
                    'type' => 'text',
                    'default_value' => 'Déconnexion',
                ],

                // Section Dashboard
                [
                    'key' => 'field_account_dashboard_tab',
                    'label' => 'Tableau de bord',
                    'name' => 'account_dashboard_tab',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_account_welcome_message',
                    'label' => 'Message de bienvenue',
                    'name' => 'account_welcome_message',
                    'type' => 'textarea',
                    'default_value' => 'Bonjour {username}, bienvenue sur votre espace personnel !',
                    'instructions' => 'Utilisez {username} pour afficher le nom d\'utilisateur.',
                ],
                [
                    'key' => 'field_account_dashboard_description',
                    'label' => 'Description du tableau de bord',
                    'name' => 'account_dashboard_description',
                    'type' => 'wysiwyg',
                    'default_value' => 'Depuis votre tableau de bord, vous pouvez consulter vos commandes récentes, gérer vos adresses de livraison et de facturation, et modifier vos informations personnelles.',
                ],

                // Section Commandes
                [
                    'key' => 'field_account_orders_tab',
                    'label' => 'Commandes',
                    'name' => 'account_orders_tab',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_account_orders_title',
                    'label' => 'Titre section commandes',
                    'name' => 'account_orders_title',
                    'type' => 'text',
                    'default_value' => 'Mes commandes',
                ],
                [
                    'key' => 'field_account_no_orders_message',
                    'label' => 'Message aucune commande',
                    'name' => 'account_no_orders_message',
                    'type' => 'textarea',
                    'default_value' => 'Aucune commande n\'a été passée pour le moment.',
                ],
                [
                    'key' => 'field_account_orders_browse_products',
                    'label' => 'Texte bouton "Parcourir les produits"',
                    'name' => 'account_orders_browse_products',
                    'type' => 'text',
                    'default_value' => 'Parcourir les produits',
                ],

                // Section Adresses
                [
                    'key' => 'field_account_addresses_tab',
                    'label' => 'Adresses',
                    'name' => 'account_addresses_tab',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_account_addresses_title',
                    'label' => 'Titre section adresses',
                    'name' => 'account_addresses_title',
                    'type' => 'text',
                    'default_value' => 'Mes adresses',
                ],
                [
                    'key' => 'field_account_billing_address_title',
                    'label' => 'Titre adresse de facturation',
                    'name' => 'account_billing_address_title',
                    'type' => 'text',
                    'default_value' => 'Adresse de facturation',
                ],
                [
                    'key' => 'field_account_shipping_address_title',
                    'label' => 'Titre adresse de livraison',
                    'name' => 'account_shipping_address_title',
                    'type' => 'text',
                    'default_value' => 'Adresse de livraison',
                ],
                [
                    'key' => 'field_account_edit_address_button',
                    'label' => 'Texte bouton "Modifier l\'adresse"',
                    'name' => 'account_edit_address_button',
                    'type' => 'text',
                    'default_value' => 'Modifier l\'adresse',
                ],

                // Section Détails du compte
                [
                    'key' => 'field_account_details_tab',
                    'label' => 'Détails du compte',
                    'name' => 'account_details_tab',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_account_details_title',
                    'label' => 'Titre section détails',
                    'name' => 'account_details_title',
                    'type' => 'text',
                    'default_value' => 'Détails du compte',
                ],
                [
                    'key' => 'field_account_details_description',
                    'label' => 'Description section détails',
                    'name' => 'account_details_description',
                    'type' => 'textarea',
                    'default_value' => 'Modifiez les informations de votre compte et votre mot de passe.',
                ],

                // Section Connexion/Déconnexion
                [
                    'key' => 'field_account_auth_tab',
                    'label' => 'Connexion/Déconnexion',
                    'name' => 'account_auth_tab',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_account_login_title',
                    'label' => 'Titre page de connexion',
                    'name' => 'account_login_title',
                    'type' => 'text',
                    'default_value' => 'Connexion',
                ],
                [
                    'key' => 'field_account_register_title',
                    'label' => 'Titre section inscription',
                    'name' => 'account_register_title',
                    'type' => 'text',
                    'default_value' => 'S\'inscrire',
                ],
                [
                    'key' => 'field_account_register_description',
                    'label' => 'Description inscription',
                    'name' => 'account_register_description',
                    'type' => 'textarea',
                    'default_value' => 'Créez votre compte pour profiter de tous nos avantages.',
                ],
                [
                    'key' => 'field_account_logout_confirmation',
                    'label' => 'Message confirmation déconnexion',
                    'name' => 'account_logout_confirmation',
                    'type' => 'text',
                    'default_value' => 'Vous avez été déconnecté avec succès.',
                ],

                // Section Messages et notifications
                [
                    'key' => 'field_account_messages_tab',
                    'label' => 'Messages et notifications',
                    'name' => 'account_messages_tab',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_account_save_success_message',
                    'label' => 'Message succès sauvegarde',
                    'name' => 'account_save_success_message',
                    'type' => 'text',
                    'default_value' => 'Vos modifications ont été enregistrées avec succès.',
                ],
                [
                    'key' => 'field_account_password_changed_message',
                    'label' => 'Message mot de passe modifié',
                    'name' => 'account_password_changed_message',
                    'type' => 'text',
                    'default_value' => 'Votre mot de passe a été modifié avec succès.',
                ],
                [
                    'key' => 'field_account_address_saved_message',
                    'label' => 'Message adresse sauvegardée',
                    'name' => 'account_address_saved_message',
                    'type' => 'text',
                    'default_value' => 'Votre adresse a été enregistrée avec succès.',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page',
                        'operator' => '==',
                        'value' => get_option('woocommerce_myaccount_page_id'),
                    ],
                ],
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => 'Champs pour personnaliser les textes de la page Mon compte',
        ]);
    }
}
