<?php 
/*********************************************
	@package ganeshtheme
	Enqueue Functions
**********************************************/
function ganesh_load_admin_scripts($hook){
	//echo $hook;
	if('toplevel_page_ganesh_slug' == $hook){

	wp_register_style('ganesh_admin', get_template_directory_uri().'/css/ganesh_admin.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('ganesh_admin');
	wp_enqueue_media();

	wp_register_script('ganesh_admin_script', get_template_directory_uri().'/js/ganesh_admin.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('ganesh_admin_script');
	}else if('ganesh-theme-options_page_ganesh_slug_css'== $hook){
		wp_enqueue_style('ace',  get_template_directory_uri().'/css/ganesh.ace.css', array(), '1.0.0', 'all');
		wp_enqueue_script('ace',  get_template_directory_uri().'/js/ace/ace.js', array('jquery'), '1.2.2', true);
		wp_enqueue_script('ganesh-custom-css',  get_template_directory_uri().'/js/ganesh_custom_css.js', array('jquery'), '1.0.0', true);
	}
	else{ return;	}
}
add_action('admin_enqueue_scripts', 'ganesh_load_admin_scripts');
/*
=================================
	Font-End Enqueue Functions
=================================
*/
function ganesh_load_scripts(){
		wp_enqueue_style('bootstrap',  get_template_directory_uri().'/css/bootstrap.min.css', array(), '3.3.7', 'all');
		wp_enqueue_style('ganeth',  get_template_directory_uri().'/css/ganesh.css', array(), '1.0.0', 'all');		
		wp_enqueue_style('raleway',  'https://fonts.googleapis.com/css?family=Raleway');			
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri().'/js/jquery-3.1.1.min.js', array(), '3.1.1', true);
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap',  get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), '3.3.7', true);
		wp_enqueue_script('ganesh',  get_template_directory_uri().'/js/ganesh.js', array('jquery'), '1.0.0', true);

		wp_localize_script('ganesh', 'magicaldata', array(
			'nonce' => wp_create_nonce('wp_rest'),
			'siteurl' => get_site_url()			
			));
	}
add_action('wp_enqueue_scripts', 'ganesh_load_scripts');
?>