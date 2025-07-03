{{--
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
--}}

@php
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.
@endphp

@if($product->is_in_stock())

	@php do_action('woocommerce_before_add_to_cart_form'); @endphp

	<form class="cart mt-6" action="{{ esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())) }}" method="post" enctype='multipart/form-data'>
		@php do_action('woocommerce_before_add_to_cart_button'); @endphp

		<div class="flex flex-wrap items-center gap-4">
			@php
			do_action('woocommerce_before_add_to_cart_quantity');

			// Customize the quantity input with Tailwind classes
			woocommerce_quantity_input(
				array(
					'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
					'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
					'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
					'classes'     => apply_filters('woocommerce_quantity_input_classes', array( 'border', 'border-gray-300', 'text-gray-900', 'text-sm', 'rounded-lg', 'focus:ring-primary-500', 'focus:border-primary-500', 'block', 'w-full', 'p-2.5',)),
				)
			);

			do_action('woocommerce_after_add_to_cart_quantity');
			@endphp

			<div class="add-to-cart-wrapper relative flex-1 min-w-0">
				<button type="submit" name="add-to-cart" value="{{ esc_attr($product->get_id()) }}" 
						class="w-full inline-flex items-center justify-center bg-primary-600 hover:bg-primary-700 text-white font-medium px-6 py-2.5 rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed relative overflow-hidden group">
					<span class="button-text">{{ esc_html($product->single_add_to_cart_text()) }}</span>
					<span class="loading-spinner hidden">
						<svg class="animate-spin h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
							<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
							<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
						</svg>
					</span>
				</button>
				
				{{-- Message de succès moderne --}}
				<div class="success-message hidden absolute inset-0 bg-green-600 text-white flex items-center justify-center rounded-md">
					<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
					</svg>
					<span>Ajouté au panier !</span>
				</div>
			</div>
		</div>

		@php do_action('woocommerce_after_add_to_cart_button'); @endphp
		
		@if($product->get_stock_quantity() && $product->get_stock_quantity() <= 5)
			<p class="text-sm text-orange-600 mt-2">
				<i class="fas fa-exclamation-circle mr-1"></i> 
				{{ sprintf(__('Only %s left in stock', 'woocommerce'), $product->get_stock_quantity()) }}
			</p>
		@endif
	</form>

	@php do_action('woocommerce_after_add_to_cart_form'); @endphp

@endif
