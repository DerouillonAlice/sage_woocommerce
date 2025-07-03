{{-- 
Template Name: Cart
--}}

@extends('layouts.app')

@section('content')
  @php
    do_action('woocommerce_before_cart');
  @endphp

  <div class="container mx-auto px-4 py-8">
    
    <!-- En-tête de la page panier -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $main_info['title'] ?? 'Mon panier' }}</h1>
      <p class="text-gray-600">{{ $main_info['description'] ?? 'Vérifiez vos articles avant de procéder au paiement' }}</p>
    </div>

    @if (WC()->cart->is_empty())
      <!-- Panier vide -->
      <div class="text-center py-16">
        <div class="mb-8">
          <i class="{{ $empty_cart['icon'] ?? 'fas fa-shopping-cart' }} text-8xl text-gray-300"></i>
        </div>
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">{{ $empty_cart['title'] ?? 'Votre panier est vide' }}</h2>
        <p class="text-gray-600 mb-8">{{ $empty_cart['message'] ?? 'Ajoutez des articles à votre panier pour continuer vos achats' }}</p>
        <a href="{{ wc_get_page_permalink('shop') }}" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition-colors">
          <i class="fas fa-arrow-left mr-2"></i>
          {{ $empty_cart['button_text'] ?? 'Continuer mes achats' }}
        </a>
      </div>
    @else
      <!-- Panier avec contenu -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Colonne principale - Articles du panier -->
        <div class="lg:col-span-2">
          <form class="woocommerce-cart-form" action="{{ esc_url(wc_get_cart_url()) }}" method="post">
            @php do_action('woocommerce_before_cart_table'); @endphp

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
              <!-- En-tête du tableau -->
              <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">{{ $cart_actions['cart_table_title'] ?? 'Articles dans votre panier' }}</h3>
              </div>

              <!-- Articles du panier -->
              <div class="divide-y divide-gray-200">
                @php do_action('woocommerce_before_cart_contents'); @endphp

                @foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
                  @php
                    $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                    $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                  @endphp

                  @if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key))
                    @php
                      $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    @endphp

                    <div class="p-6 woocommerce-cart-form__cart-item {{ apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key) }}">
                      <div class="flex flex-col sm:flex-row gap-4">
                        
                        <!-- Image du produit -->
                        <div class="flex-shrink-0">
                          <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-lg overflow-hidden bg-gray-100">
                            @php
                              $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail', ['class' => 'w-full h-full object-cover']), $cart_item, $cart_item_key);
                            @endphp
                            @if ($product_permalink)
                              <a href="{{ $product_permalink }}">{!! $thumbnail !!}</a>
                            @else
                              {!! $thumbnail !!}
                            @endif
                          </div>
                        </div>

                        <!-- Informations du produit -->
                        <div class="flex-1 min-w-0">
                          <h4 class="text-lg font-medium text-gray-900 mb-2">
                            @if ($product_permalink)
                              <a href="{{ $product_permalink }}" class="hover:text-primary-600 transition-colors">
                                {!! apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) !!}
                              </a>
                            @else
                              {!! $product_name !!}
                            @endif
                          </h4>
                          
                          @php do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key); @endphp

                          <!-- Meta data (variations, etc.) -->
                          <div class="text-sm text-gray-500 mb-2">
                            {!! wc_get_formatted_cart_item_data($cart_item) !!}
                          </div>

                          @if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity']))
                            <p class="text-sm text-orange-600 mb-2">
                              {!! apply_filters('woocommerce_cart_item_backorder_notification', '<span class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</span>', $product_id) !!}
                            </p>
                          @endif

                          <!-- Prix unitaire -->
                          <p class="text-sm text-gray-600 mb-3">
                            Prix unitaire : <span class="font-medium">{!! apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key) !!}</span>
                          </p>

                          <!-- Quantité et actions -->
                          <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                              <label class="text-sm font-medium text-gray-700">Quantité :</label>
                              @php
                                if ($_product->is_sold_individually()) {
                                    $min_quantity = 1;
                                    $max_quantity = 1;
                                } else {
                                    $min_quantity = 0;
                                    $max_quantity = apply_filters('woocommerce_quantity_input_max', $_product->get_max_purchase_quantity(), $_product);
                                }

                                // Solution temporaire : utiliser un input HTML personnalisé pour contourner le problème
                                $input_id = "quantity_" . $cart_item_key;
                                $input_min = $_product->is_sold_individually() ? 1 : 0;
                                $input_max = $_product->is_sold_individually() ? 1 : '';
                                $input_step = apply_filters('woocommerce_quantity_input_step', 1, $_product);
                                
                                echo '<div class="quantity">';
                                echo '<input type="number" ';
                                echo 'id="' . esc_attr($input_id) . '" ';
                                echo 'class="input-text qty text border border-gray-300 rounded px-3 py-2 w-20 text-center" ';
                                echo 'name="cart[' . $cart_item_key . '][qty]" ';
                                echo 'value="' . esc_attr($cart_item['quantity']) . '" ';
                                echo 'aria-label="Quantité du produit" ';
                                echo 'size="4" ';
                                echo 'min="' . esc_attr($input_min) . '" ';
                                if (!empty($input_max)) echo 'max="' . esc_attr($input_max) . '" ';
                                echo 'step="' . esc_attr($input_step) . '" ';
                                echo 'placeholder="" ';
                                echo 'inputmode="numeric" ';
                                echo 'autocomplete="off" />';
                                echo '</div>';
                              @endphp
                            </div>
                            
                            <!-- Prix total et suppression -->
                            <div class="flex items-center gap-4">
                              <div class="text-right">
                                <div class="text-lg font-bold text-gray-900">
                                  {!! apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key) !!}
                                </div>
                              </div>
                              @php
                                echo apply_filters(
                                    'woocommerce_cart_item_remove_link',
                                    sprintf(
                                        '<a href="%s" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50 transition-colors remove" aria-label="%s" data-product_id="%s" data-product_sku="%s" title="Supprimer cet article"><i class="fas fa-trash-alt"></i></a>',
                                        esc_url(wc_get_cart_remove_url($cart_item_key)),
                                        esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                                        esc_attr($product_id),
                                        esc_attr($_product->get_sku())
                                    ),
                                    $cart_item_key
                                );
                              @endphp
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                @endforeach

                @php do_action('woocommerce_cart_contents'); @endphp
              </div>

              <!-- Actions du panier -->
              <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex justify-center">
                  <a href="{{ wc_get_page_permalink('shop') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-md hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    {{ $cart_actions['continue_shopping_text'] ?? 'Continuer mes achats' }}
                  </a>
                  <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors" name="update_cart" value="{{ __('Update cart', 'woocommerce') }}">
                    <i class="fas fa-sync-alt mr-2"></i>
                    {{ $cart_actions['update_cart_text'] ?? 'Mettre à jour le panier' }}
                  </button>
                </div>
              </div>
            </div>

            @php do_action('woocommerce_after_cart_contents'); @endphp
            @php do_action('woocommerce_after_cart_table'); @endphp
          </form>

          <!-- Formulaire de coupon -->
          @if (wc_coupons_enabled() && ($coupons['enabled'] ?? true))
            <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
              <button type="button" class="w-full text-left flex items-center justify-between p-3 bg-secondary-50 border border-secondary-200 rounded-lg text-secondary-700 hover:bg-secondary-100 transition-colors" id="toggle-coupon-form">
                <span class="flex items-center font-medium">
                  <i class="{{ $coupons['icon'] ?? 'fas fa-ticket-alt' }} mr-2"></i>
                  {{ $coupons['toggle_text'] ?? 'Avez-vous un code promo ?' }}
                </span>
                <i class="fas fa-chevron-down transform transition-transform" id="coupon-arrow"></i>
              </button>

              <form class="checkout_coupon woocommerce-form-coupon mt-4 hidden" method="post" id="coupon-form-cart">
                <?php wp_nonce_field( 'woocommerce-apply_coupon', 'woocommerce-apply-coupon-nonce' ); ?>
                <div class="flex gap-3">
                  <div class="flex-1">
                    <input type="text" name="coupon_code" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="{{ $coupons['placeholder'] ?? 'Code promo' }}" id="coupon_code" />
                  </div>
                  <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-medium px-6 py-2 rounded-lg transition-colors" name="apply_coupon" value="Apply coupon">
                    {{ $coupons['button_text'] ?? 'Appliquer' }}
                  </button>
                </div>
                <p class="text-sm text-gray-600 mt-2">{{ $coupons['help_text'] ?? 'Saisissez votre code promo pour bénéficier d\'une réduction.' }}</p>
              </form>
            </div>
          @endif
        </div>

        <!-- Colonne latérale - Récapitulatif et checkout -->
        <div class="lg:col-span-1">
          <div class="sticky top-6">
            @php do_action('woocommerce_before_cart_collaterals'); @endphp
            <div class="cart-collaterals">
              @php do_action('woocommerce_cart_collaterals'); @endphp
            </div>
          </div>
        </div>

      </div>
    @endif

  </div>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggle-coupon-form');
    const couponForm = document.getElementById('coupon-form-cart');
    const arrow = document.getElementById('coupon-arrow');
    
    if (toggleButton && couponForm && arrow) {
      toggleButton.addEventListener('click', function() {
        couponForm.classList.toggle('hidden');
        arrow.classList.toggle('fa-chevron-down');
        arrow.classList.toggle('fa-chevron-up');
      });
    }
  });
  </script>

  @php do_action('woocommerce_after_cart'); @endphp
@endsection