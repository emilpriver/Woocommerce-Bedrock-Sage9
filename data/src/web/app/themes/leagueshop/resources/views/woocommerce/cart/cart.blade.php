@php
/**
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); @endphp

<div class="cart_page">
  <div class="w-full xl:w-3/5 products-content float-left">
    <h2> Cart </h2>
    <form class="woocommerce-cart-form" action="@php echo esc_url( wc_get_cart_url() ); @endphp" method="post">
      @php do_action( 'woocommerce_before_cart_table' ); @endphp
        <div class="cart_headers">
          <div class="fill column product-thumbnail">Product Details</div>
          <div class="column product-price">@php esc_html_e( 'Price', 'woocommerce' ); @endphp</div>
          <div class="column product-quantity">@php esc_html_e( 'Quantity', 'woocommerce' ); @endphp</div>
          <div class="column product-subtotal">@php esc_html_e( 'Total', 'woocommerce' ); @endphp</div>
          <div class="product-remove column small">&nbsp;</div>
        </div>
        <div class="cart_content">
          @php 
          do_action( 'woocommerce_before_cart_contents' ); 
          foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
              $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
              @endphp
              <div class="woocommerce-cart-form__cart-item @php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); @endphp">
                <div class="product-info column fill">
                  <div class="small-col product-thumbnail">
                  @php
                  $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('full'), $cart_item, $cart_item_key );
                  if ( ! $product_permalink ) {
                    echo $thumbnail; // PHPCS: XSS ok.
                  } else {
                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                  }
                  @endphp
                  </div>
                  <div class="product-name small-col  fill" data-title="@php esc_attr_e( 'Product', 'woocommerce' ); @endphp">
                  @php
                  if ( ! $product_permalink ) {
                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                  } else {
                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                  }
                  do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                  // Meta data.
                  echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
                  // Backorder notification.
                  if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                  }
                  echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                    '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                    __( 'Remove', 'woocommerce' ),
                    esc_attr( $product_id ),
                    esc_attr( $_product->get_sku() )
                  ), $cart_item_key );
                  @endphp
                  </div>
                </div>
                <div class="product-price column" data-title="@php esc_attr_e( 'Price', 'woocommerce' ); @endphp">
                  @php
                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                  @endphp
                </div>
                <div class="column product-quantity" data-title="@php esc_attr_e( 'Quantity', 'woocommerce' ); @endphp">
                @php
                if ( $_product->is_sold_individually() ) {
                  $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                } else {
                  $product_quantity = woocommerce_quantity_input( array(
                    'input_name'   => "cart[{$cart_item_key}][qty]",
                    'input_value'  => $cart_item['quantity'],
                    'max_value'    => $_product->get_max_purchase_quantity(),
                    'min_value'    => '0',
                    'product_name' => $_product->get_name(),
                  ), $_product, false );
                }
                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                @endphp
                </div>
                <div class="column product-subtotal" data-title="@php esc_attr_e( 'Total', 'woocommerce' ); @endphp">
                  @php
                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                  @endphp
                </div>
                <div class="product-remove column small">&nbsp;</div>
              </div>
              @php
            }
          }
          @endphp
          @php do_action( 'woocommerce_cart_contents' ); @endphp
          <div>
            <div colspan="6" class="actions">
              @php if ( wc_coupons_enabled() ) { @endphp
                <div class="coupon">
                  <label for="coupon_code">@php esc_html_e( 'Coupon:', 'woocommerce' ); @endphp</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="@php esc_attr_e( 'Coupon code', 'woocommerce' ); @endphp" /> <button type="submit" class="button" name="apply_coupon" value="@php esc_attr_e( 'Apply coupon', 'woocommerce' ); @endphp">@php esc_attr_e( 'Apply coupon', 'woocommerce' ); @endphp</button>
                  @php do_action( 'woocommerce_cart_coupon' ); @endphp
                </div>
              @php } @endphp
              <button type="submit" class="button" name="update_cart" value="@php esc_attr_e( 'Update cart', 'woocommerce' ); @endphp">@php esc_html_e( 'Update cart', 'woocommerce' ); @endphp</button>
              @php do_action( 'woocommerce_cart_actions' ); @endphp
              @php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); @endphp
            </div>
          </div>
          @php do_action( 'woocommerce_after_cart_contents' ); @endphp
        </div>
      @php do_action( 'woocommerce_after_cart_table' ); @endphp
    </form>
  </div>
  <div class="w-full xl:w-2/5 float-left cart-totalts-content">
    <div class="cart-collaterals">
      @php
        /**
          * Cart collaterals hook.
          *
          * @hooked woocommerce_cross_sell_display
          * @hooked woocommerce_cart_totals - 10
          */
        do_action( 'woocommerce_cart_collaterals' );
      @endphp
    </div>
  </div>
</div>

@php do_action( 'woocommerce_after_cart' ); @endphp
