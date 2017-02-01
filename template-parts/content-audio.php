<?php
/*
@ganeshtheme
Content template for Audio Post
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('ganesh-format-audio'); ?>>
	<header class="entry-header">
		<?php the_title('<h1 class="entry-title"><a href="'. get_permalink() .'">', '</a></h1>'); ?></a>
			<div class="entry-meta">
		<?php echo ganesh_posted_meta(); ?>
	</div>
	</header>
	<div class="entry-content">
		<?php 
			echo ganesh_get_embed_media(array('audio', 'iframe'));
		 ?>
	</div>
	<footer class="entry-footer">
		<?php echo ganesh_posted_footer(); ?>
	</footer>	
</article>