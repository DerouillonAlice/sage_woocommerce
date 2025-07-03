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
			<div class="flex items-center text-yellow-400 mr-2">
				@php
				$full_stars = floor($average);
				$half_star = ($average - $full_stars) >= 0.5;
				@endphp
				
				@for($i = 1; $i <= 5; $i++)
					@if($i <= $full_stars)
						<i class="fas fa-star text-sm"></i>
					@elseif($i == $full_stars + 1 && $half_star)
						<i class="fas fa-star-half-alt text-sm"></i>
					@else
						<i class="far fa-star text-sm text-gray-300"></i>
					@endif
				@endfor
			</div>
			<span class="text-sm font-medium text-gray-700">{{ number_format($average, 1) }}/5</span>
		</div>
		

	</div>
@endif
