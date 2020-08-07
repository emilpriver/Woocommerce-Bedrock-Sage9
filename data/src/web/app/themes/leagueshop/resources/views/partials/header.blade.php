<header id="header-menu" class="">
  <div class="col logo float-left clearfix w-4/5 xl:w-3/12">
    {{ the_custom_logo() }}
  </div>
  <div class="col w-1/5 handle flex xl:hidden">
    <div class="hamburger handle-btn hamburger--spin">
        <div class="hamburger-box">
          <div class="hamburger-inner"></div>
        </div>
      </div>
  </div>
  <div class="col menu-handle w-full xl:w-9/12 float-left clearfix">
    @php  
    wp_nav_menu( 
      array( 
        'theme_location' => 'main-menu', 
        'container_class' => 'main-menu' 
      ) 
    ); 
    @endphp
    <div class="extra-menu">
      <ul class="flex items-center justify-start xl:justify-end">
        <li>
          <span id="search-btn">
            <box-icon name='search-alt' size='sm' ></box-icon>
          </span>
        </li>
        <li>
          <span>
            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
              <box-icon name='user' ></box-icon>
            </a>
          </span>
        </li>
        <li>
          <span class="open-mini-cart">
            <box-icon name='cart'></box-icon>
          </span>
        </li>
      </ul>
    </div>
  </div>
  <div id="search-row">
    <div class="wrapper">
      <form role="search" method="get" class="search-form" action="{{ bloginfo('url') }}">
        <input type="search" class="search-field" placeholder="Search the entire collection..." value="" name="s">
        <button type="submit">
          <box-icon name='search-alt' ></box-icon>
        </button>
      </form>
    </div>
  </div>
</header>

<div class="mini-cart-overlay"></div>

<div class="mini-cart" id="mini-cart">
  <div class="close-mini-cart">
    <box-icon name='x' size='md'></box-icon>
  </div>
  <div class="wrapper" id="mini-cart-container">
    <svg width="70px"  height="70px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ripple" style="background: none;">
      <circle cx="50" cy="50" r="22.3211" fill="none" ng-attr-stroke="1" ng-attr-stroke-width="1" stroke="#000000" stroke-width="3">
        <animate attributeName="r" calcMode="spline" values="0;40" keyTimes="0;1" dur="2.7" keySplines="0 0.2 0.8 1" begin="-1.35s" repeatCount="indefinite"></animate>
        <animate attributeName="opacity" calcMode="spline" values="1;0" keyTimes="0;1" dur="2.7" keySplines="0.2 0 0.8 1" begin="-1.35s" repeatCount="indefinite"></animate>
      </circle>
      <circle cx="50" cy="50" r="38.7721" fill="none" ng-attr-stroke="1" ng-attr-stroke-width="1" stroke="#716d68" stroke-width="3">
        <animate attributeName="r" calcMode="spline" values="0;40" keyTimes="0;1" dur="2.7" keySplines="0 0.2 0.8 1" begin="0s" repeatCount="indefinite"></animate>
        <animate attributeName="opacity" calcMode="spline" values="1;0" keyTimes="0;1" dur="2.7" keySplines="0.2 0 0.8 1" begin="0s" repeatCount="indefinite"></animate>
      </circle>
    </svg>
  </div>
</div>