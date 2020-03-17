<?php
function turkey_table() {
  global $wpdb;
  $turkey_table = $wpdb->prefix."turkey_visa_form";
  $turkey_visa_sql = "
            CREATE TABLE IF NOT EXISTS `{$turkey_table}` (
              `id` INTEGER NOT NULL AUTO_INCREMENT,
              `email_address` VARCHAR(100) NULL,
              `telephone_number` VARCHAR(100) NULL,
              `address` VARCHAR(100) NULL,
              `country` VARCHAR(100) NULL,
              `City` VARCHAR(100) NULL,
              `postcode` VARCHAR(10) NULL,
              `departure_date` VARCHAR(100) NULL,
              `urgent_procedure` VARCHAR(100) NULL,
              `updated_at` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
              `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
              PRIMARY KEY (id)
            ) ENGINE=INNODB DEFAULT CHARSET=utf8;
    ";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $turkey_visa_sql );
}
add_action( 'after_setup_theme', 'turkey_table' );

?>