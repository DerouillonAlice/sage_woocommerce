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

use App\PostTypes\ShopPreferences;

// Récupérer les paramètres depuis les réglages administrateur
$shop_settings = ShopPreferences::getActiveSettings();
$card_elements = $shop_settings['product_card_elements'];
$current_view = $shop_settings['default_view'];
?>
<li <?php 
	$classes = 'bg-white rounded-lg border border-gray-200 flex flex-col overflow-hidden';
	if ($current_view === 'list') {
		$classes .= ' flex flex-col sm:flex-row items-stretch h-auto sm:h-48';
	}
	wc_product_class( $classes, $product ); 
?>>
	
	{{-- Image container --}}
	<div class="relative overflow-hidden <?php echo $current_view === 'list' ? 'w-full sm:w-64 h-48 sm:h-full flex-shrink-0' : ''; ?>">
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
		<div class="bg-gray-100 w-full h-full group-hover:scale-105 transition-transform duration-300 overflow-hidden">
			<div class="w-full h-48 [&_img]:w-full [&_img]:h-full [&_img]:object-cover">
				<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
			</div>
		</div>
	
	</div>

	{{-- Contenu produit --}}
	<div class="<?php echo $current_view === 'list' ? 'flex-1 flex flex-col justify-between min-h-0 p-4' : 'p-4 flex-1'; ?>">
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="hover:no-underline">
		<div class="<?php echo $current_view === 'list' ? 'flex-1' : ''; ?>">
			<?php if ($card_elements['show_category']) : ?>
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
				<h3 class="<?php echo $current_view === 'list' ? 'text-lg sm:text-xl' : 'text-lg'; ?> font-semibold text-gray-900 group-hover:text-primary-600 transition-colors <?php echo $current_view === 'list' ? 'line-clamp-2' : 'line-clamp-2'; ?>">
						<?php echo get_the_title(); ?>
					</h3>
				</div>
				
				<?php if ($card_elements['show_rating'] && $product->get_average_rating()) : ?>
					{{-- Note --}}
					<div class="mb-2">
						<?php
					$rating = $product->get_average_rating();
					$rating_count = $product->get_rating_count();
					?>
					<div class="flex items-center space-x-1">
						<div class="flex items-center">
							<?php for ($i = 1; $i <= 5; $i++) : ?>
								<svg class="w-4 h-4 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
									<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
								</svg>
								<?php endfor; ?>
							</div>
							<?php if ($rating_count > 0) : ?>
								<span class="text-sm text-gray-500">(<?php echo $rating_count; ?>)</span>
								<?php endif; ?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if ($card_elements['show_description'] && $current_view === 'list') : ?>
							{{-- Description courte en mode liste --}}
				<div class="mb-2 hidden sm:block">
					<p class="text-sm text-gray-600 line-clamp-2">
						<?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
					</p>
				</div>
				<?php endif; ?>
			</div>
			
			{{-- Prix et bouton (toujours en bas) --}}
			<div class="<?php echo $current_view === 'list' ? 'flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-4 mt-auto pt-2' : 'mt-auto'; ?>">
				<?php if ($card_elements['show_price']) : ?>
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
				<?php endif; ?>
				
				<?php if ($current_view === 'list' && $card_elements['show_add_to_cart']) : ?>
					{{-- Bouton panier en mode liste --}}
					<div class="flex-shrink-0">
						<?php
					if ( $product->is_purchasable() && $product->is_in_stock() ) {
						// Ajouter une classe CSS spécifique pour le style liste
						add_filter('woocommerce_loop_add_to_cart_args', function($args) {
							$args['class'] = isset($args['class']) ? $args['class'] . ' list-view-button' : 'list-view-button';
							return $args;
						});
						
						woocommerce_template_loop_add_to_cart();
						
						// Retirer le filtre après utilisation
						remove_all_filters('woocommerce_loop_add_to_cart_args');
					}
					?>
				</div>
				<?php endif; ?>
			</div>
		</a>
	</div>

	<?php if ($current_view !== 'list' && $card_elements['show_add_to_cart']) : ?>
		{{-- Bouton d'ajout au panier en mode grille --}}
		<div class="p-4 pt-0">
			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 * On retire le hook par défaut et on l'ajoute manuellement pour contrôler le style
			 */
			if ( $product->is_purchasable() && $product->is_in_stock() ) {
				echo '<div class="w-full">';
				woocommerce_template_loop_add_to_cart();
				echo '</div>';
			}
			?>
		</div>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 */
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
