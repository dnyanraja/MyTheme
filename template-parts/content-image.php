<?php
/*
	
@package ganeshtheme
--Image post Format
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('ganesh-format-image'); ?>>
	
	<?php $featured_image = ganesh_get_attachment();	?>	

	<header class="entry-header text-center background-image" style="background-image:url(<?php echo $featured_image; ?>);">
		<?php the_title('<h1 class="entry-title"><a href="'. get_permalink() .'">', '</a></h1>'); ?></a>
		<div class="entry-meta"><?php ganesh_posted_meta(); ?></div>
	</header>
	
	<div class="entry-content ">
		<div class="entry-excerpt image-caption"><?php the_excerpt();  ?>	</div>
	</div>
	
	<footer class="entry-footer">
		<?php ganesh_posted_footer(); ?>
	</footer>	
</article>