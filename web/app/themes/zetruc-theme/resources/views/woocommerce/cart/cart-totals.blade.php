<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
		<i class="fas fa-calculator mr-2 text-primary-600"></i>
		<?php esc_html_e( 'Récapitulatif de commande', 'woocommerce' ); ?>
	</h3>

	<div class="space-y-3">

		<div class="flex justify-between items-center py-2 border-b border-gray-100">
			<span class="text-gray-600"><?php esc_html_e( 'Sous-total', 'woocommerce' ); ?></span>
			<span class="font-medium text-gray-900"><?php wc_cart_totals_subtotal_html(); ?></span>
		</div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="flex justify-between items-center py-2 border-b border-gray-100 text-primary-600">
				<span class="flex items-center">
					<i class="fas fa-ticket-alt mr-2"></i>
					<?php wc_cart_totals_coupon_label( $coupon ); ?>
				</span>
				<span class="font-medium"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
			</div>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<div class="py-2 border-b border-gray-100">
				<div class="text-gray-600 mb-2 flex items-center">
					<i class="fas fa-shipping-fast mr-2"></i>
					<?php esc_html_e( 'Livraison', 'woocommerce' ); ?>
				</div>
				<?php wc_cart_totals_shipping_html(); ?>
			</div>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<div class="py-2 border-b border-gray-100">
				<div class="text-gray-600 mb-2 flex items-center">
					<i class="fas fa-shipping-fast mr-2"></i>
					<?php esc_html_e( 'Livraison', 'woocommerce' ); ?>
				</div>
				<?php echo '<strong>' . esc_html__( 'Shipping', 'woocommerce' ) . '</strong>'; ?>
				<?php woocommerce_shipping_calculator(); ?>
			</div>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="flex justify-between items-center py-2 border-b border-gray-100">
				<span class="text-gray-600"><?php echo esc_html( $fee->name ); ?></span>
				<span class="font-medium text-gray-900"><?php wc_cart_totals_fee_html( $fee ); ?></span>
			</div>
		<?php endforeach; ?>

		<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				/* translators: %s location. */
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { ?>
					<div class="flex justify-between items-center py-2 border-b border-gray-100">
						<span class="text-gray-600"><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<span class="font-medium text-gray-900"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
					</div>
					<?php
				}
			} else { ?>
				<div class="flex justify-between items-center py-2 border-b border-gray-100">
					<span class="text-gray-600"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<span class="font-medium text-gray-900"><?php wc_cart_totals_taxes_total_html(); ?></span>
				</div>
				<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<div class="flex justify-between items-center py-4 border-t-2 border-gray-200 bg-gray-50 -mx-6 px-6 mt-4">
			<span class="text-lg font-bold text-gray-900"><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
			<span class="text-xl font-bold text-primary-600"><?php wc_cart_totals_order_total_html(); ?></span>
		</div>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</div>

	<div class="mt-6">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
