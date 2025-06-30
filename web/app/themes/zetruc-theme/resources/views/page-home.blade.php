{{-- 
Template Name: Home 
--}}

@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Nos produits</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @php
        $args = [
          'post_type' => 'product',
          'posts_per_page' => 4,
        ];
        $products = new WP_Query($args);
      @endphp

      @if ($products->have_posts())
        @while ($products->have_posts()) @php $products->the_post(); global $product; @endphp
          <div class="bg-white shadow rounded p-4 text-center">
            <a href="{{ get_permalink() }}">
              {!! woocommerce_get_product_thumbnail('medium') !!}
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
        @php wp_reset_postdata(); @endphp
      @else
        <p>Aucun produit trouvé.</p>
      @endif
    </div>
  </div>
@endsection
