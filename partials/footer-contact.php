<?php $options = get_option( THEME_OPTIONS ); ?>

<div class="col-xs-12 col-md-4">

	<h4><?php esc_html_e( 'Kontakt', 'rto-theme' ); ?></h4>

	<ul class="list-unstyled">

		<?php if ( ! empty( $options['contact_companyname'] ) ) : ?>
			<li class="contact__companyname"><?php echo esc_html( $options['contact_companyname'] ); ?></li>
		<?php endif; ?>
		<?php if ( ! empty( $options['contact_street'] ) ) : ?>
			<li><?php echo esc_html( $options['contact_street'] ); ?>, <?php echo esc_html( $options['contact_zip'] ); ?> <?php echo esc_html( $options['contact_city'] ); ?></li>
		<?php endif; ?>

		<?php if ( ! empty( $options['contact_phone'] ) ) : ?>
			<li>Telefon: <?php echo esc_html( $options['contact_phone'] ); ?></li>
		<?php endif; ?>

		<?php if ( ! empty( $options['contact_email'] ) ) : ?>
			<li>E-mail: <a href="mailto: <?php echo esc_html( $options['contact_email'] ); ?>"><?php echo esc_html( $options['contact_email'] ); ?></a></li>
		<?php endif; ?>

		<?php if ( ! empty( $options['contact_ydernummer'] ) ) : ?>
			<li>Ydernummer: <?php echo esc_html( $options['contact_ydernummer'] ); ?></li>
		<?php endif; ?>

		<?php if ( ! empty( $options['contact_cvr'] ) ) : ?>
			<li>CVR: <?php echo esc_html( $options['contact_cvr'] ); ?></li>
		<?php endif; ?>


	</ul>

</div>
