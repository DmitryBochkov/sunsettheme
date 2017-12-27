<h1>Sunset Theme Support</h1>
<?php settings_errors(); ?>

<form class="sunset-feneral-form" action="options.php" method="post">
  <?php settings_fields( 'sunset-theme-support' ); ?>
  <?php do_settings_sections( 'alecadd_sunset_theme' ); ?>
  <?php submit_button(); ?>
</form>
