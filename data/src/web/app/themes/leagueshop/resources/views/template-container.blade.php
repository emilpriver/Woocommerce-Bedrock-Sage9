{{--
  Template Name: With Container
--}}

@extends('layouts.app')

@section('content')
  <div class="with-container">
    <div class="container mx-auto">
        @php
        if(have_posts()):
            while(have_posts()):
              the_post();
              the_content();
            endwhile;
        endif;
        @endphp
      </div>
  </div>
@endsection
