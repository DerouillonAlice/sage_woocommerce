<?php
/**
 * Login Only Form
 *
 * Custom template for login only (without registration)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="flex flex-col justify-center py-12 sm:px-6 lg:px-8">
	<div class="sm:mx-auto sm:w-full sm:max-w-md">
		<h1 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
			<?php echo get_bloginfo('name'); ?>
		</h1>
		<p class="mt-2 text-center text-sm text-gray-600">
			Connectez-vous à votre compte
		</p>
	</div>

	<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
		<div class="bg-white py-8 px-4 shadow-lg sm:rounded-lg sm:px-10">

			<div class="mb-6">
				<h2 class="text-2xl font-bold text-gray-900 flex items-center">
					<i class="fas fa-sign-in-alt w-6 h-6 mr-2 text-primary-600"></i>
					<?php esc_html_e( 'Login', 'woocommerce' ); ?>
				</h2>
				<p class="mt-2 text-sm text-gray-600">Accédez à votre espace personnel</p>
			</div>

			<form class="woocommerce-form woocommerce-form-login login space-y-6" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="username" class="block text-sm font-medium text-gray-700 mb-2">
						<?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;
						<span class="text-red-500" aria-hidden="true">*</span>
					</label>
					<div class="relative">
						<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
							<i class="fas fa-user h-5 w-5 text-gray-400"></i>
						</div>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="votre@email.com" /><?php // @codingStandardsIgnoreLine ?>
					</div>
				</p>
				
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="password" class="block text-sm font-medium text-gray-700 mb-2">
						<?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;
						<span class="text-red-500" aria-hidden="true">*</span>
					</label>
					<input class="woocommerce-Input woocommerce-Input--text input-text block w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" type="password" name="password" id="password" autocomplete="current-password" placeholder="Votre mot de passe" />
				</p>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<div class="flex items-center justify-between">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme flex items-center">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" name="rememberme" type="checkbox" id="rememberme" value="forever" /> 
						<span class="ml-2 block text-sm text-gray-700"><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
					</label>
					<div class="text-sm">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="font-medium text-primary-600 hover:text-primary-500 transition-colors">
							<?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?>
						</a>
					</div>
				</div>

				<p class="form-row">
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<button type="submit" class="woocommerce-button button woocommerce-form-login__submit group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
						<span class="absolute left-0 inset-y-0 flex items-center pl-3">
							<i class="fas fa-sign-in-alt text-primary-300 group-hover:text-primary-400 transition-colors"></i>
						</span>
						<?php esc_html_e( 'Log in', 'woocommerce' ); ?>
					</button>
				</p>

				<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
				

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>

		</div>
	</div>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
