
@extends('layouts.app')

@section('content')
  @php do_action('woocommerce_before_account_navigation'); @endphp

  <div class="max-w-5xl mx-auto mt-10">
    <div class="mb-8">
      @php woocommerce_account_navigation(); @endphp
    </div>
    <div>
      @php do_action('woocommerce_account_content'); @endphp
    </div>
  </div>

  @php do_action('woocommerce_after_account_navigation'); @endphp
@endsection
