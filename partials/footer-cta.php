<?php $options = get_option( THEME_OPTIONS ); ?>

<div class="col-xs-12 col-md-4 col-md-offset-1">

	<h4><?php esc_html_e( 'Bestil tid', 'rto-theme' ); ?></h4>

<p>Tidsbestilling til undersøgelse og behandling foregår via telefon eller e-mail Ortoklinik har telefontid på alle hverdage fra kl 9.00 til kl 10.30.</p>

<p>E-mail sendt til Ortoklinik på <a href="mailto: <?php echo esc_html( $options['contact_email'] ); ?>"><?php echo esc_html( $options['contact_email'] ); ?></a> besvares på alle hverdage.</p>

</div>
