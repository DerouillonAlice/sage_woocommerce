<?php
/**
 * Order again button
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-again.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="order-again mb-4">
	<a href="<?php echo esc_url( $order_again_url ); ?>" 
	   class="inline-flex  items-center justify-center px-4 py-2 bg-primary hover:bg-primary-400 transition-all w-full text-white font-medium rounded-lg ">
		<i class="fas fa-redo mr-2"></i>
		<?php esc_html_e( 'Commander à nouveau', 'woocommerce' ); ?>
	</a>
</div>
