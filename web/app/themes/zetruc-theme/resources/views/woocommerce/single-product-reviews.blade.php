<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews mt-12">
	<div id="comments" class="bg-white shadow-sm rounded-lg p-6 mb-6">
		<h2 class="text-2xl font-bold text-gray-800 mb-6 pb-3 border-b border-gray-200">
			@php
			$count = $product->get_review_count();
			if ($count && wc_review_ratings_enabled()) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf(
					esc_html(_n('%1$s avis pour %2$s', '%1$s avis pour %2$s', $count, 'woocommerce')),
					esc_html($count),
					'<span class="text-secondary-600">' . get_the_title() . '</span>'
				);
				echo apply_filters('woocommerce_reviews_title', $reviews_title, $count, $product);
			} else {
				esc_html_e('Avis clients', 'woocommerce');
			}
			@endphp
		</h2>

		@if(have_comments())
			<div class="mb-6 flex justify-between items-center">
				<div class="text-sm text-gray-600">
					<i class="fas fa-info-circle mr-1"></i> {{ sprintf(__('Affichage de %d avis sur ce produit', 'woocommerce'), $count) }}
				</div>
				
				@if($count >= 5)
				<div class="flex items-center">
					<label for="review-sort" class="mr-2 text-sm font-medium text-gray-600">{{ __('Trier par:', 'woocommerce') }}</label>
					<select id="review-sort" class="text-sm rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring focus:ring-secondary-200">
						<option value="recent">{{ __('Plus récent', 'woocommerce') }}</option>
						<option value="helpful">{{ __('Plus utile', 'woocommerce') }}</option>
						<option value="rating-high">{{ __('Note - décroissant', 'woocommerce') }}</option>
						<option value="rating-low">{{ __('Note - croissant', 'woocommerce') }}</option>
					</select>
				</div>
				@endif
			</div>
			
			<ol class="commentlist divide-y divide-gray-100">
				@php
				wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments')));
				@endphp
			</ol>

			@php
			if (get_comment_pages_count() > 1 && get_option('page_comments')) {
				echo '<nav class="woocommerce-pagination flex justify-center mt-6">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => is_rtl() ? '<i class="fas fa-chevron-right"></i>' : '<i class="fas fa-chevron-left"></i>',
							'next_text' => is_rtl() ? '<i class="fas fa-chevron-left"></i>' : '<i class="fas fa-chevron-right"></i>',
							'type'      => 'list',
							'class'     => 'flex gap-2',
						)
					)
				);
				echo '</nav>';
			}
			@endphp
		@else
			<div class="woocommerce-noreviews bg-secondary-50 text-secondary-700 p-4 rounded-md flex items-center">
				<i class="fas fa-comment-slash text-xl mr-3"></i>
				<p class="m-0">{{ esc_html__('Il n\'y a pas encore d\'avis.', 'woocommerce') }}</p>
			</div>
		@endif
	</div>

	@if(get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id()))
		<div id="review_form_wrapper" class="bg-white shadow-sm rounded-lg p-6 mt-8">
			<div id="review_form">
				@php
				$commenter = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply' => have_comments() ? 
						esc_html__('Ajouter un avis', 'woocommerce') : 
						sprintf(esc_html__('Soyez le premier à évaluer &ldquo;%s&rdquo;', 'woocommerce'), get_the_title()),
					/* translators: %s is product title */
					'title_reply_to' => esc_html__('Répondre à %s', 'woocommerce'),
					'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-xl font-bold text-gray-800 mb-4" role="heading" aria-level="3">',
					'title_reply_after' => '</h3>',
					'comment_notes_after' => '',
					'label_submit' => esc_html__('Soumettre', 'woocommerce'),
					'logged_in_as' => '',
					'comment_field' => '',
					'class_form' => 'space-y-4',
					'class_submit' => 'bg-secondary-600 hover:bg-secondary-700 text-white font-semibold px-6 py-2 rounded shadow transition-colors',
				);

				$name_email_required = (bool)get_option('require_name_email', 1);
				$fields = array(
					'author' => array(
						'label' => __('Nom', 'woocommerce'),
						'type' => 'text',
						'value' => $commenter['comment_author'],
						'required' => $name_email_required,
						'autocomplete' => 'name',
						'class' => 'w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring focus:ring-secondary-200',
					),
					'email' => array(
						'label' => __('Email', 'woocommerce'),
						'type' => 'email',
						'value' => $commenter['comment_author_email'],
						'required' => $name_email_required,
						'autocomplete' => 'email',
						'class' => 'w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring focus:ring-secondary-200',
					),
				);

				$comment_form['fields'] = array();

				foreach ($fields as $key => $field) {
					$field_html = '<div class="comment-form-' . esc_attr($key) . ' mb-4">';
					$field_html .= '<label for="' . esc_attr($key) . '" class="block text-sm font-medium text-gray-700 mb-1">' . esc_html($field['label']);

					if ($field['required']) {
						$field_html .= '&nbsp;<span class="required text-red-500">*</span>';
					}

					$field_html .= '</label><input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" type="' . esc_attr($field['type']) . '" class="' . esc_attr($field['class']) . '" autocomplete="' . esc_attr($field['autocomplete']) . '" value="' . esc_attr($field['value']) . '" ' . ($field['required'] ? 'required' : '') . ' /></div>';

					$comment_form['fields'][$key] = $field_html;
				}

				$account_page_url = wc_get_page_permalink('myaccount');
				if ($account_page_url) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<div class="must-log-in bg-secondary-50 text-secondary-700 p-4 rounded-md flex items-center mb-6">
						<i class="fas fa-user-lock text-xl mr-3"></i>
						<p class="m-0">' . sprintf(esc_html__('Vous devez être %1$sconnecté%2$s pour poster un avis.', 'woocommerce'), '<a href="' . esc_url($account_page_url) . '" class="text-secondary-600 font-medium hover:underline">', '</a>') . '</p>
					</div>';
				}

				if (wc_review_ratings_enabled()) {
					$star_html = '
						<div class="rating-stars flex flex-row-reverse justify-end mb-4">
							<input type="radio" id="star5" name="rating" value="5" required /><label for="star5" title="' . esc_attr__('Parfait', 'woocommerce') . '"><i class="fas fa-star"></i></label>
							<input type="radio" id="star4" name="rating" value="4" required /><label for="star4" title="' . esc_attr__('Bien', 'woocommerce') . '"><i class="fas fa-star"></i></label>
							<input type="radio" id="star3" name="rating" value="3" required /><label for="star3" title="' . esc_attr__('Moyen', 'woocommerce') . '"><i class="fas fa-star"></i></label>
							<input type="radio" id="star2" name="rating" value="2" required /><label for="star2" title="' . esc_attr__('Pas si mal', 'woocommerce') . '"><i class="fas fa-star"></i></label>
							<input type="radio" id="star1" name="rating" value="1" required /><label for="star1" title="' . esc_attr__('Très mauvais', 'woocommerce') . '"><i class="fas fa-star"></i></label>
						</div>';
						
					$comment_form['comment_field'] = '
					<div class="comment-form-rating mb-4">
						<label for="rating" id="comment-form-rating-label" class="block text-sm font-medium text-gray-700 mb-2">' . 
							esc_html__('Votre note', 'woocommerce') . 
							(wc_review_ratings_required() ? '&nbsp;<span class="required text-red-500">*</span>' : '') . 
						'</label>
						
						' . $star_html . '
					</div>
					
					<style>
					.rating-stars {
						direction: rtl;
					}
					.rating-stars input {
						display: none;
					}
					.rating-stars label {
						color: #ddd;
						cursor: pointer;
						font-size: 1.5rem;
						padding: 0 0.1em;
					}
					.rating-stars label:hover,
					.rating-stars label:hover ~ label,
					.rating-stars input:checked ~ label {
						color: #ffb700;
					}
					</style>';
				}

				$comment_form['comment_field'] .= '<div class="comment-form-comment mb-4">
					<label for="comment" class="block text-sm font-medium text-gray-700 mb-1">' . 
						esc_html__('Votre avis', 'woocommerce') . 
						'&nbsp;<span class="required text-red-500">*</span>
					</label>
					<textarea id="comment" name="comment" class="w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring focus:ring-secondary-200" rows="6" required></textarea>
				</div>';

				comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
				@endphp
			</div>
		</div>
	@else
		<div class="woocommerce-verification-required bg-yellow-50 border-l-4 border-yellow-400 p-4 mt-8">
			<div class="flex">
				<div class="flex-shrink-0">
					<i class="fas fa-exclamation-triangle text-yellow-600"></i>
				</div>
				<div class="ml-3">
					<p class="text-sm text-yellow-700">
						{{ esc_html__('Seuls les clients connectés ayant acheté ce produit peuvent laisser un avis.', 'woocommerce') }}
					</p>
				</div>
			</div>
		</div>
	@endif

	<div class="clear"></div>
</div>
