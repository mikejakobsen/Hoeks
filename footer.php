<?php $options = get_option( THEME_OPTIONS ); ?>

<footer>
	<div class="container">
		<div class="row">

			<?php get_template_part('partials/footer', 'contact'); ?>

			<?php get_template_part('partials/footer', 'openinghours'); ?>

			<?php get_template_part('partials/footer', 'cta'); ?>

		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
