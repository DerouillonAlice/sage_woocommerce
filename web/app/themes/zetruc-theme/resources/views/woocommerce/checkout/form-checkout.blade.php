

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
	echo '<div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">';
	echo '<div class="flex items-center">';
	echo '<i class="fas fa-exclamation-triangle text-yellow-600 mr-3"></i>';
	echo '<div>';
	echo '<p class="text-yellow-800 font-medium">' . esc_html( $messages['login_required'] ?? 'Vous devez être connecté pour finaliser votre commande.' ) . '</p>';
	echo '<div class="mt-3 flex gap-3">';
	echo '<a href="' . esc_url( wp_login_url( wc_get_checkout_url() ) ) . '" class="inline-flex items-center px-3 py-2 bg-primary-600 text-white text-sm font-medium rounded-md hover:bg-primary-700 transition-colors">';
	echo esc_html( $messages['login_button_text'] ?? 'Se connecter' );
	echo '</a>';
	if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
		echo '<a href="' . esc_url( wp_registration_url() ) . '" class="inline-flex items-center px-3 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 transition-colors">';
		echo esc_html( $messages['register_button_text'] ?? 'Créer un compte' );
		echo '</a>';
	}
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	return;
}


?>

<div class="min-h-screen py-8">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="text-center mb-8">
			<h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $checkout_header['title'] ?? 'Finaliser votre commande' }}</h1>
			<p class="text-gray-600">{{ $checkout_header['description'] ?? 'Vérifiez vos informations et procédez au paiement en toute sécurité' }}</p>
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
									<i class="{{ $customer_info['billing_icon'] ?? 'fas fa-user' }} w-5 h-5 mr-2 text-primary-600"></i>
									{{ $customer_info['billing_title'] ?? 'Informations de facturation' }}
								</h2>
								<div class="billing-fields">
									<?php do_action( 'woocommerce_checkout_billing' ); ?>
								</div>
							</div>

							<!-- Informations de livraison -->
							<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
								<h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
									<i class="{{ $customer_info['shipping_icon'] ?? 'fas fa-shipping-fast' }} w-5 h-5 mr-2 text-primary-600"></i>
									{{ $customer_info['shipping_title'] ?? 'Adresse de livraison' }}
								</h2>
								<div class="shipping-fields">
									<?php do_action( 'woocommerce_checkout_shipping' ); ?>
								</div>
							</div>
						</div>

						<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

					<?php endif; ?>


				</div>

				<!-- Section droite : Récapitulatif de commande -->
				<div class="lg:col-span-5">
					<div class="{{ ($display_options['sticky_summary'] ?? true) ? 'sticky top-8' : '' }}">
						<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
							<h3 id="order_review_heading" class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
								<i class="{{ $order_summary['icon'] ?? 'fas fa-clipboard-list' }} w-5 h-5 mr-2 text-primary-600"></i>
								{{ $order_summary['title'] ?? 'Récapitulatif de votre commande' }}
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
