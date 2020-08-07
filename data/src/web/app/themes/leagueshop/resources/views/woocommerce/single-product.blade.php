@extends('layouts.app')

@section('content')
  @php 
  global $product,$woocommerce;
  @endphp
  @if(have_rows('blocks'))
    @while(have_rows('blocks')) 
      @php the_row(); @endphp
      @if(get_row_layout() == 'product_content')
        @include('partials.woo.single-templates.content-single-product')
      @elseif(get_row_layout() == 'you_may_also_like')
        @include('partials.woo.single-templates.content-single-product')
      @elseif(get_row_layout() == 'usp')
        @include('partials.woo.single-templates.content-usp')
      @endif
    @endwhile
  @else
    @include('partials.woo.single-templates.content-single-product')
    @include('partials.woo.single-templates.content-you-may-also-like')
    @include('partials.woo.single-templates.content-usp')
  @endif
@endsection