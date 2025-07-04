<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {
	?>
	<nav class="woocommerce-breadcrumb py-4" aria-label="Fil d'Ariane">
		<div class="container mx-auto px-4 lg:px-6">
			<ol class="flex items-center space-x-2 text-sm text-gray-600">
				<?php foreach ( $breadcrumb as $key => $crumb ) : ?>
					<li class="flex items-center">
						<?php if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) : ?>
							<a href="<?php echo esc_url( $crumb[1] ); ?>" 
							   class="text-gray-600 hover:text-primary-600 transition-colors duration-200 hover:underline">
								<?php echo esc_html( $crumb[0] ); ?>
							</a>
						<?php else : ?>
							<span class="text-gray-900 font-medium" aria-current="page">
								<?php echo esc_html( $crumb[0] ); ?>
							</span>
						<?php endif; ?>
						
						<?php if ( sizeof( $breadcrumb ) !== $key + 1 ) : ?>
							<i class="fas fa-chevron-right w-4 h-4 mx-2 text-gray-400"></i>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</nav>
	<?php
}
