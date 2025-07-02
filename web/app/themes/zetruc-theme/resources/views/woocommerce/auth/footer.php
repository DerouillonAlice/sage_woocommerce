<?php
/**
 * Auth footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/auth/footer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Auth
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
		</div>
		
		<!-- Footer E-commerce -->
		<footer class="bg-gray-900 text-white">
			<!-- Section principale du footer -->
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
					
					<!-- Informations entreprise -->
					<div class="space-y-4">
						<div class="flex items-center space-x-2">
							<div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
								<svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
									<path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
								</svg>
							</div>
							<h3 class="text-xl font-bold"><?php echo get_bloginfo('name'); ?></h3>
						</div>
						<p class="text-gray-400 text-sm leading-relaxed">
							Votre boutique en ligne de confiance. Nous proposons des produits de qualité avec un service client exceptionnel.
						</p>
						<div class="flex space-x-4">
							<a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
								<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
									<path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
								</svg>
							</a>
							<a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
								<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
									<path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
								</svg>
							</a>
							<a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
								<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
									<path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.097.118.112.221.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
								</svg>
							</a>
							<a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
								<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
									<path d="M12.007 0C5.348 0 0 5.348 0 12.007 0 18.665 5.348 24.014 12.007 24.014S24.014 18.665 24.014 12.007C24.014 5.348 18.666.001 12.007.001zM18.464 9.155c.006.133.009.266.009.4 0 4.077-3.102 8.78-8.78 8.78a8.738 8.738 0 01-4.735-1.384c.241.029.487.042.737.042a6.172 6.172 0 003.827-1.317 3.087 3.087 0 01-2.883-2.14c.191.037.387.056.588.056.285 0 .561-.038.824-.11a3.085 3.085 0 01-2.473-3.026v-.04c.457.254.979.406 1.534.424a3.086 3.086 0 01-.954-4.116 8.755 8.755 0 006.354 3.221 3.085 3.085 0 015.253-2.813 6.16 6.16 0 001.956-.748 3.092 3.092 0 01-1.356 1.706A6.12 6.12 0 0019.91 8.05a6.197 6.197 0 01-1.446 1.105z"/>
								</svg>
							</a>
						</div>
					</div>

					<!-- Liens rapides -->
					<div class="space-y-4">
						<h4 class="text-lg font-semibold">Liens rapides</h4>
						<ul class="space-y-2 text-sm">
							<li><a href="<?php echo home_url(); ?>" class="text-gray-400 hover:text-white transition-colors duration-200">Accueil</a></li>
							<li><a href="<?php echo wc_get_page_permalink('shop'); ?>" class="text-gray-400 hover:text-white transition-colors duration-200">Boutique</a></li>
							<li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">À propos</a></li>
							<li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Contact</a></li>
							<li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Blog</a></li>
						</ul>
					</div>

					<!-- Service client -->
					<div class="space-y-4">
						<h4 class="text-lg font-semibold">Service client</h4>
						<ul class="space-y-2 text-sm">
							<li><a href="<?php echo wc_get_page_permalink('myaccount'); ?>" class="text-gray-400 hover:text-white transition-colors duration-200">Mon compte</a></li>
							<li><a href="<?php echo wc_get_page_permalink('cart'); ?>" class="text-gray-400 hover:text-white transition-colors duration-200">Panier</a></li>
							<li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Suivi de commande</a></li>
							<li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Retours & Échanges</a></li>
							<li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">FAQ</a></li>
						</ul>
					</div>

					<!-- Informations légales -->
					<div class="space-y-4">
						<h4 class="text-lg font-semibold">Informations légales</h4>
						<ul class="space-y-2 text-sm">
							<li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Mentions légales</a></li>
							<li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Conditions générales</a></li>
							<li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Politique de confidentialité</a></li>
							<li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Cookies</a></li>
						</ul>
						
						<!-- Moyens de paiement -->
						<div class="mt-6">
							<h5 class="text-sm font-medium mb-3">Moyens de paiement</h5>
							<div class="flex space-x-2">
								<div class="w-8 h-6 bg-white rounded flex items-center justify-center">
									<span class="text-xs font-bold text-secondary-600">VISA</span>
								</div>
								<div class="w-8 h-6 bg-white rounded flex items-center justify-center">
									<span class="text-xs font-bold text-red-600">MC</span>
								</div>
								<div class="w-8 h-6 bg-white rounded flex items-center justify-center">
									<span class="text-xs font-bold text-secondary-800">PP</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Newsletter -->
			<div class="border-t border-gray-800">
				<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
					<div class="md:flex md:items-center md:justify-between">
						<div class="mb-4 md:mb-0">
							<h4 class="text-lg font-semibold mb-2">Restez informé</h4>
							<p class="text-gray-400 text-sm">Recevez nos dernières offres et nouveautés directement dans votre boîte mail</p>
						</div>
						<div class="flex max-w-md">
							<input type="email" placeholder="Votre adresse email" class="flex-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-l-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
							<button class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-r-lg transition-colors duration-200">
								S'abonner
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Copyright -->
			<div class="border-t border-gray-800">
				<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
					<div class="md:flex md:items-center md:justify-between">
						<div class="text-sm text-gray-400">
							© <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?>. Tous droits réservés.
						</div>
						<div class="mt-4 md:mt-0 flex items-center space-x-6 text-sm text-gray-400">
							<span class="flex items-center">
								<svg class="w-4 h-4 mr-1 text-primary-500" fill="currentColor" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
								</svg>
								Paiement sécurisé
							</span>
							<span class="flex items-center">
								<svg class="w-4 h-4 mr-1 text-secondary-500" fill="currentColor" viewBox="0 0 20 20">
									<path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
								</svg>
								Livraison rapide
							</span>
							<span class="flex items-center">
								<svg class="w-4 h-4 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
									<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
								</svg>
								Service client 5 étoiles
							</span>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>
