@php
/**
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
@endphp
<div class="woocommerce-shipping-totals shipping">
	<h3 class="checkout_hide">@php echo wp_kses_post( $package_name ); @endphp</h3>
	<div data-title="@php echo esc_attr( $package_name ); @endphp">
		@php if ( $available_methods ) : @endphp
			<select id="shipping_method" name="@php printf( 'shipping_method[%1$d]', $index); @endphp" class="woocommerce-shipping-methods">
				@php foreach($available_methods as $method): @endphp
					<option class="" value="@php echo $method->id; @endphp" @php selected( $method->id, $chosen_method, true); @endphp>@php echo $method->label . ' ' . $method->cost; @endphp$</option>
				@php endforeach; @endphp
			</select>
			@php foreach($available_methods as $method):
				printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) );
			endforeach; @endphp
			@php if ( is_cart() ) : @endphp
				<p class="woocommerce-shipping-destination">
					@php
					if ( $formatted_destination ) {
						// Translators: $s shipping destination.
						printf( esc_html__( 'Estimate for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' );
						$calculator_text = __( 'Change address', 'woocommerce' );
					} else {
						echo esc_html__( 'This is only an estimate. Prices will be updated during checkout.', 'woocommerce' );
					}
					@endphp
				</p>
			@php endif; @endphp
		@php
		elseif ( ! $has_calculated_shipping || ! $formatted_destination ) :
			esc_html_e( 'Enter your address to view shipping options.', 'woocommerce' );
		elseif ( ! is_cart() ) :
			echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping methods available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) );
		else :
			// Translators: $s shipping destination.
			echo wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
			$calculator_text = __( 'Enter a different address', 'woocommerce' );
		endif;
		@endphp
		@php if ( $show_package_details ) : @endphp
			@php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; @endphp
		@php endif; @endphp
		@php if ( $show_shipping_calculator ) : @endphp
			@php woocommerce_shipping_calculator( $calculator_text ); @endphp
		@php endif; @endphp
	</div>
</div>
