<h1>Sunset Contact Form</h1>
<?php settings_errors(); ?>

<p>Use this <strong>shortcode</strong> to activate the Contact Form inside a page or a post.</p>
<p><code>[contact_form]</code></p>

<form class="sunset-feneral-form" action="options.php" method="post">
  <?php settings_fields( 'sunset-contact-options' ); ?>
  <?php do_settings_sections( 'alecadd_sunset_theme_contact' ); ?>
  <?php submit_button(); ?>
</form>
