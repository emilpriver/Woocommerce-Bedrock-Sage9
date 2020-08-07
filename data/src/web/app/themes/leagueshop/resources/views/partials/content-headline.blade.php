<section class="headline" style="margin: {{ get_sub_field('margin') }}">
  <div class="container mx-auto">
    <span>{{ get_sub_field('text') }}</span>
    @if(get_sub_field('line_through_text'))
      <div class="line"></div>
    @endif
  </div>
</section>