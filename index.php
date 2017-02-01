<?php 
/*
@ganeshtheme

*/

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		<div class="container">
				<?php if(current_user_can('administrator')) :?>
			<div class="admin-quick-add">
				<h3>Quickly Add Post</h3>
				<input type="text" name="title" placeholder="Title" >
				<textarea name="content" placeholder="content"></textarea>
				<button id="quick-add-button">Create Post</button>
			</div>
		<?php endif; ?>
			<?php 
				if(have_posts()):
				
					while(have_posts()): the_post();

						get_template_part('template-parts/content', get_post_format());

					endwhile;

				endif;	
			?>
			<div id="moreposts" class="container"></div>
			<div style="text-align:center;margin-bottom:40px;"><button id="btnloadmore">Load More</button></div>
		</div><!--
		<div class="container text-center">
			<a class="btn btn-lg btn-default">Load More</a>
		</div>-->
	</main>
</div><!-- #primary-->

<?php get_footer(); ?>