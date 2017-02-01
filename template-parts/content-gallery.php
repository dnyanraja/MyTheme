<?php
/*
@ganeshtheme
Content template for standard post
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('ganesh-format-gallery'); ?>>
	<header class="entry-header text-center">
		<?php if(ganesh_get_attachment()):
				//var_dump($attachments);
			//endif; ?>
			<div id="post-gallery-<?php the_ID(); ?>" class="carousel slide ganesh-carousel-thumb" data-ride="carousel">
				<div class="carousel-inner" role="listbox">
					<?php 
						
						$attachments = ganesh_get_bs_slides( ganesh_get_attachment(7) );
						foreach( $attachments as $attachment ):
					?>					
						<div class="item<?php echo $attachment['class']; ?> background-image standard-featured" style="background-image: url( <?php echo $attachment['url']; ?> );">							
							<div class="hide next-image-preview" data-image="<?php echo $attachment['next_img']; ?>"></div>
							<div class="hide prev-image-preview" data-image="<?php echo $attachment['prev_img']; ?>"></div>							
							<div class="entry-excerpt image-caption">
								<p><?php echo $attachment['caption']; ?></p>
							</div>							
						</div>					
					<?php endforeach; ?>
				</div>
				<a class="left carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="prev">
					<div class="table">
						<div class="table-cell">
							<div class="preview-container">
							<span class="thumbnail-container background-image"></span>
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
							</div>
						</div>
					</div>
				</a>
				<a class="right carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="next">
					<div class="table">
						<div class="table-cell">
							<div class="preview-container">
							<span class="thumbnail-container background-image"></span>
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php 
			endif;
			the_title('<h1 class="entry-title"><a href="'. get_permalink() .'">', '</a></h1>'); ?>
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