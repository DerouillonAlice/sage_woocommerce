{{-- 
Template Name: Form Pay
--}}

@extends('layouts.app')

@section('content')

<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.2.0
 */

defined( 'ABSPATH' ) || exit;

$totals = $order->get_order_item_totals(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
?>

<div class=" py-8">
  <div class="container mx-auto px-4">
    
    <!-- En-tête de la page -->
    <div class="max-w-4xl mx-auto mb-8 text-center">
      <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-100 rounded-full mb-4">
        <i class="fas fa-credit-card text-2xl text-primary-600"></i>
      </div>
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Finaliser le paiement</h1>
      <p class="text-gray-600">Commande N° <span class="font-semibold text-primary-600">#<?php echo $order->get_order_number(); ?></span></p>
    </div>

    <div class="max-w-4xl mx-auto">
      <form id="order_review" method="post">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          
          <!-- Section principale - Récapitulatif de commande -->
          <div class="lg:col-span-3">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
              
              <!-- En-tête du récapitulatif -->
              <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                  <i class="fas fa-shopping-cart mr-3 text-primary-600"></i>
                  Récapitulatif de votre commande
                </h2>
              </div>

              <!-- Articles de la commande -->
              <div class="p-6">
                <?php if ( count( $order->get_items() ) > 0 ) : ?>
                  <div class="space-y-4">
                    <?php foreach ( $order->get_items() as $item_id => $item ) : ?>
                      <?php
                      if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
                          continue;
                      }
                      ?>
                      <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="flex-1">
                          <h4 class="font-medium text-gray-900 mb-1">
                            <?php
                              echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $item->get_name(), $item, false ) );

                              do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

                              wc_display_item_meta( $item );

                              do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
                            ?>
                          </h4>
                          <div class="text-sm text-gray-500">
                            <?php echo apply_filters( 'woocommerce_order_item_quantity_html', '<span class="font-medium">Quantité : ' . esc_html( $item->get_quantity() ) . '</span>', $item ); ?>
                          </div>
                        </div>
                        <div class="text-right">
                          <span class="text-lg font-semibold text-gray-900">
                            <?php echo $order->get_formatted_line_subtotal( $item ); ?>
                          </span>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>

                <!-- Totaux -->
                <?php if ( $totals ) : ?>
                  <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="space-y-3">
                      <?php foreach ( $totals as $total ) : ?>
                        <div class="flex justify-between items-center py-2 <?php echo strpos(strtolower($total['label']), 'total') !== false ? 'border-t-2 border-gray-200 bg-gray-50 -mx-6 px-6 mt-4' : 'border-b border-gray-100'; ?>">
                          <span class="<?php echo strpos(strtolower($total['label']), 'total') !== false ? 'text-lg font-bold text-gray-900' : 'text-gray-600'; ?>">
                            <?php echo $total['label']; ?>
                          </span>
                          <span class="<?php echo strpos(strtolower($total['label']), 'total') !== false ? 'text-xl font-bold text-primary-600' : 'font-medium text-gray-900'; ?>">
                            <?php echo $total['value']; ?>
                          </span>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Section droite - Paiement -->
          <div class="lg:col-span-3">
            <div class="sticky top-6">
              
              <?php
              /**
               * Triggered from within the checkout/form-pay.php template, immediately before the payment section.
               *
               * @since 8.2.0
               */
              do_action( 'woocommerce_pay_order_before_payment' ); 
              ?>

              <div id="payment" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                
                <!-- En-tête du paiement -->
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                  <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-lock mr-2 text-primary-600"></i>
                    Paiement sécurisé
                  </h3>
                </div>

                <div class="p-6">
                  <?php if ( $order->needs_payment() ) : ?>
                    <!-- Méthodes de paiement -->
                    <div class="space-y-4 mb-6">
                      <?php
                      if ( ! empty( $available_gateways ) ) {
                        foreach ( $available_gateways as $gateway ) {
                          echo '<div class="payment-method-wrapper p-4 border border-gray-200 rounded-lg hover:border-primary-300 transition-colors">';
                          wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
                          echo '</div>';
                        }
                      } else {
                        echo '<div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">';
                        echo '<div class="flex items-start">';
                        echo '<i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3"></i>';
                        echo '<div>';
                        wc_print_notice( apply_filters( 'woocommerce_no_available_payment_methods_message', esc_html__( 'Désolé, il semble qu\'aucune méthode de paiement ne soit disponible pour votre localisation. Veuillez nous contacter si vous avez besoin d\'aide.', 'woocommerce' ) ), 'notice' );
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                      }
                      ?>
                    </div>
                  <?php endif; ?>

                  <!-- Formulaire de soumission -->
                  <div class="space-y-4">
                    <input type="hidden" name="woocommerce_pay" value="1" />

                    <?php wc_get_template( 'checkout/terms.php' ); ?>

                    <?php do_action( 'woocommerce_pay_order_before_submit' ); ?>

                    <div class="pt-4">
                      <?php 
                      $button_html = apply_filters( 
                        'woocommerce_pay_order_button_html', 
                        '<button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors duration-200" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">
                          <i class="fas fa-credit-card mr-2"></i>
                          ' . esc_html( $order_button_text ) . '
                        </button>' 
                      );
                      echo $button_html;
                      ?>
                    </div>

                    <?php do_action( 'woocommerce_pay_order_after_submit' ); ?>

                    <?php wp_nonce_field( 'woocommerce-pay', 'woocommerce-pay-nonce' ); ?>

                    <!-- Informations de sécurité -->
                    <div class="mt-6 p-4 bg-primary-50 border border-primary-200 rounded-lg">
                      <div class="flex items-start">
                        <i class="fas fa-shield-alt text-primary-600 mt-1 mr-3"></i>
                        <div>
                          <h4 class="text-sm font-medium text-primary-800 mb-1">Paiement sécurisé</h4>
                          <p class="text-sm text-primary-700">Vos informations de paiement sont protégées par un cryptage SSL de niveau bancaire.</p>
                        </div>
                      </div>
                    </div>

                    <!-- Informations de support -->
                    <div class="mt-4 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                      <div class="flex items-start">
                        <i class="fas fa-question-circle text-gray-600 mt-1 mr-3"></i>
                        <div>
                          <h4 class="text-sm font-medium text-gray-800 mb-1">Besoin d'aide ?</h4>
                          <p class="text-sm text-gray-600">Contactez notre support client pour toute question concernant votre commande.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
/* Styles pour les méthodes de paiement */
.payment-method-wrapper input[type="radio"] {
  @apply w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 focus:ring-primary-500 focus:ring-2;
}

.payment-method-wrapper label {
  @apply ml-3 text-sm font-medium text-gray-900 cursor-pointer;
}

.payment-method-wrapper .payment_box {
  @apply mt-3 p-4 bg-gray-50 border border-gray-200 rounded-md;
}

/* Animation pour les méthodes de paiement */
.payment-method-wrapper:hover {
  @apply border-primary-300 bg-primary-50;
}

.payment-method-wrapper input[type="radio"]:checked + label {
  @apply text-primary-600;
}

/* Styles pour les termes et conditions */
.woocommerce-terms-and-conditions-wrapper {
  @apply mt-4;
}

.woocommerce-terms-and-conditions-wrapper input[type="checkbox"] {
  @apply w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2;
}

.woocommerce-terms-and-conditions-wrapper label {
  @apply ml-3 text-sm text-gray-700;
}

.woocommerce-terms-and-conditions-wrapper a {
  @apply text-primary-600 hover:text-primary-700 underline;
}
</style>

@endsection
