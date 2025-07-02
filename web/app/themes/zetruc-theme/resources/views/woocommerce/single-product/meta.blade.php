<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product_meta mt-6 pt-6 border-t border-gray-200">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( ProductType::VARIABLE ) ) ) : ?>
		<div class="flex items-center text-sm text-gray-600 mb-2">
			<span class="font-medium mr-2"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?></span>
			<span><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span>
		</div>
	<?php endif; ?>

	<?php
	// Categories
	$categories = wc_get_product_category_list( $product->get_id() );
	if ( $categories ) :
	?>
		<div class="flex flex-wrap items-center text-sm text-gray-600 mb-2">
			<span class="font-medium mr-2"><?php echo _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ); ?></span>
			<?php echo wp_kses_post( str_replace(', ', '</span><span class="bg-gray-100 rounded px-2 py-1 text-xs mr-1 mb-1">', str_replace('>, <a', '></span><span class="bg-gray-100 rounded px-2 py-1 text-xs mr-1 mb-1"><a', $categories) ) ); ?>
		</div>
	<?php endif; ?>

	<?php
	// Tags
	$tags = wc_get_product_tag_list( $product->get_id() );
	if ( $tags ) :
	?>
		<div class="flex flex-wrap items-center text-sm text-gray-600">
			<span class="font-medium mr-2"><?php echo _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ); ?></span>
			<?php echo wp_kses_post( str_replace(', ', '</span><span class="bg-secondary-100 text-secondary-800 rounded px-2 py-1 text-xs mr-1 mb-1">', str_replace('>, <a', '></span><span class="bg-secondary-100 text-secondary-800 rounded px-2 py-1 text-xs mr-1 mb-1"><a', $tags) ) ); ?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
