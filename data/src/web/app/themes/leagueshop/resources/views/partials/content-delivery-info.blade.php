<section class="delivery-info">
  <div class="container mx-auto">
    <div class="title">
      <h2>{{ the_sub_field('heading') }}</h2>
    </div>
    <div class="content">
      @if(have_rows('repeater'))
        @while(have_rows('repeater')) @php the_row() @endphp
          <div class="col float-left w-full xs:w-full md:w-1/2 sm:w/full xl:w-1/3">
            <div class="image">
              {!! wp_get_attachment_image(get_sub_field('image'), 'full') !!}
            </div>
            <div class="info">
              <h3>{{ the_sub_field('heading') }}</h3>
              <span>{{ the_sub_field('sub_heading') }}</span>
            </div>
          </div>
        @endwhile
      @endif
    </div>
  </div>
</section>