<?php $options = get_option( THEME_OPTIONS ); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body>

<nav class="navbar navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
			        aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo bloginfo( 'url' ); ?>"><img alt="<?php bloginfo('name'); ?>" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/logo.png" /></a>
		</div>
		<?php
		wp_nav_menu( array(
				'menu'            => 'primary',
				'theme_location'  => 'primary',
				'depth'           => 2,
				'container'       => 'div',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'navbar',
				'menu_class'      => 'nav navbar-nav navbar-right',
				'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
				'walker'          => new wp_bootstrap_navwalker()
			)
		);
		?>
	</div>
</nav>

