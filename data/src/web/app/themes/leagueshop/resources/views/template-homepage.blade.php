{{--
  Template Name: Homepage
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @if(have_rows('block'))
      @while(have_rows('block')) @php the_row(); @endphp
        @if(get_row_layout() == 'hero')
          @include('partials.content-hero')
        @elseif(get_row_layout() == 'full_width_image')
          @include('partials.content-full-width-image')
        @elseif(get_row_layout() == 'full_width_slider')
          @include('partials.content-slider')
        @elseif(get_row_layout() == 'headline')
          @include('partials.content-headline')
        @elseif(get_row_layout() == 'grid')
          @include('partials.content-grid')
        @elseif(get_row_layout() == 'showcase')
          @include('partials.content-showcase')
        @elseif(get_row_layout() == '3_3_grid')
          @include('partials.content-3x3-grid')
        @elseif(get_row_layout() == '2_2_grid')
          @include('partials.content-2x2-grid')
        @elseif(get_row_layout() == 'row_reapter')
          @include('partials.content-row-repeater')
        @elseif(get_row_layout() == 'usp_repeater')
          @include('partials.content-usp-repeater')
        @endif
      @endwhile
    @endif
  @endwhile
@endsection
