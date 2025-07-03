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
          Votre boutique en ligne de confiance. Nous proposons des produits de qualité avec un service client exceptionnel et une livraison rapide.
        </p>
        <div class="flex space-x-4">
          <a href="#" class="text-gray-400 hover:text-primary transition-colors">
            <i class="fab fa-facebook-f text-xl"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-primary transition-colors">
            <i class="fab fa-twitter text-xl"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-primary transition-colors">
            <i class="fab fa-instagram text-xl"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-primary transition-colors">
            <i class="fab fa-linkedin-in text-xl"></i>
          </a>
        </div>
      </div>

      {{-- Liens rapides --}}
      <div>
        <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
        <ul class="space-y-2">
          <li><a href="{{ home_url('/') }}" class="text-gray-400 hover:text-primary transition-colors">Accueil</a></li>
          @if(function_exists('wc_get_page_permalink'))
            <li><a href="{{ wc_get_page_permalink('shop') }}" class="text-gray-400 hover:text-primary transition-colors">Boutique</a></li>
          @endif
          <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">À propos</a></li>
          <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Contact</a></li>
        </ul>
      </div>

      {{-- Service client --}}
      <div>
        <h4 class="text-lg font-semibold mb-4">Service client</h4>
        <ul class="space-y-2">
          @if(function_exists('wc_get_page_permalink'))
            <li><a href="{{ wc_get_page_permalink('myaccount') }}" class="text-gray-400 hover:text-primary transition-colors">Mon compte</a></li>
            <li><a href="{{ wc_get_page_permalink('cart') }}" class="text-gray-400 hover:text-primary transition-colors">Panier</a></li>
          @endif
          <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Livraison</a></li>
          <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Retours</a></li>
          <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">FAQ</a></li>
        </ul>
      </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-gray-700 mt-8 pt-6 text-center">
      <p class="text-gray-400">
        © {{ date('Y') }} {{ get_bloginfo('name') }}. Tous droits réservés. | 
        <a href="#" class="hover:text-primary transition-colors">Mentions légales</a> | 
        <a href="#" class="hover:text-primary transition-colors">Politique de confidentialité</a>
      </p>
    </div>
  </div>
</footer>
