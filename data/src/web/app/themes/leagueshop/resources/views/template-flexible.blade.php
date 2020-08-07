{{--
  Template Name: Flexible
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @if(have_rows('block'))
      @while(have_rows('block')) @php the_row(); @endphp
        @if(get_row_layout() == 'hero')
          @include('partials.content-hero')
        @elseif(get_row_layout() == 'shop_content')
          @include('partials.content-shop-content')
        @elseif(get_row_layout() == 'contact_form')
          @include('partials.content-contact-form')
        @elseif(get_row_layout() == 'map')
          @include('partials.content-map')
        @elseif(get_row_layout() == 'faq')
          @include('partials.content-faq')
        @elseif(get_row_layout() == 'delivery_info')
          @include('partials.content-delivery-info')
        @elseif(get_row_layout() == '2_columns')
          @include('partials.content-2-columns')
        @elseif(get_row_layout() == 'wysiwyg')
          @include('partials.content-wysiwyg')
        @elseif(get_row_layout() == 'usp')
          @include('partials.woo.single-templates.content-usp')
        @elseif(get_row_layout() == 'blocks-repeater')
          @include('partials.content-blocks-repeater')
        @endif
      @endwhile
    @endif
  @endwhile
@endsection
