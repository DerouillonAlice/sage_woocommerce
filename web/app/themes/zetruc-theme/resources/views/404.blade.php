@extends('layouts.app')

@section('content')
<section class="py-20 ">
  <div class="container mx-auto px-6 max-w-7xl text-center">
    <h1 class="text-6xl font-bold text-gray-800 mb-6">404</h1>
    <p class="text-xl text-gray-600 mb-8">Oups ! La page que vous recherchez est introuvable.</p>
    <a href="{{ home_url() }}" class="inline-block px-6 py-3 bg-black text-white rounded-full">Retour à l’accueil 
    </a>
  </div>
</section>

@endsection
