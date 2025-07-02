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
		{{-- Main product image with PhotoSwipe support --}}
		<div class="mb-4 bg-white rounded-lg overflow-hidden flex items-center justify-center">
			@if($post_thumbnail_id)
				@php
					$full_img_src = wp_get_attachment_image_src($post_thumbnail_id, 'full');
					$image_title = get_post_field('post_title', $post_thumbnail_id);
					$image_caption = get_post_field('post_excerpt', $post_thumbnail_id);
					$image_alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
				@endphp
				<a href="{{ $full_img_src[0] }}" class="woocommerce-product-gallery__image" 
					data-size="{{ $full_img_src[1] }}x{{ $full_img_src[2] }}"
					data-index="0">
					<img src="{{ wp_get_attachment_image_url($post_thumbnail_id, 'large') }}" 
						alt="{{ $image_alt }}" 
						class="rounded-lg max-h-96 w-auto mx-auto" 
						data-large_image="{{ $full_img_src[0] }}"
						data-large_image_width="{{ $full_img_src[1] }}"
						data-large_image_height="{{ $full_img_src[2] }}"
					/>
				</a>
			@else
				<a href="{{ wc_placeholder_img_src('woocommerce_single') }}" class="woocommerce-product-gallery__image--placeholder">
					<img src="{{ wc_placeholder_img_src('woocommerce_single') }}" alt="{{ __('Awaiting product image', 'woocommerce') }}" class="rounded-lg max-h-96 w-auto mx-auto" />
				</a>
			@endif
		</div>
		
		{{-- Thumbnails/gallery images --}}
		@if(count($gallery_image_ids) > 0)
			<div class="flex flex-wrap gap-2 justify-center">
				{{-- Main thumbnail --}}
				@if($post_thumbnail_id)
					<div class="thumbnail-item cursor-pointer w-20 h-20 border-2 border-blue-500 rounded-md overflow-hidden" data-index="0">
						{!! wp_get_attachment_image($post_thumbnail_id, 'thumbnail', false, ['class' => 'h-full w-full object-cover']) !!}
					</div>
				@endif
				
				{{-- Gallery thumbnails with PhotoSwipe support --}}
				@foreach($gallery_image_ids as $i => $gallery_image_id)
					@php
						$full_img_src = wp_get_attachment_image_src($gallery_image_id, 'full');
						$gallery_index = $i + 1; // +1 because the main image is index 0
					@endphp
					<div class="thumbnail-item cursor-pointer w-20 h-20 border-2 border-transparent hover:border-blue-300 rounded-md overflow-hidden"
						 data-index="{{ $gallery_index }}">
						{!! wp_get_attachment_image($gallery_image_id, 'thumbnail', false, ['class' => 'h-full w-full object-cover']) !!}
					</div>
					
					{{-- Hidden gallery image links for PhotoSwipe --}}
					<a href="{{ $full_img_src[0] }}" class="woocommerce-product-gallery__image hidden" 
						data-size="{{ $full_img_src[1] }}x{{ $full_img_src[2] }}"
						data-index="{{ $gallery_index }}">
						<img src="{{ wp_get_attachment_image_url($gallery_image_id, 'large') }}" 
							alt="{{ get_post_meta($gallery_image_id, '_wp_attachment_image_alt', true) }}" 
							data-large_image="{{ $full_img_src[0] }}"
							data-large_image_width="{{ $full_img_src[1] }}"
							data-large_image_height="{{ $full_img_src[2] }}"
						/>
					</a>
				@endforeach
			</div>
		@endif
	</figure>
</div>

{{-- Add necessary JavaScript for thumbnail switching and PhotoSwipe --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    const mainImageContainer = document.querySelector('.woocommerce-product-gallery__wrapper > div:first-child');
    const mainImageLink = mainImageContainer.querySelector('a');
    const mainImage = mainImageContainer.querySelector('img');
    const galleryItems = document.querySelectorAll('.woocommerce-product-gallery__image');
    
    // Thumbnail switching
    if (thumbnails.length > 0 && mainImage) {
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                // Remove active border from all thumbnails
                thumbnails.forEach(t => {
                    t.classList.remove('border-blue-500');
                    t.classList.add('border-transparent');
                });
                
                // Add active border to clicked thumbnail
                this.classList.remove('border-transparent');
                this.classList.add('border-blue-500');
                
                // Find the index and corresponding gallery item
                const index = parseInt(this.getAttribute('data-index'));
                const galleryItem = document.querySelector(`.woocommerce-product-gallery__image[data-index="${index}"]`);
                
                if (galleryItem) {
                    // Update main image with the selected gallery item
                    const newSrc = galleryItem.getAttribute('href');
                    const newSize = galleryItem.getAttribute('data-size');
                    const img = galleryItem.querySelector('img');
                    
                    mainImageLink.href = newSrc;
                    mainImageLink.setAttribute('data-size', newSize);
                    mainImageLink.setAttribute('data-index', index);
                    
                    mainImage.src = img.getAttribute('src');
                    mainImage.alt = img.alt;
                    mainImage.setAttribute('data-large_image', img.getAttribute('data-large_image'));
                    mainImage.setAttribute('data-large_image_width', img.getAttribute('data-large_image_width'));
                    mainImage.setAttribute('data-large_image_height', img.getAttribute('data-large_image_height'));
                }
            });
        });
    }
    
    // PhotoSwipe initialization
    initPhotoSwipe('.woocommerce-product-gallery__image');
    
    // Function to initialize PhotoSwipe
    function initPhotoSwipe(gallerySelector) {
        // Loop through all gallery elements
        const galleryElements = document.querySelectorAll(gallerySelector);
        
        if (galleryElements.length === 0) return;
        
        galleryElements.forEach(galleryElement => {
            if (galleryElement.classList.contains('hidden')) return;
            
            galleryElement.addEventListener('click', function(e) {
                e.preventDefault();
                
                openPhotoSwipe(this.getAttribute('data-index') || 0);
            });
        });
        
        function openPhotoSwipe(index) {
            const pswpElement = document.querySelector('.pswp');
            const items = [];
            
            // Build items array
            galleryElements.forEach(el => {
                if (el.getAttribute('href')) {
                    const size = el.getAttribute('data-size').split('x');
                    const item = {
                        src: el.getAttribute('href'),
                        w: parseInt(size[0], 10),
                        h: parseInt(size[1], 10),
                        el: el
                    };
                    
                    if (el.querySelector('img')) {
                        item.msrc = el.querySelector('img').getAttribute('src');
                        item.title = el.querySelector('img').getAttribute('alt');
                    }
                    
                    items.push(item);
                }
            });
            
            if (items.length === 0) return;
            
            // Define PhotoSwipe options
            const options = {
                index: parseInt(index, 10),
                getThumbBoundsFn: function(index) {
                    const thumbnail = document.querySelector(`.thumbnail-item[data-index="${index}"]`);
                    const pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
                    const rect = thumbnail.getBoundingClientRect();
                    
                    return { x: rect.left, y: rect.top + pageYScroll, w: rect.width };
                },
                showHideOpacity: true,
                history: false,
                shareEl: false
            };
            
            // Check if PhotoSwipe is available
            if (window.PhotoSwipe && window.PhotoSwipeUI_Default) {
                // Initialize PhotoSwipe
                const gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
                gallery.init();
            } else {
                console.error('PhotoSwipe not available. Make sure to enqueue the scripts.');
                
                // Fallback - just open the image in a new tab
                window.open(items[options.index].src, '_blank');
            }
        }
    }
});
</script>
