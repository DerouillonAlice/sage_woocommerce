{{--
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.2.0
--}}

@php
if (!defined('ABSPATH')) {
    exit;
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.
@endphp

@if($product->is_in_stock())

	@php do_action('woocommerce_before_add_to_cart_form'); @endphp

	<form class="cart" action="{{ esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())) }}" method="post" enctype='multipart/form-data'>
		@php do_action('woocommerce_before_add_to_cart_button'); @endphp

		<div class="flex items-center gap-2">
			@php
			do_action('woocommerce_before_add_to_cart_quantity');

			woocommerce_quantity_input(
				array(
					'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
					'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
					'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
					'classes'     => apply_filters('woocommerce_quantity_input_classes', array( 'border', 'border-gray-300', 'text-gray-900', 'text-sm', 'rounded-md', 'focus:ring-primary-500', 'focus:border-primary-500', 'block', 'w-16', 'p-2', 'text-center')),
				)
			);

			do_action('woocommerce_after_add_to_cart_quantity');
			@endphp

			<button type="submit" name="add-to-cart" value="{{ esc_attr($product->get_id()) }}" 
					class="flex-1 inline-flex items-center justify-center bg-primary-600 hover:bg-primary-700 text-white font-medium px-4 py-2 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
				{{ esc_html($product->single_add_to_cart_text()) }}
			</button>
		</div>

		@php do_action('woocommerce_after_add_to_cart_button'); @endphp
	</form>

	@php do_action('woocommerce_after_add_to_cart_form'); @endphp

@endif
