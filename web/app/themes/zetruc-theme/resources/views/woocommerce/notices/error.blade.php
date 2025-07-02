<?php
/**
 * Show error messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/error.php.
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

$multiple = count( $notices ) > 1;

?>

<div class="mb-4 p-4 rounded-lg border-l-4 shadow-sm" role="alert" style="border-left-color: var(--color-error); background-color: color-mix(in srgb, var(--color-error) 10%, white);">
	<div class="flex items-start">
		<div class="flex-shrink-0">
			<i class="fas fa-exclamation-circle text-lg mt-0.5" style="color: var(--color-error);"></i>
		</div>
		<div class="ml-3 flex-1">
			<?php if ( $multiple ) : ?>
				<div class="font-medium mb-2" style="color: color-mix(in srgb, var(--color-error) 80%, black);">
					<?php esc_html_e( 'Les erreurs suivantes ont été trouvées :', 'woocommerce' ); ?>
				</div>
				<ul class="list-disc list-inside space-y-1" style="color: color-mix(in srgb, var(--color-error) 70%, black);">
					<?php foreach ( $notices as $notice ) : ?>
						<li<?php echo wc_get_notice_data_attr( $notice ); ?>>
							<?php echo wc_kses_notice( $notice['notice'] ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<div class="font-medium" style="color: color-mix(in srgb, var(--color-error) 80%, black);">
					<?php echo wc_kses_notice( $notices[0]['notice'] ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
