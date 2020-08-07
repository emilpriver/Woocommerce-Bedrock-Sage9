<?php 
function ajax_update_mini_cart() {
  echo wc_get_template( 'cart/mini-cart.php' );
  die();
}
add_filter( 'wp_ajax_nopriv_ajax_update_mini_cart', 'ajax_update_mini_cart' );
add_filter( 'wp_ajax_ajax_update_mini_cart', 'ajax_update_mini_cart' );