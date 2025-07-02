{{--
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
--}}

@php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
@endphp

@if($rating_count > 0)
	<div class="woocommerce-product-rating flex items-center gap-3">
		<div class="flex items-center">
			<div class="flex text-yellow-400">
				@php
				$rating_html = wc_get_rating_html($average, $rating_count);
				$rating_html = str_replace('star-rating', 'star-rating flex', $rating_html);
				echo $rating_html;
				@endphp
			</div>
			<span class="ml-2 text-sm font-medium text-gray-700">{{ number_format($average, 1) }}/5</span>
		</div>
		
		@if(comments_open())
			<a href="#reviews" class="text-sm font-medium text-secondary-600 hover:text-secondary-800 hover:underline flex items-center transition-colors" rel="nofollow">
				<i class="fas fa-comment-dots mr-1"></i>
				@php
				printf(
					_n('%s avis client', '%s avis clients', $review_count, 'woocommerce'),
					'<span class="count">' . esc_html($review_count) . '</span>'
				);
				@endphp
			</a>
		@endif
	</div>
@endif
