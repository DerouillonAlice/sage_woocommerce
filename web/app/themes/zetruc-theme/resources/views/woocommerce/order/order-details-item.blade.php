<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item ', $item, $order ) ); ?>">

	<td class="woocommerce-table__product-name product-name px-4 py-4">
		<div class="flex items-start space-x-4">
			<!-- Image du produit -->
			<?php if ( $product && $product->get_image_id() ) : ?>
				<div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
					<?php echo wp_kses_post( $product->get_image( 'thumbnail', array( 'class' => 'w-full h-full object-cover' ) ) ); ?>
				</div>
			<?php endif; ?>
			
			<div class="flex-1 min-w-0">
				<!-- Nom du produit -->
				<div class="mb-2">
					<?php
					$is_visible        = $product && $product->is_visible();
					$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

					echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', 
						$product_permalink ? sprintf( '<a href="%s" class="text-lg font-medium text-gray-900 hover:text-secondary-600 transition-colors">%s</a>', $product_permalink, $item->get_name() ) : 
						'<span class="text-lg font-medium text-gray-900">' . $item->get_name() . '</span>', $item, $is_visible ) );
					?>
				</div>

				<!-- Quantité -->
				<div class="text-sm text-gray-600 mb-2">
					<?php
					$qty          = $item->get_quantity();
					$refunded_qty = $order->get_qty_refunded_for_item( $item_id );

					if ( $refunded_qty ) {
						$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
					} else {
						$qty_display = esc_html( $qty );
					}

					echo apply_filters( 'woocommerce_order_item_quantity_html', 
						'<span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-800">' . 
						sprintf( 'Quantité: %s', $qty_display ) . '</span>', $item );
					?>
				</div>

				<!-- Métadonnées du produit -->
				<div class="text-sm text-gray-600">
					<?php
					do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );
					wc_display_item_meta( $item );
					do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
					?>
				</div>

				<!-- Note d'achat -->
				<?php if ( $show_purchase_note && $purchase_note ) : ?>
					<div class="mt-3 p-3 bg-secondary-50 border border-secondary-200 rounded-lg">
						<div class="flex items-start">
							<i class="fas fa-info-circle text-secondary-600 mr-2 mt-0.5"></i>
							<div class="text-sm text-secondary-800">
								<strong>Note :</strong> <?php echo wp_kses_post( wpautop( do_shortcode( $purchase_note ) ) ); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</td>

	<td class="woocommerce-table__product-total product-total px-4 py-4 text-right">
		<div class="text-lg font-bold text-gray-900">
			<?php echo wp_kses_post( $order->get_formatted_line_subtotal( $item ) ); ?>
		</div>
	</td>
</tr>
