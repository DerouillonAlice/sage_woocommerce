<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! $product_attributes ) {
	return;
}
?>
<div class="woocommerce-product-attributes-wrapper bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
	<div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
		<h3 class="text-lg font-semibold text-gray-900 flex items-center">
			<i class="fas fa-info-circle mr-2 text-secondary-600"></i>
			<?php esc_html_e( 'Informations complémentaires', 'woocommerce' ); ?>
		</h3>
	</div>
	<div class="p-0">
		<table class="woocommerce-product-attributes shop_attributes w-full" aria-label="<?php esc_attr_e( 'Product Details', 'woocommerce' ); ?>">
			<?php foreach ( $product_attributes as $product_attribute_key => $product_attribute ) : ?>
				<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--<?php echo esc_attr( $product_attribute_key ); ?> border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition-colors">
					<th class="woocommerce-product-attributes-item__label px-6 py-4 text-left text-sm font-medium text-gray-900 bg-gray-50 w-1/3" scope="row">
						<?php echo wp_kses_post( $product_attribute['label'] ); ?>
					</th>
					<td class="woocommerce-product-attributes-item__value px-6 py-4 text-sm text-gray-700">
						<?php echo wp_kses_post( $product_attribute['value'] ); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
