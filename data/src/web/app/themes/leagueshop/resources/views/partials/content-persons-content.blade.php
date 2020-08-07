@php
if(get_sub_field('type_of_query') == 'streamers'):

  $args = array(
    'post_type' => 'streamers',
    'posts_per_page' => 1000000000,
  );
  if(get_sub_field('order') == 'latest'):
    $args['orderby'] = 'publish_date';
  else: 
    $args['post__in'] = get_sub_field('relation_streamers');
    $args['orderby'] = 'post__in';
  endif;

else: 

  $args = array(
    'post_type' => 'designers',
    'posts_per_page' => 1000000000,
  );
  if(get_sub_field('order') == 'latest'):
    $args['orderby'] = 'publish_date';
  else: 
    $args['post__in'] = get_sub_field('relation_designers');
    $args['orderby'] = 'post__in';
  endif;

endif;
$loop = new WP_Query($args);
@endphp 
<section class="persons">
  @if( function_exists('yoast_breadcrumb') && get_sub_field('show_breadcrumbz') )
    <div class="breadcrumbz">
      <div class="container mx-auto bread">
        {!! yoast_breadcrumb( '','' ) !!} 
      </div>
    </div>
  @endif
  <div class="mx-auto">
    @if(!empty(get_sub_field('heading')))
      <div class="title">
        <h2>{{ the_sub_field('heading') }}</h2>
      </div>
    @endif
    <div class="content">
      @if($loop->have_posts())
        @while($loop->have_posts())
          @php $loop->the_post() @endphp
          <div class="col w-full sm:w-full md:w-1/2 lg:w-1/3 float-left">
            <div class="wrapper">
              <a href="{!! get_permalink() !!}">
                <div class="thumbnail" style="background-image:url({!! the_post_thumbnail_url() !!})"></div>
                <div class="content">
                  <div class="title">
                    <h3>{{ the_title() }}</h3>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endwhile
      @endif
    </div>
  </div>
</section>