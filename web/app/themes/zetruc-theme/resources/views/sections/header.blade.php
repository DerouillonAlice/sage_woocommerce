<header class="bg-white shadow-sm sticky top-0 z-50">
  <!-- Header principal -->
  <div class="border-b border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        
        {{-- Logo --}}
        <div class="flex-shrink-0">
          <a href="{{ home_url('/') }}" class="flex items-center">
            <span class="text-2xl font-bold text-primary-600 hover:text-primary-700 transition-colors">
              {{ get_bloginfo('name') }}
            </span>
          </a>
        </div>

        {{-- Barre de recherche (desktop) --}}
        <div class="hidden md:flex flex-1 max-w-2xl mx-8">
          <form role="search" method="get" class="w-full" action="{{ home_url('/') }}">
            <div class="relative flex">
              <select name="product_cat" class="flex-shrink-0 bg-gray-50 border border-gray-300 rounded-l-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">Toutes catégories</option>
                @foreach(get_terms('product_cat', ['hide_empty' => true]) as $category)
                  <option value="{{ $category->slug }}" {{ request('product_cat') == $category->slug ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
              <input type="search" 
                     name="s" 
                     class="flex-1 px-4 py-2.5 border-t border-b border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                     placeholder="Rechercher un produit..." 
                     value="{{ get_search_query() }}" />
              <input type="hidden" name="post_type" value="product" />
              <button type="submit" class="flex-shrink-0 px-6 py-2.5 bg-primary-600 text-white rounded-r-lg hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </form>
        </div>

        {{-- Actions utilisateur --}}
        <div class="flex items-center space-x-4">
          
          {{-- Bouton recherche mobile --}}
          <button type="button" class="md:hidden p-2 text-gray-600 hover:text-primary-600 transition-colors" id="mobile-search-toggle">
            <i class="fas fa-search text-xl"></i>
          </button>

          {{-- Panier --}}
          <div class="relative group">
            <a href="{{ wc_get_cart_url() }}" class="relative p-2 text-gray-600 hover:text-primary-600 transition-colors">
              <i class="fas fa-shopping-cart text-2xl"></i>
              
              {{-- Badge de nombre d'articles --}}
              @if(WC()->cart->get_cart_contents_count() > 0)
                <span class="absolute -top-1 -right-1 bg-primary-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold min-w-[20px]">
                  {{ WC()->cart->get_cart_contents_count() }}
                </span>
              @endif
            </a>
            
            {{-- Aperçu du panier (dropdown) --}}
            <div class="cart-dropdown absolute right-0 top-full mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
              @if(WC()->cart->get_cart_contents_count() > 0)
                <div class="p-4">
                  <div class="flex items-center justify-between mb-3">
                    <h3 class="font-semibold text-gray-900">Mon Panier</h3>
                    <span class="text-sm text-gray-500">{{ WC()->cart->get_cart_contents_count() }} article(s)</span>
                  </div>
                  
                  <div class="space-y-3 max-h-64 overflow-y-auto">
                    @foreach(WC()->cart->get_cart() as $cart_item_key => $cart_item)
                      @php
                        $product = $cart_item['data'];
                        $quantity = $cart_item['quantity'];
                        $line_total = $cart_item['line_total'];
                        $product_price = $product->get_price();
                      @endphp
                      <div class="flex items-start space-x-3 py-2 border-b border-gray-100 last:border-0">
                        <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded overflow-hidden">
                          @if($product->get_image_id())
                            <img src="{{ wp_get_attachment_image_url($product->get_image_id(), 'thumbnail') }}" 
                                 alt="{{ $product->get_name() }}" 
                                 class="w-12 h-12 object-cover">
                          @else
                            <div class="w-12 h-12 bg-gray-200 flex items-center justify-center">
                             <i class="fas fa-box-open text-gray-400 text-2xl"></i>
                            </div>
                          @endif
                        </div>
                        <div class="flex-1 min-w-0">
                          <h4 class="text-sm font-medium text-gray-900 truncate leading-tight">{{ $product->get_name() }}</h4>
                          <div class="text-xs text-gray-500 mt-1">
                            Qté: {{ $quantity }} × {!! html_entity_decode(strip_tags(wc_price($product_price))) !!}
                          </div>
                        </div>
                        <div class="flex-shrink-0 text-sm font-semibold text-gray-900">
                          {!! html_entity_decode(strip_tags(wc_price($line_total))) !!}
                        </div>
                      </div>
                    @endforeach
                  </div>
                  
                  <div class="border-t border-gray-200 pt-3 mt-3">
                    <div class="flex items-center justify-between mb-3">
                      <span class="font-semibold text-gray-900">Total:</span>
                      <span class="font-bold text-lg text-primary-600">{!! html_entity_decode(strip_tags(WC()->cart->get_cart_subtotal())) !!}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                      <a href="{{ wc_get_cart_url() }}" class="text-center px-3 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors text-sm">
                        Voir panier
                      </a>
                      <a href="{{ wc_get_checkout_url() }}" class="text-center px-3 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors text-sm">
                        Commander
                      </a>
                    </div>
                  </div>
                </div>
              @else
                <div class="p-4 text-center">
                  <div class="text-gray-400 mb-3">
                    <i class="fas fa-shopping-cart text-5xl"></i>
                  </div>
                  <p class="text-gray-500 text-sm mb-3">Votre panier est vide</p>
                  <a href="{{ get_permalink(wc_get_page_id('shop')) }}" class="inline-block px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors text-sm">
                    Voir la boutique
                  </a>
                </div>
              @endif
            </div>
          </div>
          
          {{-- Compte utilisateur --}}
          <div class="relative group">
            <a href="{{ get_permalink( get_option('woocommerce_myaccount_page_id') ) }}" class="flex items-center p-2 text-gray-600 hover:text-primary-600 transition-colors">
              <i class="fas fa-user text-2xl"></i>
            </a>
            
            {{-- Menu déroulant utilisateur --}}
            <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
              @if(is_user_logged_in())
                <div class="p-3 border-b border-gray-200">
                  <p class="text-sm text-gray-600">Connecté en tant que</p>
                  <p class="font-medium text-gray-900 truncate">{{ wp_get_current_user()->display_name }}</p>
                </div>
                <div class="py-2">
                  <a href="{{ get_permalink( get_option('woocommerce_myaccount_page_id') ) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon compte</a>
                  <a href="{{ wc_get_account_endpoint_url('orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mes commandes</a>
                  <a href="{{ wp_logout_url(home_url()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Déconnexion</a>
                </div>
              @else
                <div class="py-2">
                  <a href="{{ get_permalink( get_option('woocommerce_myaccount_page_id') ) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Se connecter</a>
                  <a href="{{ get_permalink( get_option('woocommerce_myaccount_page_id') ) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Créer un compte</a>
                </div>
              @endif
            </div>
          </div>

          {{-- Menu burger mobile --}}
          <button type="button" class="md:hidden p-2 text-gray-600 hover:text-primary-600 transition-colors" id="mobile-menu-toggle">
            <i class="fas fa-bars text-xl"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  {{-- Barre de recherche mobile --}}
  <div class="md:hidden border-b border-gray-200 bg-gray-50 hidden" id="mobile-search">
    <div class="container mx-auto px-4 py-3">
      <form role="search" method="get" action="{{ home_url('/') }}">
        <div class="space-y-3">
          <select name="product_cat" class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
            <option value="">Toutes catégories</option>
            @foreach(get_terms('product_cat', ['hide_empty' => true]) as $category)
              <option value="{{ $category->slug }}" {{ request('product_cat') == $category->slug ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
          <div class="flex">
            <input type="search" 
                   name="s" 
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                   placeholder="Rechercher un produit..." 
                   value="{{ get_search_query() }}" />
            <input type="hidden" name="post_type" value="product" />
            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-r-lg hover:bg-primary-700 transition-colors">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  {{-- Navigation principale --}}
  <nav class="border-b border-gray-200 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      {{-- Navigation desktop --}}
      <div class="hidden md:block">
        {!! wp_nav_menu([
          'theme_location' => 'header_navigation',
          'menu_class' => 'flex items-center space-x-8 py-4',
          'container' => false,
          'echo' => false,
          'link_before' => '',
          'link_after' => '',
          'before' => '',
          'after' => '',
        ]) !!}
      </div>

      {{-- Navigation mobile --}}
      <div class="md:hidden hidden" id="mobile-menu">
        <div class="py-3 space-y-1">
          {!! wp_nav_menu([
            'theme_location' => 'header_navigation',
            'menu_class' => 'space-y-1',
            'container' => false,
            'echo' => false,
            'link_before' => '',
            'link_after' => '',
            'before' => '',
            'after' => '',
          ]) !!}
        </div>
      </div>
    </div>
  </nav>
</header>

{{-- JavaScript pour la navigation mobile --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Toggle menu mobile
  const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  
  if (mobileMenuToggle && mobileMenu) {
    mobileMenuToggle.addEventListener('click', function() {
      mobileMenu.classList.toggle('hidden');
      
      // Changer l'icône du bouton
      const icon = this.querySelector('i');
      if (mobileMenu.classList.contains('hidden')) {
        icon.className = 'fas fa-bars text-xl';
      } else {
        icon.className = 'fas fa-times text-xl';
      }
    });
  }
  
  // Toggle recherche mobile
  const mobileSearchToggle = document.getElementById('mobile-search-toggle');
  const mobileSearch = document.getElementById('mobile-search');
  
  if (mobileSearchToggle && mobileSearch) {
    mobileSearchToggle.addEventListener('click', function() {
      mobileSearch.classList.toggle('hidden');
      
      if (!mobileSearch.classList.contains('hidden')) {
        // Focus sur le champ de recherche
        const searchInput = mobileSearch.querySelector('input[name="s"]');
        if (searchInput) {
          setTimeout(() => searchInput.focus(), 100);
        }
      }
    });
  }
});
</script>