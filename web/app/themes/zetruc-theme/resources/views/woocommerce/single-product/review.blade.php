{{--
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
--}}

@php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
@endphp

<li {{ comment_class('mb-6') }} id="li-comment-{{ comment_ID() }}">
    <div id="comment-{{ comment_ID() }}" class="comment_container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="comment-text w-full">
            {{-- Suppression complète de l'avatar des avis --}}
            {{-- Nous n'exécutons pas le hook woocommerce_review_before qui afficherait normalement l'avatar --}}
            
            @php
            /**
             * The woocommerce_review_before_comment_meta hook.
             *
             * @hooked woocommerce_review_display_rating - 10
             */
            do_action('woocommerce_review_before_comment_meta', $comment);

            /**
             * The woocommerce_review_meta hook.
             *
             * @hooked woocommerce_review_display_meta - 10
             */
            do_action('woocommerce_review_meta', $comment);
            
            do_action('woocommerce_review_before_comment_text', $comment);
            @endphp
            
            <div class="prose prose-sm max-w-none text-gray-700 mt-2 py-2">
                @php
                /**
                 * The woocommerce_review_comment_text hook
                 *
                 * @hooked woocommerce_review_display_comment_text - 10
                 */
                do_action('woocommerce_review_comment_text', $comment);
                
                do_action('woocommerce_review_after_comment_text', $comment);
                @endphp
            </div>
        </div>
    </div>
