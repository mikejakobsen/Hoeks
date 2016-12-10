<?php $options = get_option( THEME_OPTIONS ); ?>

<div class="sidebar col-lg-4 col-lg-pull-8">

	<h4 class="sidebar__heading"><?php esc_html_e( 'Klinikken', 'rto-theme' ); ?></h4>

	<?php
	wp_nav_menu( array(
			'menu'            => 'Primary',
			'theme_location'  => 'sidebar',
			'container'       => 'aside',
			'level'           => 2,
			'papa'            => 'Klinikken',
			'menu_class'      => 'sidebar__menu',
			'link_before'     => '<i class="fa fa-angle-right"></i> ',
			'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
			'walker'          => new wp_bootstrap_navwalker()
		)
	);
	?>

</div>


