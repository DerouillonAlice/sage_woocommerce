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

if ( ! wc_coupons_enabled() ) {
    return;
}

?>
<div class="mt-4 border-t border-gray-200 pt-4">
    <div class="mb-3">
        <button type="button" class="w-full text-left flex items-center justify-between p-3 bg-secondary-50 border border-secondary-200 rounded-lg text-secondary-700 hover:bg-secondary-100 transition-colors" id="toggle-coupon-form">
            <span class="flex items-center font-medium">
                <i class="fas fa-tag w-4 h-4 mr-2"></i>
                <?php esc_html_e( 'Avez-vous un code promo ?', 'woocommerce' ); ?>
            </span>
            <i class="fas fa-chevron-down w-4 h-4 transform transition-transform" id="coupon-arrow"></i>
        </button>
    </div>

    <form class="checkout_coupon woocommerce-form-coupon bg-gray-50 rounded-lg p-4 hidden" method="post" id="coupon-form-review">
        <?php wp_nonce_field( 'woocommerce-apply_coupon', 'woocommerce-apply-coupon-nonce' ); ?>
        <div class="flex gap-3">
            <div class="flex-1">
                <input type="text" name="coupon_code" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="<?php esc_attr_e( 'Code promo', 'woocommerce' ); ?>" id="coupon_code" />
            </div>
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
                <?php esc_html_e( 'Appliquer', 'woocommerce' ); ?>
            </button>
        </div>
        <p class="text-xs text-gray-600 mt-2">Saisissez votre code promo pour bénéficier d'une réduction.</p>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggle-coupon-form');
        const couponForm = document.getElementById('coupon-form-review');
        const arrow = document.getElementById('coupon-arrow');
        
        if (toggleBtn && couponForm && arrow) {
            toggleBtn.addEventListener('click', function() {
                couponForm.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            });
        }
    });
    </script>
</div>
