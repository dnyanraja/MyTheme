<?php
/*
@ganeshtheme
Content template for standard post
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header text-center">
		<?php the_title('<h1 class="entry-title"><a href="'. get_permalink() .'">', '</a></h1>'); ?></a>
	<div class="entry-meta">
		<?php echo ganesh_posted_meta(); ?>
	</div>
	</header>

	<div class="entry-content">
		<?php if( has_post_thumbnail() ): 
			$featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
		?>
			
			<a class="standard-featured-link" href="<?php the_permalink(); ?>">
				<div class="standard-featured background-image" style="background-image: url(<?php echo $featured_image; ?>);"></div>
			</a>
			
		<?php endif; ?>
		<div class="entry-excerpt"><?php the_excerpt();  ?>	</div>
		<div class="button-container">
			<a class="btn btn-default" href="<?php the_permalink(); ?>"><?php _e('Read More'); ?></a>
		</div>
	</div>
	<footer class="entry-footer">
		<?php echo ganesh_posted_footer(); ?>
	</footer>	
</article>