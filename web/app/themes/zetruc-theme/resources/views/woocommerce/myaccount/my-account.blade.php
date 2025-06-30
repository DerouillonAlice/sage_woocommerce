
@extends('layouts.app')

@section('content')
  @php do_action('woocommerce_before_account_navigation'); @endphp
  <div class="flex flex-col md:flex-row gap-8">
    <nav class="w-full md:w-1/4 mb-8 md:mb-0">
      @php woocommerce_account_navigation(); @endphp
    </nav>
    <div class="w-full md:w-3/4">
      @php do_action('woocommerce_account_content'); @endphp
    </div>
  </div>
  @php do_action('woocommerce_after_account_navigation'); @endphp
@endsection
