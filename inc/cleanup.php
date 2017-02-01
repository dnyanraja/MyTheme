<?php
/*
@package ganeshtheme

=================================
Remove generator version number
==================================
*/
/* Remove version string from css and js files */
function ganesh_remove_wp_version_strings($src){
	global $wp_version;
	
	parse_str( parse_url($src, PHP_URL_QUERY), $query );
	
	if(!empty( $query['ver'] ) && $query['ver'] === $wp_version ){
		$src = remove_query_arg('ver', $src);
	}

	return $src;
}
add_filter('script_loader_src', 'ganesh_remove_wp_version_strings');
add_filter('style_loader_src', 'ganesh_remove_wp_version_strings');

/* remove metatag generator version from header */
function ganesh_remove_meta_version(){
	return '';
}
add_filter('the_generator', 'ganesh_remove_meta_version');