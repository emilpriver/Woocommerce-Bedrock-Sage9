@extends('layouts.app')

@section('content')
  @if (!have_posts())
    <div class="error-page" style="background-image: url({{ the_field('background_image','option') }})">
      <div class="container">
        {{ the_field('error-text','options') }}
      </div>
    </div>
  @endif
@endsection
