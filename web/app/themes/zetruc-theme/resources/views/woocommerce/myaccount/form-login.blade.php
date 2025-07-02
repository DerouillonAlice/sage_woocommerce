<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.9.0
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
			Connectez-vous à votre compte ou créez-en un nouveau
		</p>
	</div>

	<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
		<!-- Onglets -->
		<div class="bg-white shadow-lg sm:rounded-lg overflow-hidden">
			<div class="flex">
				<button onclick="showTab('login')" id="login-tab" class="flex-1 py-4 px-6 text-center font-medium border-b-2 border-primary-600 text-primary-600 bg-primary-50">
					<svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
					</svg>
					Connexion
				</button>
				<button onclick="showTab('register')" id="register-tab" class="flex-1 py-4 px-6 text-center font-medium border-b-2 border-gray-200 text-gray-500 hover:text-gray-700 transition-colors">
					<svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
					</svg>
					Inscription
				</button>
			</div>

			<!-- Contenu Connexion -->
			<div id="login-content" class="tab-content py-8 px-6">

				<form class="woocommerce-form woocommerce-form-login login space-y-6" method="post">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="username" class="block text-sm font-medium text-gray-700 mb-2">
							<?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;
							<span class="text-red-500" aria-hidden="true">*</span>
						</label>
						<div class="relative">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
								<svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
								</svg>
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
								<svg class="h-5 w-5 text-primary-300 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
								</svg>
							</span>
							<?php esc_html_e( 'Log in', 'woocommerce' ); ?>
						</button>
					</p>

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>

			</div>

			<!-- Contenu Inscription -->
			<div id="register-content" class="tab-content py-8 px-6 hidden">

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
						<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
							<span class="absolute left-0 inset-y-0 flex items-center pl-3">
								<svg class="h-5 w-5 text-green-300 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

	<?php else : ?>

	<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
		<div class="bg-white py-8 px-4 shadow-lg sm:rounded-lg sm:px-10">

			<div class="mb-6">
				<h2 class="text-2xl font-bold text-gray-900 flex items-center">
					<svg class="w-6 h-6 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
					</svg>
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
							<svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
							</svg>
						</div>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="votre@email.com" /><?php // @codingStandardsIgnoreLine ?>
					</div>
				</p>					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
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
							<svg class="h-5 w-5 text-primary-300 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
							</svg>
						</span>
						<?php esc_html_e( 'Log in', 'woocommerce' ); ?>
					</button>
				</p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>

		</div>
	</div>

	<?php endif; ?>

</div>

<script>
function showTab(tabName) {
	// Cacher tous les contenus
	document.querySelectorAll('.tab-content').forEach(content => {
		content.classList.add('hidden');
	});
	
	// Réinitialiser tous les onglets
	document.querySelectorAll('#login-tab, #register-tab').forEach(tab => {
		tab.classList.remove('border-primary-600', 'text-primary-600', 'bg-primary-50', 'border-green-600', 'text-green-600', 'bg-green-50');
		tab.classList.add('border-gray-200', 'text-gray-500');
	});
	
	// Afficher le contenu sélectionné et styliser l'onglet
	if (tabName === 'login') {
		document.getElementById('login-content').classList.remove('hidden');
		const loginTab = document.getElementById('login-tab');
		loginTab.classList.remove('border-gray-200', 'text-gray-500');
		loginTab.classList.add('border-primary-600', 'text-primary-600', 'bg-primary-50');
	} else if (tabName === 'register') {
		document.getElementById('register-content').classList.remove('hidden');
		const registerTab = document.getElementById('register-tab');
		registerTab.classList.remove('border-gray-200', 'text-gray-500');
		registerTab.classList.add('border-green-600', 'text-green-600', 'bg-green-50');
	}
}

// Gestion des paramètres URL pour navigation directe
document.addEventListener('DOMContentLoaded', function() {
	const urlParams = new URLSearchParams(window.location.search);
	const action = urlParams.get('action');
	
	if (action === 'register') {
		showTab('register');
	} else {
		showTab('login');
	}
});

// Fonctions de compatibilité
function scrollToRegister() {
	showTab('register');
}

function scrollToLogin() {
	showTab('login');
}
</script>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
