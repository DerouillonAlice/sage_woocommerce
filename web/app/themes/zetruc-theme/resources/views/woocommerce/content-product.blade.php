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
<li <?php wc_product_class( 'bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-300 overflow-hidden', $product ); ?>>
	
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
		<div class="bg-gray-100 h-48 group-hover:scale-105 transition-transform duration-300">
			<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
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
			<h3 class="text-lg font-semibold text-gray-900 group-hover:text-primary-600 transition-colors line-clamp-2 data-[view=list]:text-xl">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="hover:no-underline">
					<?php echo get_the_title(); ?>
				</a>
			</h3>
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
		<div class="flex items-center justify-between mt-auto ">
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
