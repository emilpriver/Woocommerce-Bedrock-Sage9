/* eslint-disable */
(function ($) {

/**
 * Variables
 */
var colors = new Array();
var sizes = new Array();
var categoys = new Array();


// on Color change

$('.size-selector').click(function(){
  if($(this).data('active') == false){
    var value = $(this).data('size');
    sizes.push(value);
    $(this).attr('data-active', 'true');
    $(this).addClass('active');
  }else {
    var index = sizes.indexOf($(this).data('size'));
    if (index > -1) {
      sizes.splice(index, 1);
    }
    $(this).attr('data-active', 'false');
    $(this).removeClass('active');
  }
})

$('.color-selector').click(function(){
  if($(this).data('active') == false){
    var value = $(this).data('color');
    colors.push(value);
    $(this).attr('data-active', 'true');
    $(this).addClass('active');
  }else {
    var index = colors.indexOf($(this).data('color'));
    if (index > -1) {
      colors.splice(index, 1);
    }
    $(this).attr('data-active', 'false');
    $(this).removeClass('active');
  }
})

$('.cat-selector').click(function(){
  if($(this).data('active') == false){
    var value = $(this).data('cat');
    categoys.push(value);
    $(this).attr('data-active', 'true');
    $(this).addClass('active');
  }else {
    var index = categoys.indexOf($(this).data('cat'));
    if (index > -1) {
      categoys.splice(index, 1);
    }
    $(this).attr('data-active', 'false');
    $(this).removeClass('active');
  }
})

function load_products(reset,size,colors,categoys,offset){
  if(reset){
    $('#products').html('')
  }
}

})(jQuery);