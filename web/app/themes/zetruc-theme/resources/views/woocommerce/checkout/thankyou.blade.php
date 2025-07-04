{{-- 
Template Name: Thankyou
--}}

@extends('layouts.app')

@section('content')

<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class=" py-8">
  <div class="container mx-auto px-4">

    <?php if ( $order ) : ?>
      
      <?php do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

      <?php if ( $order->has_status( 'failed' ) ) : ?>
        
        <!-- Commande échouée -->
        <div class="max-w-2xl mx-auto">
          <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            
            <!-- En-tête d'erreur -->
            <div class="bg-red-50 px-6 py-4 border-b border-red-200">
              <div class="flex items-center">
                <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4">
                  <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div>
                  <h1 class="text-xl font-semibold text-red-900">Échec de la commande</h1>
                  <p class="text-sm text-red-700">Un problème est survenu lors du traitement de votre paiement</p>
                </div>
              </div>
            </div>

            <!-- Message d'erreur -->
            <div class="p-6">
              <div class="mb-6">
                <div class="flex items-start space-x-3">
                  <i class="fas fa-info-circle text-red-500 mt-1"></i>
                  <div>
                    <p class="text-gray-700 mb-4">
                      <?php esc_html_e( 'Malheureusement, votre commande ne peut pas être traitée car votre banque/merchant a refusé votre transaction. Veuillez essayer de nouveau votre achat.', 'woocommerce' ); ?>
                    </p>
                  </div>
                </div>
              </div>

              <!-- Actions pour commande échouée -->
              <div class="flex flex-col sm:flex-row gap-3">
                <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition-colors">
                  <i class="fas fa-credit-card mr-2"></i>
                  <?php esc_html_e( 'Recommencer le paiement', 'woocommerce' ); ?>
                </a>
                
                <?php if ( is_user_logged_in() ) : ?>
                  <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" 
                     class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-user mr-2"></i>
                    <?php esc_html_e( 'Mon compte', 'woocommerce' ); ?>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

      <?php else : ?>

        <!-- Commande réussie -->
        
        <!-- Message de confirmation principal -->
        <?php wc_get_template( 'checkout/order-received.php', array( 'order' => $order ) ); ?>

        <!-- Récapitulatif de la commande -->
        <div class="max-w-4xl mx-auto mt-8">
          <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            
            <!-- En-tête du récapitulatif -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
              <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                <i class="fas fa-receipt mr-3 text-primary-600"></i>
                Récapitulatif de votre commande
              </h2>
            </div>

            <!-- Détails de la commande -->
            <div class="p-6">
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Numéro de commande -->
                <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                  <div class="flex-shrink-0 w-10 h-10 bg-secondary-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-hashtag text-secondary-600"></i>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900"><?php esc_html_e( 'Numéro de commande', 'woocommerce' ); ?></p>
                    <p class="text-lg font-bold text-primary-600">#<?php echo $order->get_order_number(); ?></p>
                  </div>
                </div>

                <!-- Date -->
                <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                  <div class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-primary-600"></i>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900"><?php esc_html_e( 'Date de commande', 'woocommerce' ); ?></p>
                    <p class="text-sm text-gray-600"><?php echo wc_format_datetime( $order->get_date_created() ); ?></p>
                  </div>
                </div>

                <!-- Email (si connecté) -->
                <?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                  <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                      <i class="fas fa-envelope text-purple-600"></i>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-900"><?php esc_html_e( 'Email de confirmation', 'woocommerce' ); ?></p>
                      <p class="text-sm text-gray-600"><?php echo $order->get_billing_email(); ?></p>
                    </div>
                  </div>
                <?php endif; ?>

                <!-- Total -->
                <div class="flex items-center space-x-3 p-4 bg-primary-50 rounded-lg border border-primary-200">
                  <div class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-euro-sign text-primary-600"></i>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900"><?php esc_html_e( 'Montant total', 'woocommerce' ); ?></p>
                    <p class="text-xl font-bold text-primary-600"><?php echo $order->get_formatted_order_total(); ?></p>
                  </div>
                </div>

                <!-- Mode de paiement -->
                <?php if ( $order->get_payment_method_title() ) : ?>
                  <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                    <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                      <i class="fas fa-credit-card text-indigo-600"></i>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-900"><?php esc_html_e( 'Mode de paiement', 'woocommerce' ); ?></p>
                      <p class="text-sm text-gray-600"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></p>
                    </div>
                  </div>
                <?php endif; ?>

                <!-- Statut de la commande -->
                <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                  <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-info-circle text-yellow-600"></i>
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
                      <i class="fas fa-circle mr-1 text-xs"></i>
                      <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
                    </span>
                  </div>
                </div>
              </div>

              <!-- Actions supplémentaires -->
              <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                  <?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition-colors">
                      <i class="fas fa-user mr-2"></i>
                      Voir mes commandes
                    </a>
                  <?php endif; ?>
                  
                  <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                     class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Continuer mes achats
                  </a>

                  <?php if ( $order->has_status( array( 'processing', 'completed' ) ) && $order->get_billing_email() ) : ?>
                    <button onclick="window.print()" 
                            class="inline-flex items-center justify-center px-6 py-3 bg-secondary-100 text-secondary-700 font-medium rounded-lg hover:bg-secondary-200 transition-colors">
                      <i class="fas fa-print mr-2"></i>
                      Imprimer
                    </button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php endif; ?>

      <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
      <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

    <?php else : ?>

      <!-- Aucune commande trouvée -->
      <?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>

    <?php endif; ?>

  </div>
</div>

@endsection
