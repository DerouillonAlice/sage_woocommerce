<?php
/**
 * Register Only Form
 *
 * Custom template for registration only
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( 'no' === get_option( 'woocommerce_enable_myaccount_registration' ) ) {
	wp_redirect( wc_get_page_permalink( 'myaccount' ) );
	exit;
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="flex flex-col justify-center py-12 sm:px-6 lg:px-8">
	<div class="sm:mx-auto sm:w-full sm:max-w-md">
		<h1 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
			<?php echo get_bloginfo('name'); ?>
		</h1>
		<p class="mt-2 text-center text-sm text-gray-600">
			Créez votre nouveau compte
		</p>
	</div>

	<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
		<div class="bg-white py-8 px-4 shadow-lg sm:rounded-lg sm:px-10">

			<div class="mb-6">
				<h2 class="text-2xl font-bold text-gray-900 flex items-center">
					<svg class="w-6 h-6 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
					</svg>
					<?php esc_html_e( 'Register', 'woocommerce' ); ?>
				</h2>
				<p class="mt-2 text-sm text-gray-600">Créez votre compte en quelques clics</p>
			</div>

			<form method="post" class="woocommerce-form woocommerce-form-register register space-y-6" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_username" class="block text-sm font-medium text-gray-700 mb-2">
							<?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;
							<span class="text-red-500" aria-hidden="true">*</span>
						</label>
						<div class="relative">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
								<svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
								</svg>
							</div>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="Votre nom d'utilisateur" /><?php // @codingStandardsIgnoreLine ?>
						</div>
					</p>

				<?php endif; ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_email" class="block text-sm font-medium text-gray-700 mb-2">
						<?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;
						<span class="text-red-500" aria-hidden="true">*</span>
					</label>
					<div class="relative">
						<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
							<svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
							</svg>
						</div>
						<input type="email" class="woocommerce-Input woocommerce-Input--text input-text block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" placeholder="votre@email.com" /><?php // @codingStandardsIgnoreLine ?>
					</div>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_password" class="block text-sm font-medium text-gray-700 mb-2">
							<?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;
							<span class="text-red-500" aria-hidden="true">*</span>
						</label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text block w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" name="password" id="reg_password" autocomplete="new-password" placeholder="Créer un mot de passe" />
					</p>

				<?php else : ?>

					<div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
						<div class="flex">
							<div class="flex-shrink-0">
								<svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
								</svg>
							</div>
							<div class="ml-3">
								<p class="text-sm text-blue-700"><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>
							</div>
						</div>
					</div>

				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<p class="woocommerce-form-row form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
						<span class="absolute left-0 inset-y-0 flex items-center pl-3">
							<svg class="h-5 w-5 text-primary-300 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
							</svg>
						</span>
						<?php esc_html_e( 'Register', 'woocommerce' ); ?>
					</button>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>

		</div>
	</div>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
