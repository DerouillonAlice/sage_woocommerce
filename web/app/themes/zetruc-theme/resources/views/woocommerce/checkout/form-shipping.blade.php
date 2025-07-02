{{--
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
--}}

@php
defined('ABSPATH') || exit;
@endphp

<div class="woocommerce-shipping-fields mb-6">

		<h3 id="ship-to-different-address" class="text-lg font-semibold text-gray-800 mb-4">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox flex items-center cursor-pointer">
				<input id="ship-to-different-address-checkbox" 
					   class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
					   {{ checked(apply_filters('woocommerce_ship_to_different_address_checked', 'shipping' === get_option('woocommerce_ship_to_destination') ? 1 : 0), 1, false) }} 
					   type="checkbox" 
					   name="ship_to_different_address" 
					   value="1" /> 
				<span class="text-gray-700">{{ esc_html__('Livrer à une adresse différente ?', 'woocommerce') }}</span>
			</label>
		</h3>

		<div class="shipping_address">

			@php do_action('woocommerce_before_checkout_shipping_form', $checkout); @endphp

			<div class="woocommerce-shipping-fields__field-wrapper grid grid-cols-1 md:grid-cols-2 gap-4">
				@php
				$fields = $checkout->get_checkout_fields('shipping');

				foreach ($fields as $key => $field) {
					// Ajouter des classes Tailwind pour le style
					$field['class'] = array_merge(
						isset($field['class']) ? $field['class'] : [],
						['form-row-wide', 'mb-4']
					);
					
					// Style pour les inputs
					$field['input_class'] = array_merge(
						isset($field['input_class']) ? $field['input_class'] : [],
						['w-full', 'px-3', 'py-2', 'border', 'border-gray-300', 'rounded-md', 'shadow-sm', 'focus:outline-none', 'focus:ring-2', 'focus:ring-blue-500', 'focus:border-blue-500', 'resize-none']
					);
					
					// Style pour les labels
					$field['label_class'] = array_merge(
						isset($field['label_class']) ? $field['label_class'] : [],
						['block', 'text-sm', 'font-medium', 'text-gray-700', 'mb-1']
					);
					
					if (in_array($key, ['shipping_first_name', 'shipping_last_name'])) {
						$field['class'][] = 'md:col-span-1';
					} elseif (in_array($key, ['shipping_address_1', 'shipping_address_2', 'shipping_company'])) {
						$field['class'][] = 'md:col-span-2';
					} else {
						$field['class'][] = 'md:col-span-1';
					}
					
					woocommerce_form_field($key, $field, $checkout->get_value($key));
				}
				@endphp
			</div>

			@php do_action('woocommerce_after_checkout_shipping_form', $checkout); @endphp

		</div>
</div>

<div class="woocommerce-additional-fields">
	@php do_action('woocommerce_before_order_notes', $checkout); @endphp

	@if(apply_filters('woocommerce_enable_order_notes_field', 'yes' === get_option('woocommerce_enable_order_comments', 'yes')))

		<div class="woocommerce-additional-fields__field-wrapper">
			@foreach($checkout->get_checkout_fields('order') as $key => $field)
				@php
				$field['class'] = array_merge(
					isset($field['class']) ? $field['class'] : [],
					['form-row-wide', 'mb-4']
				);
				
				$field['input_class'] = array_merge(
					isset($field['input_class']) ? $field['input_class'] : [],
					['w-full', 'px-3', 'py-2', 'resize-none'  ,'border', 'border-gray-300', 'rounded-md', 'shadow-sm', 'focus:outline-none', 'focus:ring-2', 'focus:ring-blue-500', 'focus:border-blue-500', 'resize-y']
				);
				
				$field['label_class'] = array_merge(
					isset($field['label_class']) ? $field['label_class'] : [],
					['block', 'text-sm', 'font-medium', 'text-gray-700', 'mb-1']
				);
				
				woocommerce_form_field($key, $field, $checkout->get_value($key));
				@endphp
			@endforeach
		</div>

	@endif

	@php do_action('woocommerce_after_order_notes', $checkout); @endphp
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('ship-to-different-address-checkbox');
    const shippingFields = document.querySelector('.shipping_address .woocommerce-shipping-fields__field-wrapper');
    
    if (checkbox && shippingFields) {
        function toggleShippingFields() {
            if (checkbox.checked) {
                shippingFields.style.display = '';
                shippingFields.classList.remove('hidden');
            } else {
                shippingFields.style.display = 'none';
                shippingFields.classList.add('hidden');
            }
        }
        
        toggleShippingFields();
        
        // Écouter les changements
        checkbox.addEventListener('change', toggleShippingFields);
    }
});
</script>
