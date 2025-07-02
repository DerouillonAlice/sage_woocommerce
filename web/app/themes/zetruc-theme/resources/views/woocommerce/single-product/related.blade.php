<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products mt-8">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2 class="text-2xl font-bold mb-6"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
			<?php foreach ( $related_products as $related_product ) : ?>
				<div class="bg-white rounded-lg shadow-sm overflow-hidden transition-all hover:shadow-md">
					<?php
					$post_object = get_post( $related_product->get_id() );
					setup_postdata( $GLOBALS['post'] = $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
					?>
					
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="block">
						<div class="aspect-w-1 aspect-h-1">
							<?php echo $related_product->get_image('thumbnail', ['class' => 'object-cover w-full h-full']); ?>
						</div>
						<div class="p-4">
							<h3 class="text-sm font-medium"><?php echo get_the_title(); ?></h3>
							<div class="mt-2 text-sm text-gray-700">
								<?php echo $related_product->get_price_html(); ?>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>

	</section>
	<?php
endif;

wp_reset_postdata();
