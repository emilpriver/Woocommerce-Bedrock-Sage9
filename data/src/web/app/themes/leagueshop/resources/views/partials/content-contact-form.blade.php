<section class="contact-form">
  <div class="container mx-auto">
    <div class="title">
      <h2>{{ the_sub_field('heading') }}</h2>
    </div>
    <div class="col w-full md:w-3/5 float-left">
      {!! do_shortcode(get_sub_field('contact_form')) !!}
    </div>
    <div class="col text w-full md:w-2/5 float-left">
      {!! wpautop(get_sub_field('contact_text')) !!}
    </div>
  </div>
</section>