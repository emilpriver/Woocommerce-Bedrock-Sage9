<section class="blocks-repeater">
  <div class="container mx-auto">
    @if(get_sub_field('heading'))
      <div class="title">
        <h2>{{ get_sub_field('heading') }}</h2>
      </div>
    @endif
    @if(have_rows('content'))
      @while(have_rows('content'))
        @php the_row() @endphp
        <div class="w-full float-left md:w-1/2 xl:w-1/4 block">
          {!! the_sub_field('html') !!}
        </div>
      @endwhile
    @endif
  </div>
</section>