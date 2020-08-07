@extends('layouts.app')

@php 
$args = array(
  'post_type' => 'product',
  'posts_per_page' => 1000000000,
  's' => sanitize_text_field($_GET['s'])
);
$loop = new WP_Query($args);
@endphp

@section('content')
  <section class="search-page">
    <div class="breadcrumbz">
      <div class="container mx-auto bread">
        {!! yoast_breadcrumb( '','' ) !!} 
      </div>
    </div>
    <div class="search-form">
      <div class="container mx-auto">
        <form role="search" method="get" class="search-form" action="{{ bloginfo('url') }}">
          <input type="search" class="search-field" placeholder="Search the entire collection..." value="" name="s">
          <button type="submit">
            <box-icon name='search-alt' ></box-icon>
          </button>
        </form>
      </div>
    </div>
    <div class="container mx-auto">
      <div class="title">
          <h2>{{ get_search_query(true) }}</h2>
      </div>
      <div class="content">
        @if($loop->have_posts())
          @while($loop->have_posts())
            @php 
            $loop->the_post();
            $_product = wc_get_product( get_the_id() );
            @endphp
            <div class="col w-full xs:w-full sm:w-full md:w-1/2 lg:w-1/5 float-left">
              <div class="wrapper">
                <a href="{{ the_permalink() }}">
                  <div class="image">
                    {!! the_post_thumbnail('medium_large') !!}
                  </div>
                  <div class="content">
                    <div class="title">
                      <h3>{{ the_title() }}</h3>
                    </div>
                    <div class="meta">
                      <span>{!! $_product->get_price_html() !!}</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          @endwhile
        @else
          <h2 class="no-products">Sorry, No products found</h2>
        @endif
      </div>
    </div>
  </section>
@endsection
