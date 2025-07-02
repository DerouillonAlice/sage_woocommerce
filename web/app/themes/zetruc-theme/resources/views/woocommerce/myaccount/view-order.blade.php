<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

$notes = $order->get_customer_order_notes();
?>

<div class="max-w-4xl mx-auto">
  <!-- En-tête de la commande -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 overflow-hidden">
    <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h1 class="text-2xl font-bold text-gray-900 mb-1">
            Commande #<?php echo esc_html( $order->get_order_number() ); ?>
          </h1>
          <p class="text-sm text-gray-600">
            <i class="fas fa-calendar-alt mr-1"></i>
            Passée le <?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?>
          </p>
        </div>
        
        <!-- Statut de la commande -->
        <div class="mt-3 sm:mt-0">
          <?php
          $status_class = '';
          $status_icon = '';
          switch ( $order->get_status() ) {
            case 'processing':
              $status_class = 'bg-yellow-100 text-yellow-800 border-yellow-200';
              $status_icon = 'fas fa-clock';
              break;
            case 'completed':
              $status_class = 'bg-green-100 text-green-800 border-green-200';
              $status_icon = 'fas fa-check-circle';
              break;
            case 'cancelled':
              $status_class = 'bg-red-100 text-red-800 border-red-200';
              $status_icon = 'fas fa-times-circle';
              break;
            case 'pending':
              $status_class = 'bg-gray-100 text-gray-800 border-gray-200';
              $status_icon = 'fas fa-hourglass-half';
              break;
            case 'on-hold':
              $status_class = 'bg-orange-100 text-orange-800 border-orange-200';
              $status_icon = 'fas fa-pause-circle';
              break;
            default:
              $status_class = 'bg-secondary-100 text-secondary-800 border-secondary-200';
              $status_icon = 'fas fa-info-circle';
          }
          ?>
          <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium border <?php echo esc_attr( $status_class ); ?>">
            <i class="<?php echo esc_attr( $status_icon ); ?> mr-2"></i>
            <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
          </span>
        </div>
      </div>
    </div>

    <!-- Informations rapides -->
    <div class="p-6">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gray-50 rounded-lg p-4">
          <div class="text-sm text-gray-600 mb-1">Total</div>
          <div class="text-lg font-bold text-gray-900"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></div>
        </div>
        <div class="bg-gray-50 rounded-lg p-4">
          <div class="text-sm text-gray-600 mb-1">Articles</div>
          <div class="text-lg font-bold text-gray-900"><?php echo esc_html( $order->get_item_count() ); ?></div>
        </div>
        <div class="bg-gray-50 rounded-lg p-4">
          <div class="text-sm text-gray-600 mb-1">Paiement</div>
          <div class="text-lg font-bold text-gray-900"><?php echo esc_html( $order->get_payment_method_title() ); ?></div>
        </div>
        <div class="bg-gray-50 rounded-lg p-4">
          <div class="text-sm text-gray-600 mb-1">Livraison</div>
          <div class="text-lg font-bold text-gray-900"><?php echo esc_html( $order->get_shipping_method() ?: 'N/A' ); ?></div>
        </div>
      </div>
    </div>

    <!-- Suivi de commande pour les commandes en cours -->
    <?php if ( in_array( $order->get_status(), ['processing', 'shipped'], true ) ) : ?>
      <div class="px-6 pb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Suivi de la commande</h3>
        <div class="relative">
          <div class="flex justify-between items-center">
            <div class="flex flex-col items-center text-center">
              <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white mb-2">
                <i class="fas fa-check text-sm"></i>
              </div>
              <span class="text-xs text-gray-600">Confirmée</span>
            </div>
            <div class="flex-1 h-1 bg-green-500 mx-2"></div>
            <div class="flex flex-col items-center text-center">
              <div class="w-8 h-8 bg-<?php echo $order->get_status() === 'processing' ? 'secondary-500' : 'green-500'; ?> rounded-full flex items-center justify-center text-white mb-2">
                <i class="fas fa-<?php echo $order->get_status() === 'processing' ? 'cog fa-spin' : 'check'; ?> text-sm"></i>
              </div>
              <span class="text-xs text-gray-600">En préparation</span>
            </div>
            <div class="flex-1 h-1 bg-<?php echo $order->get_status() === 'shipped' ? 'secondary-500' : 'gray-300'; ?> mx-2"></div>
            <div class="flex flex-col items-center text-center">
              <div class="w-8 h-8 bg-<?php echo $order->get_status() === 'shipped' ? 'secondary-500' : 'gray-300'; ?> rounded-full flex items-center justify-center text-white mb-2">
                <i class="fas fa-truck text-sm"></i>
              </div>
              <span class="text-xs text-gray-600">Expédiée</span>
            </div>
            <div class="flex-1 h-1 bg-gray-300 mx-2"></div>
            <div class="flex flex-col items-center text-center">
              <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-white mb-2">
                <i class="fas fa-home text-sm"></i>
              </div>
              <span class="text-xs text-gray-600">Livrée</span>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Détails de la commande -->
    <div class="lg:col-span-2">
      <div class="">
          <?php
          wc_get_template( 'order/order-details.php', array(
            'order_id'       => $order->get_id(),
            'show_downloads' => false, 
          ) );
          ?>
      </div>

      <!-- Téléchargements disponibles -->
      <?php
      $downloads = $order->get_downloadable_items();
      if ( $downloads ) :
      ?>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
          <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
              <i class="fas fa-download mr-2 text-secondary-600"></i>
              Téléchargements
            </h3>
          </div>
          <div class="p-6">
            <?php
            wc_get_template( 'order/order-downloads.php', array(
              'downloads'  => $downloads,
              'show_title' => false,
            ) );
            ?>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <!-- Informations latérales -->
    <div class="space-y-6">
      <!-- Adresses -->
      <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gray-100 px-4 py-3 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-900">Adresses</h3>
        </div>
        <div class="p-4 space-y-4">
          <!-- Adresse de facturation -->
          <div>
            <h4 class="font-medium text-gray-900 mb-2 flex items-center">
              <i class="fas fa-file-invoice mr-2 text-secondary-600"></i>
              Facturation
            </h4>
            <div class="text-sm text-gray-600">
              <?php echo wp_kses_post( $order->get_formatted_billing_address( __( 'N/A', 'woocommerce' ) ) ); ?>
              
              <?php if ( $order->get_billing_phone() ) : ?>
                <p class="mt-1">
                  <i class="fas fa-phone mr-1"></i>
                  <?php echo esc_html( $order->get_billing_phone() ); ?>
                </p>
              <?php endif; ?>
              
              <?php if ( $order->get_billing_email() ) : ?>
                <p class="mt-1">
                  <i class="fas fa-envelope mr-1"></i>
                  <?php echo esc_html( $order->get_billing_email() ); ?>
                </p>
              <?php endif; ?>
            </div>
          </div>

          <!-- Adresse de livraison -->
            <div class="border-t border-gray-200 pt-4">
              <h4 class="font-medium text-gray-900 mb-2 flex items-center">
                <i class="fas fa-truck mr-2 text-green-600"></i>
                Livraison
              </h4>
              <div class="text-sm text-gray-600">
                <?php echo wp_kses_post( $order->get_formatted_shipping_address( __( 'N/A', 'woocommerce' ) ) ); ?>
              </div>
            </div>
        </div>
      </div>

      <!-- Notes de commande -->
      <?php if ( $notes ) : ?>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
          <div class="bg-gray-100 px-4 py-3 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Notes de commande</h3>
          </div>
          <div class="p-4">
            <div class="space-y-3">
              <?php foreach ( $notes as $note ) : ?>
                <div class="border-l-4 border-secondary-400 pl-4">
                  <div class="text-sm text-gray-600 mb-1">
                    <i class="fas fa-clock mr-1"></i>
                    <?php echo esc_html( wc_format_datetime( $note->comment_date_gmt ) ); ?>
                  </div>
                  <p class="text-sm text-gray-900"><?php echo wp_kses_post( wpautop( wptexturize( $note->comment_content ) ) ); ?></p>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Actions rapides -->
      
        <div class="p-4 space-y-3">

        	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

          
          <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>" 
             class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Retour aux commandes
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.woocommerce-order-details {
  background: white;
  border-radius: 0.5rem;
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
  border: 1px solid #e5e7eb;
  overflow: hidden;
}

.woocommerce-order-details .woocommerce-table {
  margin: 0;
}

.woocommerce-order-details th,
.woocommerce-order-details td {
  padding: 1rem;
  border-bottom: 1px solid #e5e7eb;
}

.woocommerce-order-details th {
  background-color: #f9fafb;
  font-weight: 600;
  color: #374151;
}

.woocommerce-order-details .product-name a {
  color: #1f2937;
  text-decoration: none;
  font-weight: 500;
}

.woocommerce-order-details .product-name a:hover {
  color: #3b82f6;
}

.woocommerce-order-details .product-total {
  font-weight: 600;
  text-align: right;
}
</style>
