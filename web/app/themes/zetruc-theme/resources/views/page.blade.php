@extends('layouts.app')

@section('content')
  @if (function_exists('is_woocommerce') && is_woocommerce())
    {{-- Affiche la vue WooCommerce de base --}}
    @php do_action('woocommerce_before_main_content') @endphp
    {!! woocommerce_content() !!}
    @php do_action('woocommerce_after_main_content') @endphp
  @else
    {{-- Affiche le contenu classique WordPress/ACF --}}
    @if(function_exists('get_field') && get_field('contenu_principal'))
      <div class="prose max-w-4xl mx-auto mb-8">
        {!! get_field('contenu_principal') !!}
      </div>
    @else
      {!! the_content() !!}
    @endif
  @endif
@endsection
