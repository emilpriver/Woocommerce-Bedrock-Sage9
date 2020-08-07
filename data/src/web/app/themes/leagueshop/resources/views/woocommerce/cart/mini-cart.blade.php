@php
/**
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
do_action( 'woocommerce_before_mini_cart' ); 
@endphp

@if ( ! WC()->cart->is_empty() )

  <ul class="woocommerce-mini-cart cart_list product_list_widget {!! esc_attr( $args['list_class'] ) !!}">
		@php
			do_action( 'woocommerce_before_mini_cart_contents' );
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					@endphp
					<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
            <div class="col w-1/4 float-left product-image">
              @if ( empty( $product_permalink ) )
                <?php echo $thumbnail; ?>
              @else
                <a href="<?php echo esc_url( $product_permalink ); ?>">
                  <?php echo $thumbnail; ?>
                </a>
              @endif  
            </div>
            <div class="col w-3/4 float-left">
              <h3>{{ $product_name }} </h3>
              <div class="meta-data">
                @if(!empty($cart_item['variation']))
                  @php 
                    $itemsCount = count($cart_item['variation']);
                    $i = 0;
                  @endphp
                  @foreach($cart_item['variation'] as $item => $val)
                    {{ $val }} {{ ++$i === $itemsCount ? '' : ',' }}
                  @endforeach
                @endif  
              </div>
              @php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ) @endphp
            </div>
            @php
              echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                '<a href="%s" class="remove-product-item" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                __( 'Remove this item', 'woocommerce' ),
                esc_attr( $product_id ),
                esc_attr( $cart_item_key ),
                esc_attr( $_product->get_sku() )
              ), $cart_item_key );
						@endphp
					</li>
					<?php
				}
			}
			do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>

	<p class="woocommerce-mini-cart__total total"><strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

@else

	<p class="woocommerce-mini-cart__empty-message"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></p>

@endif

<?php do_action( 'woocommerce_after_mini_cart' ); ?>