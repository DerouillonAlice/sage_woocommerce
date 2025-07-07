<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total    = wc_get_loop_prop('total');
$per_page = wc_get_loop_prop('per_page');
$current  = wc_get_loop_prop('current_page');
$orderedby = isset($orderedby) ? $orderedby : '';
?>
<div class="flex w-full flex-col sm:flex-row justify-between flex-start sm:items-center gap-8 mb-4">
  <div class="woocommerce-result-count flex items-center gap-2 text-sm text-gray-600">
    <i class="fas fa-list w-4 h-4 text-gray-400"></i>
    <span class="font-medium">
    <?php
    // phpcs:disable WordPress.Security
    if ( 1 === intval( $total ) ) {
      _e( '1 produit trouvé', 'woocommerce' );
    } elseif ( $total <= $per_page || -1 === $per_page ) {
      $orderedby_placeholder = empty( $orderedby ) ? '%2$s' : '<span class="screen-reader-text">%2$s</span>';
      /* translators: 1: total results 2: sorted by */
      printf( _n( '%1$d produit trouvé', '%1$d produits trouvés', $total, 'woocommerce' ) . $orderedby_placeholder, $total, esc_html( $orderedby ) );
    } else {
      $first                 = ( $per_page * $current ) - $per_page + 1;
      $last                  = min( $total, $per_page * $current );
      $orderedby_placeholder = empty( $orderedby ) ? '%4$s' : '<span class="screen-reader-text">%4$s</span>';
      /* translators: 1: first result 2: last result 3: total results 4: sorted by */
      printf( _nx( 'Affichage %1$d–%2$d sur %3$d produit', 'Affichage %1$d–%2$d sur %3$d produits', $total, 'with first and last result', 'woocommerce' ) . $orderedby_placeholder, $first, $last, $total, esc_html( $orderedby ) );
    }
    // phpcs:enable WordPress.Security
    ?>
  </span>
</div>
