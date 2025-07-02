<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit();

do_action('woocommerce_before_account_orders', $has_orders); ?>

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
            <i class="fas fa-shopping-bag mr-3 text-blue-600"></i>
            Mes commandes
        </h2>
        <p class="text-sm text-gray-600 mt-1">Suivez l'état de vos commandes et consultez votre historique d'achats</p>
    </div>

    <?php if ( $has_orders ) : ?>
    <!-- Filtres rapides -->
    <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
        <div class="flex flex-wrap gap-2" id="order-filters">
            <button
                class="filter-btn active px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-700 border border-blue-200 hover:bg-blue-200 transition-colors"
                data-filter="all">
                Toutes les commandes
            </button>
            <button
                class="filter-btn px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-700 border border-gray-200 hover:bg-gray-200 transition-colors"
                data-filter="processing">
                En traitement
            </button>
            <button
                class="filter-btn px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-700 border border-gray-200 hover:bg-gray-200 transition-colors"
                data-filter="completed">
                Terminées
            </button>
            <button
                class="filter-btn px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-700 border border-gray-200 hover:bg-gray-200 transition-colors"
                data-filter="cancelled">
                Annulées
            </button>
        </div>
    </div>

    <!-- Liste des commandes -->
    <div class="divide-y divide-gray-200" id="orders-list">
        <?php
      foreach ( $customer_orders->orders as $customer_order ) {
        $order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        $item_count = $order->get_item_count() - $order->get_item_count_refunded();
        ?>
        <div class="order-item p-6" data-status="<?php echo esc_attr($order->get_status()); ?>">
            <div class="flex flex-col gap-4">

                <!-- Informations principales de la commande -->
                <div class="flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3">
                        <div>
                            <div class="flex items-center space-x-3 mb-3">


                                <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                    <a href="<?php echo esc_url($order->get_view_order_url()); ?>" class="hover:text-blue-600 transition-colors">
                                        Commande #<?php echo esc_html($order->get_order_number()); ?>
                                    </a>
                                </h3>
                                <!-- Statut de la commande -->
                                <div class="mt-2 sm:mt-0">
                                    <?php
                                    $status_class = '';
                                    $status_icon = '';
                                    switch ($order->get_status()) {
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
                                            $status_class = 'bg-blue-100 text-blue-800 border-blue-200';
                                            $status_icon = 'fas fa-info-circle';
                                    }
                                    ?>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border <?php echo esc_attr($status_class); ?>">
                                        <i class="<?php echo esc_attr($status_icon); ?> mr-1.5"></i>
                                        <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
                                    </span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                Passée le <?php echo esc_html(wc_format_datetime($order->get_date_created())); ?>
                            </p>
                        </div>


                    </div>

                    <!-- Détails de la commande -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm mb-4">
                        <div>
                            <span class="text-gray-600">Articles:</span>
                            <span class="font-medium text-gray-900 ml-1"><?php echo esc_html($item_count); ?></span>
                        </div>
                        <div>
                            <span class="text-gray-600">Total:</span>
                            <span class="font-bold text-gray-900 ml-1"><?php echo wp_kses_post($order->get_formatted_order_total()); ?></span>
                        </div>
                        <div>
                            <?php if ( $order->get_status() === 'processing' && $order->get_shipping_method() ) : ?>
                            <span class="text-gray-600">Livraison:</span>
                            <span class="font-medium text-gray-900 ml-1"><?php echo esc_html($order->get_shipping_method()); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Boutons d'action intégrés -->
                    <div class="flex flex-wrap gap-2">
                        <a href="<?php echo esc_url($order->get_view_order_url()); ?>" 
                           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-eye mr-2"></i>
                            Voir détails
                        </a>
                        
                        <?php
                        $actions = wc_get_account_orders_actions($order);
                        if (!empty($actions)) {
                            foreach ($actions as $key => $action) {
                                // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                $button_class = '';
                                $icon = '';
                                
                                switch ($key) {
                                    case 'pay':
                                        $button_class = 'bg-green-600 text-white hover:bg-green-700';
                                        $icon = 'fas fa-credit-card';
                                        break;
                                    case 'cancel':
                                        $button_class = 'bg-red-600 text-white hover:bg-red-700';
                                        $icon = 'fas fa-times';
                                        break;
                                    case 'view':
                                        // Skip view button as we already have one
                                        continue 2;
                                    default:
                                        $button_class = 'bg-gray-600 text-white hover:bg-gray-700';
                                        $icon = 'fas fa-cog';
                                }
                                
                                echo '<a href="' . esc_url($action['url']) . '" class="inline-flex items-center justify-center px-4 py-2 ' . $button_class . ' text-sm font-medium rounded-md transition-colors">';
                                if ($icon) echo '<i class="' . $icon . ' mr-2"></i>';
                                echo esc_html($action['name']);
                                echo '</a>';
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
        <?php
      }
      ?>
    </div>

    <!-- Pagination -->
    <?php if ( 1 < $customer_orders->max_num_pages ) : ?>
    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Affichage de <?php echo esc_html(($current_page - 1) * $page_size + 1); ?> à
                <?php echo esc_html(min($current_page * $page_size, $customer_orders->total)); ?>
                sur <?php echo esc_html($customer_orders->total); ?> commandes
            </div>
            <div class="flex items-center space-x-2">
                <?php echo paginate_links(
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    apply_filters(
                        'woocommerce_pagination_args',
                        [
                            'base' => esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', wc_get_endpoint_url('orders', 999999999, wc_get_page_permalink('myaccount'))))),
                            'format' => '',
                            'current' => $current_page,
                            'total' => $customer_orders->max_num_pages,
                            'prev_text' => '<i class="fas fa-chevron-left"></i>',
                            'next_text' => '<i class="fas fa-chevron-right"></i>',
                            'type' => 'list',
                            'end_size' => 3,
                            'mid_size' => 3,
                        ],
                        'orders',
                    ),
                ); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php else : ?>
    <!-- Aucune commande -->
    <div class="text-center py-16">
        <div class="mb-6">
            <i class="fas fa-shopping-bag text-6xl text-gray-300"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucune commande trouvée</h3>
        <p class="text-gray-600 mb-6">Vous n'avez pas encore passé de commande.</p>
        <a href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>"
            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-shopping-cart mr-2"></i>
            Commencer mes achats
        </a>
    </div>
    <?php endif; ?>
</div>

<style>
    .filter-btn.active {
        background-color: rgb(219 234 254);
        color: rgb(29 78 216);
        border-color: rgb(147 197 253);
    }

    .order-item:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .page-numbers {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 0.75rem;
        margin: 0 0.125rem;
        text-sm;
        font-medium;
        color: #374151;
        background-color: #fff;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: all 0.2s;
    }

    .page-numbers:hover {
        background-color: #f3f4f6;
        color: #1f2937;
    }

    .page-numbers.current {
        background-color: #3b82f6;
        color: #fff;
        border-color: #3b82f6;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des filtres
        const filterButtons = document.querySelectorAll('.filter-btn');
        const orderItems = document.querySelectorAll('.order-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');

                // Mise à jour des boutons actifs
                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.remove('bg-blue-100', 'text-blue-700',
                        'border-blue-200');
                    btn.classList.add('bg-gray-100', 'text-gray-700',
                    'border-gray-200');
                });

                this.classList.add('active');
                this.classList.remove('bg-gray-100', 'text-gray-700', 'border-gray-200');
                this.classList.add('bg-blue-100', 'text-blue-700', 'border-blue-200');

                // Filtrage des commandes
                orderItems.forEach(item => {
                    const status = item.getAttribute('data-status');
                    if (filter === 'all' || status === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Gestion du modal de suivi
        const trackingModal = document.getElementById('tracking-modal');
        const trackButtons = document.querySelectorAll('.track-order-btn');
        const closeModalBtn = document.getElementById('close-tracking-modal');

        if (trackButtons.length > 0) {
            trackButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    showTrackingModal(orderId);
                });
            });
        }

        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', function() {
                trackingModal.classList.add('hidden');
            });
        }

        // Fermer le modal en cliquant en dehors
        if (trackingModal) {
            trackingModal.addEventListener('click', function(e) {
                if (e.target === trackingModal) {
                    trackingModal.classList.add('hidden');
                }
            });
        }

        function showTrackingModal(orderId) {
            if (trackingModal) {
                trackingModal.classList.remove('hidden');

                // Simuler le chargement d'informations de suivi
                setTimeout(() => {
                    const trackingContent = document.getElementById('tracking-content');
                    if (trackingContent) {
                        trackingContent.innerHTML = `
            <div class="space-y-4">
              <div class="text-center mb-4">
                <h4 class="font-semibold text-gray-900">Commande #${orderId}</h4>
                <p class="text-sm text-gray-600">Suivi de livraison</p>
              </div>
              <div class="space-y-3">
                <div class="flex items-center">
                  <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                  <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Commande confirmée</p>
                    <p class="text-xs text-gray-500">Il y a 2 jours</p>
                  </div>
                </div>
                <div class="flex items-center">
                  <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                  <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">En préparation</p>
                    <p class="text-xs text-gray-500">Il y a 1 jour</p>
                  </div>
                </div>
                <div class="flex items-center">
                  <div class="w-3 h-3 bg-gray-300 rounded-full mr-3"></div>
                  <div class="flex-1">
                    <p class="text-sm text-gray-500">Expédiée</p>
                    <p class="text-xs text-gray-400">En attente</p>
                  </div>
                </div>
                <div class="flex items-center">
                  <div class="w-3 h-3 bg-gray-300 rounded-full mr-3"></div>
                  <div class="flex-1">
                    <p class="text-sm text-gray-500">Livrée</p>
                    <p class="text-xs text-gray-400">En attente</p>
                  </div>
                </div>
              </div>
            </div>
          `;
                    }
                }, 1000);
            }
        }
    });
</script>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>
