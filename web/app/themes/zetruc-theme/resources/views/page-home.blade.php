{{-- 
Template Name: Home 
--}}

@extends('layouts.app')

@section('content')

  <div class="">
    {{-- Bannière principale --}}
      <div class="relative overflow-hidden mb-12">
          <img src="{{ $home_banner['image']['url'] }}" alt="{{ $home_banner['image']['alt'] ?? '' }}" class="absolute inset-0 w-full h-64 object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 flex flex-col items-center justify-center text-center p-8 md:p-12">
          <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $home_banner['title'] ?? '' }}</h1>
          <p class="text-lg text-gray-300 mb-6">{{ $home_banner['text'] ?? '' }}</p>
          <a href="{{ $home_banner['button_url'] }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded shadow hover:bg-blue-700 font-semibold transition">
            {{ $home_banner['button_text'] }}
          </a>
        </div>
      </div>

    {{-- Produits à la une --}}
    <div class="container mx-auto px-4 py-8 space-y-16">
      <h2 class="text-2xl font-bold mb-6">Nos produits à la une</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
        @if ($featured_products && is_array($featured_products))
          @foreach ($featured_products as $product_id)
            @php
              $product = wc_get_product($product_id);
              $post = get_post($product_id);
              setup_postdata($post);
            @endphp
            <div class="bg-white shadow rounded p-4 text-center flex flex-col">
              <a href="{{ get_permalink($product_id) }}">
                {!! $product->get_image('medium', ['class' => 'mx-auto rounded']) !!}
                <h3 class="text-lg font-semibold mt-4">{{ get_the_title($product_id) }}</h3>
              </a>
              <p class="text-gray-700 mt-2">{!! $product->get_price_html() !!}</p>
              <form action="{{ esc_url( wc_get_cart_url() ) }}" method="post">
                <input type="hidden" name="add-to-cart" value="{{ $product->get_id() }}" />
                <button type="submit" class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                  Ajouter au panier
                </button>
              </form>
            </div>
          @endforeach
          @php wp_reset_postdata(); @endphp
        @else
          <p>Aucun produit sélectionné.</p>
        @endif
      </div>
      <div class="flex justify-center mt-8">
        <a href="{{ get_permalink( wc_get_page_id('shop') ) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-3 rounded shadow text-lg">
          Voir tous les produits
        </a>
      </div>
    </div>

    {{-- Liste des catégories --}}
    <div class="container mx-auto px-4 py-8 space-y-16">
      <h2 class="text-2xl font-bold mb-6">Nos catégories</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
        @php
          $categories = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
          ]);
        @endphp

        @if ($categories && !is_wp_error($categories))
          @foreach ($categories as $category)
            <div class="bg-white shadow rounded p-4 text-center flex flex-col">
              <a href="{{ get_term_link($category) }}">
                @php
                  $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                  $image_url = wp_get_attachment_url($thumbnail_id);
                @endphp
                @if ($image_url)
                  <img src="{{ $image_url }}" alt="{{ $category->name }}" class="mx-auto rounded mb-4">
                @endif
                <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
              </a>
              <p class="text-gray-700 mt-2">{{ $category->count }} produits</p>
            </div>
          @endforeach
        @else
          <p>Aucune catégorie disponible.</p>
        @endif
      </div>
    </div>
  </div>
@endsection
