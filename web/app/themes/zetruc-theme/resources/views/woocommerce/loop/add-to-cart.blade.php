{{--
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.2.0
--}}

@php
if (!defined('ABSPATH')) {
    exit;
}

global $product;

$aria_describedby = isset($args['aria-describedby_text']) ? sprintf('aria-describedby="woocommerce_loop_add_to_cart_link_describedby_%s"', esc_attr($product->get_id())) : '';

$button_classes = 'w-full inline-flex items-center justify-center bg-primary-600 hover:bg-primary-700 text-white font-medium px-4 py-2.5 rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed relative overflow-hidden group';
$custom_classes = isset($args['class']) ? $args['class'] : '';
$final_classes = trim($button_classes . ' ' . $custom_classes);

$product_id = $product->get_id();
@endphp

<div class="add-to-cart-wrapper relative">
    @php
    echo apply_filters(
        'woocommerce_loop_add_to_cart_link', 
        sprintf(
            '<a href="%s" %s data-quantity="%s" class="%s" data-product_id="%s" data-product_sku="%s" %s>
                <span class="button-text">%s</span>
                <span class="loading-spinner hidden">
                    <svg class="animate-spin h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
            </a>',
            esc_url($product->add_to_cart_url()),
            $aria_describedby,
            esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
            esc_attr($final_classes),
            esc_attr($product_id),
            esc_attr($product->get_sku()),
            isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
            esc_html($product->add_to_cart_text())
        ),
        $product,
        $args
    );
    @endphp
    
    <div class="success-message hidden absolute inset-0 bg-primary-600 text-white flex items-center justify-center rounded-md">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
        <span>Ajouté </span>
    </div>
</div>

@if(isset($args['aria-describedby_text']))
    <span id="woocommerce_loop_add_to_cart_link_describedby_{{ esc_attr($product->get_id()) }}" class="sr-only">
        {{ esc_html($args['aria-describedby_text']) }}
    </span>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-cart-wrapper a[data-product_id]').forEach(function(button) {
        button.addEventListener('click', function(e) {
            const wrapper = this.closest('.add-to-cart-wrapper');
            const buttonText = this.querySelector('.button-text');
            const spinner = this.querySelector('.loading-spinner');
            const successMessage = wrapper.querySelector('.success-message');
            
            if (this.getAttribute('href').includes('add-to-cart=')) {
                e.preventDefault();
                
                this.disabled = true;
                buttonText.textContent = 'Ajout...';
                spinner.classList.remove('hidden');
                
                fetch(this.href, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(data => {
                    successMessage.classList.remove('hidden');
                    
                    setTimeout(() => {
                        successMessage.classList.add('hidden');
                        this.disabled = false;
                        buttonText.textContent = 'Ajouter au panier';
                        spinner.classList.add('hidden');
                        
                        document.body.dispatchEvent(new Event('wc_fragment_refresh'));
                    }, 2000);
                })
                .catch(error => {
                    this.disabled = false;
                    buttonText.textContent = 'Ajouter au panier';
                    spinner.classList.add('hidden');
                    console.error('Erreur:', error);
                });
            }
        });
    });
});
</script>
