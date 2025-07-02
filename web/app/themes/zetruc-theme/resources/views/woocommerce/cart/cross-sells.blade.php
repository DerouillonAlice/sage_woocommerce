<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.6.0
 */

defined( 'ABSPATH' ) || exit;

if ( $cross_sells ) : ?>

	<div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
		<?php
		$heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'Ces produits pourraient vous intéresser', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
				<i class="fas fa-heart mr-2 text-primary-600"></i>
				<?php echo esc_html( $heading ); ?>
			</h3>
		<?php endif; ?>

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

			<?php foreach ( $cross_sells as $cross_sell ) : ?>

				<?php
					$post_object = get_post( $cross_sell->get_id() );

					setup_postdata( $GLOBALS['post'] = $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
				?>

				<div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-shadow">
					<div class="aspect-square mb-3 bg-white rounded-lg overflow-hidden">
						<a href="<?php echo esc_url( $cross_sell->get_permalink() ); ?>">
							<?php echo $cross_sell->get_image( 'woocommerce_thumbnail', ['class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-200'] ); ?>
						</a>
					</div>
					
					<h4 class="font-medium text-gray-900 mb-2 line-clamp-2">
						<a href="<?php echo esc_url( $cross_sell->get_permalink() ); ?>" class="hover:text-primary-600 transition-colors">
							<?php echo esc_html( $cross_sell->get_name() ); ?>
						</a>
					</h4>
					
					<div class="flex items-center justify-between">
						<span class="text-lg font-bold text-primary-600">
							<?php echo $cross_sell->get_price_html(); ?>
						</span>
						
						<?php if ( $cross_sell->is_purchasable() && $cross_sell->is_in_stock() ) : ?>
							<a href="<?php echo esc_url( $cross_sell->add_to_cart_url() ); ?>" 
							   class="inline-flex items-center px-3 py-1.5 bg-primary-600 text-white text-sm font-medium rounded hover:bg-primary-700 transition-colors"
							   data-product_id="<?php echo esc_attr( $cross_sell->get_id() ); ?>">
								<i class="fas fa-plus mr-1"></i>
								Ajouter
							</a>
						<?php endif; ?>
					</div>
				</div>

			<?php endforeach; ?>

		</div>

	</div>
	<?php
endif;

wp_reset_postdata();
