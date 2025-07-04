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
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments" class="mb-6">
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
			
			<ol class="commentlist divide-y divide-gray-100 border border-gray-200 p-6 ">
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
			<div class="woocommerce-noreviews text-secondary-700 p-4 rounded-md flex items-center">
				<i class="fas fa-comment-slash text-xl mr-3"></i>
				<p class="m-0">Il n'y a pas encore d'avis.</p>
			</div>
		@endif
	</div>

	@if(get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id()))
		<div id="review_form_wrapper" class="rounded-xl border border-gray-200 overflow-hidden mt-8">
			<button type="button" id="toggle-review-form" class="w-full bg-primary text-white px-6 py-4 flex items-center justify-between">
				<div class="flex items-center">
					<i class="fas fa-pen-alt mr-3"></i>
					<div class="text-left">
						<h3 class="text-lg font-bold">
							{{ have_comments() ? __('Rédiger un avis', 'woocommerce') : sprintf(__('Soyez le premier à évaluer "%s"', 'woocommerce'), get_the_title()) }}
						</h3>
						<p class="text-white text-sm">{{ __('Partagez votre expérience avec ce produit', 'woocommerce') }}</p>
					</div>
				</div>
				<div class="flex items-center">
					<i class="fas fa-chevron-down transition-transform duration-300" id="toggle-icon"></i>
				</div>
			</button>
			
			<div id="review_form_container" class="hidden overflow-hidden transition-all duration-500">
				<div id="review_form" class="p-6">
					@php
					$commenter = wp_get_current_commenter();
					$comment_form = array(
						'title_reply' => '',
						'title_reply_to' => esc_html__('Répondre à %s', 'woocommerce'),
						'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title text-lg font-semibold text-gray-800 mb-4 flex items-center" role="heading" aria-level="4">',
						'title_reply_after' => '</h4>',
						'comment_notes_after' => '',
						'label_submit' => esc_html__('Publier mon avis', 'woocommerce'),
						'logged_in_as' => '',
						'comment_field' => '',
						'class_form' => 'space-y-6',
						'class_submit' => 'w-full bg-primary text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center',
					);

					$name_email_required = (bool)get_option('require_name_email', 1);
					$fields = array(
						'author' => array(
							'label' => __('Votre nom', 'woocommerce'),
							'type' => 'text',
							'value' => $commenter['comment_author'],
							'required' => $name_email_required,
							'autocomplete' => 'name',
							'class' => 'w-full rounded-lg border border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-2 focus:ring-secondary-200 transition-all duration-200 px-4 py-3',
							'icon' => 'fas fa-user'
						),
						'email' => array(
							'label' => __('Votre email', 'woocommerce'),
							'type' => 'email',
							'value' => $commenter['comment_author_email'],
							'required' => $name_email_required,
							'autocomplete' => 'email',
							'class' => 'w-full rounded-lg border border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-2 focus:ring-secondary-200 transition-all duration-200 px-4 py-3',
							'icon' => 'fas fa-envelope'
						),
					);

					$comment_form['fields'] = array();

					foreach ($fields as $key => $field) {
						$field_html = '<div class="comment-form-' . esc_attr($key) . ' relative">';
						$field_html .= '<label for="' . esc_attr($key) . '" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">';
						$field_html .= '<i class="' . esc_attr($field['icon']) . ' mr-2 text-secondary-600"></i>';
						$field_html .= esc_html($field['label']);

						if ($field['required']) {
							$field_html .= '&nbsp;<span class="required text-red-500 text-xs">*</span>';
						}

						$field_html .= '</label>';
						$field_html .= '<div class="relative">';
						$field_html .= '<input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" type="' . esc_attr($field['type']) . '" class="' . esc_attr($field['class']) . '" autocomplete="' . esc_attr($field['autocomplete']) . '" value="' . esc_attr($field['value']) . '" placeholder="' . esc_attr($field['label']) . '" ' . ($field['required'] ? 'required' : '') . ' />';
						$field_html .= '</div></div>';

						$comment_form['fields'][$key] = $field_html;
					}

					$account_page_url = wc_get_page_permalink('myaccount');
					if ($account_page_url) {
						$comment_form['must_log_in'] = '<div class="must-log-in bg-primary border-l-4 border-amber-400 p-4 rounded-lg mb-6">
							<div class="flex items-center">
								<div class="flex-shrink-0">
									<i class="fas fa-user-lock text-2xl text-amber-600"></i>
								</div>
								<div class="ml-4">
									<h4 class="text-lg font-semibold text-amber-800">Connexion requise</h4>
									<p class="text-amber-700 mt-1">' . sprintf(esc_html__('Vous devez être %1$sconnecté%2$s pour poster un avis.', 'woocommerce'), '<a href="' . esc_url($account_page_url) . '" class="text-amber-600 font-semibold hover:text-amber-800 underline">', '</a>') . '</p>
								</div>
							</div>
						</div>';
					}

					if (wc_review_ratings_enabled()) {
						$star_html = '
							<div class="rating-container bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
								<div class="flex items-center justify-between mb-3">
									<span class="text-sm font-medium text-gray-700">Cliquez pour noter :</span>
									<div class="rating-display text-lg font-bold text-secondary-600" id="rating-display">-</div>
								</div>
								<div class="rating-stars flex justify-center space-x-1">
									<input type="radio" id="star5" name="rating" value="5" required />
									<label for="star5" title="' . esc_attr__('Excellent', 'woocommerce') . '" class="star-label"><i class="fas fa-star"></i></label>
									<input type="radio" id="star4" name="rating" value="4" required />
									<label for="star4" title="' . esc_attr__('Très bien', 'woocommerce') . '" class="star-label"><i class="fas fa-star"></i></label>
									<input type="radio" id="star3" name="rating" value="3" required />
									<label for="star3" title="' . esc_attr__('Bien', 'woocommerce') . '" class="star-label"><i class="fas fa-star"></i></label>
									<input type="radio" id="star2" name="rating" value="2" required />
									<label for="star2" title="' . esc_attr__('Moyen', 'woocommerce') . '" class="star-label"><i class="fas fa-star"></i></label>
									<input type="radio" id="star1" name="rating" value="1" required />
									<label for="star1" title="' . esc_attr__('Décevant', 'woocommerce') . '" class="star-label"><i class="fas fa-star"></i></label>
								</div>
								<div class="rating-labels flex justify-between text-xs text-gray-500 mt-2">
									<span>Décevant</span>
									<span>Excellent</span>
								</div>
							</div>';
							
						$comment_form['comment_field'] = '
						<div class="comment-form-rating">
							<label for="rating" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
								<i class="fas fa-star mr-2 text-yellow-500"></i>' . 
								esc_html__('Votre évaluation', 'woocommerce') . 
								(wc_review_ratings_required() ? '&nbsp;<span class="required text-red-500 text-xs">*</span>' : '') . 
							'</label>
							' . $star_html . '
						</div>';
					}

					$comment_form['comment_field'] .= '
					<div class="comment-form-comment">
						<label for="comment" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
							<i class="fas fa-comment-alt mr-2 text-secondary-600"></i>' . 
							esc_html__('Votre avis détaillé', 'woocommerce') . 
							'&nbsp;<span class="required text-red-500 text-xs">*</span>
						</label>
						<textarea id="comment" name="comment" class="w-full rounded-lg border border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-2 focus:ring-secondary-200 transition-all duration-200 px-4 py-3 resize-none" rows="6" placeholder="Partagez votre expérience avec ce produit. Qu\'avez-vous aimé ? Que pourrait-on améliorer ?" required></textarea>
					</div>';

					$comment_form['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s">
						<i class="fas fa-paper-plane mr-2"></i>%4$s
					</button>';

					comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
					@endphp
				</div>
			</div>
		</div>
		
		<style>
		.rating-stars input {
			display: none;
		}
		.star-label {
			color: #d1d5db;
			cursor: pointer;
			font-size: 1.75rem;
			transition: all 0.2s ease;
			transform: scale(1);
		}
		.star-label:hover {
			color: #fbbf24;
			transform: scale(1.1);
		}
		.rating-stars input:checked ~ .star-label,
		.star-label:hover ~ .star-label {
			color: #f59e0b;
		}
		.rating-stars {
			direction: rtl;
		}
		.rating-stars .star-label {
			display: inline-block;
		}
		
		/* Animation pour le formulaire */
		#review_form_wrapper {
			animation: slideInUp 0.5s ease-out;
		}
		
		@keyframes slideInUp {
			from {
				opacity: 0;
				transform: translateY(30px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		</style>
		
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Gestion du toggle du formulaire
			const toggleButton = document.getElementById('toggle-review-form');
			const formContainer = document.getElementById('review_form_container');
			const toggleIcon = document.getElementById('toggle-icon');
			const formStatus = document.getElementById('form-status');
			let isOpen = false;

			if (toggleButton && formContainer) {
				toggleButton.addEventListener('click', function() {
					isOpen = !isOpen;
					
					if (isOpen) {
						formContainer.classList.remove('hidden');
						formContainer.style.maxHeight = formContainer.scrollHeight + 'px';
						toggleIcon.style.transform = 'rotate(180deg)';
						formStatus.textContent = 'Cliquez pour fermer';
						
						// Focus sur le premier champ après l'animation
						setTimeout(() => {
							const firstInput = formContainer.querySelector('input, textarea');
							if (firstInput) firstInput.focus();
						}, 300);
					} else {
						formContainer.style.maxHeight = '0px';
						toggleIcon.style.transform = 'rotate(0deg)';
						formStatus.textContent = 'Cliquez pour ouvrir';
						
						// Cacher complètement après l'animation
						setTimeout(() => {
							formContainer.classList.add('hidden');
						}, 500);
					}
				});
			}

			// Gestion des étoiles de notation
			const ratingInputs = document.querySelectorAll('.rating-stars input[type="radio"]');
			const ratingDisplay = document.getElementById('rating-display');
			const ratingLabels = ['', 'Décevant', 'Moyen', 'Bien', 'Très bien', 'Excellent'];
			
			ratingInputs.forEach(input => {
				input.addEventListener('change', function() {
					const value = this.value;
					ratingDisplay.textContent = value + '/5 - ' + ratingLabels[value];
					ratingDisplay.className = 'rating-display text-lg font-bold text-yellow-600';
				});
			});

			// Validation du textarea
			const textarea = document.getElementById('comment');
			if (textarea) {
				textarea.addEventListener('input', function() {
					const length = this.value.length;
					const minLength = 20;
					const parent = this.closest('.comment-form-comment');
					let indicator = parent.querySelector('.char-indicator');
					
					if (!indicator) {
						indicator = document.createElement('div');
						indicator.className = 'char-indicator text-xs mt-1';
						parent.appendChild(indicator);
					}
					
					if (length < minLength) {
						indicator.innerHTML = '<i class="fas fa-exclamation-circle text-orange-500 mr-1"></i>Encore ' + (minLength - length) + ' caractères minimum';
						indicator.className = 'char-indicator text-xs mt-1 text-orange-600';
					} else {
						indicator.innerHTML = '<i class="fas fa-check-circle text-primary-500 mr-1"></i>' + length + ' caractères - Parfait !';
						indicator.className = 'char-indicator text-xs mt-1 text-primary-600';
					}
				});
			}
		});
		</script>
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
