<?php
function visa_global_table() {
  global $wpdb;
  $visa_form = $wpdb->prefix."visa_form_data";
  $traveral_table = $wpdb->prefix."traveler_visa_form";
  $china_table = $wpdb->prefix."china_visa_form";
  $turkey_table = $wpdb->prefix."turkey_visa_form";
  $desti_sql = "
          CREATE TABLE IF NOT EXISTS `{$visa_form}` (
            `id` INTEGER NOT NULL AUTO_INCREMENT,
            `china_id` INTEGER NULL,
            `updated_at` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
            `created_at` TIMESTAMP NOT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (`china_id`) REFERENCES ".$china_table." (`id`) ON DELETE CASCADE
          ) ENGINE=INNODB DEFAULT CHARSET=utf8;
    ";
    $traveral_sql = "
    CREATE TABLE IF NOT EXISTS `{$traveral_table}` (
      `id` INTEGER NOT NULL AUTO_INCREMENT,
      `nationality` VARCHAR(100) NULL,
      `first_name` VARCHAR(100) NULL,
      `surname` VARCHAR(100) NULL,
      `date_birth` VARCHAR(100) NULL,
      `turkey_id` INTEGER NULL,
      `travel_document` VARCHAR(100) NULL,
      `passport_number` VARCHAR(30) NULL,
      `date_issue` DATE NULL,
      `expiration_date` DATE NULL,
      `place_birth` VARCHAR(100) NULL,
      `first_name_mother` VARCHAR(100) NULL,
      `first_name_father` VARCHAR(100) NULL,
      `updated_at` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
      `created_at` TIMESTAMP NOT NULL,
      `china_id` INTEGER NULL,
      PRIMARY KEY (id),
      FOREIGN KEY  (china_id) REFERENCES ".$china_table." (id) ON DELETE CASCADE,
      FOREIGN KEY  (turkey_id) REFERENCES ".$turkey_table." (id) ON DELETE CASCADE
    ) ENGINE=INNODB DEFAULT CHARSET=utf8;
";



    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $desti_sql );
    dbDelta( $traveral_sql );

}
add_action( 'after_setup_theme', 'visa_global_table' );

require_once get_stylesheet_directory() . "/inc/visa_form/china_form_sql.php"; // China Form SQL
require_once get_stylesheet_directory() . "/inc/visa_form/chine_form_submit.php"; // China Form submit

require_once get_stylesheet_directory() . "/inc/visa_form/turkey_form_sql.php"; // turkey Form SQL
require_once get_stylesheet_directory() . "/inc/visa_form/turkey_form_submit.php"; // turkey Form submit


require_once get_stylesheet_directory() . "/inc/visa_form/russia_form_submit_new.php"; // russia Form submit

require_once get_stylesheet_directory() . "/inc/visa_form/thailand_form_submit_new.php"; // thailand Form submit

require_once get_stylesheet_directory() . "/inc/visa_form/indonesia_form_submit_new.php"; // indonesia Form submit

require_once get_stylesheet_directory() . "/inc/visa_form/newzealand_form_submit_new.php"; //New Zealand Form submit

require_once get_stylesheet_directory() . "/inc/visa_form/usa_form_submit_new.php"; //usa Form submit
?>