<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}

$oldcol = 1;
$col    = 1;
?>


<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<!-- En-tête de la section -->
	<div class="mb-8">
		<h1 class="text-3xl font-bold text-gray-900 mb-3 flex items-center">
			<i class="fas fa-map-marker-alt text-primary-600 mr-3"></i>
			Mes adresses
		</h1>
		<p class="text-gray-600 text-lg">
			<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'Gérez vos adresses de facturation et de livraison pour faciliter vos commandes futures.', 'woocommerce' ) ); ?>
		</p>
	</div>


<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
<?php endif; ?>

<?php foreach ( $get_addresses as $name => $address_title ) : ?>
	<?php
		$address = wc_get_account_formatted_address( $name );
		$col     = $col * -1;
		$oldcol  = $oldcol * -1;
	?>

	<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
		<!-- En-tête de la carte d'adresse -->
		<div class=" px-6 py-4 border-b border-gray-200">
			<div class="flex items-center justify-between">
				<div class="flex items-center">
					<div class="w-10 h-10 <?php echo $name === 'billing' ? 'bg-secondary-100' : 'bg-primary-100'; ?> rounded-lg flex items-center justify-center mr-3">
						<i class="<?php echo $name === 'billing' ? 'fas fa-credit-card text-secondary-600' : 'fas fa-shipping-fast text-primary-600'; ?> text-lg"></i>
					</div>
					<h3 class="text-xl font-semibold text-gray-900"><?php echo esc_html( $address_title ); ?></h3>
				</div>
				<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" 
				   class="inline-flex items-center px-4 py-2 <?php echo $name === 'billing' ? 'bg-secondary-600 hover:bg-secondary-700' : 'bg-primary-600 hover:bg-primary-700'; ?> text-white text-sm font-medium rounded-lg transition-colors duration-200">
					<i class="fas fa-edit mr-2"></i>
					<?php
						echo $address ? esc_html__( 'Modifier', 'woocommerce' ) : esc_html__( 'Ajouter', 'woocommerce' );
					?>
				</a>
			</div>
		</div>

		<!-- Contenu de l'adresse -->
		<div class="p-6">
			<?php if ( $address ) : ?>
				<div class="space-y-3">
					<div class="flex items-start">
						<i class="fas fa-map-marker-alt text-gray-400 mt-1 mr-3 flex-shrink-0"></i>
						<address class="text-gray-700 leading-relaxed not-italic">
							<?php echo wp_kses_post( $address ); ?>
						</address>
					</div>
				</div>
				
				<!-- Statut de l'adresse -->
				<div class="mt-4 pt-4 border-t border-gray-100">
					<div class="flex items-center gap-4 flex-col  sm:flex-row justify-between">
						<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
							<i class="fas fa-check-circle mr-1"></i>
							Adresse configurée
						</span>
						<span class="text-xs text-gray-500">
							<?php echo $name === 'billing' ? 'Utilisée pour la facturation' : 'Utilisée pour la livraison'; ?>
						</span>
					</div>
				</div>
			<?php else : ?>
				<!-- État vide -->
				<div class="text-center py-8">
					<div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
						<i class="fas fa-plus text-gray-400 text-xl"></i>
					</div>
					<h4 class="text-lg font-medium text-gray-900 mb-2">Aucune adresse configurée</h4>
					<p class="text-gray-600 mb-4">
						<?php echo $name === 'billing' ? 'Ajoutez votre adresse de facturation pour faciliter vos achats.' : 'Ajoutez votre adresse de livraison pour recevoir vos commandes.'; ?>
					</p>
					<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" 
					   class="inline-flex items-center px-4 py-2 <?php echo $name === 'billing' ? 'bg-secondary-600 hover:bg-secondary-700' : 'bg-primary-600 hover:bg-primary-700'; ?> text-white text-sm font-medium rounded-lg transition-colors duration-200">
						<i class="fas fa-plus mr-2"></i>
						Ajouter une adresse
					</a>
				</div>
			<?php endif; ?>

			<?php
				/**
				 * Used to output content after core address fields.
				 *
				 * @param string $name Address type.
				 * @since 8.7.0
				 */
				do_action( 'woocommerce_my_account_after_my_address', $name );
			?>
		</div>
	</div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	</div>
<?php endif; ?>

</div>
