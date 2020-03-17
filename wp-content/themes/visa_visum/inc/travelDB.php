<?php
function craete_table() {
  global $wpdb;
  $national_table = $wpdb->prefix."user_nationality";
  $trave_table = $wpdb->prefix."travel_purpose";
  $destination_table = $wpdb->prefix."user_destination";
  $national_sql = "
            CREATE TABLE IF NOT EXISTS `{$national_table}` (
              `id` INTEGER NOT NULL AUTO_INCREMENT,
              `country` text NOT NULL,
              `country_abbr` VARCHAR(10) NOT NULL,
              PRIMARY KEY (id)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    ";
    $travel_sql = "
            CREATE TABLE IF NOT EXISTS `{$trave_table}` (
              `id` INTEGER NOT NULL AUTO_INCREMENT,
              `purpose` text NOT NULL,
              PRIMARY KEY (id)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    ";

    $desti_sql = "
            CREATE TABLE IF NOT EXISTS `{$destination_table}` (
              `id` INTEGER NOT NULL AUTO_INCREMENT,
              `title` VARCHAR(100) NOT NULL,
              `nationality_id` INTEGER NOT NULL,
              `purpose_id` INTEGER NOT NULL,
              `destination_id` INTEGER NOT NULL,
              PRIMARY KEY (id),
              FOREIGN KEY  (nationality_id) REFERENCES ".$national_table." (id) ON DELETE CASCADE,
              FOREIGN KEY  (purpose_id) REFERENCES ".$trave_table." (id) ON DELETE CASCADE
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    ";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $national_sql );
    dbDelta( $travel_sql );
    dbDelta( $desti_sql );
}
add_action( 'after_setup_theme', 'craete_table' );
?>