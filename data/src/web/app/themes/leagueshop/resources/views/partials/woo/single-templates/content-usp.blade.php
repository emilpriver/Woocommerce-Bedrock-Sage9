<section class="usp">
  <div class="container mx-auto">
    @if(get_sub_field('heading'))
      <div class="title">
        <h2>{{ get_sub_field('heading') }}</h2>
      </div>
    @endif
    @if(have_rows('repeater'))
      @while(have_rows('repeater'))
        @php the_row(); @endphp
        <div class="usp">
          <div class="image">
            <img src="{{ get_sub_field('image') }}" alt="{{ get_sub_field('text') }}" />
          </div>
          <div class="text">
            <h3>{{ get_sub_field('heading') }}</h3>
            <span>{{ get_sub_field('text') }}</span>
          </div>
        </div>
      @endwhile
    @else
      @if(have_rows('default_usp', 'options'))
        @while(have_rows('default_usp', 'options'))
          @php the_row(); @endphp
          <div class="usp">
            <div class="image">
              <img src="{{ get_sub_field('image') }}" alt="{{ get_sub_field('text') }}" />
            </div>
            <div class="text">
              <h3>{{ get_sub_field('heading') }}</h3>
              <span>{{ get_sub_field('text') }}</span>
            </div>
          </div>
        @endwhile
      @endif
    @endif
  </div>
</section>