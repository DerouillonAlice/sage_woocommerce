{{--
The Template for displaying all single products

This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.

HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.

@see         https://docs.woocommerce.com/document/template-structure/
@package     WooCommerce\Templates
@version     1.6.4
--}}

@extends('layouts.app')

@section('content')
  @php
    do_action('get_header', 'shop');
    do_action('woocommerce_before_main_content');
  @endphp


  <div class="container mx-auto px-4 py-8">
    @while(have_posts())
      @php
        the_post();
        global $product;
      @endphp
      <div class="bg-white shadow rounded-lg p-8 flex flex-col md:flex-row gap-8">
        <div class="md:w-1/2 flex justify-center items-center">
          {!! $product->get_image('large', ['class' => 'rounded-lg max-h-96 w-auto mx-auto']) !!}
        </div>
        <div class="md:w-1/2 flex flex-col justify-between">
          <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ get_the_title() }}</h1>
            <div class="flex flex-wrap items-center gap-2 mb-2">
              @foreach ($product->get_category_ids() as $cat_id)
                <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">{{ get_term($cat_id)->name }}</span>
              @endforeach
            </div>
            <div class="flex items-center gap-4 mb-4">
              @if (comments_open())
                <a href="#reviews" class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                  <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v8a2 2 0 01-2 2H7a2 2 0 01-2-2V10a2 2 0 012-2h2m5-4h-2a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V6a2 2 0 00-2-2z"/></svg>
                  {{ $product->get_review_count() }} avis
                </a>
                <span class="text-yellow-400 text-base">
                  {!! wc_get_rating_html($product->get_average_rating(), $product->get_review_count()) !!}
                </span>
              @endif
            </div>
            <div class="text-lg text-gray-700 mb-4">{!! $product->get_price_html() !!}</div>
            <div class="prose max-w-none mb-6">{!! apply_filters('the_content', get_the_content()) !!}</div>
          </div>
          <form action="{{ esc_url( wc_get_cart_url() ) }}" method="post" class="mt-4">
            <input type="hidden" name="add-to-cart" value="{{ $product->get_id() }}" />
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
              Ajouter au panier
            </button>
          </form>
        </div>
      </div>
    @endwhile
  </div>

  @php
    do_action('woocommerce_after_main_content');
    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  @endphp
@endsection
