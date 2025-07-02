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
		'class' => array(),
	),
);

// Récupération des données utilisateur
$customer = WC()->customer;
$orders = wc_get_orders( array(
	'customer' => get_current_user_id(),
	'limit' => 5,
	'orderby' => 'date',
	'order' => 'DESC',
) );
$total_orders = wc_get_customer_order_count( get_current_user_id() );
$total_spent = wc_get_customer_total_spent( get_current_user_id() );
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	
	<!-- En-tête de bienvenue -->
	<div class="bg-primary-500 rounded-2xl p-8 mb-8 text-white">
		<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
			<div>
				<h1 class="text-3xl font-bold mb-2">
					<?php printf( esc_html__( 'Bonjour %s !', 'woocommerce' ), esc_html( $current_user->display_name ) ); ?>
				</h1>
				<p class="text-lg">
					<?php esc_html_e( 'Bienvenue dans votre espace personnel', 'woocommerce' ); ?>
				</p>
			</div>

		</div>
	</div>

	<!-- Statistiques rapides -->
	<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
		<!-- Total des commandes -->
		<div class="bg-white rounded-xl  p-6 border border-gray-200">
			<div class="flex items-center">
				<div class="flex-shrink-0">
					<div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
						<i class="fas fa-shopping-bag text-blue-600 text-xl"></i>
					</div>
				</div>
				<div class="ml-4">
					<h3 class="text-lg font-semibold text-gray-900"><?php echo esc_html( $total_orders ); ?></h3>
					<p class="text-gray-600"><?php esc_html_e( 'Commandes passées', 'woocommerce' ); ?></p>
				</div>
			</div>
		</div>

		<!-- Total dépensé -->
		<div class="bg-white rounded-xl  p-6 border border-gray-200">
			<div class="flex items-center">
				<div class="flex-shrink-0">
					<div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
						<i class="fas fa-euro-sign text-primary-600 text-xl"></i>
					</div>
				</div>
				<div class="ml-4">
					<h3 class="text-lg font-semibold text-gray-900"><?php echo wp_kses_post( wc_price( $total_spent ) ); ?></h3>
					<p class="text-gray-600"><?php esc_html_e( 'Total dépensé', 'woocommerce' ); ?></p>
				</div>
			</div>
		</div>
	</div>

	<!-- Actions rapides -->
	<div class="bg-white rounded-xl  border border-gray-200 p-6 mb-8">

		
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
			<!-- Voir les commandes -->
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'orders' ) ); ?>" class="group flex flex-col items-center p-4 bg-gray-50 hover:bg-primary-50 rounded-lg transition-colors border border-gray-200 hover:border-primary-200">
				<div class="w-10 h-10 bg-primary-100 group-hover:bg-primary-200 rounded-lg flex items-center justify-center mb-3 transition-colors">
					<i class="fas fa-list-alt text-primary-600"></i>
				</div>
				<span class="text-sm font-medium text-gray-900 text-center"><?php esc_html_e( 'Mes commandes', 'woocommerce' ); ?></span>
			</a>

			<!-- Gérer les adresses -->
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address' ) ); ?>" class="group flex flex-col items-center p-4 bg-gray-50 hover:bg-primary-50 rounded-lg transition-colors border border-gray-200 hover:border-primary-200">
				<div class="w-10 h-10 bg-primary-100 group-hover:bg-primary-200 rounded-lg flex items-center justify-center mb-3 transition-colors">
					<i class="fas fa-map-marker-alt text-primary-600"></i>
				</div>
				<span class="text-sm font-medium text-gray-900 text-center"><?php esc_html_e( 'Mes adresses', 'woocommerce' ); ?></span>
			</a>

			<!-- Modifier le compte -->
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' ) ); ?>" class="group flex flex-col items-center p-4 bg-gray-50 hover:bg-primary-50 rounded-lg transition-colors border border-gray-200 hover:border-primary-200">
				<div class="w-10 h-10 bg-primary-100 group-hover:bg-primary-200 rounded-lg flex items-center justify-center mb-3 transition-colors">
					<i class="fas fa-user-edit text-primary-600"></i>
				</div>
				<span class="text-sm font-medium text-gray-900 text-center"><?php esc_html_e( 'Mon profil', 'woocommerce' ); ?></span>
			</a>

			<!-- Continuer les achats -->
			<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="group flex flex-col items-center p-4 bg-gray-50 hover:bg-primary-50 rounded-lg transition-colors border border-gray-200 hover:border-primary-200">
				<div class="w-10 h-10 bg-primary-100 group-hover:bg-primary-200 rounded-lg flex items-center justify-center mb-3 transition-colors">
					<i class="fas fa-shopping-cart text-primary-600"></i>
				</div>
				<span class="text-sm font-medium text-gray-900 text-center"><?php esc_html_e( 'Continuer mes achats', 'woocommerce' ); ?></span>
			</a>
		</div>
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

