<section class="two-columns">
  <div class="container mx-auto {{ get_sub_field('align_items') ? 'flex items-center' : '' }}">
    <div class="col float-left w-full md:w-1/2">
      {{ the_sub_field('column_1') }}
    </div>
    <div class="col float-left w-full md:w-1/2">
      {{ the_sub_field('column_2') }}
    </div>
  </div>
</section>