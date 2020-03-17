<?php
function russia_form_submit_new($postData) {
	global $wpdb;
	$visa_global_entry_db = $wpdb->prefix."visa_form_entries";
	$russia_form_db = $wpdb->prefix."russia_visa_form_new";
	$traveral_db = $wpdb->prefix."russia_visa_traverler_data_new";
	$intended_db= $wpdb->prefix."russia_intended_data";
	$place_db= $wpdb->prefix."russia_place_visit_data";
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
		'return_date' => $postData['return_date'],
		'shipping_method' => $postData['shipping_method'],
		'return_method' => $postData['return_method'],
		'hotel_company_name' => $postData['hotel_company_name'],
		'hotel_company_address' => $postData['hotel_company_address'],
		'hotel_company_place' => $postData['hotel_company_place'],
		'area' => $postData['area_1_to_8']
	);
	$wpdb->insert( $russia_form_db, $formData );
	$russia_form_insert_id = $wpdb->insert_id;
	if ($russia_form_insert_id) {

		if(is_array($postData['traverler'])) {
			$cntTraveller = count($_POST['traverler']['nationality']);
			for ($j = 0; $j < $cntTraveller; $j++) {
				$traveral_data = array(
					'russia_form_id' => $russia_form_insert_id,
					'gender' => $postData['traverler']['gender'][$j],
					'nationality' => $postData['traverler']['nationality'][$j],
					'full_name' => $postData['traverler']['full_name'][$j],
					// 'surname' => $postData['traverler']['surname'][$j],
					'birth_country' => $postData['traverler']['birth_country'][$j],
					'birth_place' => $postData['traverler']['birth_place'][$j],
					'date_birth' => $postData['traverler']['date_birth'][$j],
					'russian_nationality' => $postData['traverler']['russian_nationality'][$j],
					'lost_nationality_date' => $postData['traverler']['lost_nationality_date'][$j],
					'reason_for_nationality_loss' => $postData['traverler']['reason_for_nationality_loss'][$j],
					'born_in_russia' => $postData['traverler']['born_in_russia'][$j],
					'immigration_date' => $postData['traverler']['immigration_date'][$j],
					'immigration_country' => $postData['traverler']['immigration_country'][$j],
					'alt_name' => $postData['traverler']['alt_name'][$j],
					'alternative_name' => $postData['traverler']['alternative_name'][$j],
					'document_number' => $postData['traverler']['document_number'][$j],
					'release_date' => $postData['traverler']['release_date'][$j],
					'expiration_date' => $postData['traverler']['expiration_date'][$j],
					'delivery_location' => $postData['traverler']['delivery_location'][$j],
					'passport_data' => $postData['traverler']['passport_data'][$j],
					'passport_photo' => $postData['traverler']['passport_photo'][$j],
					'afgifteland_passport' => $postData['traverler']['afgifteland_passport'][$j],
					'insurer_name' => $postData['traverler']['insurer_name'][$j],
					'insurance_number' => $postData['traverler']['insurance_number'][$j],
					'study' => $postData['traverler']['study'][$j],
					'employer_name_1_to_8' => $postData['traverler']['employer_name_1_to_8'][$j],
					'job_title_1_to_8' => $postData['traverler']['job_title_1_to_8'][$j],
					'job_address_1_to_8' => $postData['traverler']['job_address_1_to_8'][$j],
					'job_telephone_1_to_8' => $postData['traverler']['job_telephone_1_to_8'][$j],
					'employer' => $postData['traverler']['employer'][$j],
					'employer_name_9_to_30' => $postData['traverler']['employer_name_9_to_30'][$j],
					'employer_email_9_to_30' => $postData['traverler']['employer_email_9_to_30'][$j],
					'employer_street_name_house_no_9_to_30' => $postData['traverler']['employer_street_name_house_no_9_to_30'][$j],
					'employer_town_9_to_30' => $postData['traverler']['employer_town_9_to_30'][$j],
					'employer_postal_code_9_to_30' => $postData['traverler']['employer_postal_code_9_to_30'][$j],
					'employer_country_9_to_30' => $postData['traverler']['employer_country_9_to_30'][$j],
					'employer_job_title_9_to_30' => $postData['traverler']['employer_job_title_9_to_30'][$j],
					'employer_telephone_9_to_30' => $postData['traverler']['employer_telephone_9_to_30'][$j],
					'family_member' => $postData['traverler']['family_member'][$j],
					'family_birth_date' => $postData['traverler']['family_birth_date'][$j],
					'family_relationship' => $postData['traverler']['family_relationship'][$j],
					'family_last_name' => $postData['traverler']['family_last_name'][$j],
					'family_first_name' => $postData['traverler']['family_first_name'][$j],
					'family_address' => $postData['traverler']['family_address'][$j],
					'family_street_name_house_no' => $postData['traverler']['family_street_name_house_no'][$j],
					'family_town' => $postData['traverler']['family_town'][$j],
					'russia_visit' => $postData['traverler']['russia_visit'][$j],
					'no_of_visits_russia_' => $postData['traverler']['no_of_visits_russia_'][$j],
					'last_trip_date' => $postData['traverler']['last_trip_date'][$j],
					'last_trip_return_date' => $postData['traverler']['last_trip_return_date'][$j],
					'terms' => $postData['traverler']['terms'][$j]
				);
				$wpdb->insert( $traveral_db, $traveral_data );
			}
		}

		if ($postData['duration'] == '1 t/m 8 days') {
			if(is_array($postData['intended_1_to_8'])) {
				$cntIntended = count($_POST['intended_1_to_8']['name']);
				for ($i = 0; $i < $cntIntended; $i++) {
					$intended_data = array(
						'russia_id' => $russia_form_insert_id,
						'type_of_accomodation' => $postData['intended_1_to_8']['type_of_accomodation'][$i],
						'name' => $postData['intended_1_to_8']['name'][$i],
						'address' => $postData['intended_1_to_8']['address'][$i],
						'number' => $postData['intended_1_to_8']['number'][$i]
					);

					$wpdb->insert( $intended_db, $intended_data );
				}
			}
		}

		if ($postData['duration'] == '9 t/m 30 days') {
			if(is_array($postData['place'])) {
				$cntPlace = count($_POST['place']['place_name']);
				for ($i = 0; $i < $cntPlace; $i++) {
					$place_data = array(
						'russia_id' => $russia_form_insert_id,
						'place_name' => $postData['place']['place_name'][$i],
					);

					$wpdb->insert( $place_db, $place_data );
				}
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