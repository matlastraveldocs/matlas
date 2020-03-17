<?php
// Create Shortcode need_a_visa
// Use the shortcode: [need_a_visa =""]
function create_needavisa_shortcode($atts) {
	// Attributes
	$farray = array(
		'need_a_visa' => '',
		'from' => '',
		'to' => '',
		'purpose' => '',
		'btn' => ''
	);
	$atts = shortcode_atts($farray,$atts,'need_a_visa');
	// Get the list of Nationality
	global $wpdb;
	$user_nationality = $wpdb->prefix."user_nationality";
	$nationalityQuery = $wpdb->get_results( "SELECT * FROM $user_nationality" );
	// Attributes in var
	$output = '<div class="need_a_visa">';
		$output .= '<div class="inside">';
			$output .= '<h2>'.$atts['need_a_visa'].'</h2>';
			$output .= '<div class="search-column">';
				$output .= '<label>'.$atts['from'].'</label>';
				//$output .= print_r($nationalityQuery,true);
				$output .= '<span>';
					$output .= '<select name="nationality">';
						//$output .= '<option value="">Select Nationality</option>';
						if(!empty($nationalityQuery)){
							$strSelected = "";
							foreach($nationalityQuery as $nationality){
								if(strtoupper($nationality->country_abbr) == 'NL'){
									$strSelected = "selected";
								}
								$output .= '<option value="'.$nationality->id.'" '.$strSelected.'>'.icl_t('visachild', $nationality->country, $nationality->country).'</option>';
							}
						}
					$output .= '</select>';
				$output .= '</span>';
			$output .= '</div>';
			$output .= '<div class="search-column">';
				$output .= '<label>'.$atts['to'].'</label>';
				$output .= '<span>';
					$output .= '<select name="destination" id="destination">';
						$output .= '<option value="" selected>'.__('Select Destination','traveldocs').'</option>';
						if(!empty($nationalityQuery)){
							foreach($nationalityQuery as $nationality){
								if(8 == $nationality->id){
									$output .= '<option value="'.$nationality->id.'">'.__(ucwords(icl_t('visachild', $nationality->country, $nationality->country)),'traveldocs').'</option>';
								}
							}
						}
					$output .= '</select>';
				$output .= '</span>';
			$output .= '</div>';
			$output .= '<div class="search-column">';
				$output .= '<input type="button" id="search" class="theme-button" name="search" value="'.$atts['btn'].'">';
			$output .= '</div>';
		$output .= '</div>';
	$output .= '</div>';
	// Output Code
	return $output;
}
add_shortcode( 'need_a_visa', 'create_needavisa_shortcode' );

// Create Need a Visa element for Visual Composer
add_action( 'vc_before_init', 'needavisa_integrateWithVC' );
function needavisa_integrateWithVC() {
	vc_map( array(
		'name' => __( 'Need a Visa', 'traveldocs' ),
		'description' => __( 'Need a Visa', 'traveldocs' ),
		'base' => 'need_a_visa',
		'show_settings_on_create' => true,
		'category' => __( 'traveldocs', 'traveldocs'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Popup Title', 'traveldocs' ),
				'param_name' => 'need_a_visa',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'I hold a passport from title', 'traveldocs' ),
				'param_name' => 'from',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'I am travelling to title', 'traveldocs' ),
				'param_name' => 'to',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'My purpose of trip is title', 'traveldocs' ),
				'param_name' => 'purpose',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Button title', 'traveldocs' ),
				'param_name' => 'btn',
			),
		)
	) );
}