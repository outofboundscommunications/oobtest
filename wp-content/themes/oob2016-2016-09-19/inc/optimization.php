<?php
// Remove query string from static files
function remove_cssjs_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );

function remove_cssjs_v( $src ) {
	if( strpos( $src, '?v=' ) )
		$src = remove_query_arg( 'v', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_v', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_v', 10, 2 );

// Page speed fix
function defer_parsing_of_js ( $url ) {
	
	// Return if admin-panel
	if ( is_admin() ) return $url;
	
	// Return if not javascript
	if ( FALSE === strpos( $url, '.js' ) ) return $url;
	
	// Return if jQuery
	if ( strpos( $url, 'jquery.js' ) ) return $url;
	// if ( strpos( $url, 'jquery.themepunch.revolution.min.js' ) ) return $url;
	// if ( strpos( $url, 'bootstrap.min.js' ) ) return $url;
	// if ( strpos( $url, 'common.min.js' ) ) return $url;
	// if ( strpos( $url, 'jquery.slicknav.min.js' ) ) return $url;
	// if ( strpos( $url, 'superfish.min.js' ) ) return $url;
	// if ( strpos( $url, 'jquery-migrate.min.js' ) ) return $url;
	// if ( strpos( $url, 'modernizr.min.js' ) ) return $url;
	if ( strpos( $url, 'css3-mediaqueries.min.js' ) ) return $url;
		// if ( strpos( $url, 'jquery.prettyPhoto.min.js' ) ) return $url;
		// if ( strpos( $url, 'owl.carousel.min.js' ) ) return $url;
		// if ( strpos( $url, 'jquery.matchHeight-min.js' ) ) return $url;
		// if ( strpos( $url, 'jquery.uniform.min.js' ) ) return $url;
		// if ( strpos( $url, 'comment-reply.min.js' ) ) return $url;
		// if ( strpos( $url, 'jquery.bxslider.js' ) ) return $url;
		// if ( strpos( $url, 'navigation.js' ) ) return $url;
			// if ( strpos( $url, 'http://www.seetheclarity.com' ) ) return $url;
	
	// Return
	// Must be a ', not "!
	// return "$url' defer ";
	return "$url' defer='defer";
}
add_filter( 'clean_url', 'defer_parsing_of_js', 50, 1 );