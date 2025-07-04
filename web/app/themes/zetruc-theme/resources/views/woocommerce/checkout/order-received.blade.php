{{-- 
Template Name: Order Received
--}}

@extends('layouts.app')

@section('content')

<?php
/**
 * "                  <!-- Email -->
                  <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                      <i class="fas fa-envelope text-purple-600"></i>
                    </div>eceived" message.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-received.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.8.0
 *
 * @var WC_Order|false $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="py-8">
  <div class="container mx-auto px-4">
    
    <div class="max-w-2xl mx-auto text-center mb-8">
      <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mb-6">
        <i class="fas fa-check text-3xl text-primary-600"></i>
      </div>

      <!-- Message de confirmation -->
      <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
        <?php
        /**
         * Filter the message shown after a checkout is complete.
         *
         * @since 2.2.0
         *
         * @param string         $message The message.
         * @param WC_Order|false $order   The order created during checkout, or false if order data is not available.
         */
        $message = apply_filters(
          'woocommerce_thankyou_order_received_text',
          esc_html( __( 'Merci ! Votre commande a été reçue avec succès.', 'woocommerce' ) ),
          $order
        );

        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $message;
        ?>
      </h1>
      
      <p class="text-lg text-gray-600 mb-8">
        Nous avons bien reçu votre commande et nous vous enverrons une confirmation par email dans les plus brefs délais.
      </p>
    </div>

    <?php if ( $order ) : ?>
      <!-- Informations de la commande -->
      <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-4 ">
          
          <!-- Détails de la commande -->
          <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
              
              <!-- En-tête de la commande -->
              <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                  <h2 class="text-xl font-semibold text-gray-900 mb-2 sm:mb-0">
                    Détails de votre commande
                  </h2>
                  <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">Commande N°</span>
                    <span class="text-lg font-bold text-primary-600">#<?php echo $order->get_order_number(); ?></span>
                  </div>
                </div>
              </div>

              <!-- Informations essentielles -->
              <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                  
                  <!-- Date de commande -->
                  <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-secondary-100 rounded-lg flex items-center justify-center">
                      <i class="fas fa-calendar-alt text-secondary-600"></i>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-900">Date de commande</p>
                      <p class="text-sm text-gray-600"><?php echo wc_format_datetime( $order->get_date_created() ); ?></p>
                    </div>
                  </div>

                  <!-- Email -->
                  <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                      <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z"></path>
                      </svg>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-900">Email de confirmation</p>
                      <p class="text-sm text-gray-600"><?php echo esc_html( $order->get_billing_email() ); ?></p>
                    </div>
                  </div>

                  <!-- Statut -->
                  <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                      <i class="fas fa-check-circle text-primary-600"></i>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-900">Statut</p>
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        <?php 
                        $status = $order->get_status();
                        if ($status === 'completed') {
                          echo 'bg-primary-100 text-primary-800';
                        } elseif ($status === 'processing') {
                          echo 'bg-yellow-100 text-yellow-800';
                        } elseif ($status === 'pending') {
                          echo 'bg-gray-100 text-gray-800';
                        } else {
                          echo 'bg-secondary-100 text-secondary-800';
                        }
                        ?>">
                        <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
                      </span>
                    </div>
                  </div>

                  <?php if ( $order->get_payment_method_title() ) : ?>
                    <!-- Mode de paiement -->
                    <div class="flex items-start space-x-3">
                      <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-credit-card text-indigo-600"></i>
                      </div>
                      <div>
                        <p class="text-sm font-medium text-gray-900">Mode de paiement</p>
                        <p class="text-sm text-gray-600"><?php echo esc_html( $order->get_payment_method_title() ); ?></p>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- Adresses -->
                <div class="border-t border-gray-200 pt-6">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Adresse de facturation -->
                    <div>
                      <h3 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                        Adresse de facturation
                      </h3>
                      <div class="text-sm text-gray-600 space-y-1">
                        <?php echo wp_kses_post( $order->get_formatted_billing_address() ?: esc_html__( 'N/A', 'woocommerce' ) ); ?>
                      </div>
                    </div>

                    <!-- Adresse de livraison -->
                    <?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>
                      <div>
                        <h3 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                          <i class="fas fa-shipping-fast mr-2 text-gray-400"></i>
                          Adresse de livraison
                        </h3>
                        <div class="text-sm text-gray-600 space-y-1">
                          <?php echo wp_kses_post( $order->get_formatted_shipping_address() ?: esc_html__( 'N/A', 'woocommerce' ) ); ?>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Récapitulatif financier -->
          <div class="lg:col-span-1">
            <div class="bg-white h-full rounded-lg shadow-sm border border-gray-200 p-6 sticky top-6">
              <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-calculator mr-2 text-primary-600"></i>
                Récapitulatif financier
              </h3>

              <div class="space-y-3">
                <!-- Sous-total -->
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                  <span class="text-gray-600">Sous-total</span>
                  <span class="font-medium text-gray-900"><?php echo $order->get_formatted_line_subtotal( $order ); ?></span>
                </div>

                <!-- Frais de livraison -->
                <?php if ( $order->get_shipping_total() > 0 ) : ?>
                  <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Livraison</span>
                    <span class="font-medium text-gray-900"><?php echo wc_price( $order->get_shipping_total() ); ?></span>
                  </div>
                <?php endif; ?>

                <!-- Taxes -->
                <?php if ( $order->get_total_tax() > 0 ) : ?>
                  <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Taxes</span>
                    <span class="font-medium text-gray-900"><?php echo wc_price( $order->get_total_tax() ); ?></span>
                  </div>
                <?php endif; ?>

                <!-- Total -->
                <div class="flex justify-between items-center py-4 border-t-2 border-gray-200 bg-gray-50 -mx-6 px-6 mt-4">
                  <span class="text-lg font-bold text-gray-900">Total</span>
                  <span class="text-xl font-bold text-primary-600"><?php echo $order->get_formatted_order_total(); ?></span>
                </div>
              </div>

              <!-- Actions -->
              <div class="mt-6 space-y-3">
                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" 
                   class="w-full inline-flex items-center justify-center px-4 py-2 bg-primary-600 text-white font-medium rounded-md hover:bg-primary-700 transition-colors">
                  <i class="fas fa-user mr-2"></i>
                  Mon compte
                </a>
                
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                   class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 transition-colors">
                  <i class="fas fa-shopping-bag mr-2"></i>
                  Continuer mes achats
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Hooks WooCommerce -->
        <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
        <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
      </div>
    <?php else : ?>
      <!-- Cas où il n'y a pas de commande -->
      <div class="max-w-md mx-auto text-center">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
          </div>
          <h2 class="text-xl font-semibold text-gray-900 mb-2">Commande introuvable</h2>
          <p class="text-gray-600 mb-6">Nous n'avons pas pu trouver les détails de votre commande.</p>
          <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
             class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-medium rounded-md hover:bg-primary-700 transition-colors">
            <i class="fas fa-shopping-bag mr-2"></i>
            Retour à la boutique
          </a>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

@endsection
