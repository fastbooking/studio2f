<?php
global $data;

$coords = explode(',', $data['hotel_coords']);

$lat = trim($coords[0]);
$lng = trim($coords[1]);

$mail = '<a href=mailto:'. $data['hotel_email'] .'>'.$data['hotel_email'].'</a>';

// infowindow content
$infowindow_title  = ($data['map_title']) ? $data['map_title'] : $data['hotel_name'];

$htmladdress = '<p><i class="fa fa-map-marker"></i>'.$data['hotel_address'].', '.$data['hotel_pc'].' '.$data['hotel_city'].' '.$data['hotel_country'].'</p><p><i class="fa fa-phone"></i>'.$data['hotel_phone'].'</p>';
$infowindow_desc  = $data['map_popup'];

$hotel_studio_img = '<img src="'.ROJAK_PARENT_URI.'/img/upload/home-post1.jpg" alt="'.$hotel_studio_name.'">';
// hotel marker
$hotel_info['html'] = '<div class="map-infowindow"><h4 class="map_title">'.$infowindow_title.'</h4>
                       <div class="row"><div class="col-md-6">'.$hotel_studio_img.'</div>
                         <div class="col-md-6">'.$infowindow_desc.'</div></div>
                       <div class="map-address"><a class="btn btn-red" href="'.$data['hotel_url'].'" target="_blank" title="'.__('Visit site',TEXT_DOMAIN).'">'.__('Visit site',TEXT_DOMAIN).'</a>'.$htmladdress.'</div>';
                       
$hotel_info['title']  = ($data['map_title']) ? $data['map_title'] : $data['hotel_name'];
$hotel_info['latitude']  = $lat;
$hotel_info['longitude']  = $lng;

// map config params
$gmap_config = array();
// map type
$gmap_config['maptype']=  ($data['map_type']) ? ($data['map_type']) : 'ROADMAP';
// zoom of the map
$gmap_config['zoom'] = (intval($data['map_zoom'])) ? intval($data['map_zoom']) : 14;
if($data['map_zoom_control'] === '1'){
  $map_control_styles = array( 0 => 'DEFAULT', 1 => 'SMALL', 2 => 'LARGE', 3 => 'Tm');
  $map_control_positions = array( 0 => 'NONE', 1 => 'TOP_LEFT', 2 => 'TOP_CENTER', 3 => 'TOP_RIGHT', 4 => 'LEFT_CENTER', 5 => 'LEFT_TOP', 6 => 'LEFT_BOTTOM', 7 => 'RIGHT_TOP', 8 => 'RIGHT_CENTER', 9 => 'RIGHT_BOTTOM', 10 => 'BOTTOM_LEFT', 11 => 'BOTTOM_CENTER', 12 => 'BOTTOM_RIGHT', 13 => 'CENTER');
  $zoom_style = $data['zoom_control_style'];
  $zoom_position = $data['zoom_control_position'];
  foreach ($map_control_styles as $k => $style){
    if ($style == $zoom_style){
      $zoom_style = $k;
      $gmap_config['controlsStyle']['zoom'] = strval($k);
    }
  }

  foreach ($map_control_positions as $k => $position){
    if ($position == $zoom_position){
      $zoom_style = $k;
      $gmap_config['controlsPositions']['zoom'] = strval($k);
    }
  }
}
// these settings have to be boolean
// type controls, satellite, map, etc
$gmap_config['mapTypeControl'] = ($data['map_type_control'] === '1') ? true : false;
// zoom controls
$gmap_config['zoomControl'] = ($data['map_zoom_control'] === '1') ? true : false;
// scroll with mousewheel
$gmap_config['scrollwheel'] = ($data['map_scroll_wheel'] === '1') ? true : false;
// streetview control
$gmap_config['streetViewControl'] = ($data['map_streetview_control'] === '1') ? true : false;

// streeeet view coords
$streetview_coords =  array();
$stcoords = explode(',', smart_rwmb_meta('street_view_coords', array(), $post->ID));
$streetview_coords['latitude']  = $stcoords[0];
$streetview_coords['longitude']  = $stcoords[1];

// map radius max_radius
$gmap_config['maxRadius']=  ($data['max_radius']) ? ($data['max_radius']) : '10000';
// map travel mode
$gmap_config['travel_mode']=  ($data['travel_mode']) ? ($data['travel_mode']) : 'DRIVING';

?>
<script type="text/javascript">
  var map_data = <?php echo json_encode($hotel_info); ?>;
  var map_config = <?php echo json_encode($gmap_config); ?>;
</script>
<section class="block">
    <div class="container">
        <h3 class="block-title">How to find us</h3>
        <div class="row">
            <div class="col-md-12"> 
                <div id="map-canvas" class="map-canvas js-map-canvas"></div>
            </div>
        </div>
    </div> 
</section>