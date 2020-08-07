@php
/**
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $order;

@endphp
<div class="cart_totals @php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; @endphp">
	@php do_action( 'woocommerce_before_cart_totals' ); @endphp
	<h2>@php _e( 'Cart totals', 'woocommerce' ); @endphp</h2>
	<div cellspacing="0" class="shop_table shop_table_responsive">
		<div class="cart-subtotal">
			<span>@php _e( 'Subtotal', 'woocommerce' ); @endphp</span>
			<span data-title="@php esc_attr_e( 'Subtotal', 'woocommerce' ); @endphp">@php wc_cart_totals_subtotal_html(); @endphp</span>
		</div>
		@php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : @endphp
			<div class="cart-discount coupon-@php echo esc_attr( sanitize_title( $code ) ); @endphp">
				<span>@php wc_cart_totals_coupon_label( $coupon ); @endphp</span>
				<span data-title="@php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); @endphp">@php wc_cart_totals_coupon_html( $coupon ); @endphp</span>
			</div>
		@php endforeach; @endphp
		@php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : @endphp
			@php do_action( 'woocommerce_cart_totals_before_shipping' ); @endphp
			@php wc_cart_totals_shipping_html(); @endphp
			@php do_action( 'woocommerce_cart_totals_after_shipping' ); @endphp
		@php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : @endphp
			<div class="shipping">
				<span>@php _e( 'Shipping', 'woocommerce' ); @endphp</span>
				<span data-title="@php esc_attr_e( 'Shipping', 'woocommerce' ); @endphp">@php woocommerce_shipping_calculator(); @endphp</span>
			</div>
		@php endif; @endphp
		@php foreach ( WC()->cart->get_fees() as $fee ) : @endphp
			<div class="fee">
				<span>@php echo esc_html( $fee->name ); @endphp</span>
				<span data-title="@php echo esc_attr( $fee->name ); @endphp">@php wc_cart_totals_fee_html( $fee ); @endphp</span>
			</div>
		@php endforeach; @endphp
		@php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
					? sprintf( ' <small>' . __( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
					: '';
			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : @endphp
				@php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : @endphp
					<div class="tax-rate tax-rate-@php echo sanitize_title( $code ); @endphp">
						<span>@php echo esc_html( $tax->label ) . $estimated_text; @endphp</span>
						<span data-title="@php echo esc_attr( $tax->label ); @endphp">@php echo wp_kses_post( $tax->formatted_amount ); @endphp</span>
					</div>
				@php endforeach; @endphp
			@php else : @endphp
				<div class="tax-total">
					<span>@php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; @endphp</span>
					<span data-title="@php echo esc_attr( WC()->countries->tax_or_vat() ); @endphp">@php wc_cart_totals_taxes_total_html(); @endphp</span>
				</div>
			@php endif; @endphp
		@php endif; @endphp
		@php do_action( 'woocommerce_cart_totals_before_order_total' ); @endphp
		<div class="order-total">
			<span>Shipping: <strong>{!! WC()->cart->get_cart_shipping_total() !!}</strong></span>
		</div>
		<div class="order-total">
			<span>@php _e( 'Total', 'woocommerce' ); @endphp</span>
			<span data-title="@php esc_attr_e( 'Total', 'woocommerce' ); @endphp">@php wc_cart_totals_order_total_html(); @endphp</span>
		</div>
		@php do_action( 'woocommerce_cart_totals_after_order_total' ); @endphp
	</div>
	<div class="wc-proceed-to-checkout">
		@php do_action( 'woocommerce_proceed_to_checkout' ); @endphp
	</div>
	@php do_action( 'woocommerce_after_cart_totals' ); @endphp
</div>