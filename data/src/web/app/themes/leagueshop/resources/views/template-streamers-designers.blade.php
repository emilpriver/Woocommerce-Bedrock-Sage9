{{--
  Template Name: Streamers or Designers
--}}

@extends('layouts.app')

@section('content')
  @if(have_rows('block'))
    @while(have_rows('block')) 
      @php the_row(); @endphp
      @if(get_row_layout() == 'hero')
        @include('partials.content-hero')
      @elseif(get_row_layout() == 'content')
        @include('partials.content-persons-content')
      @elseif(get_row_layout() == 'info_text_row')
        @include('partials.content-text-row')
      @endif
    @endwhile
  @endif
@endsection