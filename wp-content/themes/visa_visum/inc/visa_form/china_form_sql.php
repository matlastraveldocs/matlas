<?php
function china_table() {
  global $wpdb;
  $china_table = $wpdb->prefix."china_visa_form";
  $china_visa_sql = "
            CREATE TABLE IF NOT EXISTS `{$china_table}` (
              `id` INTEGER NOT NULL AUTO_INCREMENT,
              `email_address` VARCHAR(100) NULL,
              `telephone_number` VARCHAR(100) NULL,
              `type_address` VARCHAR(100) NULL,
              `country` VARCHAR(100) NULL,
              `postcode` VARCHAR(10) NULL,
              `house_number` VARCHAR(100) NULL,
              `appart_number` VARCHAR(100) NULL,
              `street_name` VARCHAR(150) NULL,
              `place` VARCHAR(100) NULL,
              `province` VARCHAR(100) NULL,
              `departure_date` VARCHAR(100) NULL,
              `purpose_trip` VARCHAR(100) NULL,
              `number_entries` VARCHAR(100) NULL,
              `urgent_procedure` VARCHAR(100) NULL,
              `return_shipment` VARCHAR(100) NULL,
              `updated_at` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
              `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
              PRIMARY KEY (id)
            ) ENGINE=INNODB DEFAULT CHARSET=utf8;
    ";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $china_visa_sql );
}
add_action( 'after_setup_theme', 'china_table' );

?>