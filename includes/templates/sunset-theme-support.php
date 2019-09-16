<h1>Sunset Sidebar Options</h1>
<?php settings_errors();?>
<?php
?>
<form action="options.php" method="post" class="sunset-general-form">
    <?php settings_fields('sunset-theme-support'); ?>
    <?php do_settings_sections('alama_sunset_theme');?>
    <?php submit_button(); ?>
</form>
