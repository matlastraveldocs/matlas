<?php
function newzealand_form_submit_new($postData) {
	global $wpdb;
	$visa_global_entry_db = $wpdb->prefix."visa_form_entries";
	$newzealand_form_db = $wpdb->prefix."newzealand_visa_form_new";
	$traveral_db = $wpdb->prefix."newzealand_visa_traverler_data_new";
	$formData = array(
		'destination_country' => $postData['destination_country'],
		'nationality' => $postData['nationality'],
		'purpose' => $postData['purpose'],
		'arrival_date' => $postData['arrival_date'],
		'email_address' => $postData['email_address'],
		'telephone_number' => $postData['telephone_number'],
		'country' => $postData['countries'],
		'street_name'=> $postData['street_name'],
		'house_number' => $postData['house_number'],
		'town' => $postData['town'],
		'postcode' => $postData['postcode'],
		'province' => $postData['province'],);
	$wpdb->insert($newzealand_form_db, $formData );
	$newzealand_form_insert_id = $wpdb->insert_id;
	if ($newzealand_form_insert_id) {
		if(is_array($postData['traverler'])) {
			$cntTraveller = count($_POST['traverler']['nationality']);
			for ($j = 0; $j < $cntTraveller; $j++) {
				$traveral_data = array(
					'newzealand_form_id' => $newzealand_form_insert_id,
					'sex' => $postData['traverler']['gender'][$j],
					'nationality' => $postData['traverler']['nationality'][$j],
					'first_name' => $postData['traverler']['first_name'][$j],
					'surname' => $postData['traverler']['surname'][$j],
					'country_of_birth' => $postData['traverler']['country_of_birth'][$j],
					'place_of_birth' => $postData['traverler']['place_of_birth'][$j],
					'date_of_birth' => $postData['traverler']['date_birth'][$j],
					'official_alias' => $postData['traverler']['official_alias'][$j],
					'official_alias_first_name' => $postData['traverler']['official_alias_first_name'][$j],
					'official_alias_last_name' => $postData['traverler']['official_alias_last_name'][$j],
					'delivery_country' => $postData['traverler']['delivery_country'][$j],
					'document_number' => $postData['traverler']['document_number'][$j],
					'release_date' => $postData['traverler']['release_date'][$j],
					'expiration_date' => $postData['traverler']['expiration_date'][$j],
					'citizen_service_number' => $postData['traverler']['citizen_service_number'][$j],
					'medical' => $postData['traverler']['medical'][$j],
					'plotted_other' => $postData['traverler']['plotted_other'][$j],
					'disabled' => $postData['traverler']['disabled'][$j],
					'convicted' => $postData['traverler']['convicted'][$j],
				);
				$wpdb->insert( $traveral_db, $traveral_data );
			}
		}

		if (!isset($postData['duration'])) {
			$postData['duration'] = '';
		}
		$visa_global_entry_Data = array(
			'country' => $postData['destination_country'],
			'purpose' => $postData['purpose'],
			'duration' => $postData['duration'],
			'arrival_date' => $postData['arrival_date'],
		);
		$wpdb->insert( $visa_global_entry_db, $visa_global_entry_Data );
		$wpdb->flush();
		return true;
	}
}
?>