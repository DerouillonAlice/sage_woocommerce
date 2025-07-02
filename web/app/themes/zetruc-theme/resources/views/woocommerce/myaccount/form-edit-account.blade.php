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

<!-- En-tête stylisé -->
<div class="w-full max-w-4xl mx-auto  rounded-t-2xl p-6 ">
    <div class="flex items-center space-x-4">
        <i class="fas fa-user-circle  text-3xl"></i>
        <div>
            <h1 class="text-2xl font-bold "><?php esc_html_e( 'Modifier mon compte', 'woocommerce' ); ?></h1>
            <p class=" text-sm opacity-90"><?php esc_html_e( 'Mettez à jour vos informations personnelles et préférences', 'woocommerce' ); ?></p>
        </div>
    </div>
</div>

<form class="woocommerce-EditAccountForm edit-account w-full max-w-4xl mx-auto  p-4 space-y-6" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
		<div>
			<label for="account_first_name" class="block text-sm font-medium text-gray-700 mb-1">
				<?php esc_html_e( 'First name', 'woocommerce' ); ?> <span class="text-red-400">*</span>
			</label>
			<div class="relative">
				<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
					<i class="fas fa-user"></i>
				</span>
				<input type="text" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" aria-required="true" />
			</div>
		</div>
		<div>
			<label for="account_last_name" class="block text-sm font-medium text-gray-700 mb-1">
				<?php esc_html_e( 'Last name', 'woocommerce' ); ?> <span class="text-red-400">*</span>
			</label>
			<div class="relative">
				<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
					<i class="fas fa-user"></i>
				</span>
				<input type="text" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" aria-required="true" />
			</div>
		</div>
	</div>

	<div>
		<label for="account_display_name" class="block text-sm font-medium text-gray-700 mb-1">
			<?php esc_html_e( 'Display name', 'woocommerce' ); ?> <span class="text-red-400">*</span>
		</label>
		<div class="relative">
			<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
				<i class="fas fa-id-card"></i>
			</span>
			<input type="text" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" name="account_display_name" id="account_display_name" aria-describedby="account_display_name_description" value="<?php echo esc_attr( $user->display_name ); ?>" aria-required="true" />
		</div>
		<p id="account_display_name_description" class="mt-1 text-xs text-gray-500 italic">
			<i class="fas fa-info-circle mr-1"></i> <?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?>
		</p>
	</div>

	<div>
		<label for="account_email" class="block text-sm font-medium text-gray-700 mb-1">
			<?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="text-red-400">*</span>
		</label>
		<div class="relative">
			<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
				<i class="fas fa-envelope"></i>
			</span>
			<input type="email" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" aria-required="true" />
		</div>
	</div>

	<?php do_action( 'woocommerce_edit_account_form_fields' ); ?>

	<fieldset class="border border-gray-200 rounded-xl py-6 px-2 mt-6 relative">
		<legend class="text-lg font-semibold px-3 -ml-1 bg-white text-secondary">
			<i class="fas fa-key mr-2"></i><?php esc_html_e( 'Password change', 'woocommerce' ); ?>
		</legend>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-3">
			<div>
				<label for="password_current" class="block text-sm font-medium text-gray-700 mb-1">
					<?php esc_html_e( 'Current password', 'woocommerce' ); ?>
				</label>
				<div class="relative">
					<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
						<i class="fas fa-lock"></i>
					</span>
					<input type="password" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" name="password_current" id="password_current" autocomplete="off" />
				</div>
			</div>

			<div>
				<label for="password_1" class="block text-sm font-medium text-gray-700 mb-1">
					<?php esc_html_e( 'New password', 'woocommerce' ); ?>
				</label>
				<div class="relative">
					<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
						<i class="fas fa-key"></i>
					</span>
					<input type="password" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" name="password_1" id="password_1" autocomplete="off" />
				</div>
			</div>

			<div>
				<label for="password_2" class="block text-sm font-medium text-gray-700 mb-1">
					<?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?>
				</label>
				<div class="relative">
					<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
						<i class="fas fa-check-double"></i>
					</span>
					<input type="password" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" name="password_2" id="password_2" autocomplete="off" />
				</div>
			</div>
		</div>
		<div class="mt-3 text-xs text-gray-500">
			<div class="flex items-center">
				<i class="fas fa-info-circle mr-2 text-[var(--color-warning)]"></i>
				<span><?php esc_html_e( 'Laissez vide pour conserver votre mot de passe actuel.', 'woocommerce' ); ?></span>
			</div>
		</div>
	</fieldset>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<div class="pt-4 flex flex-col sm:flex-row items-center justify-start gap-4">
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="inline-flex items-center w-full sm:w-fit bg-primary justify-center text-white font-medium px-6 py-3 rounded-lg " name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>">
			<i class="fas fa-save mr-2"></i> <?php esc_html_e( 'Save changes', 'woocommerce' ); ?>
		</button>
		<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" class="inline-flex w-full sm:w-fit justify-center items-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium px-6 py-3 rounded-lg shadow-sm transition duration-150">
			<i class="fas fa-times mr-2"></i> <?php esc_html_e( 'Cancel', 'woocommerce' ); ?>
		</a>
		<input type="hidden" name="action" value="save_account_details" />
	</div>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>