<?php
/**
 *
 * Template Name: Klinikken Page
 *
 */

// No direct access, please

if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-push-4">
				<div class="clinic">
						<h1 class="clinic__headline"><?php the_field('clinic__headline'); ?></h1>

						<div class="clinic__summary">
							<?php if( get_field('clinic__summary') ): ?>

								<p><?php the_field('clinic__summary'); ?></p>

							<?php endif; ?>
						</div>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="clinic__image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
							</div>
						<?php endif; ?>
						<div class="clinic__text">
							<p><?php the_field('clinic__text'); ?></p>
						</div>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>



