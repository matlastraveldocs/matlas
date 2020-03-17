<?php
function turkey_form_submit($postData) {

  die();
  global $wpdb;
  $turkey_form_db = $wpdb->prefix."turkey_visa_form";
  $traveral_db = $wpdb->prefix."traveler_visa_form";
  $visa_form = $wpdb->prefix."visa_form_data";
  $formData = array(
    'email_address' => $postData['email_address'],
    'telephone_number' => $postData['telephone'],
    'type_address' => $postData['type_address'],
    'country' => $postData['countries'],
    'postcode' => $postData['postcode'],
    'house_number' => $postData['house_number'],
    'appart_number' => $postData['appart_number'],
    'street_name' => $postData['street_name'],
    'place' => $postData['place_name'],
    'province' => $postData['province_name'],
    'departure_date' => $postData['departure_date'],
    'purpose_trip' => $postData['purpose_trip'],
    'number_entries' => $postData['number_entries'],
    'urgent_procedure' => $postData['urgent_procedure'],
    'return_shipment' => $postData['return_shipment'],
    'created_at' => date('Y-m-d H:i:s')
  );


  $wpdb->insert( $turkey_form_db, $formData );
  $china_form_insert_id = $wpdb->insert_id;
if ($china_form_insert_id) {
  $visa_global_data = array(
    'china_id' => $china_form_insert_id,
    'created_at' => date('Y-m-d H:i:s')
  );
  $wpdb->insert( $visa_form, $visa_global_data );
    if(is_array($postData['traverler'])) {
      foreach ($postData['traverler'] as $key => $value) {
        $traveral_data = array(
          'nationality' => $value['nationality'],
          'first_name' => $value['first_name'],
          'surname' => $value['surname'],
          'date_birth' => $value['date_birth'],
          'china_id' => $china_form_insert_id,
          'created_at' => date('Y-m-d H:i:s')
        );

        $wpdb->insert( $traveral_db, $traveral_data );
      }
  }
  $wpdb->flush();
    return true;
  }
}
?>
