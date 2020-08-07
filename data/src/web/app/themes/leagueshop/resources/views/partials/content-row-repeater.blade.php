<section class="row-repeater">
  <div class="container mx-auto">
    @foreach(get_sub_field('blocks') as $block)
      <a href="{{ $block['button_link'] }}">
        <div class="block relative">
          {!! wp_get_attachment_image($block['image'], 'full') !!}
        </div>
      </a>
    @endforeach
  </div>
</section>