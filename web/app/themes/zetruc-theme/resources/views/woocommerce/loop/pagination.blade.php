<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}

// Récupérer les liens de pagination sous forme de tableau
$pagination = paginate_links(
	apply_filters(
		'woocommerce_pagination_args',
		array(
			'base'      => $base,
			'format'    => $format,
			'add_args'  => false,
			'current'   => max( 1, $current ),
			'total'     => $total,
			'prev_text' => '<i class="fas fa-chevron-left"></i><span class="hidden sm:inline ml-1">Précédent</span>',
			'next_text' => '<span class="hidden sm:inline mr-1">Suivant</span><i class="fas fa-chevron-right"></i>',
			'type'      => 'array',
			'end_size'  => 2,
			'mid_size'  => 1,
		)
	)
);
?>

<nav class="flex items-center justify-center mt-8 mb-6" aria-label="<?php esc_attr_e( 'Product Pagination', 'woocommerce' ); ?>">
  <div class="flex items-center space-x-1 sm:space-x-2">
    <?php if ( $pagination ) : ?>
      <?php foreach ( $pagination as $link ) : ?>
        <?php
        // Analyser le lien pour déterminer son type
        $is_current = strpos($link, 'current') !== false;
        $is_prev = strpos($link, 'prev') !== false;
        $is_next = strpos($link, 'next') !== false;
        $is_dots = strpos($link, '&hellip;') !== false || strpos($link, '…') !== false;
        ?>
        
        <?php if ( $is_dots ) : ?>
          <span class="px-2 py-1 text-gray-400 text-sm sm:text-base">
            <i class="fas fa-ellipsis-h"></i>
          </span>
        <?php elseif ( $is_current ) : ?>
          <span class="px-3 py-2 sm:px-4 sm:py-2 bg-primary-600 text-white rounded-lg font-semibold text-sm sm:text-base shadow-md">
            <?php echo strip_tags($link); ?>
          </span>
        <?php elseif ( $is_prev ) : ?>
          <?php echo str_replace(
            ['class="prev', '<a'],
            ['class="prev flex items-center px-3 py-2 sm:px-4 sm:py-2 text-gray-600 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-200 border border-gray-300 hover:border-primary-300 text-sm sm:text-base', '<a'],
            $link
          ); ?>
        <?php elseif ( $is_next ) : ?>
          <?php echo str_replace(
            ['class="next', '<a'],
            ['class="next flex items-center px-3 py-2 sm:px-4 sm:py-2 text-gray-600 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-200 border border-gray-300 hover:border-primary-300 text-sm sm:text-base', '<a'],
            $link
          ); ?>
        <?php else : ?>
          <?php echo str_replace(
            '<a',
            '<a class="px-3 py-2 sm:px-4 sm:py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-200 border border-gray-300 hover:border-primary-300 font-medium text-sm sm:text-base"',
            $link
          ); ?>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</nav>

<!-- Informations sur la pagination -->
<div class="text-center text-sm text-gray-600 mb-6">
  <?php
  $paged = max(1, $current);
  $per_page = wc_get_loop_prop('per_page');
  $total_products = wc_get_loop_prop('total');
  $first = ($paged - 1) * $per_page + 1;
  $last = min($first + $per_page - 1, $total_products);
  ?>
  
  Affichage de <?php echo $first; ?> à <?php echo $last; ?> sur <?php echo $total_products; ?> produits
</div>

<style>
/* Styles additionnels pour la pagination */
.woocommerce-pagination a:hover,
.woocommerce-pagination span:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.woocommerce-pagination .current {
  box-shadow: 0 2px 8px rgba(var(--primary-600), 0.3);
}

@media (max-width: 640px) {
  .woocommerce-pagination {
    margin: 1rem 0;
  }
  
  .woocommerce-pagination a,
  .woocommerce-pagination span {
    min-width: 40px !important;
    padding: 8px 12px !important;
  }
}
</style>
