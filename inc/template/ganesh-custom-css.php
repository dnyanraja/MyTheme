<h1>Custom CSS</h1>
<?php settings_errors(); ?>
<?php 
//	$picture = esc_attr(get_option('profile_picture'));
?>
<form id="save-custom-css-form" method="post" action="options.php" class="ganesh-general-form">
<?php settings_fields('ganesh-custom-css-options'); ?>
<?php do_settings_sections('ganesh_slug_css'); ?>
<?php submit_button('Save Changes'); ?>
</form>