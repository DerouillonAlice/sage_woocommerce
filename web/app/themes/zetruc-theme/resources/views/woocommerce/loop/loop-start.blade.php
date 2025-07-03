<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use App\PostTypes\ShopPreferences;

$shop_settings = ShopPreferences::getActiveSettings();
$current_view = $shop_settings['default_view'];

// Classes CSS pour la grille avec valeurs fixes
$grid_classes = 'products grid gap-6 mt-5 transition-all duration-300 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4';

// Classes CSS pour la liste
$list_classes = 'products flex flex-col gap-4 mt-5 transition-all duration-300';
?>
<ul class="<?php echo $current_view === 'list' ? $list_classes : $grid_classes; ?>">