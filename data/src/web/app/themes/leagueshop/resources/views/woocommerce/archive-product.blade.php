{{--
  Template Name: Flexible
--}}
@php
$query = get_queried_object();
$page_id = is_shop() ? get_option( 'woocommerce_shop_page_id' ) : $query;
@endphp 

@extends('layouts.app')

@section('content')
  @if(have_rows('block', $page_id))
    @while(have_rows('block', $page_id )) 
      @php the_row(); @endphp
      @if(get_row_layout() == 'hero')
        @include('partials.content-hero')
      @elseif(get_row_layout() == 'shop_content_woocommerce')
        @include('partials.content-shop-content-woocommerce')
      @endif
    @endwhile
  @endif
@endsection
