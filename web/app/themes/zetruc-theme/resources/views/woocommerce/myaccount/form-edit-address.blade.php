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

	<form method="post" novalidate class="w-full max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-10 space-y-6">
		<h2 class="text-2xl font-bold text-gray-800 mb-6">
			<?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?>
		</h2>
		<div class="woocommerce-address-fields">
			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

			<div class="woocommerce-address-fields__field-wrapper grid grid-cols-1 md:grid-cols-2 gap-6">
				<?php
				foreach ( $address as $key => $field ) {
					// Ajout classes Tailwind aux champs
					if ( isset($field['input_class']) && is_array($field['input_class']) ) {
						$field['input_class'][] = 'w-full';
						$field['input_class'][] = 'border';
						$field['input_class'][] = 'border-gray-300';
						$field['input_class'][] = 'rounded-lg';
						$field['input_class'][] = 'px-4';
						$field['input_class'][] = 'py-2';
						$field['input_class'][] = 'focus:outline-none';
						$field['input_class'][] = 'focus:ring-2';
						$field['input_class'][] = 'focus:ring-blue-500';
						$field['input_class'][] = 'focus:border-blue-500';
					} else {
						$field['input_class'] = [
							'w-full','border','border-gray-300','rounded-lg','px-4','py-2','focus:outline-none','focus:ring-2','focus:ring-blue-500','focus:border-blue-500'
						];
					}
					woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
				}
				?>
			</div>

			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

			<div class="pt-6 flex items-center justify-start gap-4">
				<button type="submit" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg shadow-sm transition duration-150" name="save_address" value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>">
					<?php esc_html_e( 'Save address', 'woocommerce' ); ?>
				</button>
				<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</div>
		</div>
	</form>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
