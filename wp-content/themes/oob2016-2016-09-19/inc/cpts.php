<?php
function cpt_loader(){
	$cpts_path = get_stylesheet_directory().'/inc/cpts/';
	if ( is_dir( $cpts_path ) ) {
		$cpt_paths = glob($cpts_path."*.{php}", GLOB_BRACE);
		if( !empty($cpt_paths) ){
			foreach( $cpt_paths as $cpt_path ) {
				include($cpt_path);
			}
		}
	}
}
cpt_loader();
?>