

{{-- 
Template Name: Checkout
--}}

<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}


?>

<div class="min-h-screen py-8">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="text-center mb-8">
			<h1 class="text-3xl font-bold text-gray-900 mb-2">Finaliser votre commande</h1>
			<p class="text-gray-600">Vérifiez vos informations et procédez au paiement en toute sécurité</p>
		</div>

		<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

			<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
				<!-- Section gauche : Informations client -->
				<div class="lg:col-span-7">
					<?php if ( $checkout->get_checkout_fields() ) : ?>

						<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

						<div id="customer_details" class="space-y-6">
							<!-- Informations de facturation -->
							<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
								<h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
									<i class="fas fa-user w-5 h-5 mr-2 text-primary-600"></i>
									Informations de facturation
								</h2>
								<div class="billing-fields">
									<?php do_action( 'woocommerce_checkout_billing' ); ?>
								</div>
							</div>

							<!-- Informations de livraison -->
							<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
								<h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
									<i class="fas fa-shipping-fast w-5 h-5 mr-2 text-primary-600"></i>
									Adresse de livraison
								</h2>
								<div class="shipping-fields">
									<?php do_action( 'woocommerce_checkout_shipping' ); ?>
								</div>
							</div>
						</div>

						<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

					<?php endif; ?>

					<!-- Notes de commande -->
					<!-- <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mt-6">
						<h3 class="text-lg font-semibold text-gray-900 mb-4">Notes de commande (optionnel)</h3>
						<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
						<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
					</div> -->
				</div>

				<!-- Section droite : Récapitulatif de commande -->
				<div class="lg:col-span-5">
					<div class="sticky top-8">
						<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
							<h3 id="order_review_heading" class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
								<i class="fas fa-clipboard-list w-5 h-5 mr-2 text-primary-600"></i>
								Récapitulatif de votre commande
							</h3>

							<div id="order_review" class="woocommerce-checkout-review-order">
								<?php do_action( 'woocommerce_checkout_order_review' ); ?>
							</div>

						</div>
					</div>
				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

		</form>
	</div>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
