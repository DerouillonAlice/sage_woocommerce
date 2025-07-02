<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="woocommerce-no-products-found text-center py-16">
	<div class="max-w-md mx-auto">
		{{-- Icône illustrative --}}
		<div class="mb-6">
			<i class="fas fa-box-open text-8xl text-gray-300"></i>
		</div>

		{{-- Message principal --}}
		<h3 class="text-xl font-semibold text-gray-900 mb-2">
			Aucun produit trouvé
		</h3>
		
		<p class="text-gray-600 mb-6">
			Désolé, aucun produit ne correspond à vos critères de recherche. 
			Essayez de modifier vos filtres ou votre recherche.
		</p>

		{{-- Suggestions d'actions --}}
		<div class="space-y-3">
			<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
			   class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
				<i class="fas fa-store w-5 h-5 mr-2"></i>
				Voir tous les produits
			</a>
			
			<div class="flex flex-col sm:flex-row gap-2 justify-center">
				<button onclick="history.back()" 
						class="inline-flex items-center justify-center px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
					<i class="fas fa-arrow-left w-4 h-4 mr-2"></i>
					Retour
				</button>
				
				<button onclick="clearFilters()" 
						class="inline-flex items-center justify-center px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
					<i class="fas fa-redo w-4 h-4 mr-2"></i>
					Effacer les filtres
				</button>
			</div>
		</div>

		{{-- Suggestions de catégories populaires --}}
		<?php
		$popular_categories = get_terms( array(
			'taxonomy' => 'product_cat',
			'hide_empty' => true,
			'number' => 4,
			'orderby' => 'count',
			'order' => 'DESC'
		) );
		
		if ( ! is_wp_error( $popular_categories ) && ! empty( $popular_categories ) ) :
		?>
			<div class="mt-8">
				<h4 class="text-sm font-medium text-gray-700 mb-3">Catégories populaires :</h4>
				<div class="flex flex-wrap justify-center gap-2">
					<?php foreach ( $popular_categories as $category ) : ?>
						<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" 
						   class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-600 bg-blue-50 rounded-full hover:bg-blue-100 transition-colors">
							<?php echo esc_html( $category->name ); ?>
							<span class="ml-1 text-blue-400">(<?php echo $category->count; ?>)</span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<script>
function clearFilters() {
	// Supprimer tous les paramètres de filtre de l'URL
	const url = new URL(window.location);
	const params = new URLSearchParams(url.search);
	
	// Liste des paramètres à supprimer
	const filterParams = ['orderby', 'min_price', 'max_price', 'filter_color', 'filter_size', 'filter_brand', 'product_cat', 'product_tag'];
	
	filterParams.forEach(param => {
		params.delete(param);
	});
	
	// Redirection vers l'URL nettoyée
	url.search = params.toString();
	window.location.href = url.toString();
}
</script>
