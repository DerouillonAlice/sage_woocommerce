<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden mt-8">
		<div class="border-b border-gray-200 bg-gray-50">
			<ul class="flex flex-wrap tabs wc-tabs" role="tablist">
				<?php $first_tab = true; ?>
				<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
					<li role="presentation" class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>">
						<a href="#tab-<?php echo esc_attr( $key ); ?>" 
                           class="tab-link inline-block px-6 py-4 font-medium text-sm transition-all duration-200 border-b-2 <?php echo $first_tab ? 'border-blue-500 text-blue-600 bg-white' : 'border-transparent text-gray-600 hover:text-blue-600 hover:border-blue-300 hover:bg-gray-100'; ?>" 
                           role="tab" 
                           aria-controls="tab-<?php echo esc_attr( $key ); ?>"
                           data-tab="<?php echo esc_attr( $key ); ?>">
							<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
						</a>
					</li>
					<?php $first_tab = false; ?>
				<?php endforeach; ?>
			</ul>
		</div>
        
		<?php $first_panel = true; ?>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab p-6 <?php echo $first_panel ? '' : 'hidden'; ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
			<?php $first_panel = false; ?>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

	<script>
	document.addEventListener('DOMContentLoaded', function() {
		const tabLinks = document.querySelectorAll('.tab-link');
		const tabPanels = document.querySelectorAll('.wc-tab');
		
		tabLinks.forEach(function(link) {
			link.addEventListener('click', function(e) {
				e.preventDefault();
				
				// Retirer l'état actif de tous les onglets
				tabLinks.forEach(function(l) {
					l.classList.remove('border-blue-500', 'text-blue-600', 'bg-white');
					l.classList.add('border-transparent', 'text-gray-600');
				});
				
				// Cacher tous les panneaux
				tabPanels.forEach(function(panel) {
					panel.classList.add('hidden');
				});
				
				// Activer l'onglet cliqué
				this.classList.add('border-blue-500', 'text-blue-600', 'bg-white');
				this.classList.remove('border-transparent', 'text-gray-600');
				
				// Afficher le panneau correspondant
				const targetTab = this.getAttribute('data-tab');
				const targetPanel = document.getElementById('tab-' + targetTab);
				if (targetPanel) {
					targetPanel.classList.remove('hidden');
				}
			});
		});
	});
	</script>

<?php endif; ?>
