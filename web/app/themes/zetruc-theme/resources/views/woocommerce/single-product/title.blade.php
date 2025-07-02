{{--
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
--}}

@php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $product;
@endphp

<h1 class="product_title entry-title text-3xl font-bold text-gray-800 mb-2">
    {!! get_the_title() !!}
    @if($product->is_on_sale())
        <span class="inline-block ml-3 bg-red-500 text-white text-sm font-semibold px-2 py-1 rounded">
            {{ __('Promo!', 'woocommerce') }}
        </span>
    @endif
</h1>

@php
// Check if there are custom fields that could serve as subtitle
$subtitle = get_post_meta(get_the_ID(), 'subtitle', true);
$highlight = get_post_meta(get_the_ID(), 'highlight', true);
@endphp

@if($subtitle)
  <div class="text-gray-500 text-lg mb-2">{{ $subtitle }}</div>
@endif

@if($highlight)
  <div class="bg-yellow-100 rounded p-4 mb-4">{{ $highlight }}</div>
@endif
