<?php
/*
@package ganesh
Custom post type
*/
$contact = get_option( 'activate_contact' );

if( @$contact == 1 ){
	//add_theme_support('custom-post-type');
	add_action('init', 'ganesh_contact_custom_post_type');
	add_filter('manage_ganesh-contact_posts_columns', 'ganesh_set_ganesh_contact_columns');
	add_action('manage_ganesh-contact_posts_custom_column', 'ganesh_contact_custom_column', 10, 2);

	add_action('add_meta_boxes','ganesh_contact_add_meta_box');	
	add_action( 'save_post', 'ganesh_save_contact_email_data');
}

/* CONTACT CPT */
function ganesh_contact_custom_post_type(){
	$labels = array(
		'name' 			=> 'Messages',
		'singular_name' => 'Message',
		'menu_name' 	=> 'Messages',
		'name_admin_bar'=> 'Message'
		);
	$args = array(
		'labels' => $labels,
		'show_ui'=>true,
		'show_in_menu'=>true,
		'capability_type'=>'post',
		'hierarchical'=>false,
		'menu_position' => 26,
		'menu_icon' => 'dashicons-email-alt',
		'supports' => array('title', 'editor', 'author')
		);
	register_post_type('ganesh-contact', $args);
}

function ganesh_set_ganesh_contact_columns($columns){
	//unset($columns['author']); // remove author from messages list in admin panel
	$newColumns = array();
	$newColumns['title'] = 'Full Name';
	$newColumns['message'] = 'Message';
	$newColumns['email'] = 'Email';
	$newColumns['date'] = 'Date';
	return $newColumns;
}
function ganesh_contact_custom_column($column, $post_id){
	switch($column){
		case 'message':
			//message column
			echo get_the_excerpt();
			break;
		case 'email':
			//email column	
			$email = get_post_meta($post_id, '_contact_email_value_key', true);
			echo '<a href="mailto:'.$email.'">'.$email.'</a>';
			break;
		case 'date':
			//date column
			break;
	}
}

/* Contact Meta Boxes */
function ganesh_contact_add_meta_box(){
	add_meta_box('contact_email', 'User Email', 'ganesh_contact_email_callback', 'ganesh-contact', 'normal', 'high');	
}

function ganesh_contact_email_callback( $post ){
	wp_nonce_field('ganesh_save_contact_email_data', 'ganesh_contact_email_meta_box_nonce');

	$value = get_post_meta($post->ID, '_contact_email_value_key', true);
	echo '<label for="ganesh_contact_email_field">User Email Address</label>';
	echo '<input type="email" name="ganesh_contact_email_field" id="ganesh_contact_email_field" value="'. esc_attr($value) .'"  size="25" />';
}
function ganesh_save_contact_email_data( $post_id ){

	if( ! isset( $_POST['ganesh_contact_email_meta_box_nonce'] ) ){
		return;
	}
	
	if( ! wp_verify_nonce( $_POST['ganesh_contact_email_meta_box_nonce'], 'ganesh_save_contact_email_data') ) {
		return;
	}
	
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	}
	
	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	if( ! isset( $_POST['ganesh_contact_email_field'] ) ) {
		return;
	}
	
	$my_data = sanitize_text_field( $_POST['ganesh_contact_email_field'] );
	
	update_post_meta( $post_id, '_contact_email_value_key', $my_data );

}

