@php 
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
  'nopaging' => false,
  'paged'=> $paged,
  'post_type' => 'product',
  'orderby' => 'latest',
  'posts_per_page' => 12,
  'meta_key' => 'streamer_or_designer',
  'meta_value' => get_the_ID()
);
$loop = new WP_Query($args);
@endphp
<section class="products-content">
  <div class="container mx-auto">
    <div class="title">
     <h2>{{ get_sub_field('heading') }}</h2>
    </div>
    <div class="products">
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
    <div class="paged">
      @php 
        $total_pages = $loop->max_num_pages; 
        if ($total_pages > 1):
          $current_page = max(1, get_query_var('paged'));
          echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'    => __('<'),
            'next_text'    => __('>'),
          ));
        endif;
        wp_reset_postdata();
      @endphp
    </div>
  </div>
</section>