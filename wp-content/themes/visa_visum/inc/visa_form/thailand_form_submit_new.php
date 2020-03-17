<?php
function thailand_form_submit_new($postData) {
	global $wpdb;
	$visa_global_entry_db = $wpdb->prefix."visa_form_entries";
	$russia_form_db = $wpdb->prefix."thailand_visa_form_new";
	$traveral_db = $wpdb->prefix."thailand_visa_traverler_data_new";
	$formData = array(
		'destination_country' => $postData['destination_country'],
		'nationality' => $postData['nationality'],
		'purpose' => $postData['purpose'],
		'duration' => $postData['duration'],
		'arrival_date' => $postData['arrival_date'],
		'email_address' => $postData['email_address'],
		'telephone' => $postData['telephone'],
		'country' => $postData['countries'],
		'street_name'=> $postData['street_name'],
		'house_number' => $postData['house_number'],
		'town' => $postData['town'],
		'postcode' => $postData['postcode'],
		'province_name' => $postData['province_name'],
		'no_of_days_stay' => $postData['no_of_days_stay'],
		'travel_method' => $postData['travel_method'],
		'flight_no' => $postData['flight_no'],
		'vessel_name' => $postData['vessel_name'],
		'residence_address' => $postData['residence_address'],
		'residence_phone_no' => $postData['residence_phone_no'],
		'shipping_method' => $postData['shipping_method'],
		'return_method' => $postData['return_method'],
	);
	$wpdb->insert( $russia_form_db, $formData );
	$russia_form_insert_id = $wpdb->insert_id;
	if ($russia_form_insert_id) {
		if(is_array($postData['traverler'])) {
			$cntTraveller = count($_POST['traverler']['nationality']);
			for ($j = 0; $j < $cntTraveller; $j++) {
				$traveral_data = array(
					'thailand_form_id' => $russia_form_insert_id,
					'gender' => $postData['traverler']['gender'][$j],
					'first_name' => $postData['traverler']['first_name'][$j],
					'surname' => $postData['traverler']['surname'][$j],
					'date_birth' => $postData['traverler']['date_birth'][$j],
					'birth_place' => $postData['traverler']['birth_place'][$j],
					'nationality' => $postData['traverler']['nationality'][$j],
					'nationality_at_birth' => $postData['traverler']['nationality_at_birth'][$j],
					'marital_status' => $postData['traverler']['marital_status'][$j],
					'work' => $postData['traverler']['work'][$j],
					'profession' => $postData['traverler']['profession'][$j],
					'name_of_employer' => $postData['traverler']['name_of_employer'][$j],
					'document_number' => $postData['traverler']['document_number'][$j],
					'release_date' => $postData['traverler']['release_date'][$j],
					'expiration_date' => $postData['traverler']['expiration_date'][$j],
					'thailand_visit' => $postData['traverler']['thailand_visit'][$j],
					'previous_visit_date' => $postData['traverler']['previous_visit_date'][$j],
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