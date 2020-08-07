@php 
$data = get_sub_field('data');
@endphp
<section class="container-grid">
  <div class="mx-auto">
    @foreach($data as $post)
      <div class="col w-full md:w-1/3 float-left">
        <div class="wrapper">
        <a href="{{ get_the_permalink($post->ID) }}">
            <div class="image">
              <img src="{{ get_the_post_thumbnail_url($post->ID) }}" alt="{{ get_the_title($post->ID) }}" />
            </div>
            <div class="content">
              <h3>{{ get_the_title($post->ID) }}</h3>
            </div>
          </a>
        </div>
      </div>
    @endforeach  
  </div>
</section>