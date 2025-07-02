<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
			<?php
			$fields = $checkout->get_checkout_fields( 'billing' );

			foreach ( $fields as $key => $field ) {
				// Déterminer la classe de colonnes
				$col_class = 'col-span-1';
				if ( in_array( $key, array( 'billing_address_1', 'billing_address_2', 'billing_company' ) ) ) {
					$col_class = 'col-span-1 md:col-span-2';
				}
				
				echo '<div class="' . $col_class . '">';
				woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
				echo '</div>';
			}
			?>
		</div>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields mt-6">
		<?php if ( ! $checkout->is_registration_required() ) : ?>
			<div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox flex items-center">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox mr-2" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" />
					<span class="text-blue-800 font-medium"><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</div>
		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>
			<div class="create-account mt-4" style="<?php echo ( ! $checkout->is_registration_required() ) ? 'display:none;' : ''; ?>">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
