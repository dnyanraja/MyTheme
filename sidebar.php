<?php /*
	
@package ganeshtheme
*/
if ( ! is_active_sidebar( 'ganesh-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	
	<?php dynamic_sidebar( 'ganesh-sidebar' ); ?>
	
</aside>