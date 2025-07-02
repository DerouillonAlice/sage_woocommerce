<?php
/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/notice.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}

?>

<?php foreach ( $notices as $notice ) : ?>
	<div class="mb-4 p-4 rounded-lg border-l-4 shadow-sm flex items-start" style="border-left-color: var(--color-warning); background-color: color-mix(in srgb, var(--color-warning) 10%, white);"<?php echo wc_get_notice_data_attr( $notice ); ?>>
		<div class="flex-shrink-0">
			<i class="fas fa-info-circle text-lg mt-0.5" style="color: var(--color-warning);"></i>
		</div>
		<div class="ml-3 flex-1 font-medium" style="color: color-mix(in srgb, var(--color-warning) 80%, black);">
			<?php echo wc_kses_notice( $notice['notice'] ); ?>
		</div>
	</div>
<?php endforeach; ?>
