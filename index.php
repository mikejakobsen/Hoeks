<?php get_header(); ?>

	<div class="container">
		<div class="row">

			<div class="col-xs-12">
				<?php the_field('frontpage'); ?>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h3><?php the_title(); ?></h3>
					<?php the_content(); ?>
				<?php endwhile; endif; ?>
			</div>


		</div>
	</div>

<?php get_footer(); ?>
