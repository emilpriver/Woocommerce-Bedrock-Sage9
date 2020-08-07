@php 
global $product;

if( ! is_a( $product, 'WC_Product' ) ){
  $product = wc_get_product(get_the_id());
}

$args = array(
  'posts_per_page' => 12,
  'orderby'        => 'rand',
  'order'          => 'desc',
  'post_type'      => 'product',
);

$args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
$args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

wc_set_loop_prop( 'name', 'related' );

$related_products =  new WP_Query($args);
@endphp
<section class="you-may-like">
  <div class="container mx-auto">
    <div class="title">
      <h2>{{ !empty(get_sub_field('heading')) ? get_sub_field('heading') : 'You may also like' }}</h2>
    </div>
    <div class="products related-products-loop">
      @while($related_products->have_posts())
        @php 
        $related_products->the_post(); 
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
      @php wp_reset_query(); @endphp
    </div>
    <div class="arrows" >
      <div class="arrow prev">
        <box-icon type="solid" color="black" name="left-arrow-circle"></box-icon>
      </div>
      <div class="arrow next">
        <box-icon type="solid" color="black" name="right-arrow-circle"></box-icon>
      </div>
    </div>
    <div class="dots"></div>
  </div>
</section>