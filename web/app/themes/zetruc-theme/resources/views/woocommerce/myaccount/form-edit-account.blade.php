<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook - woocommerce_before_edit_account_form.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_before_edit_account_form' );
?>



<form class="woocommerce-EditAccountForm edit-account w-full max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-10 space-y-6" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
		<div>
			<label for="account_first_name" class="block text-sm font-medium text-gray-700 mb-1">
				<?php esc_html_e( 'First name', 'woocommerce' ); ?> <span class="text-red-500">*</span>
			</label>
			<input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" aria-required="true" />
		</div>
		<div>
			<label for="account_last_name" class="block text-sm font-medium text-gray-700 mb-1">
				<?php esc_html_e( 'Last name', 'woocommerce' ); ?> <span class="text-red-500">*</span>
			</label>
			<input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" aria-required="true" />
		</div>
	</div>

	<div>
		<label for="account_display_name" class="block text-sm font-medium text-gray-700 mb-1">
			<?php esc_html_e( 'Display name', 'woocommerce' ); ?> <span class="text-red-500">*</span>
		</label>
		<input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="account_display_name" id="account_display_name" aria-describedby="account_display_name_description" value="<?php echo esc_attr( $user->display_name ); ?>" aria-required="true" />
		<p id="account_display_name_description" class="mt-1 text-xs text-gray-500 italic">
			<?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?>
		</p>
	</div>

	<div>
		<label for="account_email" class="block text-sm font-medium text-gray-700 mb-1">
			<?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="text-red-500">*</span>
		</label>
		<input type="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" aria-required="true" />
	</div>

	<?php do_action( 'woocommerce_edit_account_form_fields' ); ?>

	<fieldset class="border border-gray-200 rounded-xl p-6 mt-6">
		<legend class="text-lg font-semibold text-gray-800 mb-4">
			<?php esc_html_e( 'Password change', 'woocommerce' ); ?>
		</legend>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
			<div>
				<label for="password_current" class="block text-sm font-medium text-gray-700 mb-1">
					<?php esc_html_e( 'Current password', 'woocommerce' ); ?>
				</label>
				<input type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="password_current" id="password_current" autocomplete="off" />
			</div>

			<div>
				<label for="password_1" class="block text-sm font-medium text-gray-700 mb-1">
					<?php esc_html_e( 'New password', 'woocommerce' ); ?>
				</label>
				<input type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="password_1" id="password_1" autocomplete="off" />
			</div>

			<div>
				<label for="password_2" class="block text-sm font-medium text-gray-700 mb-1">
					<?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?>
				</label>
				<input type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="password_2" id="password_2" autocomplete="off" />
			</div>
		</div>
	</fieldset>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<div class="pt-6 flex items-center justify-start gap-4">
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg shadow-sm transition duration-150" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>">
			<?php esc_html_e( 'Save changes', 'woocommerce' ); ?>
		</button>
		<input type="hidden" name="action" value="save_account_details" />
	</div>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>


<!-- 