{{-- 
Template Name: Cart
--}}

@extends('layouts.app')

@section('content')
  @php
    do_action('woocommerce_before_cart');
  @endphp

    <div class="prose max-w-4xl mx-auto mb-8">
      {!! $contenu_principal !!}
    </div>

  <form class="woocommerce-cart-form w-full max-w-4xl mx-auto bg-white rounded-lg shadow p-6 mt-8" action="{{ esc_url(wc_get_cart_url()) }}" method="post">
    @php do_action('woocommerce_before_cart_table'); @endphp

    <table class="min-w-full divide-y divide-gray-200 mb-6">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
        </tr>
      </thead>
      <tbody class="bg-red-500 divide-y divide-gray-200">
        @foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
          @php
            $_product   = $cart_item['data'];
            $product_id = $cart_item['product_id'];
          @endphp
          <tr class="woocommerce-cart-form__cart-item">
            <td class="px-4 py-4 flex items-center gap-4">
              @if ($_product->get_image())
                <span class="w-16 h-16 flex-shrink-0">{!! $_product->get_image('woocommerce_thumbnail', ['class' => 'rounded']) !!}</span>
              @endif
              <span class="font-semibold text-gray-800">{!! $_product->get_name() !!}</span>
            </td>
            <td class="px-4 py-4">
              {!! woocommerce_quantity_input([
                'input_name'  => "cart[{$cart_item_key}][qty]",
                'input_value' => $cart_item['quantity'],
                'max_value'   => $_product->get_max_purchase_quantity(),
                'min_value'   => '0',
                'class'       => 'w-16 border-gray-300 rounded',
              ], $_product, false) !!}
            </td>
            <td class="px-4 py-4 text-right font-bold text-gray-700">
              {!! WC()->cart->get_product_subtotal($_product, $cart_item['quantity']) !!}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    @php do_action('woocommerce_cart_contents'); @endphp

    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow" name="update_cart" value="{{ esc_attr__('Update cart', 'woocommerce') }}">
        {{ __('Mettre à jour le panier', 'woocommerce') }}
      </button>
      {!! wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce', true, false) !!}
      <div class="text-lg font-semibold text-gray-800">
        Total : <span class="text-blue-600">{!! WC()->cart->get_cart_total() !!}</span>
      </div>
    </div>

    @php do_action('woocommerce_after_cart_contents'); @endphp
    @php do_action('woocommerce_after_cart_table'); @endphp
  </form>

  @php do_action('woocommerce_cart_collaterals'); @endphp
  @php do_action('woocommerce_after_cart'); @endphp
@endsection