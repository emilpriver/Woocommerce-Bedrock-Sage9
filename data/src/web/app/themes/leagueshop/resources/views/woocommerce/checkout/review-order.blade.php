@php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
@endphp
<div class="shop_table woocommerce-checkout-review-order-table">
	<div>
		<!--
		<div class="cart-subtotal">
			<span>@php _e( 'Subtotal', 'woocommerce' ); @endphp</span>
			<span>@php wc_cart_totals_subtotal_html(); @endphp</span>
		</div> -->
		@php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : @endphp
			<div class="cart-discount coupon-@php echo esc_attr( sanitize_title( $code ) ); @endphp">
				<span>@php wc_cart_totals_coupon_label( $coupon ); @endphp</span>
				<span>@php wc_cart_totals_coupon_html( $coupon ); @endphp</span>
			</div>
		@php endforeach; @endphp
		@php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : @endphp
			@php do_action( 'woocommerce_review_order_before_shipping' ); @endphp
			@php wc_cart_totals_shipping_html(); @endphp
			@php do_action( 'woocommerce_review_order_after_shipping' ); @endphp
		@php endif; @endphp
		@php foreach ( WC()->cart->get_fees() as $fee ) : @endphp
			<div class="fee">
				<span>@php echo esc_html( $fee->name ); @endphp</span>
				<span>@php wc_cart_totals_fee_html( $fee ); @endphp</span>
			</div>
		@php endforeach; @endphp
		@php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : @endphp
			@php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : @endphp
				@php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : @endphp
					<div class="tax-rate tax-rate-@php echo sanitize_title( $code ); @endphp">
						<span>@php echo esc_html( $tax->label ); @endphp</span>
						<span>@php echo wp_kses_post( $tax->formatted_amount ); @endphp</span>
					</div>
				@php endforeach; @endphp
			@php else : @endphp
				<div class="tax-total">
					<span>@php echo esc_html( WC()->countries->tax_or_vat() ); @endphp</span>
					<span>@php wc_cart_totals_taxes_total_html(); @endphp</span>
				</div>
			@php endif; @endphp
		@php endif; @endphp
		<div class="order-total">
			<span>@php _e( 'Total', 'woocommerce' ); @endphp</span>
			<span>@php wc_cart_totals_order_total_html(); @endphp</span>
		</div>
	</div>
</div>
