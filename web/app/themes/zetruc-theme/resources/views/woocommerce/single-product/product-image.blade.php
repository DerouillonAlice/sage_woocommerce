{{--
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
--}}

@php
use Automattic\WooCommerce\Enums\ProductType;

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$gallery_image_ids = $product->get_gallery_image_ids();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
@endphp

<div class="{{ esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ) }}" data-columns="{{ esc_attr( $columns ) }}">
	<figure class="woocommerce-product-gallery__wrapper flex flex-col">
		{{-- Main product image --}}
		<div class="mb-4 bg-white rounded-lg overflow-hidden flex items-center justify-center">
			@if($post_thumbnail_id)
				@php
					$full_img_src = wp_get_attachment_image_src($post_thumbnail_id, 'full');
					$image_alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
				@endphp
				<img id="main-product-image" 
					src="{{ wp_get_attachment_image_url($post_thumbnail_id, 'large') }}" 
					alt="{{ $image_alt }}" 
					class="rounded-lg w-96 h-96 object-cover  mx-auto" 
				/>
			@else
				<img id="main-product-image" 
					src="{{ wc_placeholder_img_src('woocommerce_single') }}" 
					alt="{{ __('Awaiting product image', 'woocommerce') }}" 
					class="rounded-lg w-96 h-96 object-cover  mx-auto" 
				/>
			@endif
		</div>
		
		{{-- Thumbnails/gallery images --}}
		@if(count($gallery_image_ids) > 0)
			<div class="flex flex-wrap gap-2 justify-center">
				{{-- Main thumbnail --}}
				@if($post_thumbnail_id)
					<div class="thumbnail-item cursor-pointer w-20 h-20 border-2 border-primary-500 rounded-md overflow-hidden" 
						data-image-src="{{ wp_get_attachment_image_url($post_thumbnail_id, 'large') }}"
						data-image-alt="{{ get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) }}">
						{!! wp_get_attachment_image($post_thumbnail_id, 'thumbnail', false, ['class' => 'h-full w-full object-cover']) !!}
					</div>
				@endif
				
				{{-- Gallery thumbnails --}}
				@foreach($gallery_image_ids as $gallery_image_id)
					@php
						$image_alt = get_post_meta($gallery_image_id, '_wp_attachment_image_alt', true);
					@endphp
					<div class="thumbnail-item cursor-pointer w-20 h-20 border-2 border-transparent hover:border-primary-300 rounded-md overflow-hidden"
						data-image-src="{{ wp_get_attachment_image_url($gallery_image_id, 'large') }}"
						data-image-alt="{{ $image_alt }}">
						{!! wp_get_attachment_image($gallery_image_id, 'thumbnail', false, ['class' => 'h-full w-full object-cover']) !!}
					</div>
				@endforeach
			</div>
		@endif
	</figure>
</div>

{{-- Simple JavaScript for image switching --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    const mainImage = document.getElementById('main-product-image');
    
    if (thumbnails.length > 0 && mainImage) {
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                // Remove active border from all thumbnails
                thumbnails.forEach(t => {
                    t.classList.remove('border-primary-500');
                    t.classList.add('border-transparent');
                });
                
                // Add active border to clicked thumbnail
                this.classList.remove('border-transparent');
                this.classList.add('border-primary-500');
                
                // Update main image
                const newSrc = this.getAttribute('data-image-src');
                const newAlt = this.getAttribute('data-image-alt');
                
                if (newSrc) {
                    mainImage.src = newSrc;
                    mainImage.alt = newAlt || '';
                }
            });
        });
    }
});
</script>
