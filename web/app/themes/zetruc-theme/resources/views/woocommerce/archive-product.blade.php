{{--
The Template for displaying product archives, including the main shop page which is a post type archive
--}}

@extends('layouts.app')

@section('content')
  @php
    do_action('get_header', 'shop');
    do_action('woocommerce_before_main_content');
  @endphp

  @include('woocommerce.loop.header')

  <div class="container mx-auto px-4 lg:px-6">
    @if (woocommerce_product_loop())
      @php do_action('woocommerce_before_shop_loop'); @endphp
      
      {{-- Barre d'outils avec filtres et tri --}}
      <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
          <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            @include('woocommerce.loop.result-count')
            
            </div>
          </div>
          <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            @include('woocommerce.loop.orderby')
          </div>
        </div>
      </div>

      <div class="products-container" data-view="grid">
        @include('woocommerce.loop.loop-start')
          @if (wc_get_loop_prop('total'))
            @while (have_posts())
              @php the_post(); @endphp
              @include('woocommerce.content-product')
            @endwhile
          @endif
        @include('woocommerce.loop.loop-end')
      </div>

      <div class="mt-8">
        @php do_action('woocommerce_after_shop_loop'); @endphp
      </div>
    @else
      @include('woocommerce.loop.no-products-found')
    @endif
  </div>

  @php
    do_action('woocommerce_after_main_content');
    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  @endphp
@endsection
