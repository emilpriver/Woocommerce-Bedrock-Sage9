<section class="hero flex" style="height: {{ the_sub_field('height') }}px;background-image:url({{ the_sub_field('image') }})">
    <div class="container {{ get_sub_field('wrapper_content_placement') }}">
        <div class="wrapper" style="max-width: {{ get_sub_field('content_max_width') }}px">
            {{ the_sub_field('content') }}
            @if(!empty(get_sub_field('buttons')))
                <div class="links">
                    @foreach(get_sub_field('buttons') as $btn)
                        <div class="link">
                            <span class="link-button" style="color: {{ $btn['link_button_color'] }}; background: {{ $btn['link_button_background_color'] }}">
                                {{ $btn['link_text'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>