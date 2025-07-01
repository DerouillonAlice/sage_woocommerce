<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="woocommerce-form-coupon-toggle mb-4">
	<?php
		wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message',
			'<span class="font-medium text-gray-700">' . esc_html__( 'Vous avez un code promo ?', 'woocommerce' ) . '</span> <a href="#" role="button" aria-label="' . esc_attr__( 'Entrer votre code promo', 'woocommerce' ) . '" aria-controls="woocommerce-checkout-form-coupon" aria-expanded="false" class="showcoupon text-blue-600 hover:underline font-semibold">' . esc_html__( 'Cliquez ici pour le saisir', 'woocommerce' ) . '</a>'
		), 'notice' );
	?>
</div>

<form class="checkout_coupon woocommerce-form-coupon bg-white  p-6 flex flex-col md:flex-row items-center gap-4 mb-8" method="post" style="display:none" id="woocommerce-checkout-form-coupon">
	<label for="coupon_code" class="sr-only"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
	<input type="text" name="coupon_code" class="input-text w-full md:w-64 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="<?php esc_attr_e( 'Code promo', 'woocommerce' ); ?>" id="coupon_code" value="" />
	<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Appliquer', 'woocommerce' ); ?></button>
</form>
