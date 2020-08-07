@php 
if(get_sub_field('type_of_query') == 'latest'):
  $args = array(
    'post_type' => 'product',
    'orderby' => 'latest',
    'posts_per_page' => 12,
  );
elseif(get_sub_field('type_of_query') == 'popular'):
  $args = array(
    'post_type' => 'product',
    'orderby' => 'latest',
    'posts_per_page' => 12,
  );
else:
  $args = array(
    'post_type' => 'product',
    'post_in' => get_sub_field('custom_posts'),
    'orderby' => 'post__in',
    'posts_per_page' => 12,
  );
endif;
@endphp 
<section class="shop-content">
  @if( function_exists('yoast_breadcrumb') && get_sub_field('show_breadcrumbz') )
    <div class="breadcrumbz">
      <div class="container mx-auto bread">
        {!! yoast_breadcrumb( '','' ) !!} 
      </div>
    </div>
  @endif
  @if(!empty(get_sub_field('header')))
    <div class="container mx-auto">
      <h2>{{ get_sub_field('header') }}</h2>
    </div>
  @endif
  <div class="container mx-auto">
    <div class="w-full products float-left" id="products">
      <div class="column">
        @php $loop = new WP_Query($args); @endphp
        @if($loop->have_posts())
          @while($loop->have_posts())
            @php 
            $loop->the_post();
            $_product = wc_get_product( get_the_id() );
            @endphp
            <div class="col w-full xs:w-full sm:w-full md:w-1/2 lg:w-1/4 float-left">
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
        @endif
      </div>
    </div>
  </div>
</section>