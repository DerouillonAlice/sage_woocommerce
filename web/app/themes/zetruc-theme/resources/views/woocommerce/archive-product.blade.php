{{--
The Template for displaying product archives, including the main shop page which is a post type archive

This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.

HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.

@see https://docs.woocommerce.com/document/template-structure/
@package WooCommerce/Templates
@version 3.4.0
--}}

@extends('layouts.app')

@section('content')
  @php
    do_action('get_header', 'shop');
    do_action('woocommerce_before_main_content');
  @endphp


  <header class="bg-white shadow rounded-lg py-8 mb-8 border border-gray-100">
    <div class="container mx-auto px-4">
      @if (apply_filters('woocommerce_show_page_title', true))
        <h1 class="text-3xl font-bold text-gray-800 mb-2">{!! woocommerce_page_title(false) !!}</h1>
      @endif
      <div class="text-gray-600 text-lg">
        @php do_action('woocommerce_archive_description') @endphp
      </div>
    </div>
  </header>

  <div class="container mx-auto px-4">


    @if (woocommerce_product_loop())
      @php
        do_action('woocommerce_before_shop_loop');
        woocommerce_product_loop_start();
      @endphp

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
        @if (wc_get_loop_prop('total'))
          @while (have_posts())
            @php
              the_post();
              do_action('woocommerce_shop_loop');
              global $product;
            @endphp
            <div class="bg-white shadow rounded p-4 text-center flex flex-col">
              <a href="{{ get_permalink() }}">
                {!! $product->get_image('medium', ['class' => 'mx-auto rounded']) !!}
                <h2 class="text-lg font-semibold mt-4">{{ get_the_title() }}</h2>
              </a>
              <p class="text-gray-700 mt-2">{!! $product->get_price_html() !!}</p>
              <form action="{{ esc_url( wc_get_cart_url() ) }}" method="post">
                <input type="hidden" name="add-to-cart" value="{{ $product->get_id() }}" />
                <button type="submit" class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                  Ajouter au panier
                </button>
              </form>
            </div>
          @endwhile
        @endif
      </div>

      @php
        woocommerce_product_loop_end();
        do_action('woocommerce_after_shop_loop');
      @endphp
    @else
      <div class="text-center text-gray-500 py-12 text-lg">
        @php do_action('woocommerce_no_products_found') @endphp
      </div>
    @endif
  </div>

  @php
    do_action('woocommerce_after_main_content');
    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  @endphp
@endsection
