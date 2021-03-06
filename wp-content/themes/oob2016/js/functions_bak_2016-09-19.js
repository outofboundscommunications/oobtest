jQuery(document).ready(function($) {
	/*------------------------------------------------------------------------
		Primary Menu
	------------------------------------------------------------------------*/
	$('#primary_menu_source').slicknav({
		label: '',
		prependTo:'#primary_menu',
		closedSymbol: "&#43;",
		openedSymbol: "&#45;",
		allowParentLinks:true,
	});
	
	
	/*------------------------------------------------------------------------
		Match Height
	------------------------------------------------------------------------*/
	 $('.section-type-our_thinking_a .our-thinking-title').matchHeight();
	 $('.section-type-our_thinking_a .our-thinking-content').matchHeight();
	$('body.page-template-case-studies article.page-section-ptb .entry-content .row div.case-study-content-block').matchHeight();
	
	/*
	*  new_map
	*
	*  This function will render a Google Map onto the selected jQuery element
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$el (jQuery element)
	*  @return	n/a
	*/

	function new_map( $el ) {
		
		// var
		var $markers = $el.find('.marker');
		
		
		// vars
		var args = {
			zoom		: 16,
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP,
			draggable: false,
			scrollwheel: false,
			navigationControl: false,
			mapTypeControl: false,
			scaleControl: false,
		};
		
		
		// create map	        	
		var map = new google.maps.Map( $el[0], args);
		
		var styles = [{"stylers":[{"color":"#"},{"hue":"#0022ff"},{"saturation":-100},{"lightness":60},{"gamma":0.5},]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#"},{"hue":"#"},{"lightness":57},]}];			
		map.setOptions({styles: styles});
		
		// add a markers reference
		map.markers = [];
		
		
		// add markers
		$markers.each(function(){
			
			add_marker( $(this), map );
			
		});
		
		
		// center map
		center_map( map );
		
		
		// return
		return map;
		
	}

	/*
	*  add_marker
	*
	*  This function will add a marker to the selected Google Map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$marker (jQuery element)
	*  @param	map (Google Map object)
	*  @return	n/a
	*/

	function add_marker( $marker, map ) {

		// var
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map,
			icon: 'http://potenzawp.ga/oobc/wp-content/themes/oob2016/images/map-marker.png'
		});

		// add to array
		map.markers.push( marker );

		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() )
		{
			// create info window
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});

			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {

				infowindow.open( map, marker );

			});
		}

	}

	/*
	*  center_map
	*
	*  This function will center the map, showing all markers attached to this map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	map (Google Map object)
	*  @return	n/a
	*/

	function center_map( map ) {

		// vars
		var bounds = new google.maps.LatLngBounds();

		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){

			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

			bounds.extend( latlng );

		});

		// only 1 marker?
		if( map.markers.length == 1 )
		{
			// set center of map
			map.setCenter( bounds.getCenter() );
			map.setZoom( 16 );
		}
		else
		{
			// fit to bounds
			map.fitBounds( bounds );
		}

	}

	/*
	*  document ready
	*
	*  This function will render each map when the document is ready (page has loaded)
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	// global var
	var map = null;

	$('.acf-map').each(function(){
		// create map
		map = new_map( $(this) );
	});

	jQuery('.news_latter_mailchimp').click(function(){
		var form_id           = jQuery(this).attr('data-form-id');
		var news_letter_email = jQuery('form#'+form_id+' .news_letter_email').val();
		
		jQuery('form#'+form_id+' .newslatter_msg').html('').removeClass('success_msg').removeClass('error_msg');
		
		jQuery.ajax({
			url: ajaxurl,
			type : 'post',
			data:'action=mailchimp_singup&news_letter_email='+news_letter_email,
			// data:'',
			success: function(msg){
				jQuery('form#'+form_id+' .newslatter_msg').show();
				jQuery('form#'+form_id+' .newslatter_msg').addClass('success_msg');
				jQuery('form#'+form_id+' .newslatter_msg').html(msg);
				
				jQuery('#process').css('display','none');
				
				jQuery('form#'+form_id+' .news_letter_name').val('');
				jQuery('form#'+form_id+' .news_letter_email').val('');
			},
			error: function(msg){
				jQuery('form#'+form_id+' .newslatter_msg').addClass('error_msg');
				jQuery('form#'+form_id+' .newslatter_msg').html(msg);
				jQuery('form#'+form_id+' .newslatter_msg').show();
				jQuery('#process').css('display','none');
			}
		});
		return false;
	});
});