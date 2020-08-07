@php 
$data = get_sub_field('blocks');
@endphp
<section class="twotimestwo">
  <div class="py-4 sm:py-16 container mx-auto">
    <div class="wrapper">
      @foreach($data as $post)
        <div class="col w-1/2 float-left">
          @if(!empty($post['link']))
            <a href="{{ $post['link'] }}">
          @endif
          <img src="{{ $post['image'] }}" />
          @if(!empty($post['link']))
            </a>
          @endif
        </div>
      @endforeach  
    </div>
  </div>
</section>