<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>


<div class="max-w-3xl mx-auto mt-10 bg-white rounded-2xl shadow-lg p-8">
	<div class="mb-6">
		<?php
		printf(
			/* translators: 1: user display name 2: logout url */
			'<span class="text-lg font-semibold text-gray-800">' . esc_html__( 'Bonjour', 'woocommerce' ) . ' %1$s</span> <span class="text-gray-500">(</span><a href="%2$s" class="text-blue-600 hover:underline font-medium">' . esc_html__( 'Déconnexion', 'woocommerce' ) . '</a><span class="text-gray-500">)</span>',
			'<span class="font-bold">' . esc_html( $current_user->display_name ) . '</span>',
			esc_url( wc_logout_url() )
		);
		?>
	</div>
	<div class="mb-4 text-gray-700">
		<?php
		/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
		$dashboard_desc = __( 'Depuis votre tableau de bord, vous pouvez consulter vos <a href="%1$s" class="text-blue-600 hover:underline">commandes récentes</a>, gérer vos <a href="%2$s" class="text-blue-600 hover:underline">adresses</a> et <a href="%3$s" class="text-blue-600 hover:underline">modifier votre mot de passe et vos informations</a>.', 'woocommerce' );
		if ( wc_shipping_enabled() ) {
			$dashboard_desc = __( 'Depuis votre tableau de bord, vous pouvez consulter vos <a href="%1$s" class="text-blue-600 hover:underline">commandes récentes</a>, gérer vos <a href="%2$s" class="text-blue-600 hover:underline">adresses de livraison et de facturation</a> et <a href="%3$s" class="text-blue-600 hover:underline">modifier votre mot de passe et vos informations</a>.', 'woocommerce' );
		}
		printf(
			wp_kses( $dashboard_desc, $allowed_html ),
			esc_url( wc_get_endpoint_url( 'orders' ) ),
			esc_url( wc_get_endpoint_url( 'edit-address' ) ),
			esc_url( wc_get_endpoint_url( 'edit-account' ) )
		);
		?>
	</div>

	<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );
	?>
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
