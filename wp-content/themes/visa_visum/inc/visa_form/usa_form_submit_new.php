<?php
function usa_form_submit_new($postData) {
	global $wpdb;
	$visa_global_entry_db = $wpdb->prefix."visa_form_entries";
	$usa_form_db = $wpdb->prefix."usa_visa_form_new";
	$traveral_db = $wpdb->prefix."usa_visa_traverler_data_new";
	$formData = array(
		'destination_country' => $postData['destination_country'],
		'nationality' => $postData['nationality'],
		'purpose' => $postData['purpose'],
		'arrival_date' => $postData['arrival_date'],
		'email_address' => $postData['email_address'],
		'phone_number' => $postData['phone_number'],
		'country' => $postData['countries'],
		'street_name'=> $postData['street_name'],
		'house_number' => $postData['house_number'],
		'city' => $postData['city'],
		'postcode' => $postData['postcode'],
		'province' => $postData['province'],
		'emergency_contact_first_name' => $postData['emergency_contact_first_name'],
		'emergency_contact_last_name' => $postData['emergency_contact_last_name'],
		'emergency_contact_phone_number' => $postData['emergency_contact_phone_number'],
		'emergency_contact_phone_number' => $postData['emergency_contact_phone_number'],
		'emergency_contact_email' => $postData['emergency_contact_email'],
		'transit' => $postData['transit'],
		'contact_us_name' => $postData['contact_us_name'],
		'contact_us_street_name' => $postData['contact_us_street_name'],
		'contact_us_state' => $postData['contact_us_state'],
		'contact_us_phone_number' => $postData['contact_us_phone_number'],
		'waiver_of_rights' => $postData['waiver_of_rights'],
		'urgent_request' => $postData['urgent_request']);
	$wpdb->insert($usa_form_db, $formData );
	$usa_form_insert_id = $wpdb->insert_id;
	if ($usa_form_insert_id) {
		if(is_array($postData['traverler'])) {
			$cntTraveller = count($_POST['traverler']['nationality']);
			for ($j = 0; $j < $cntTraveller; $j++) {
				$traveral_data = array(
					'usa_form_id' => $usa_form_insert_id,
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
					'father_first_name' => $postData['traverler']['father_first_name'][$j],
					'father_surname' => $postData['traverler']['father_surname'][$j],
					'mother_first_name' => $postData['traverler']['mother_first_name'][$j],
					'mother_surname' => $postData['traverler']['mother_surname'][$j],
					'delivery_country' => $postData['traverler']['delivery_country'][$j],
					'document_number' => $postData['traverler']['document_number'][$j],
					'citizen_service_number' => $postData['traverler']['citizen_service_number'][$j],
					'issue_date' => $postData['traverler']['issue_date'][$j],
					'expiry_date' => $postData['traverler']['expiry_date'][$j],
					'alternative_passport' => $postData['traverler']['alternative_passport'][$j],
					'alt_delivery_country' => $postData['traverler']['alt_delivery_country'][$j],
					'alt_document_number' => $postData['traverler']['alt_document_number'][$j],
					'alt_expiry_year' => $postData['traverler']['alt_expiry_year'][$j],
					'alternative_citizenship_current' => $postData['traverler']['alternative_citizenship_current'][$j],
					'alt_current_citizen_country' => $postData['traverler']['alt_current_citizen_country'][$j],
					'alt_current_citizen_obtain_by' => $postData['traverler']['alt_current_citizen_obtain_by'][$j],
					'alternative_citizenship_past' => $postData['traverler']['alternative_citizenship_past'][$j],
					'alt_past_citizen_country' => $postData['traverler']['alt_past_citizen_country'][$j],
					'employer' => $postData['traverler']['employer'][$j],
					'employer_name' => $postData['traverler']['employer_name'][$j],
					'employer_street_name_house_no' => $postData['traverler']['employer_street_name_house_no'][$j],
					'employer_city' => $postData['traverler']['employer_city'][$j],
					'employer_district' => $postData['traverler']['employer_district'][$j],
					'employer_country' => $postData['traverler']['employer_country'][$j],
					'employer_phone_no' => $postData['traverler']['employer_phone_no'][$j],
					'health_problem' => $postData['traverler']['health_problem'][$j],
					'arrested' => $postData['traverler']['arrested'][$j],
					'drugs' => $postData['traverler']['drugs'][$j],
					'terrorism' => $postData['traverler']['terrorism'][$j],
					'fraud' => $postData['traverler']['fraud'][$j],
					'jobseeker' => $postData['traverler']['jobseeker'][$j],
					'visa_rejection' => $postData['traverler']['visa_rejection'][$j],
					'deadline_exceeded' => $postData['traverler']['deadline_exceeded'][$j],
					'risky_countries' => $postData['traverler']['risky_countries'][$j],
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