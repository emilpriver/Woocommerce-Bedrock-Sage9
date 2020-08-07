<section class="shop-content">
  @if( function_exists('yoast_breadcrumb') && get_sub_field('show_breadcrumbz') )
    <div class="breadcrumbz">
      <div class="container mx-auto bread">
        {!! yoast_breadcrumb( '','' ) !!} 
      </div>
    </div>
  @endif
  @if(!empty(get_sub_field('header')))
    <div class="container heading mx-auto">
      <h2>{{ get_sub_field('header') }}</h2>
    </div>
  @endif
  <div class="container mx-auto">
    <div class="filter w-full xl:w-1/4 float-left filter">
      @php dynamic_sidebar('sidebar-woocommerce-allproducts') @endphp
    </div>
    <div class="w-full xl:w-3/4 products float-left" id="products">
      <div class="column">
        @if( woocommerce_product_loop() )
	        @php do_action( 'woocommerce_before_shop_loop' ) @endphp
	        @php woocommerce_product_loop_start() @endphp
	        @if( wc_get_loop_prop( 'total' ) ) 
            @while ( have_posts() ) 
              @php
              the_post();
              do_action( 'woocommerce_shop_loop' );
              $_product = wc_get_product( get_the_id() );
              @endphp
              <div class="col w-1/2 md:w-1/3 lg:w-1/4 float-left">
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
	        @php woocommerce_product_loop_end() @endphp
	        @php do_action( 'woocommerce_after_shop_loop' ) @endphp
        @else
	        @php do_action( 'woocommerce_no_products_found' ) @endphp
        @endif
      </div>
    </div>
  </div>
</section>