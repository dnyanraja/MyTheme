<?php 
/*********************************************
	@package ganeshtheme
	Admin page
*********************************************/
function ganesh_add_admin_page_1(){	
	//Generate Theme Option -  Admin page
	add_menu_page('Ganesh Theme Option', 'Ganesh Theme Options', 'manage_options', 'ganesh_slug', 'ganesh_theme_create_page', get_template_directory_uri().'/images/sunset-icon.png', 80);

	//Ganerate Theme Option - Admin subpages
	add_submenu_page('ganesh_slug', 'Ganesh Theme Option', 'General', 'manage_options', 'ganesh_slug', 'ganesh_theme_create_page');
	add_submenu_page('ganesh_slug', 'Ganesh Theme Options ', 'Theme Options', 'manage_options', 'ganesh_theme_support', 'ganesh_theme_support_page');
	add_submenu_page('ganesh_slug', 'Ganesh Contact Form ', 'Contact Form', 'manage_options', 'ganesh_contact', 'ganesh_theme_contact_page');
	add_submenu_page('ganesh_slug', 'Ganesh CSS Options', 'Custom CSS', 'manage_options', 'ganesh_slug_css', 'ganesh_theme_customcss_page');
}
add_action('admin_menu', 'ganesh_add_admin_page_1');
//template submenu function
function ganesh_theme_create_page(){
	require_once(get_template_directory().'/inc/template/ganesh-admin.php'); //Generation of admin page for General menu
}
function ganesh_theme_contact_page(){
	require_once(get_template_directory().'/inc/template/ganesh-contact-form.php'); //Generation of admin page for Contact Form
}
function ganesh_theme_support_page(){ 
	require_once(get_template_directory().'/inc/template/ganesh-theme-support.php'); //Generation of admin page for Theme support
}
function ganesh_theme_customcss_page(){
	require_once(get_template_directory().'/inc/template/ganesh-custom-css.php'); //Generation of admin page for Theme support
}
//Activate custom settings
add_action('admin_init', 'ganesh_custom_settings');
function ganesh_custom_settings(){
	//General page
	register_setting('ganesh-settings-group', 'profile_picture');
	register_setting('ganesh-settings-group', 'first_name');
	register_setting('ganesh-settings-group', 'last_name');
	register_setting('ganesh-settings-group', 'user_description');
	register_setting('ganesh-settings-group', 'twitter_handler', 'ganesh_sanitize_twitter_handler');
	register_setting('ganesh-settings-group', 'facebook_handler');

	add_settings_section('ganesh-sidebar-options', 'Sidebar Option', 'ganesh_sidebar_options', 'ganesh_slug');

	add_settings_field('sidebar-profilepic', 'Profile Picture','ganesh_sidebar_profile', 'ganesh_slug', 'ganesh-sidebar-options');
	add_settings_field('sidebar-name', 'Full Name','ganesh_sidebar_name', 'ganesh_slug', 'ganesh-sidebar-options');
	add_settings_field('sidebar-userdesc', 'User Description','ganesh_sidebar_userdesc', 'ganesh_slug', 'ganesh-sidebar-options');
	add_settings_field('sidebar-twitter', 'Twitter Handler','ganesh_sidebar_twitter', 'ganesh_slug', 'ganesh-sidebar-options');
	add_settings_field('sidebar-facebook', 'Facebook Handler','ganesh_sidebar_facebook', 'ganesh_slug', 'ganesh-sidebar-options');	

	//Theme Support options (Theme Option page)
	register_setting('ganesh-theme-support', 'post_formats');
	register_setting( 'ganesh-theme-support', 'custom_header' );
	register_setting( 'ganesh-theme-support', 'custom_background' );
	
	add_settings_section('ganesh-theme-options', 'Theme Options', 'ganesh_theme_options', 'ganesh_theme_support');

	add_settings_field('post-formats', 'Post Formats', 'ganesh_post_formats', 'ganesh_theme_support', 'ganesh-theme-options');
	add_settings_field( 'custom-header', 'Custom Header', 'ganesh_custom_header', 'ganesh_theme_support', 'ganesh-theme-options' );
	add_settings_field( 'custom-background', 'Custom Background', 'ganesh_custom_background', 'ganesh_theme_support', 'ganesh-theme-options' );

	//Contact Form
	register_setting('ganesh-contact-options', 'activate_contact');
	add_settings_section('ganesh-contact-section', 'Contact Form', 'ganesh_contact_section', 'ganesh_contact');
	add_settings_field('activate-form', 'Activate Contact Form', 'ganesh_activate_contact', 'ganesh_contact', 'ganesh-contact-section');

	//Custom CSS Options
	register_setting('ganesh-custom-css-options', 'ganesh_css', 'ganesh_sanitize_customcss');
	add_settings_section('ganesh-custom-css-section', 'Custom CSS', 'ganesh_custom_css_section_callback', 'ganesh_slug_css');
	add_settings_field('custom-css', 'Insert your custom css', 'ganesh_custom_css_callback', 'ganesh_slug_css', 'ganesh-custom-css-section');
}

