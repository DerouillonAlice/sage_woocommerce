<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
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

defined( 'ABSPATH' ) || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table">
    <div class="space-y-4">
        <?php
        do_action( 'woocommerce_review_order_before_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                ?>
                <div class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <?php if ( $_product->get_image_id() ) : ?>
                                <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
                                    <?php echo wp_kses_post( $_product->get_image( 'thumbnail', array( 'class' => 'w-full h-full object-cover' ) ) ); ?>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900">
                                    <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                                </h4>
                                <div class="text-sm text-gray-500 mt-1">
                                    <span class="quantity">Quantité : <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                    <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="font-semibold text-gray-900">
                                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php
            }
        }

        do_action( 'woocommerce_review_order_after_cart_contents' );
        ?>
    </div>

    <!-- Totaux -->
    <div class="mt-6 space-y-3">
        <div class="border-t border-gray-200 pt-4 space-y-2">
            <div class="cart-subtotal flex justify-between">
                <span class="text-gray-700"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
                <span class="font-medium"><?php wc_cart_totals_subtotal_html(); ?></span>
            </div>

            <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                <div class="fee flex justify-between">
                    <span class="text-gray-700"><?php echo esc_html( $fee->name ); ?></span>
                    <span class="font-medium"><?php wc_cart_totals_fee_html( $fee ); ?></span>
                </div>
            <?php endforeach; ?>

            <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
                <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                    <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                        <div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> flex justify-between">
                            <span class="text-gray-700"><?php echo esc_html( $tax->label ); ?></span>
                            <span class="font-medium"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="tax-total flex justify-between">
                        <span class="text-gray-700"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
                        <span class="font-medium"><?php wc_cart_totals_taxes_total_html(); ?></span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                <?php wc_cart_totals_shipping_html(); ?>
            <?php endif; ?>

            <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

            <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

            <!-- Total final -->
            <div class="order-total border-t border-gray-300 pt-4 mt-4">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-900"><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
                    <span class="text-xl font-bold text-primary-600"><?php wc_cart_totals_order_total_html(); ?></span>
                </div>
            </div>
        </div>

        <!-- Coupons appliqués -->
        <?php if ( WC()->cart->get_coupons() ) : ?>
            <div class="mt-4 space-y-2">
                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                    <div class="flex justify-between items-center py-2 px-4 bg-primary-50 rounded-lg border border-primary-200">
                        <span class="text-sm font-medium text-primary-800 flex items-center">
                            <i class="fas fa-tag w-4 h-4 mr-2"></i>
                            <?php wc_cart_totals_coupon_label( $coupon ); ?>
                        </span>
                        <span class="text-sm font-semibold text-primary-800">
                            <?php wc_cart_totals_coupon_html( $coupon ); ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire de code promo -->
        <?php wc_get_template( 'checkout/form-coupon.blade.php' ); ?>
    </div>
</div>
