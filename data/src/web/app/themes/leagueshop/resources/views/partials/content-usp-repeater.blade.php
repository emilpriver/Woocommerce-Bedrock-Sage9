<section class="usp-repeater py-10 w-full float-left">
  <div class="container mx-auto">
    @foreach(get_sub_field('blocks') as $block)
      <div class="float-left usp w-1/2 md:w-1/4 p-1">
        <div class="wrapper p-2 items-center flex">
          <div class="image float-left w-1/4">
            {!! wp_get_attachment_image($block['image'], array(70,70)) !!}
          </div>
          <div class="text float-left w-3/4">
            {{ $block['text'] }}
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>
