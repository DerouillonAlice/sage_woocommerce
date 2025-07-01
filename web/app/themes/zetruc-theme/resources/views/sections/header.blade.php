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
        <form role="search" method="get" class="w-full max-w-md" action="{{ home_url('/') }}">
          <div class="relative">
            <input type="search" name="s" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Rechercher un produit..." value="{{ get_search_query() }}" />
            <input type="hidden" name="post_type" value="product" />
            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-primary-600 hover:text-primary-700">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
      </div>

      <div class="flex items-center flex-1 justify-end space-x-4">
        <a href="{{ wc_get_cart_url() }}" class="flex items-center space-x-2 text-gray-700 hover:text-primary-600 transition-colors duration-200 p-2 rounded-md hover:bg-primary-50 relative">
          <i class="fas fa-shopping-cart text-xl"></i>
          @if(WC()->cart->get_cart_contents_count() > 0)
            <span class="absolute -top-2 -right-2 bg-primary-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
              {{ WC()->cart->get_cart_contents_count() }}
            </span>
          @endif
          <span class="hidden lg:inline-block font-medium">
            Panier
            @if(WC()->cart->get_cart_contents_count() > 0)
              <span class="text-primary-600">({!! strip_tags(WC()->cart->get_total()) !!})</span>
            @endif
          </span>
        </a>
        @if(is_user_logged_in())
          <a href="{{ get_permalink( get_option('woocommerce_myaccount_page_id') ) }}" class="flex items-center space-x-2 text-gray-700 hover:text-primary-600 transition-colors duration-200 p-2 rounded-md hover:bg-primary-50">
            <i class="fas fa-user-circle text-xl"></i>
            <span class="hidden lg:inline-block font-medium">Mon compte</span>
          </a>
        @else
          <a href="{{ get_permalink( get_option('woocommerce_myaccount_page_id') ) }}" class="flex items-center space-x-2 text-gray-700 hover:text-primary-600 transition-colors duration-200 p-2 rounded-md hover:bg-primary-50">
            <i class="fas fa-sign-in-alt text-xl"></i>
            <span class="hidden lg:inline-block font-medium">Connexion / Inscription</span>
          </a>
        @endif
      </div>
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