<h1>Ganesh Theme Support</h1>
<?php settings_errors(); ?>
<?php 
	//$picture = esc_attr(get_option('profile_picture'));

?>

<form method="post" action="options.php" class="ganesh-general-form">
<?php settings_fields('ganesh-theme-support'); ?>
<?php do_settings_sections('ganesh_theme_support'); ?>
<?php submit_button(); ?>
</form>