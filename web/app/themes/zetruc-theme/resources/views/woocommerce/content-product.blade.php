<?php
/**
 * The template for displaying product content within loops
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'group relative bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-300 overflow-hidden data-[view=list]:flex data-[view=list]:gap-4 data-[view=list]:p-4', $product ); ?>>
	
	{{-- Image container --}}
	<div class="relative overflow-hidden">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );

		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		?>
		<div class="aspect-square bg-gray-100 group-hover:scale-105 transition-transform duration-300">
			<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
		</div>
		
		{{-- Badge de réduction --}}
		<?php if ( $product->is_on_sale() ) : ?>
			<div class="absolute top-2 left-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
				<?php
				if ( $product->get_type() === 'variable' ) {
					echo esc_html__( 'Promo', 'woocommerce' );
				} else {
					$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
					echo '-' . $percentage . '%';
				}
				?>
			</div>
		<?php endif; ?>
	
		
		{{-- Boutons d'action rapide --}}
		<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
			<div class="flex gap-2">
				<?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
					<button class="bg-white text-gray-800 p-2 rounded-full hover:bg-gray-100 transition-colors" 
							onclick="event.preventDefault(); addToCartQuick(<?php echo $product->get_id(); ?>)" 
							title="Ajouter au panier">
						<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L3 3m4 10v6a1 1 0 001 1h12a1 1 0 001-1v-6M9 19v2m6-2v2"/>
						</svg>
					</button>
				<?php endif; ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" 
				   class="bg-white text-gray-800 p-2 rounded-full hover:bg-gray-100 transition-colors"
				   title="Voir les détails">
					<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
					</svg>
				</a>
			</div>
		</div>
	</div>

	{{-- Contenu produit --}}
	<div class="p-4 flex-1 data-[view=list]:p-0">
		{{-- Catégorie --}}
		<?php
		$terms = get_the_terms( $product->get_id(), 'product_cat' );
		if ( $terms && ! is_wp_error( $terms ) ) :
			$term = reset( $terms );
		?>
			<div class="text-xs text-gray-500 uppercase tracking-wide mb-1">
				<?php echo esc_html( $term->name ); ?>
			</div>
		<?php endif; ?>

		{{-- Titre --}}
		<div class="mb-2">
			<?php
			/**
			 * Hook: woocommerce_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			?>
			<h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 data-[view=list]:text-xl">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="hover:no-underline">
					<?php echo get_the_title(); ?>
				</a>
			</h3>
		</div>

		{{-- Description courte en vue liste --}}
		<div class="hidden data-[view=list]:block mb-3">
			<?php
			$short_description = $product->get_short_description();
			if ( $short_description ) {
				echo '<p class="text-gray-600 text-sm line-clamp-2">' . wp_strip_all_tags( $short_description ) . '</p>';
			}
			?>
		</div>

		{{-- Rating --}}
		<div class="mb-2">
			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 */
			if ( wc_review_ratings_enabled() ) {
				$rating_count = $product->get_rating_count();
				$review_count = $product->get_review_count();
				$average      = $product->get_average_rating();

				if ( $rating_count > 0 ) {
					echo '<div class="flex items-center gap-1 mb-2">';
					echo wc_get_rating_html( $average, $rating_count );
					echo '<span class="text-sm text-gray-500">(' . $review_count . ')</span>';
					echo '</div>';
				}
			}
			?>
		</div>

		{{-- Prix et bouton --}}
		<div class="flex items-center justify-between mt-auto data-[view=list]:justify-start data-[view=list]:gap-4">
			<div class="flex flex-col">
				<?php
				/**
				 * Hook: woocommerce_after_shop_loop_item_title.
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				?>
				<span class="text-lg font-bold text-gray-900">
					<?php echo $product->get_price_html(); ?>
				</span>
				
				<?php if ( $product->is_on_sale() && $product->get_regular_price() ) : ?>
					<span class="text-sm text-gray-500 line-through">
						<?php echo wc_price( $product->get_regular_price() ); ?>
					</span>
				<?php endif; ?>
			</div>

			{{-- Bouton d'action --}}
			<div class="data-[view=list]:ml-auto">
				<?php
				/**
				 * Hook: woocommerce_after_shop_loop_item.
				 *
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				?>
				<div class="mt-2">
					<?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
						<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" 
						   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors"
						   data-product_id="<?php echo $product->get_id(); ?>"
						   data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>">
							<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L3 3m4 10v6a1 1 0 001 1h12a1 1 0 001-1v-6"/>
							</svg>
							Ajouter au panier
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url( get_permalink() ); ?>" 
						   class="inline-flex items-center justify-center px-4 py-2 bg-gray-400 text-white text-sm font-medium rounded-md">
							Voir le produit
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
