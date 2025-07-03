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
                      @php do_action('woocommerce_before_cart_item_quantity_zero', $cart_item_key, $cart_item); @endphp

                      <div class="flex flex-col sm:flex-row gap-4">
                        
                        <!-- Image du produit -->
                        @if ($_product->get_image() && ($filled_cart['show_product_images'] ?? true))
                          <div class="flex-shrink-0">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-lg overflow-hidden bg-gray-100">
                              @php
                                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail', ['class' => 'w-full h-full object-cover']), $cart_item, $cart_item_key);
                                if (!$product_permalink) {
                                    echo $thumbnail;
                                } else {
                                    printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                                }
                              @endphp
                            </div>
                          </div>
                        @endif

                        <!-- Informations du produit -->
                        <div class="flex-1 min-w-0">
                          <h4 class="text-lg font-medium text-gray-900 mb-2">
                            @php
                              if (!$product_permalink) {
                                  echo wp_kses_post($product_name);
                              } else {
                                  echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s" class="hover:text-primary-600 transition-colors">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                              }
                            @endphp
                          </h4>
                          <!-- Attributs du produit -->
                          @if ($cart_item['variation'] && ($filled_cart['show_product_variations'] ?? true))
                            <div class="text-sm text-gray-500 mb-2">
                              @foreach ($cart_item['variation'] as $name => $value)
                                <span class="inline-block mr-4">
                                  {{ wc_attribute_label(str_replace('attribute_', '', $name)) }}: {{ $value }}
                                </span>
                              @endforeach
                            </div>
                          @endif

                          <!-- Prix unitaire -->
                          <p class="text-sm text-gray-600 mb-3">
                            {{ $filled_cart['unit_price_label'] ?? 'Prix unitaire :' }} <span class="font-medium">{!! apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key) !!}</span>
                          </p>

                          <!-- Quantité et actions -->
                          <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                              <label class="text-sm font-medium text-gray-700">{{ $filled_cart['quantity_label'] ?? 'Quantité :' }}</label>
                              @php
                                if ($_product->is_sold_individually()) {
                                    $min_quantity = 1;
                                    $max_quantity = 1;
                                } else {
                                    $min_quantity = 0;
                                    $max_quantity = $_product->get_max_purchase_quantity();
                                }

                                $product_quantity = woocommerce_quantity_input(
                                    array(
                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                        'input_value'  => $cart_item['quantity'],
                                        'max_value'    => $max_quantity,
                                        'min_value'    => $min_quantity,
                                        'product_name' => $product_name,
                                        'classes'     => apply_filters('woocommerce_quantity_input_classes', array( 'border', 'border-gray-300', 'text-gray-900', 'text-sm', 'rounded-lg', 'focus:ring-primary-500', 'focus:border-primary-500', 'block', 'w-full', 'p-2.5',)),

                                    ),
                                    $_product,
                                    false
                                );

                                echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
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
                @php do_action('woocommerce_after_cart_contents'); @endphp
              </div>

              <!-- Actions du panier -->
              <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row gap-3 justify-between">
                  <a href="{{ wc_get_page_permalink('shop') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-md hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    {{ $cart_actions['continue_shopping_text'] ?? 'Continuer mes achats' }}
                  </a>
                  <button type="submit" name="update_cart" value="{{ esc_attr__('Update cart', 'woocommerce') }}" class="inline-flex items-center justify-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
                    <i class="fas fa-sync-alt mr-2"></i>
                    {{ $cart_actions['update_cart_text'] ?? 'Mettre à jour le panier' }}
                  </button>
                </div>
              </div>
            </div>

            @php do_action('woocommerce_after_cart_contents'); @endphp
            {!! wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce', true, false) !!}
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
                @php wp_nonce_field('woocommerce-apply_coupon', 'woocommerce-apply-coupon-nonce'); @endphp
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
            <!-- Récapitulatif de commande -->
            @include('woocommerce.cart.cart-totals')
          </div>
        </div>
      </div>
    @endif
  </div>

  @php
    do_action('woocommerce_after_cart');
  @endphp

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

@endsection
