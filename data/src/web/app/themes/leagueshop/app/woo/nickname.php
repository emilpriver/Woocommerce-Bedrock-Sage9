<?php
add_action('woocommerce_before_add_to_cart_button', 'add_fields_before_add_to_cart');
function add_fields_before_add_to_cart()
{
    global $post;
    $checkbox = get_post_meta($post->ID, '_checkbox', true);
    if ($checkbox == 'yes'):
    ?>
	<div class="w-full custom_nickname_wrapper">
    <span class="label">Custom Nickname (<?php echo get_field('default_nickname_cost', 'option'); ?>$)</span>
    <input type="text" id="custom_nickname" name="nickname" placeholder="Enter Custom Nickname" value="">
  </div>
	<?php
endif;
}
/**
 * Add data to cart item
 */
add_filter('woocommerce_add_cart_item_data', 'add_cart_item_data', 25, 2);
function add_cart_item_data($cart_item_meta, $product_id)
{
    if (!empty($_POST['nickname'])) {
        /**
         * Add nickname data
         */
        $custom_data = array();
        $custom_data['nickname'] = !empty($_POST['nickname']) ? sanitize_text_field($_POST['nickname']) : "";
        $cart_item_meta['custom_data'] = $custom_data;
        /**
         * Change price
         */
        $product = wc_get_product($product_id);
        $price = $product->get_price();
        $cart_item_meta['total_price'] = $price + get_field('default_nickname_cost', 'option');
    }
    return $cart_item_meta;
}
/**
 * Display the custom data on cart and checkout page
 */
add_filter('woocommerce_get_item_data', 'get_item_data', 25, 2);
function get_item_data($other_data, $cart_item)
{
    if (isset($cart_item['custom_data'])) {
        $custom_data = $cart_item['custom_data'];
        $other_data[] = array('name' => 'Nickname', 'display' => $custom_data['nickname']);
    }

    return $other_data;
}
/**
 * Add order item meta
 */
add_action('woocommerce_add_order_item_meta', 'add_order_item_meta', 10, 2);
function add_order_item_meta($item_id, $values)
{
    var_dump($values);
    if (isset($values['custom_data'])) {
        $custom_data = $values['custom_data'];
        wc_add_order_item_meta($item_id, 'Nickname', $custom_data['nickname']);
    }
}

/**
 * Add custom nickname to order details
 */
function show_custom_data_in_order($item, $cart_item_key, $values, $order)
{
    var_dump($values);
    if (!isset($values['custom_data'])) {
        $custom_data = $values['custom_data'];
        $item->add_meta_data(__('Nickname (+' . get_field('default_nickname_cost', 'option') . '$)', 'theme'), $custom_data['nickname']);
    }
}
add_action('woocommerce_checkout_create_order_line_item', 'show_custom_data_in_order', 10, 4);

function custom_meta_after_order_itemmeta($item_id, $item, $product)
{
    $data = json_decode($item, true)['meta_data'];
    if (!empty($data)):
        foreach ($data as $value) {
            echo '<p>' . $value['key'] . ': <strong>' . $value['value'] . '</strong> </p>';
        }
    endif;
};

// add the action
add_action('woocommerce_after_order_itemmeta', 'custom_meta_after_order_itemmeta', 10, 3);

/**
 * Caluculate price with the new attribute
 */
function caluculate_price($cart_obj)
{
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }
    // Iterate through each cart item
    foreach ($cart_obj->get_cart() as $key => $value) {
        if (isset($value['total_price'])) {
            $price = $value['total_price'];
            $value['data']->set_price(($price));
        }
    }
}
add_action('woocommerce_before_calculate_totals', 'caluculate_price', 10, 1);