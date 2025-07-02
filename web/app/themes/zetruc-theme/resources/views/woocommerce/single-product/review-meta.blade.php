{{--
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review-meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
--}}

@php
defined('ABSPATH') || exit;

global $comment;
$verified = wc_review_is_from_verified_owner($comment->comment_ID);
@endphp

@if('0' === $comment->comment_approved)
    <div class="meta bg-yellow-50 border-l-4 border-yellow-400 p-3 my-2">
        <em class="woocommerce-review__awaiting-approval text-yellow-700">
            {{ esc_html__('Votre avis est en attente d\'approbation', 'woocommerce') }}
        </em>
    </div>
@else
    <div class="meta flex flex-wrap items-center gap-2 mb-1">
        <span class="woocommerce-review__author font-medium text-gray-800">{{ get_comment_author() }}</span>
        
        @if('yes' === get_option('woocommerce_review_rating_verification_label') && $verified)
            <span class="woocommerce-review__verified verified inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <i class="fas fa-check-circle mr-1"></i>
                {{ esc_attr__('achat vérifié', 'woocommerce') }}
            </span>
        @endif
        
        <span class="woocommerce-review__dash text-gray-400 mx-1">&ndash;</span>
        
        <time class="woocommerce-review__published-date text-sm text-gray-500" datetime="{{ esc_attr(get_comment_date('c')) }}">
            {{ esc_html(get_comment_date(wc_date_format())) }}
        </time>
    </div>
@endif
