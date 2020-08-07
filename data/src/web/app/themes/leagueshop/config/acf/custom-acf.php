<?php  
add_filter('acf/location/rule_values/page_type', 'dc_acf_location_rules_values_woo_shop');

function dc_acf_location_rules_values_woo_shop($choices){

	$choices[ 'woo-shop-page' ] = 'WooCommerce Shop Page';

	return $choices;
}

// Add WooCommerce 'Shop' location rule match
add_filter('acf/location/rule_match/page_type', 'dc_acf_location_rules_match_woo_shop', 10, 3);

function dc_acf_location_rules_match_woo_shop($match, $rule, $options){
	if(is_admin() && $rule['value'] == 'woo-shop-page'){
		$post_id = !empty($options['post_id']) ? $options['post_id'] : null;
		$woo_shop_id = get_option( 'woocommerce_shop_page_id' );

		if($rule['operator'] == "=="){
			$match = $post_id == $woo_shop_id;
		}elseif($rule['operator'] == "!="){
			$match = $post_id != $woo_shop_id;
		}
	}

  return $match;
}