<section class="map">
  @php 
  $location = get_sub_field('map');
  @endphp
  @if( !empty($location) )
    <div class="acf-map" style="height:{{ !empty(get_sub_field('height')) ? get_sub_field('height') : 500 }}px;">
      <div class="marker" data-lat="{{ $location['lat'] }}" data-lng="{{ $location['lng'] }}">
          <h4>LeagueShop</h4>
          <p class="address">{{ $location['address'] }}</p>
      </div>
    </div>
  @endif
</section>