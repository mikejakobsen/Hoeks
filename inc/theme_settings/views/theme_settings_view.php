<?php
/**
 * Theme settings view
 * This file displays the theme settings forms
 *
 * @author: Mike Jakobsen
 * @since: 0.0.1
 */
?>

<div id="theme-options-wrap" class="widefat">

  <?php if ($_GET['settings-updated'] == 'true') : ?>
  <div class="notice notice-success is-dismissible">
    Gemt! Fortsat god dag :)
  </div>
  <?php endif; ?>

  <h1>Temaindstillinger</h1>

  <form method="post" action="options.php" enctype="multipart/form-data">

    <?php settings_fields(THEME_OPTIONS); ?>

    <?php do_settings_sections( $page ); ?>

    <p class="submit">
      <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e( 'Gem' ); ?>"/>
    </p>

  </form>
</div>
