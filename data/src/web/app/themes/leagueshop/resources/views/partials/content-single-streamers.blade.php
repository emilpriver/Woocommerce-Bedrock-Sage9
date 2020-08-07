@if(have_rows('content'))
  @while(have_rows('content')) @php the_row() @endphp
    @if(get_row_layout() == 'hero')
      @include('partials.content-hero')
    @elseif(get_row_layout() == 'info_text_row')
      @include('partials.content-text-row')
    @elseif(get_row_layout() == 'products')
      @include('partials.content-products')
    @endif
  @endwhile
@endif