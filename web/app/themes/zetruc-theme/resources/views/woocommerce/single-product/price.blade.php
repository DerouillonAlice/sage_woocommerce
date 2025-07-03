{{--
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
--}}

@php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
@endphp

<div class="product-price-wrapper my-6">
	@if($product->is_on_sale())
		<div class="price-container flex items-center gap-3">
			<span class="current-price text-3xl font-bold text-primary-600">
				{!! $product->get_price_html() !!}
			</span>
			@if($product->get_regular_price() && $product->get_sale_price())
				<span class="sale-badge bg-red-500 text-white px-2 py-1 rounded-full text-sm font-medium">
					@php
						$saving = $product->get_regular_price() - $product->get_sale_price();
						$percentage = round(($saving / $product->get_regular_price()) * 100);
					@endphp
					-{{ $percentage }}%
				</span>
			@endif
		</div>
	@else
		<div class="price-container">
			<span class="current-price text-3xl font-bold text-gray-900">
				{!! $product->get_price_html() !!}
			</span>
		</div>
	@endif
	
	{{-- Affichage des prix TTC/HT si configuré --}}
	@if(wc_tax_enabled() && 'incl' === get_option('woocommerce_tax_display_shop'))
		<p class="tax-info text-sm text-gray-500 mt-1">
			Prix TTC
		</p>
	@endif
</div>

<style>
.product-price-wrapper .price del {
	@apply text-gray-400 line-through text-lg;
}

.product-price-wrapper .price ins {
	@apply no-underline;
}

.product-price-wrapper .woocommerce-price-suffix {
	@apply text-sm text-gray-500 ml-2;
}
</style>
