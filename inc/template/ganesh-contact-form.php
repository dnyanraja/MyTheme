<h1>Contact Form</h1>
<?php settings_errors(); ?>
<?php 
//	$picture = esc_attr(get_option('profile_picture'));
?>
<form method="post" action="options.php" class="ganesh-general-form">
<?php settings_fields('ganesh-contact-options'); ?>
<?php do_settings_sections('ganesh_contact'); ?>
<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>