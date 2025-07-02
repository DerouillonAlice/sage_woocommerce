{{--
 * The template to display the reviewers star rating in reviews
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/review-rating.php.
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
--}}

@php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $comment;
$rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
@endphp

@if($rating && wc_review_ratings_enabled())
    <div class="flex items-center mb-2">
        <div class="flex text-yellow-400">
            @php
            $rating_html = wc_get_rating_html($rating);
            // Remplacer les classes de base par des classes Tailwind
            $rating_html = str_replace('star-rating', 'star-rating flex', $rating_html);
            echo $rating_html;
            @endphp
        </div>
        <span class="ml-2 text-xs font-medium text-gray-600">{{ $rating }}.0/5</span>
    </div>
@endif
