<?php 
/**
 * Remove product in mini cart via ajax
 */
add_action( 'wp_ajax_product_remove', 'warp_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'warp_ajax_product_remove' );

function warp_ajax_product_remove()
{
  // Get mini cart
  ob_start();

  foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item){
    if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] ){
      WC()->cart->remove_cart_item($cart_item_key);
    }
  }

  WC()->cart->calculate_totals();
  WC()->cart->maybe_set_cart_cookies();

  echo wc_get_template( 'cart/mini-cart.php' );

  die();
}
