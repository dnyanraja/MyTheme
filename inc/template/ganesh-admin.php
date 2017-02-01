<h1>Theme Option</h1>
<?php settings_errors(); ?>
<?php 
	$picture = esc_attr(get_option('profile_picture'));
	$firstName = esc_attr(get_option('first_name'));
	$lastName = esc_attr(get_option('last_name'));
	$fullName= $firstName.' '.$lastName;
	$userDesc = esc_attr(get_option('user_description'));
?>
<div class="ganesh-sidebar-preview">
	<div class="ganesh-sidebar">
		<div class="image-container">
			<div id="profile-picture-preview" class="profile-picture" style="background-image:url(<?php print $picture; ?>);">				
			</div>
		</div>
		<h1 class="ganesh-username"><?php print($fullName); ?></h1>
		<h2 class="ganesh-description"><?php print($userDesc); ?></h2>
		<div class="icons-wrapper"></div>
	</div>
</div>
<form method="post" action="options.php" class="ganesh-general-form">
<?php settings_fields('ganesh-settings-group'); ?>
<?php do_settings_sections('ganesh_slug'); ?>
<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>