function ganesh_sidebar_options(){ 	echo 'Customize Your sidebar settings'; }
function ganesh_contact_section(){	echo 'Activate and Deactivate theme support options';	}
function ganesh_theme_options()	 {	echo 'Activate and Deactivate contact form'; }
function ganesh_custom_css_section_callback(){	echo 'Insert your custom css to override theme styling'; }

function ganesh_custom_css_callback(){
	$customcss = get_option( 'ganesh_css' );
	$customcss = ( empty($customcss)? '/* Ganesh Theme Custom CSS */' : $customcss );
	echo '<div id="ganeshcss">'.$customcss.'</div><textarea id="ganesh_css" name="ganesh_css" style="display:none;visibility:hidden;">'. $customcss .'</textarea>';
}
function ganesh_sanitize_customcss($input){
	$output = esc_textarea($input);
	return $output;
}
function ganesh_activate_contact(){
	$options = get_option( 'activate_contact' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="activate_contact" value="1" '.$checked.' /> </label>';
}
function ganesh_post_formats(){
	$options = get_option('post_formats');
	$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
	$output  = '';
	foreach ( $formats as $format ){
		$checked = ( @$options[$format] == 1 ? 'checked' : '' );
		$output .= '<label><input type="checkbox" id="'. $format .'" name="post_formats['. $format .']" value="1" '. $checked .' />'. $format .'</label><br/>';
	}
	echo $output;
}
function ganesh_custom_header() {
	$options = get_option( 'custom_header' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';
}
function ganesh_custom_background() {
	$options = get_option( 'custom_background' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';
}
function ganesh_sidebar_profile(){
	$profilepic = esc_attr(get_option('profile_picture'));
	if(empty($profilepic)){
			echo '<input type="button" class="button button-secondary"  value="Upload Profile Picture" 
	id="upload-button" /><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
	}else{
			echo '<input type="button" class="button button-secondary"  value="Replace Profile Picture" 
	id="upload-button" /><input type="hidden" id="profile-picture" name="profile_picture" value="'.$profilepic.'" /><input type="button" class="button button-secondary"  value="Remove" 
	id="remove-picture" >';
	}
}
function ganesh_sidebar_userdesc(){
	$userDesc = esc_attr(get_option('user_description'));
	echo '<input type="text" name="user_description" value="'.$userDesc.'" />';
}
function ganesh_sidebar_name(){
	$firstName = esc_attr(get_option('first_name'));
	$lastName = esc_attr(get_option('last_name'));
	echo '<input type="text" name="first_name" value="'.$firstName.'" />
	<input type="text" name="last_name" value="'.$lastName.'" />';
}
function ganesh_sidebar_twitter(){
	$twitter = esc_attr(get_option('twitter_handler'));
	echo '<input type="text" name="twitter_handler" value="'.$twitter.'" /><p class="description">Input your twitter username without @ character</p>';
}
//Sanitization settings
function ganesh_sanitize_twitter_handler( $input ){
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);
	return $output;
}
function ganesh_sidebar_facebook(){
	$facebook = esc_attr(get_option('facebook_handler'));
	echo '<input type="text" name="facebook_handler" value="'.$facebook.'" />';	
}
?>