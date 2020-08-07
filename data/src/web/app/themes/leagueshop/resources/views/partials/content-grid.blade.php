<section class="grid flex">
    @foreach(get_sub_field('categorys') as $item)
        @php 
        $thumbnail_id = get_term_meta( $item, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        $term = get_term_by( 'id', $item, 'product_cat' );
        $link = get_term_link( (int)$item, 'product_cat' );
        @endphp
        <div class="col">
            <a href="{{ $link }}">
                <div class="wrapper">
                    <div class="image" style="background-image: url({{ !empty($image) ? $image : 'https://media.leagueshop.com/staging/Outerwear_front.progressive.jpg' }})"></div>
                    <h3>{{ $term->name }}</h3>
                </div>
            </a>
        </div>
    @endforeach
</section>