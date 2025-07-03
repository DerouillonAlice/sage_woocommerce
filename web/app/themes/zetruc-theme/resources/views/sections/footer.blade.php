<footer class="bg-white ">
  <div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      
      {{-- Informations entreprise --}}
      <div class="md:col-span-2">
        <div class="flex items-center mb-4">
          <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center mr-3">
            <i class="fas fa-store text-white"></i>
          </div>
          <h3 class="text-2xl font-bold">{{ get_bloginfo('name') }}</h3>
        </div>
        <p class="text-gray-400 mb-6 leading-relaxed">
          {{ $footer_about_content ?? 'Votre boutique en ligne de confiance. Nous proposons des produits de qualité avec un service client exceptionnel et une livraison rapide.' }}
        </p>
        <div class="flex space-x-4">
          @if($social_facebook)
            <a href="{{ $social_facebook }}" class="text-gray-400 hover:text-primary transition-colors">
              <i class="fab fa-facebook-f text-xl"></i>
            </a>
          @endif
          @if($social_twitter)
            <a href="{{ $social_twitter }}" class="text-gray-400 hover:text-primary transition-colors">
              <i class="fab fa-twitter text-xl"></i>
            </a>
          @endif
          @if($social_instagram)
            <a href="{{ $social_instagram }}" class="text-gray-400 hover:text-primary transition-colors">
              <i class="fab fa-instagram text-xl"></i>
            </a>
          @endif
          @if($social_linkedin)
            <a href="{{ $social_linkedin }}" class="text-gray-400 hover:text-primary transition-colors">
              <i class="fab fa-linkedin-in text-xl"></i>
            </a>
          @endif
        </div>
      </div>

      {{-- Liens rapides --}}
      <div>
        <h4 class="text-lg font-semibold mb-4">{{ $footer_quick_links_title ?? 'Liens rapides' }}</h4>
        <ul class="space-y-2">
          <li><a href="{{ home_url('/') }}" class="text-gray-400 hover:text-primary transition-colors">Accueil</a></li>
          @if(function_exists('wc_get_page_permalink'))
            <li><a href="{{ wc_get_page_permalink('shop') }}" class="text-gray-400 hover:text-primary transition-colors">Boutique</a></li>
          @endif
          @if($footer_about_link_url)
            <li><a href="{{ $footer_about_link_url['url'] ?? '#' }}" class="text-gray-400 hover:text-primary transition-colors" @if($footer_about_link_url['target'] ?? false) target="{{ $footer_about_link_url['target'] }}" @endif>{{ $footer_about_link_url['title'] ?? 'À propos' }}</a></li>
          @endif
          @if($footer_contact_link_url)
            <li><a href="{{ $footer_contact_link_url['url'] ?? '#' }}" class="text-gray-400 hover:text-primary transition-colors" @if($footer_contact_link_url['target'] ?? false) target="{{ $footer_contact_link_url['target'] }}" @endif>{{ $footer_contact_link_url['title'] ?? 'Contact' }}</a></li>
          @endif
        </ul>
      </div>

      {{-- Service client --}}
      <div>
        <h4 class="text-lg font-semibold mb-4">{{ $footer_customer_service_title ?? 'Service client' }}</h4>
        <ul class="space-y-2">
          @if(function_exists('wc_get_page_permalink'))
            <li><a href="{{ wc_get_page_permalink('myaccount') }}" class="text-gray-400 hover:text-primary transition-colors">Mon compte</a></li>
            <li><a href="{{ wc_get_page_permalink('cart') }}" class="text-gray-400 hover:text-primary transition-colors">Panier</a></li>
          @endif
          @if($footer_delivery_link_url)
            <li><a href="{{ $footer_delivery_link_url['url'] ?? '#' }}" class="text-gray-400 hover:text-primary transition-colors" @if($footer_delivery_link_url['target'] ?? false) target="{{ $footer_delivery_link_url['target'] }}" @endif>{{ $footer_delivery_link_url['title'] ?? 'Livraison' }}</a></li>
          @endif
          @if($footer_returns_link_url)
            <li><a href="{{ $footer_returns_link_url['url'] ?? '#' }}" class="text-gray-400 hover:text-primary transition-colors" @if($footer_returns_link_url['target'] ?? false) target="{{ $footer_returns_link_url['target'] }}" @endif>{{ $footer_returns_link_url['title'] ?? 'Retours' }}</a></li>
          @endif
          @if($footer_faq_link_url)
            <li><a href="{{ $footer_faq_link_url['url'] ?? '#' }}" class="text-gray-400 hover:text-primary transition-colors" @if($footer_faq_link_url['target'] ?? false) target="{{ $footer_faq_link_url['target'] }}" @endif>{{ $footer_faq_link_url['title'] ?? 'FAQ' }}</a></li>
          @endif
        </ul>
      </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-gray-700 mt-8 pt-6 text-center">
      <p class="text-gray-400">
        © {{ date('Y') }} {{ get_bloginfo('name') }}. {{ $footer_copyright_text ?? 'Tous droits réservés.' }} | 
        @if($footer_legal_mentions_link_url)
          <a href="{{ $footer_legal_mentions_link_url['url'] ?? '#' }}" class="hover:text-primary transition-colors" @if($footer_legal_mentions_link_url['target'] ?? false) target="{{ $footer_legal_mentions_link_url['target'] }}" @endif>{{ $footer_legal_mentions_link_url['title'] ?? 'Mentions légales' }}</a> | 
        @endif
        @if($footer_privacy_policy_link_url)
          <a href="{{ $footer_privacy_policy_link_url['url'] ?? '#' }}" class="hover:text-primary transition-colors" @if($footer_privacy_policy_link_url['target'] ?? false) target="{{ $footer_privacy_policy_link_url['target'] }}" @endif>{{ $footer_privacy_policy_link_url['title'] ?? 'Politique de confidentialité' }}</a>
        @endif
      </p>
    </div>
  </div>
</footer>
