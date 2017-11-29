<h1>Sunset Contact Form</h1>
<?php settings_errors(); ?>


<form class="sunset-feneral-form" action="options.php" method="post">
  <?php settings_fields( 'suset-contact-options' ); ?>
  <?php do_settings_sections( 'alecadd_sunset_theme_contact' ); ?>
  <?php submit_button(); ?>
</form>
