<?php
/**
 * Gestionnaires AJAX pour le panier WooCommerce
 */

namespace App;

class CartAjaxHandlers
{
    public function __construct()
    {
        // Actions AJAX pour les utilisateurs connectés et non connectés
        add_action('wp_ajax_woocommerce_update_cart_item_quantity', [$this, 'update_cart_item_quantity']);
        add_action('wp_ajax_nopriv_woocommerce_update_cart_item_quantity', [$this, 'update_cart_item_quantity']);
        
        add_action('wp_ajax_woocommerce_remove_cart_item', [$this, 'remove_cart_item']);
        add_action('wp_ajax_nopriv_woocommerce_remove_cart_item', [$this, 'remove_cart_item']);

        // Enqueue des scripts nécessaires
        add_action('wp_enqueue_scripts', [$this, 'enqueue_cart_scripts']);
    }

    /**
     * Enqueue les scripts nécessaires pour le panier
     */
    public function enqueue_cart_scripts()
    {
        if (is_cart() || is_woocommerce()) {
            // S'assurer que jQuery est chargé
            wp_enqueue_script('jquery');
            
            // Localiser les paramètres pour JavaScript
            wp_localize_script('jquery', 'wc_cart_params', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'update_cart_nonce' => wp_create_nonce('wc_update_cart_item'),
                'remove_cart_nonce' => wp_create_nonce('wc_remove_cart_item'),
                'wc_ajax_url' => WC_AJAX::get_endpoint("%%endpoint%%"),
            ]);
        }
    }

    /**
     * Mise à jour de la quantité d'un article du panier via AJAX
     */
    public function update_cart_item_quantity()
    {
        // Vérification du nonce de sécurité
        if (!wp_verify_nonce($_POST['security'], 'wc_update_cart_item')) {
            wp_send_json_error('Erreur de sécurité');
            return;
        }

        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        $quantity = absint($_POST['quantity']);

        if (!$cart_item_key) {
            wp_send_json_error('Clé d\'article invalide');
            return;
        }

        try {
            // Vérifier que l'article existe dans le panier
            $cart_item = WC()->cart->get_cart_item($cart_item_key);
            if (!$cart_item) {
                wp_send_json_error('Article non trouvé dans le panier');
                return;
            }

            // Mettre à jour la quantité dans le panier
            $updated = WC()->cart->set_quantity($cart_item_key, $quantity, true);
            
            if ($updated) {
                // Recalculer les totaux
                WC()->cart->calculate_totals();
                
                // Obtenir les informations mises à jour
                $cart_item = WC()->cart->get_cart_item($cart_item_key);
                $product = $cart_item['data'];
                
                $response_data = [
                    'cart_item_key' => $cart_item_key,
                    'quantity' => $quantity,
                    'subtotal' => WC()->cart->get_product_subtotal($product, $quantity),
                    'cart_total' => WC()->cart->get_cart_total(),
                    'cart_count' => WC()->cart->get_cart_contents_count(),
                ];

                wp_send_json_success($response_data);
            } else {
                wp_send_json_error('Impossible de mettre à jour la quantité');
            }
        } catch (Exception $e) {
            wp_send_json_error('Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }

    /**
     * Suppression d'un article du panier via AJAX
     */
    public function remove_cart_item()
    {
        // Vérification du nonce de sécurité
        if (!wp_verify_nonce($_POST['security'], 'wc_remove_cart_item')) {
            wp_send_json_error('Erreur de sécurité');
            return;
        }

        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);

        if (!$cart_item_key) {
            wp_send_json_error('Clé d\'article invalide');
            return;
        }

        try {
            // Vérifier que l'article existe dans le panier
            $cart_item = WC()->cart->get_cart_item($cart_item_key);
            if (!$cart_item) {
                wp_send_json_error('Article non trouvé dans le panier');
                return;
            }

            // Supprimer l'article du panier
            $removed = WC()->cart->remove_cart_item($cart_item_key);
            
            if ($removed) {
                // Recalculer les totaux
                WC()->cart->calculate_totals();
                
                $response_data = [
                    'cart_item_key' => $cart_item_key,
                    'cart_total' => WC()->cart->get_cart_total(),
                    'cart_count' => WC()->cart->get_cart_contents_count(),
                    'cart_is_empty' => WC()->cart->is_empty(),
                ];

                wp_send_json_success($response_data);
            } else {
                wp_send_json_error('Impossible de supprimer l\'article');
            }
        } catch (Exception $e) {
            wp_send_json_error('Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
}

// Initialiser les gestionnaires AJAX
new CartAjaxHandlers();
