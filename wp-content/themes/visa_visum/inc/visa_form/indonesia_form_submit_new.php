<?php
function indonesia_form_submit_new($postData) {
	global $wpdb;
	$visa_global_entry_db = $wpdb->prefix."visa_form_entries";
	$indonesia_form_db = $wpdb->prefix."indonesia_visa_form_new";
	$traveral_db = $wpdb->prefix."indonesia_visa_traverler_data_new";
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
		'arrival_airport' => $postData['arrival_airport'],
		'return_date' => $postData['return_date'],
		'name_of_sponsor_in_indonesia' => $postData['name_of_sponsor_in_indonesia'],
		'address_of_sponsor_in_indonesia' => $postData['address_of_sponsor_in_indonesia'],
		'telephone_number_of_sponsor_in_indonesia' => $postData['telephone_number_of_sponsor_in_indonesia'],
		'point_of_entery_in_indonesia' => $postData['point_of_entery_in_indonesia'],
		'address_of_recendence_in_indonesia' => $postData['address_of_recendence_in_indonesia'],
		'telephone_number_of_residence_in_indonesia' => $postData['telephone_number_of_residence_in_indonesia'],
		'shipping_method' => $postData['shipping_method'],
		'return_method' => $postData['return_method'],
	);
	$wpdb->insert( $indonesia_form_db, $formData );
	$indonesia_form_insert_id = $wpdb->insert_id;
	if ($indonesia_form_insert_id) {
		if(is_array($postData['traverler'])) {
			$cntTraveller = count($_POST['traverler']['nationality']);
			for ($j = 0; $j < $cntTraveller; $j++) {
				$traveral_data = array(
					'indonesia_form_id' => $indonesia_form_insert_id,
					'nationality' => $postData['traverler']['nationality'][$j],
					'full_name' => $postData['traverler']['full_name'][$j],
					//'surname' => $postData['traverler']['surname'][$j],
					'gender' => $postData['traverler']['gender'][$j],
					'marital_status' => $postData['traverler']['marital_status'][$j],
					'place_of_birth' => $postData['traverler']['place_of_birth'][$j],
					'date_birth' => $postData['traverler']['date_birth'][$j],
					'document_number' => $postData['traverler']['document_number'][$j],
					'place_of_issue' => $postData['traverler']['place_of_issue'][$j],
					'release_date' => $postData['traverler']['release_date'][$j],
					'expiration_date' => $postData['traverler']['expiration_date'][$j],
					'work' => $postData['traverler']['work'][$j],
					'name_of_employer' => $postData['traverler']['name_of_employer'][$j],
					'work_address' => $postData['traverler']['work_address'][$j],
					'employer_zipcode' => $postData['traverler']['employer_zipcode'][$j],
					'employer_place' => $postData['traverler']['employer_place'][$j],
					'employer_phone' => $postData['traverler']['employer_phone'][$j],
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