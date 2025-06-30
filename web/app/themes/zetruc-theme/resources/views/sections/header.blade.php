<header class="bg-white shadow-sm">
  <div class="container mx-auto px-6">
    <div class="flex items-center justify-between h-16">
      
      <div class="flex items-center">
        <a href="{{ home_url('/') }}" class="text-xl font-semibold text-gray-900">
          {{ get_bloginfo('name') }}
        </a>
      </div>

        <nav class="hidden md:flex space-x-8 items-center" aria-label="Navigation principale">
          {!! wp_nav_menu([
            'theme_location' => 'header_navigation', 
            'menu_class' => 'flex items-center space-x-8', 
            'container' => false,
            'echo' => false,
          ]) !!}
  @if(class_exists('WooCommerce'))
          <div class="cart-widget">
            <a href="{{ wc_get_cart_url() }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 transition-colors duration-200 p-2 rounded-md hover:bg-blue-50">
              <div class="relative">
                <i class="fas fa-shopping-cart text-xl"></i>
                @if(WC()->cart->get_cart_contents_count() > 0)
                  <span class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                    {{ WC()->cart->get_cart_contents_count() }}
                  </span>
                @endif
              </div>
              <span class="hidden lg:inline-block font-medium">
                Panier
                @if(WC()->cart->get_cart_contents_count() > 0)
                  <span class="text-blue-600">({!! strip_tags(WC()->cart->get_total()) !!})</span>
                @endif
              </span>
            </a>
          </div>
        @endif
        </nav>

    </div>
  </div>
</header>