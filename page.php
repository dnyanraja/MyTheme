<?php /*
	
@package ganeshtheme
*/
get_header(); ?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<div class="container">
				<div class="col-md-8 col-xs-12">
				<?php 
					
					if( have_posts() ):
						
						while( have_posts() ): the_post();
							get_template_part( 'template-parts/content', 'page' );
						
						endwhile;
						
					endif;
                
				?>
			</div>
			<div id="sidebar" class="col-md-4 col-xs-12">
					<?php get_sidebar('ganesh-sidebar');?>
			</div>
				
			</div><!-- .container -->
			
		</main>
	</div><!-- #primary -->
	
<?php get_footer(); ?>