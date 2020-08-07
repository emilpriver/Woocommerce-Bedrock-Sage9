<section class="text-row">
  <div class="container mx-auto">
    <div class="title">
      <h2>{{ the_sub_field('heading') }}</h2>
    </div>
    <div class="content" style="justify-content: {{ get_sub_field('content-position') }}">
      <div class="wrapper" style="max-width: {{ get_sub_field('content-max-width') }}px">
        {!! wpautop(get_sub_field('content')) !!}
      </div>
    </div>
  </div>
</section>