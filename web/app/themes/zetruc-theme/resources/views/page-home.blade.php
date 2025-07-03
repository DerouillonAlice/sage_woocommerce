{{-- 
Template Name: Home 
--}}

@extends('layouts.app')

@section('content')

  <div class="">
    {{-- Bannière principale --}}
    @if($home_banner)
      <div class="relative overflow-hidden mb-16">
        @if($home_banner['image']['url'])
          <img src="{{ $home_banner['image']['url'] }}" alt="{{ $home_banner['image']['alt'] ?? '' }}" class="absolute inset-0 w-full h-[500px] md:h-[600px] object-cover">
        @endif
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
        <div class="relative z-10 container mx-auto px-4 py-20 md:py-32">
          <div class="max-w-2xl">
            @if($home_banner['title'])
              <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                {{ $home_banner['title'] }}
              </h1>
            @endif
            @if($home_banner['text'])
              <p class="text-xl text-gray-200 mb-8 leading-relaxed">
                {{ $home_banner['text'] }}
              </p>
            @endif
            @if($home_banner['button_text'] && $home_banner['button_url'])
              <a href="{{ $home_banner['button_url'] }}" class="inline-flex items-center px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105">
                {{ $home_banner['button_text'] }}
                <i class="fas fa-arrow-right ml-2"></i>
              </a>
            @endif
          </div>
        </div>
      </div>
    @endif



    {{-- Produits à la une --}}
    <div class="py-16">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nos produits à la une</h2>
          <p class="text-xl text-gray-600 max-w-2xl mx-auto">Découvrez notre sélection de produits populaires</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
          @if ($featured_products && is_array($featured_products))
            @foreach ($featured_products as $product_id)
              @php
                $product = wc_get_product($product_id);
                $post = get_post($product_id);
                setup_postdata($post);
              @endphp
              <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group">
                <a href="{{ get_permalink($product_id) }}" class="block">
                  <div class="aspect-square overflow-hidden">
                    {!! $product->get_image('large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300']) !!}
                  </div>
                  <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors">{{ get_the_title($product_id) }}</h3>
                    <div class="text-2xl font-bold text-primary-600 mb-4">{!! $product->get_price_html() !!}</div>
                  </div>
                </a>
                <div class="px-6 pb-6">
                  <form action="{{ esc_url( wc_get_cart_url() ) }}" method="post">
                    <input type="hidden" name="add-to-cart" value="{{ $product->get_id() }}" />
                    <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-300 flex items-center justify-center">
                      <i class="fas fa-shopping-cart mr-2"></i>
                      Ajouter au panier
                    </button>
                  </form>
                </div>
              </div>
            @endforeach
            @php wp_reset_postdata(); @endphp
          @else
            <div class="col-span-full text-center py-12">
              <div class="text-gray-400 mb-4">
                <i class="fas fa-box-open text-6xl"></i>
              </div>
              <p class="text-xl text-gray-600">Aucun produit sélectionné pour le moment.</p>
            </div>
          @endif
        </div>
        <div class="text-center">
          <a href="{{ get_permalink( wc_get_page_id('shop') ) }}" class="inline-flex items-center px-8 py-4 bg-secondary-600 hover:bg-secondary-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105">
            Voir tous les produits
            <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>
    </div>

    {{-- Section Catégories --}}
    <div class="py-16 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Explorez nos catégories</h2>
          <p class="text-xl text-gray-600 max-w-2xl mx-auto">Trouvez exactement ce que vous cherchez dans nos différentes gammes</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          @php
            $categories = get_terms([
              'taxonomy' => 'product_cat',
              'hide_empty' => true,
              'number' => 6,
            ]);
          @endphp

          @if ($categories && !is_wp_error($categories))
            @foreach ($categories as $category)
              <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group">
                <a href="{{ get_term_link($category) }}" class="block">
                  <div class="aspect-video overflow-hidden bg-primary-600">
                    @php
                      $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                      $image_url = wp_get_attachment_url($thumbnail_id);
                    @endphp
                    @if ($image_url)
                      <img src="{{ $image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                      <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-tag text-4xl text-white"></i>
                      </div>
                    @endif
                  </div>
                  <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors">{{ $category->name }}</h3>
                    <p class="text-gray-600">{{ $category->count }} {{ $category->count > 1 ? 'produits' : 'produit' }}</p>
                  </div>
                </a>
              </div>
            @endforeach
          @else
            <div class="col-span-full text-center py-12">
              <div class="text-gray-400 mb-4">
                <i class="fas fa-tags text-6xl"></i>
              </div>
              <p class="text-xl text-gray-600">Aucune catégorie disponible pour le moment.</p>
            </div>
          @endif
        </div>
      </div>
    </div>

    {{-- Section CTA finale --}}
    <div class="py-16 bg-primary-600">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Prêt à découvrir nos produits ?</h2>
        <p class="text-xl text-white mb-8 max-w-2xl mx-auto">Rejoignez des milliers de clients satisfaits et découvrez notre large gamme de produits de qualité.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="{{ get_permalink( wc_get_page_id('shop') ) }}" class="inline-flex items-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-lg shadow-lg hover:bg-gray-50 transition-all duration-300 transform hover:scale-105">
            <i class="fas fa-shopping-bag mr-2"></i>
            Parcourir la boutique
          </a>
          @if(get_permalink( get_option('woocommerce_myaccount_page_id') ))
            <a href="{{ get_permalink( get_option('woocommerce_myaccount_page_id') ) }}" class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary-600 transition-all duration-300">
              <i class="fas fa-user-plus mr-2"></i>
              Créer un compte
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
