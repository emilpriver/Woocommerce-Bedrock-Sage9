<section class="faq">
  <div class="container mx-auto">
    <div class="title">
      <h2>{{ get_sub_field('heading') }}</h2>
    </div>
    <div class="information_text">
      {!! get_sub_field('information_text') !!}
    </div>
    <div class="questions">
      @if(have_rows('questions'))
        @while(have_rows('questions'))
        @php the_row() @endphp
          <div class="questions-item">
            <div class="questions-item-heading">
              <div class="icon">
                <box-icon name='right-arrow' type='solid' ></box-icon>
              </div>
              <h3>{{ get_sub_field('heading') }}</h3>
            </div>
            <div class="questions-item-content">
              {!! get_sub_field('answer') !!}
            </div>
          </div>
        @endwhile
      @endif
    </div>
  </div>
</section>