/* eslint-disable */
$(document).on('click', '.mini_cart_item a.remove-product-item', function (e)
{

  console.log(1)
  e.preventDefault();

  var 
    product_id = $(this).attr("data-product_id"),
    cart_item_key = $(this).attr("data-cart_item_key"),
    product_container = $(this).parents('.mini_cart_item');

  // Add loader
  product_container.block({
    message: null,
    overlayCSS: {
      cursor: 'none'
    }
  });

  $.ajax({
    type: 'POST',
    url: wc_add_to_cart_params.ajax_url,
    data: {
      action: "product_remove",
      product_id: product_id,
      cart_item_key: cart_item_key
    },
    success: function(response) {
      $('#mini-cart-container').html(response);
    }
  });
});