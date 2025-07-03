<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php else : ?>

	<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
		<form method="post" novalidate class="bg-white rounded-xl border border-gray-200 overflow-hidden">
			
			<!-- En-tête du formulaire -->
			<div class="<?php echo ( 'billing' === $load_address ) ? 'bg-secondary-100 ' : 'bg-primary-100'; ?> px-8 py-6 border-b border-gray-200">
				<div class="flex items-center">
					<div class="w-12 h-12 <?php echo ( 'billing' === $load_address ) ? 'bg-secondary-100' : 'bg-primary-100'; ?> rounded-lg flex items-center justify-center mr-4">
						<i class="<?php echo ( 'billing' === $load_address ) ? 'fas fa-credit-card text-secondary-600' : 'fas fa-shipping-fast text-primary-600'; ?> text-xl"></i>
					</div>
					<div>
						<h2 class="text-2xl font-bold text-gray-900">
							<?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?>
						</h2>
						<p class="text-gray-600 mt-1">
							<?php echo ( 'billing' === $load_address ) ? 'Modifiez votre adresse de facturation' : 'Modifiez votre adresse de livraison'; ?>
						</p>
					</div>
				</div>
			</div>

			<!-- Corps du formulaire -->
			<div class="p-8">
				<div class="woocommerce-address-fields">
					<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

					<div class="woocommerce-address-fields__field-wrapper space-y-6">
						<?php
						foreach ( $address as $key => $field ) {
							// Wrapper personnalisé pour chaque champ
							echo '<div class="form-group">';
							
							// Ajout classes Tailwind aux champs
							if ( isset($field['input_class']) && is_array($field['input_class']) ) {
								$field['input_class'][] = 'w-full';
								$field['input_class'][] = 'border';
								$field['input_class'][] = 'border-gray-300';
								$field['input_class'][] = 'rounded-lg';
								$field['input_class'][] = 'px-4';
								$field['input_class'][] = 'py-3';
								$field['input_class'][] = 'text-gray-900';
								$field['input_class'][] = 'placeholder-gray-500';
								$field['input_class'][] = 'focus:outline-none';
								$field['input_class'][] = 'focus:ring-2';
								$field['input_class'][] = 'focus:ring-primary-500';
								$field['input_class'][] = 'focus:border-primary-500';
								$field['input_class'][] = 'transition-colors';
							} else {
								$field['input_class'] = [
									'w-full','border','border-gray-300','rounded-lg','px-4','py-3','text-gray-900','placeholder-gray-500','focus:outline-none','focus:ring-2','focus:ring-primary-500','focus:border-primary-500','transition-colors'
								];
							}
							
							// Style des labels
							if ( isset($field['label_class']) && is_array($field['label_class']) ) {
								$field['label_class'][] = 'block';
								$field['label_class'][] = 'text-sm';
								$field['label_class'][] = 'font-medium';
								$field['label_class'][] = 'text-gray-700';
								$field['label_class'][] = 'mb-2';
							} else {
								$field['label_class'] = [
									'block','text-sm','font-medium','text-gray-700','mb-2'
								];
							}
							
							woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
							
							echo '</div>';
						}
						?>
					</div>

					<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>
				</div>
			</div>

			<!-- Pied du formulaire -->
			<div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
				<div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
					<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address' ) ); ?>" 
					   class="inline-flex items-center w-full sm:w-fit px-4 py-2 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
						<i class="fas fa-arrow-left mr-2"></i>
						Retour
					</a>
					
					<button type="submit" 
							class="inline-flex items-center w-full sm:w-fit px-6 py-3 <?php echo ( 'billing' === $load_address ) ? 'bg-secondary-600 hover:bg-secondary-700' : 'bg-primary-600 hover:bg-primary-700'; ?> text-white font-medium rounded-lg shadow-sm transition-colors duration-200" 
							name="save_address" 
							value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>">
						<i class="fas fa-save mr-2"></i>
						<?php esc_html_e( 'Enregistrer l\'adresse', 'woocommerce' ); ?>
					</button>
				</div>
				
				<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</div>
		</form>
	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
