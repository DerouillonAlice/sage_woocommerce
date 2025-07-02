{{--
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
<div class="woocommerce-billing-fields my-6">
	@if(wc_ship_to_billing_address_only() && WC()->cart->needs_shipping())

		<h3 class="text-lg font-semibold text-gray-800 mb-4">{{ esc_html__('Facturation & Livraison', 'woocommerce') }}</h3>

	@else

		<h3 class="text-lg font-semibold text-gray-800 mb-4">{{ esc_html__('Détails de facturation', 'woocommerce') }}</h3>

	@endif

	@php do_action('woocommerce_before_checkout_billing_form', $checkout); @endphp

	<div class="woocommerce-billing-fields__field-wrapper">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
			@php
			$fields = $checkout->get_checkout_fields('billing');

			foreach ($fields as $key => $field) {
				// Ajouter des classes Tailwind pour le style
				$field['class'] = array_merge(
					isset($field['class']) ? $field['class'] : [],
					['form-row-wide', 'mb-4']
				);
				
				// Style pour les inputs
				$field['input_class'] = array_merge(
					isset($field['input_class']) ? $field['input_class'] : [],
					['w-full', 'px-3', 'py-2', 'border', 'border-gray-300', 'rounded-md', 'shadow-sm', 'focus:outline-none', 'focus:ring-2', 'focus:ring-blue-500', 'focus:border-blue-500']
				);
				
				// Style pour les labels
				$field['label_class'] = array_merge(
					isset($field['label_class']) ? $field['label_class'] : [],
					['block', 'text-sm', 'font-medium', 'text-gray-700', 'mb-1']
				);
				
				// Gérer la largeur des champs
				if (in_array($key, ['billing_first_name', 'billing_last_name'])) {
					$field['class'][] = 'md:col-span-1';
				} elseif (in_array($key, ['billing_address_1', 'billing_address_2', 'billing_company'])) {
					$field['class'][] = 'md:col-span-2';
				} else {
					$field['class'][] = 'md:col-span-1';
				}
				
				woocommerce_form_field($key, $field, $checkout->get_value($key));
			}
			@endphp
		</div>
	</div>

	@php do_action('woocommerce_after_checkout_billing_form', $checkout); @endphp
</div>

@if(!is_user_logged_in() && $checkout->is_registration_enabled())
	<div class="woocommerce-account-fields bg-white rounded-lg shadow-sm p-6 mt-6">
		@if(!$checkout->is_registration_required())
			<div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox flex items-center cursor-pointer">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
						   id="createaccount" 
						   {{ checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true, false) }} 
						   type="checkbox" 
						   name="createaccount" 
						   value="1" />
					<span class="text-blue-800 font-medium">{{ esc_html__('Créer un compte ?', 'woocommerce') }}</span>
				</label>
			</div>
		@endif

		@php do_action('woocommerce_before_checkout_registration_form', $checkout); @endphp

		@if($checkout->get_checkout_fields('account'))
			<div class="create-account {{ !$checkout->is_registration_required() ? 'hidden' : '' }}" 
				 @if(!$checkout->is_registration_required()) style="display:none;" @endif>
				<h4 class="text-md font-medium text-gray-700 mb-3">{{ esc_html__('Informations du compte', 'woocommerce') }}</h4>
				@foreach($checkout->get_checkout_fields('account') as $key => $field)
					@php
					// Style pour les champs de compte
					$field['class'] = array_merge(
						isset($field['class']) ? $field['class'] : [],
						['form-row-wide', 'mb-4']
					);
					
					$field['input_class'] = array_merge(
						isset($field['input_class']) ? $field['input_class'] : [],
						['w-full', 'px-3', 'py-2', 'border', 'border-gray-300', 'rounded-md', 'shadow-sm', 'focus:outline-none', 'focus:ring-2', 'focus:ring-blue-500', 'focus:border-blue-500']
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

		@php do_action('woocommerce_after_checkout_registration_form', $checkout); @endphp
	</div>
@endif
