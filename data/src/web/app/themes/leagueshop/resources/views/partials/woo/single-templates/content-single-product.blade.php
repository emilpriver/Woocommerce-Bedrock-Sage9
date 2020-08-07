@php 
global $product;
if(!empty($product->get_gallery_image_ids())):
  $gallery_images = $product->get_gallery_image_ids();
else:
  $gallery_images = array(get_post_thumbnail_id());
endif;
if(!empty(get_sub_field('main_cat'))):
  $cat = get_sub_field('main_cat');
else:
  $primary_cat_id = get_post_meta($product->get_ID(),'_yoast_wpseo_primary_product_cat',true);
  if($primary_cat_id){
    $cat = get_term($primary_cat_id, 'product_cat');
  }
endif;
@endphp 
<section class="single-product-component">
  <div class="container-full mx-auto">
    <div class="single-product-component-hero">
      <div class="w-full float-left xl:w-2/3 single-product-component-hero-images">
        @foreach($gallery_images as $image)
          <div class="image float-left w-1/2">
            <img src="{{ wp_get_attachment_url( $image ) }}" />
          </div>
        @endforeach 
      </div>
      <div class="w-full float-left xl:w-1/3 single-product-component-hero-info">
        <div class="single-product-component-hero-info-content">
          <div class="wrapper">
            <div class="block">
              <h1>@php the_title(); @endphp</h1>
              @if(!empty($cat))
                <h4><a href="{{ get_category_link( $cat->term_id ) }}">{{ $cat->name }}</a></h4>
              @endif
              {!! do_action( 'woocommerce_single_product_summary' ) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@if(!empty(get_the_content()))
<section class="single-product-component-description">
  <div class="container mx-auto">
    <div class="single-product-component-description-info">
      <div class="container mx-auto">
        <h2>Description</h2>
        {!! wpautop(get_the_content()) !!}
      </div>
    </div>
  </div>
</section>
@endif
