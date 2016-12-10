<?php $options = get_option( THEME_OPTIONS ); ?>

<div class="col-xs-12 col-md-3 ">

	<div class="open">
		<h4><?php esc_html_e( 'Åbningstider', 'rto-theme' ); ?></h4>

		<ul class="open__list">

			<?php if ( ! empty( $options['open_monday'] ) ) : ?>
				<li><span class="open__title">Mandag: </span><span class="open__hours">kl <?php echo esc_html( $options['open_monday'] ); ?></span></li>
			<?php endif; ?>
			<?php if ( ! empty( $options['open_tuesday'] ) ) : ?>
				<li> <span class="open__title">Tirsdag: </span><span class="open__hours">kl <?php echo esc_html( $options['open_tuesday'] ); ?></span></li>
			<?php endif; ?>
			<?php if ( ! empty( $options['open_wednesday'] ) ) : ?>
				<li> <span class="open__title">Onsdag: </span><span class="open__hours">kl <?php echo esc_html( $options['open_wednesday'] ); ?></span></li>
			<?php endif; ?>
			<?php if ( ! empty( $options['open_thursday'] ) ) : ?>
				<li> <span class="open__title">Torsdag: </span><span class="open__hours">kl <?php echo esc_html( $options['open_thursday'] ); ?></span></li>
			<?php endif; ?>
			<?php if ( ! empty( $options['open_friday'] ) ) : ?>
				<li> <span class="open__title">Fredag: </span><span class="open__hours">kl <?php echo esc_html( $options['open_friday'] ); ?></span></li>
			<?php endif; ?>

		</ul>

	</div>
</div>
