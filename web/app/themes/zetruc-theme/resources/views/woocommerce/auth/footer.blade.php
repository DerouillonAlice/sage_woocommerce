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
								<i class="fas fa-store w-5 h-5 text-white"></i>
							</div>
							<h3 class="text-xl font-bold"><?php echo get_bloginfo('name'); ?></h3>
						</div>
						<p class="text-gray-400 text-sm leading-relaxed">
							Votre boutique en ligne de confiance. Nous proposons des produits de qualité avec un service client exceptionnel.
						</p>
						<div class="flex space-x-4">
							<a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
								<i class="fab fa-twitter w-5 h-5"></i>
							</a>
							<a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
								<i class="fab fa-facebook-f w-5 h-5"></i>
							</a>
							<a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
								<i class="fab fa-pinterest-p w-5 h-5"></i>
							</a>
							<a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
								<i class="fab fa-instagram w-5 h-5"></i>
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
