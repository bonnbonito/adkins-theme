<?php     
global $firmasite_content_blocks;
$header = get_sub_field("header");

$map_id = 'post' . $firmasite_content_blocks["real_source"] . '_' . $firmasite_content_blocks["block_id"] . '_map';
$map_id = str_replace("-", "_", $map_id);
?>
    <div id="block_id<?php echo $firmasite_content_blocks["block_id"];?>" class="content_blocks location_map_block">
    	<?php if(!empty($header) && !(isset($firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"]) && "row" != $firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"])){ ?>
        <h3 class="header"><?php echo $header; ?></h3>
        <?php } ?>
 <?php 
 global $firmasite_settings, $firmasite_base_settings;
 wp_enqueue_script('firmasite-gmap-api', 'http://maps.google.com/maps/api/js?sensor=true&language='. $firmasite_settings["site_language"] .'&region=' . $firmasite_settings["site_region"]);
 wp_enqueue_script('firmasite-gmaps', $firmasite_base_settings["base_url"] . 'assets/js/gmaps.min.js');
 ?>
 <div id="<?php echo $map_id;?>" class="fs-google-map"></div>
<script>
(function ($) {
	var <?php echo esc_js($map_id);?>;
 	var <?php echo esc_js($map_id);?>_markers = [
		<?php
		 $i = 1;
		 while(has_sub_field("add_marker", $firmasite_content_blocks["real_source"])):
			$coords = get_sub_field("location_map");
		 	$header = get_sub_field("header");
			if($coords) {
				preg_match('/class="(.*?)"/', $header, $icon);
				echo '['.$i.',';
				echo json_encode($header).",";
				echo $coords["lat"].",";
				echo $coords["lng"].",";
				echo json_encode(get_sub_field("location_desciption")).",";
				if (isset($icon[1])) echo json_encode( $icon[1] ); // first match from title
				echo "],";
				$i++;
			}
		 endwhile;
		 ?>
	];

    $(document).ready(function(){
		<?php echo $map_id;?> = new GMaps({
			div: '#<?php echo $map_id;?>',
			lat:  <?php echo $map_id;?>_markers[0][2],
			lng:  <?php echo $map_id;?>_markers[0][3],
			height: $("#<?php echo $map_id;?>").width()/2.4,
			width: '100%',
			zoomControl : true,
			zoomControlOpt: {
				style : 'SMALL',
				position: 'TOP_LEFT'
			},
			panControl: false,
			enableNewStyle: true,
			scrollwheel: false
		});
		$.each(<?php echo $map_id;?>_markers , function(i, val) {
			<?php
			/*
			red = new google.maps.Point(0, 0)
			darkred = new google.maps.Point(180, 0)
			orange = new google.maps.Point(36, 0)
			green = new google.maps.Point(72, 0)
			darkgreen = new google.maps.Point(252, 0)
			blue = new google.maps.Point(108, 0)
			darkblue = new google.maps.Point(216, 0)
			purple = new google.maps.Point(144, 0)
			darkpurple = new google.maps.Point(288, 0)
			cadetblue = new google.maps.Point(324, 0)
			*/?>			
			var icon = new google.maps.MarkerImage('<?php echo $firmasite_base_settings["base_url"] . 'assets/images/markers-matte.png';?>', new google.maps.Size(35, 46), new google.maps.Point(0, 0));
		 	if(val[1] || val[4]) {
			 <?php echo $map_id;?>.addMarker({
				lat: val[2],
				lng: val[3],
				/*title: val[1],*/
				icon: icon,
				infoWindow: {
				  content: '<h4>' + val[1] + '</h4>' + val[4]
				}
			  }); 
			} else {
			 <?php echo $map_id;?>.addMarker({
				lat: val[2],
				lng: val[3],
				icon: icon,
			  }); 
			}
			<?php echo $map_id;?>.drawOverlay({
				lat: val[2],
				lng: val[3],
				layer: 'floatPane',
				content: '<div class="fs-custom-mapicon"><i class="' + val[5] + '"></i></div>',
				verticalAlign: 'middle',
				horizontalAlign: 'center'
			  });	  
		});
		
   });
	
	function fs_<?php echo $map_id;?>_mapfix(){
		var $fs_<?php echo $map_id;?> = $("#<?php echo $map_id;?>");
		var fs_<?php echo $map_id;?>_height = $fs_<?php echo $map_id;?>.width()/2.4;
		$fs_<?php echo $map_id;?>.height(fs_<?php echo $map_id;?>_height);
		if ('undefined' !== typeof <?php echo $map_id;?>){
			<?php echo $map_id;?>.refresh();
			if (<?php echo $map_id;?>_markers.length > 1) {
				<?php echo $map_id;?>.fitZoom();
			} else {
				<?php echo $map_id;?>.setCenter(<?php echo $map_id;?>_markers[0][2], <?php echo $map_id;?>_markers[0][3]);
				// open first marker window
				if(visible_md() || visible_lg()) {
					google.maps.event.trigger(<?php echo $map_id;?>.markers[0], 'click');
				} else {
					<?php echo $map_id;?>.hideInfoWindows();
				}
				<?php echo $map_id;?>.setZoom(<?php echo $map_id;?>.map.getZoom() -1);// This is fix for hidden drawoverlay
				<?php echo $map_id;?>.setZoom(<?php echo $map_id;?>.map.getZoom() +1);// 
			}
		}
	}
	$(window).resize(throttle(function(){
		fs_<?php echo $map_id;?>_mapfix();
	},250));
})(jQuery);
</script>

</div>
