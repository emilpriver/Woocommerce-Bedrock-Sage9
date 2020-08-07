<?php 

/**
 * Include Widgets
 */
include_once 'widgets/product-filter.php';

/**
 * Register Widgets
 */
function register_widgets() {
	register_widget( 'product_filter_widget' );
}

add_action( 'widgets_init', 'register_widgets' );