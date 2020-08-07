<section class="full-width-slider">
  <div class="full-width-slider-blocks">
    @foreach(get_sub_field('blocks') as $data)
    <div class="slide">
      <a href="{{ $data['link'] }}">
        {!! wp_get_attachment_image($data['image'], 'full') !!}
      </a>
    </div>
    @endforeach
  </div>
  <div class="arrows">
    <div class="arrow prev">
      @include('partials.svg.arrow-left')
    </div>
    <div class="arrow next">
      @include('partials.svg.arrow-right')
    </div>
  </div>
  <div class="dots"></div>
</section>