<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>


<nav class="woocommerce-MyAccount-navigation" aria-label="<?php esc_html_e( 'Account pages', 'woocommerce' ); ?>">
	<ul class="flex flex-col md:flex-row justify-center gap-0  lg:gap-4 bg-gray-50 md:bg-transparent p-4 md:p-0 rounded-xl md:rounded-none shadow md:shadow-none">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<?php if ( $endpoint === 'customer-logout' ) continue; // Skip logout button ?>
			<?php
				$link_classes = 'flex items-center space-x-2 px-4 py-2 rounded-lg transition-colors duration-150 font-medium ';
				
				// Icônes pour chaque endpoint
				$icon_class = '';
				switch ($endpoint) {
					case 'dashboard':
						$icon_class = 'fas fa-tachometer-alt';
						break;
					case 'orders':
						$icon_class = 'fas fa-shopping-bag';
						break;
					case 'downloads':
						$icon_class = 'fas fa-download';
						break;
					case 'edit-address':
						$icon_class = 'fas fa-map-marker-alt';
						break;
					case 'edit-account':
						$icon_class = 'fas fa-user-edit';
						break;
					default:
						$icon_class = 'fas fa-user';
				}
				
				$link_classes .= 'text-gray-700 hover:bg-primary-50 hover:text-primary-700 ';
				if (wc_is_current_account_menu_item($endpoint)) {
					$link_classes .= 'bg-primary-600 text-white hover:bg-primary-700 hover:text-white ';
				}
			?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
				   class="<?php echo $link_classes; ?>"
				   <?php echo wc_is_current_account_menu_item( $endpoint ) ? 'aria-current="page"' : ''; ?>>
					<i class="<?php echo $icon_class; ?> w-4 h-4"></i>
					<span><?php echo esc_html( $label ); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
