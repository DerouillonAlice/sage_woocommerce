<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="woocommerce-order-downloads">
	<?php if ( isset( $show_title ) && $show_title ) : ?>
		<h2 class="woocommerce-order-downloads__title text-xl font-semibold text-gray-900 mb-4">
			<i class="fas fa-download mr-2 text-blue-600"></i>
			<?php esc_html_e( 'Téléchargements', 'woocommerce' ); ?>
		</h2>
	<?php endif; ?>

	<div class="space-y-4">
		<?php foreach ( $downloads as $download ) : ?>
			<div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:bg-gray-100 transition-colors">
				<div class="flex items-center justify-between">
					<div class="flex-1">
						<h4 class="font-medium text-gray-900 mb-1">
							<?php
							if ( $download['product_url'] ) {
								echo '<a href="' . esc_url( $download['product_url'] ) . '" class="hover:text-blue-600 transition-colors">' . esc_html( $download['product_name'] ) . '</a>';
							} else {
								echo esc_html( $download['product_name'] );
							}
							?>
						</h4>
						
						<div class="text-sm text-gray-600 space-y-1">
							<div class="flex items-center">
								<i class="fas fa-file mr-2"></i>
								<span><?php echo esc_html( $download['download_name'] ); ?></span>
							</div>
							
							<?php if ( is_numeric( $download['downloads_remaining'] ) ) : ?>
								<div class="flex items-center">
									<i class="fas fa-arrow-down mr-2"></i>
									<span>
										<?php printf( 
											_n( '%s téléchargement restant', '%s téléchargements restants', $download['downloads_remaining'], 'woocommerce' ), 
											$download['downloads_remaining'] 
										); ?>
									</span>
								</div>
							<?php endif; ?>
							
							<?php if ( $download['access_expires'] ) : ?>
								<div class="flex items-center">
									<i class="fas fa-clock mr-2"></i>
									<span>
										<?php printf( __( 'Expire le %s', 'woocommerce' ), date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ) ); ?>
									</span>
								</div>
							<?php endif; ?>
						</div>
					</div>
					
					<div class="ml-4">
						<a href="<?php echo esc_url( $download['download_url'] ); ?>" 
						   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition-colors">
							<i class="fas fa-download mr-2"></i>
							Télécharger
						</a>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
