<header class="bg-white ">
  <div class="container mx-auto px-6">
    <div class="flex items-center justify-between h-16">
      {{-- Logo à gauche --}}
      <div class="flex items-center flex-1">
        <a href="{{ home_url('/') }}" class="text-xl font-semibold text-primary-700 hover:text-primary-600 transition-colors">
          {{ get_bloginfo('name') }}
        </a>
      </div>

      <div class="flex-1 flex justify-center">
        <form role="search" method="get" class="w-full max-w-2xl" action="{{ home_url('/') }}">
          <div class="flex border border-gray-300 rounded-lg overflow-hidden bg-white">
            <select name="product_cat" class="flex-shrink-0 bg-gray-50 border-0 border-r border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:bg-white">
              <option value="">Toutes catégories</option>
              @foreach(get_terms('product_cat', ['hide_empty' => true]) as $category)
                <option value="{{ $category->slug }}">{{ $category->name }}</option>
              @endforeach
            </select>
            <input type="search" name="s" class="flex-1 px-4 py-2 border-0 focus:outline-none focus:ring-2 focus:ring-primary-500" placeholder="Rechercher un produit..." value="{{ get_search_query() }}" />
            <input type="hidden" name="post_type" value="product" />
            <button type="submit" class="flex-shrink-0 px-4 py-2 bg-primary-600 text-white hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
          </div>
        </form>
      </div>

      <div class="flex items-center flex-1 justify-end space-x-4">
        <!-- Panier -->
        <a href="{{ wc_get_cart_url() }}" class="relative p-2 text-gray-600 hover:text-primary-600 transition-colors">
          <i class="fas fa-shopping-cart text-2xl"></i>
          @if(WC()->cart->get_cart_contents_count() > 0)
            <span class="absolute -top-1 -right-1 bg-primary-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
              {{ WC()->cart->get_cart_contents_count() }}
            </span>
          @endif
        </a>
        
        <!-- Profil / Connexion -->

          <a href="{{ get_permalink( get_option('woocommerce_myaccount_page_id') ) }}" class="p-2 text-gray-600 hover:text-primary-600 transition-colors">
            <i class="fas fa-user text-2xl"></i>
          </a>
      </div>
    </div>
  </div>
</header>

<nav class=" border-t border-b border-gray-200 ">
  <div class="container mx-auto px-6">
    {!! wp_nav_menu([
      'theme_location' => 'header_navigation',
      'menu_class' => 'flex flex-wrap items-center justify-center space-x-6 py-2 text-gray-600 font-medium decoration-none ',
      'container' => false,
      'echo' => false,
    ]) !!}
  </div>
</nav>