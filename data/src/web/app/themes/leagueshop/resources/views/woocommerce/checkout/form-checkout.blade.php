@php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
@endphp
<div class="checkout_page">
  <h1>Complete Your Purchase</h1>

  <div class="products">
    <div class="wrapper">
      <div class="cart-info-blocks">
        <div class="large">Product</div>
        <div class="column">Price</div>
        <div class="column">&nbsp;</div>
      </div>
      @php
      foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
          $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
          @endphp
          <div class="woocommerce-cart-form__cart-item @php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); @endphp">
            <div class="product-info column fill large">
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
              @endphp
              </div>
            </div>
            <div class="column product-subtotal" data-title="@php esc_attr_e( 'Total', 'woocommerce' ); @endphp">
              @php
                echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
              @endphp
            </div>
            <div class="product-remove column small">
              @php
                // @codingStandardsIgnoreLine
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
          @php
        }
      }
      @endphp
      <div class="cart_info">
        <span class="total">Shipping:</span> <strong>{!! WC()->cart->get_cart_shipping_total() !!}</strong>
      </div>
      <div class="cart_info">
        <span class="total">Total:</span> @php wc_cart_totals_order_total_html(); @endphp
      </div>
    </div>
  </div>
  @php
  echo '<div class="content">';
    do_action( 'woocommerce_before_checkout_form', $checkout );
    // If checkout registration is disabled and not logged in, the user cannot checkout.
    if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
      echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
      return;
    }
    if ( ! is_ajax() ) {
      do_action( 'woocommerce_review_order_before_payment' );
    }
  @endphp
    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="@php echo esc_url( wc_get_checkout_url() ); @endphp" enctype="multipart/form-data">
      <div class="row">
        <div class="col-12">
          @php if ( $checkout->get_checkout_fields() ) : @endphp
          <div class="order_review_row">
            @php do_action( 'woocommerce_checkout_before_customer_details' ); @endphp
            <div class="row" id="customer_details">
              <div class="col-12">
                @php do_action( 'woocommerce_checkout_billing' ); @endphp
              </div>
              <div class="col-12">
                @php do_action( 'woocommerce_checkout_shipping' ); @endphp
              </div>
            </div>
            @php do_action( 'woocommerce_checkout_after_customer_details' ); @endphp
          </div>
          @php endif; @endphp
        </div>
        <div class="col-12">
          <h3 id="order_review_heading">@php esc_html_e( 'Shipping', 'woocommerce' ); @endphp</h3>
          @php do_action( 'woocommerce_checkout_before_order_review' ); @endphp
          <div id="order_review" class="woocommerce-checkout-review-order">
            @php do_action( 'woocommerce_checkout_order_review' ); @endphp
          </div>
          @php do_action( 'woocommerce_checkout_after_order_review' ); @endphp
        </div>
      </div>
    </form>
    @php do_action( 'woocommerce_after_checkout_form', $checkout ); @endphp
  </div>
</div>
