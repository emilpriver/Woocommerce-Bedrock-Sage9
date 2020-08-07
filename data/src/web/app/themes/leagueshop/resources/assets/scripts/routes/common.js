import 'slick-carousel';

export default {
  init() {
    /**
     * Header menu
     */
    $('#search-btn').click(function() {
      $('#search-row').toggleClass('open')
    })
    $('.handle-btn').click(() => {
      $('.menu-handle').toggleClass('open');
      $('.handle-btn').toggleClass('is-active');
    })

    /**
     * Mini cart toggl open
     */
    $('.open-mini-cart').click(function() {
      $('.mini-cart-overlay').fadeIn('fast')
      $('.mini-cart').addClass('open')
    })

    $('.open-mini-cart').click(function(e){
      e.preventDefault();
      $.ajax({
        url: woocommerce_params.ajax_url, // eslint-disable-line
        type: 'post',
        data: {
          'action': 'ajax_update_mini_cart',
        },
        beforeSend: function(){
          $('#mini-cart-container').html('<svg width="70px"  height="70px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ripple" style="background: none;"><circle cx="50" cy="50" r="22.3211" fill="none" ng-attr-stroke="{{config.c1}}" ng-attr-stroke-width="{{config.width}}" stroke="#000000" stroke-width="3"><animate attributeName="r" calcMode="spline" values="0;40" keyTimes="0;1" dur="2.7" keySplines="0 0.2 0.8 1" begin="-1.35s" repeatCount="indefinite"></animate><animate attributeName="opacity" calcMode="spline" values="1;0" keyTimes="0;1" dur="2.7" keySplines="0.2 0 0.8 1" begin="-1.35s" repeatCount="indefinite"></animate></circle><circle cx="50" cy="50" r="38.7721" fill="none" ng-attr-stroke="{{config.c2}}" ng-attr-stroke-width="{{config.width}}" stroke="#716d68" stroke-width="3"><animate attributeName="r" calcMode="spline" values="0;40" keyTimes="0;1" dur="2.7" keySplines="0 0.2 0.8 1" begin="0s" repeatCount="indefinite"></animate><animate attributeName="opacity" calcMode="spline" values="1;0" keyTimes="0;1" dur="2.7" keySplines="0.2 0 0.8 1" begin="0s" repeatCount="indefinite"></animate></circle></svg>');
        },
        success: function( response ) {
          $('#mini-cart-container').html(response);
        },
      });
    });

    /**
     * Mini cart toggl disable
     */
    $('.close-mini-cart').click(function() {
      $('.mini-cart-overlay').fadeOut('fast')
      $('.mini-cart').removeClass('open')
    })

    /**
     * Related products carousell
     */

    $('.related-products-loop').each(function(index) {
      $(this)
        .parent()
        .find('.arrow')
        .attr('data-index-related', index);
        $(this)
        .parent()
        .find('.dots')
        .attr('data-index-related', index);
        $(this).attr('data-index-related', index);
    
        $(this).slick({
        dots: true,
        appendDots: $('.dots[data-index-related="' + index + '"]'),
        loop: false,
        arrows: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        prevArrow: $('.arrow.prev[data-index-related="' + index + '"]'),
        nextArrow: $('.arrow.next[data-index-related="' + index + '"]'),
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 800,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      });
    });

    /**
     * FAQ
     */
    $('.questions-item-heading').click((e) => {
      $(e.target).parent().parent().toggleClass('active')
    })

    /**
     * Full Width slider
     */
    $('.full-width-slider-blocks').each(function(index) {
      $(this)
        .parent()
        .find('.arrow')
        .attr('data-index-full-width-slider', index);
        $(this)
        .parent()
        .find('.dots')
        .attr('data-index-full-width-slider', index);
        $(this).attr('data-index-full-width-slider', index);
    
        $(this).slick({
          dots: true,
          infinite: true,
          speed: 300,
          autoplay: true,
          slidesToShow: 1,
          adaptiveHeight: true,
          appendDots: $('.dots[data-index-full-width-slider="' + index + '"]'),
          prevArrow: $('.arrow.prev[data-index-full-width-slider="' + index + '"]'),
          nextArrow: $('.arrow.next[data-index-full-width-slider="' + index + '"]'),
      });
    });

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
