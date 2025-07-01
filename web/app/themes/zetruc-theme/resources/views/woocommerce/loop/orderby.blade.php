<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$id_suffix = wp_unique_id();

$use_label = isset($use_label) ? $use_label : false;

if (!isset($catalog_orderby_options) || !is_array($catalog_orderby_options)) {
  if (function_exists('wc_get_catalog_ordering_options')) {
    $catalog_orderby_options = wc_get_catalog_ordering_options();
  } else {
    $catalog_orderby_options = array(
      'menu_order' => __('Default sorting', 'woocommerce'),
      'popularity' => __('Sort by popularity', 'woocommerce'),
      'rating'     => __('Sort by average rating', 'woocommerce'),
      'date'       => __('Sort by latest', 'woocommerce'),
      'price'      => __('Sort by price: low to high', 'woocommerce'),
      'price-desc' => __('Sort by price: high to low', 'woocommerce'),
    );
  }
}
if (!isset($orderby)) {
  $orderby = isset($_GET['orderby']) ? wc_clean(wp_unslash($_GET['orderby'])) : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));
}

?>
<form class="woocommerce-ordering flex items-center gap-2" method="get">
  <label for="woocommerce-orderby-<?php echo esc_attr( $id_suffix ); ?>" class="text-sm font-medium text-gray-700 whitespace-nowrap">
    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
    </svg>
    Trier par
  </label>
  <select
    name="orderby"
    id="woocommerce-orderby-<?php echo esc_attr( $id_suffix ); ?>"
    class="orderby min-w-0 flex-auto rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-colors"
    aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>"
    onchange="this.form.submit()"
  >
    <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
      <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
    <?php endforeach; ?>
  </select>
  <input type="hidden" name="paged" value="1" />
  <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
