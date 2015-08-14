<?php
/**
 * @package firmasite
 */
global $firmasite_settings;

get_header();
 ?>

		<div id="primary" class="content-area clearfix col-md-5">
			
			<?php do_action( 'open_content' ); ?>
            <?php do_action( 'open_page' ); ?>

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'templates/no-results', 'index' ); ?>

			<?php endif; ?>

            <?php do_action( 'close_page' ); ?>
            
			
		</div><!-- #primary .content-area -->
		<div id="home-right" class="col-md-7">
			<div class="home-slider">
				<?php layerslider(1) ?>				
			</div>
		</div>


<?php get_footer(); ?>