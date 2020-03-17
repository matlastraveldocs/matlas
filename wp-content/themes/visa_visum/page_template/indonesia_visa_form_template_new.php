<?php
/**
* Template Name: Indonesia Visa Form
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/

$indonesia_nonce = wp_create_nonce('indonesia_form_nonce');
$formSubmit = '';
$cntTraveller = 1;
$redirectURL = 'http://traveldocs.developstaging.com/thank-you/';
$isError = false;
if (isset($_GET['purpose']) && $_GET['purpose'] != '') {
	$visa_purpose = ucfirst($_GET['purpose']);
}
if(!empty($_POST)) {
	$formSubmit = indonesia_form_submit_new($_POST);
	wp_redirect( $redirectURL );
}
get_header();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="container">
	<?php
	$outHtml = '';
	$outHtml .= '<div class="recordaddedMessage"> <p> '. __( 'Form Submitted Successfully', 'visachild' ) .' </p> </div>';
	if ($formSubmit) {
		echo $outHtml;
	}
	?>
	<!-- Matlas -->
	<div class="row">
		<div class="col-md-12" style="margin-bottom: 40px !important;">
	        <ul class="process-steps process-2 clearfix">
	            <li class=" active">
	                <a href="#" class="i-bordered i-circled divcenter"><i class="fa fa-wpforms" aria-hidden="true"></i></a>
	                <h5>1. Gegevens invullen</h5>
	            </li>
	            <li class="">
	                <a href="javascript:jQuery('#order-form').submit(); return false;" class="i-bordered i-circled divcenter"><i class="fa fa-check" aria-hidden="true"></i></a>
	                <h5>2. Controle en betaling</h5>
	            </li>
	        </ul>
	    </div>
	</div>
	<!-- Matlas -->
	<div class="row backgrouddark">
		<div class="col-md-8 matlasform mequalheight"  id="matlascontent">
			<form method="post" id="indonesia_visa_form" class="visa_form_submit" enctype="multipart/form-data">
				<div id="visa_travel-information" class="form_seprationSection">
					<h3><?php echo __( 'Travel details', 'visachild' ); ?></h3>

					<div class="form-group row">
						<label for="destination_country" class="vc_col-md-3 col-form-label"><?php echo __( 'Destination', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="text" class="form-control" value="Indonesia" name="destination_country" id="destination_country" readonly="true">
						</div>
					</div><!-- form-group -->

					<div class="form-group row">
						<label for="nationality" class="vc_col-md-3 col-form-label"><?php echo __( 'Nationality', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<select name="nationality" id="nationality">
									<option value="Belgium">Belgium</option>
									<option value="Denmark">Denmark</option>
									<option value="Germany">Germany</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="Netherlands">Netherlands</option>
									<option value="Norway">Norway</option>
									<option value="Austria">Austria</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Spain">Spain</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="United States">United States</option>
									<option value="Sweden">Sweden</option>
									<option value="---" disabled="">------------------------------------------</option>
								<?php
									if(!empty(get_list_countries())){
										foreach(get_list_countries() as $country){?>
										<option value="<?php echo $country->country_code;?>" <?php echo 'NL' == $country->country_code ? 'selected' : ''; ?>><?php echo $country->name;?></option>
									<?php } } ?>
							</select>
						</div>
					</div><!-- form-group -->

					<div class="form-group row">
						<label for="purpose" class="vc_col-md-3 col-form-label"><?php echo __( 'Purpose', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<!-- <input type="text" class="form-control" value="<?php // echo isset($visa_purpose) ? $visa_purpose : 'Tourism'; ?>" name="purpose" id="purpose" readonly="true"> -->
							<select name="purpose" id="purpose">
								<option value="Tourism" <?php echo (isset($visa_purpose) == 'Tourism') ? 'selected' : ''; ?>><?php echo __('Tourism', 'visachild') ?></option>
								<option value="Business" <?php echo (isset($visa_purpose) == 'Business') ? 'selected' : ''; ?>><?php echo __('Business', 'visachild') ?></option>
							</select>
							<span class="validate_error"><?php echo isset($purposeErr) ? $purposeErr : ''; ?></span>
							<!-- <span><a id="change_purpose" href="#purpose_modal" class="trigger-btn" data-toggle="modal">change</a></span> -->
						</div>
						<!-- Modal HTML -->
						<div id="purpose_modal" class="modal fade">
							<div class="modal-dialog modal-confirm">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3 class="modal-title"><b>Are you sure to change to business purpose?</b></h3>
									</div>
									<div class="modal-body" style="text-align: center;">
										<p>You must enter all the details again..</p>
									</div>
									<div class="modal-footer">
										<button id="cancel_purpose_btn" type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-success" id="change_purpose_btn">Yes proceed</button>
									</div>
								</div>
							</div>
						</div> <!-- Modal -->

						<!-- No visa required modal -->
						<div id="visa_modal" class="modal fade">
							<div class="modal-dialog modal-confirm">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3 class="modal-title"><b>No Visa Required</b></h3>
									</div>
									<div class="modal-body" style="text-align: center;">
										<p>You don’t need a visa with these requirements</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
									</div>
								</div>
							</div>
						</div> <!-- Modal -->
					</div><!-- form-group -->

					<div class="form-group row tourism_duration">
						<label for="duration" class="vc_col-md-3 col-form-label"><?php echo __( 'Duration', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<select name="duration" id="duration_option">
									<option value="31 to 60 days" <?php echo (isset($duration) == '31 to 60 days') ? 'selected' : ''; ?>><?php echo __('31 to 60 days', 'visachild') ?></option>
									<option value="1 to 30 days" <?php echo (isset($duration) == '1 to 30 days') ? 'selected' : ''; ?>><?php echo __('1 to 30 days', 'visachild') ?></option>
							</select>
						</div>
					</div><!-- form-group -->
				</div> <!-- End travel info -->
				<div class="duration-31-60">
					<div id="visa_general-information" class="form_seprationSection">
						<h2><?php echo __( 'General data', 'visachild' ); ?></h2>
						<p><?php echo __( "Enter all your details below. Take this carefully from your passport. You must apply for a visa for all travelers (including children who are included in their parents' passports). You can do this in one go by clicking on 'add traveler' at the bottom. You only need to enter the general details once (all visas will be sent to the same address). It is not necessary that all travelers are resident at the address entered. The address is only used for sending the visas, if desired.", 'visachild' ); ?></p>


						<div class="form-group row">
							<label for="arrival_date" class="vc_col-md-3 col-form-label"><?php echo __( 'Arrival date', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="date" class="form-control" value="<?php echo isset($arrival_date) ? $arrival_date : ''; ?>" name="arrival_date" id="arrival_date" placeholder="<?php echo __( 'Arrival Date', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($arrivalErr) ? $arrivalErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="email_address" class="vc_col-md-3 col-form-label"><?php echo __( 'Email Address', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="email" class="form-control" value="<?php echo isset($email_address) ? $email_address : ''; ?>" name="email_address" id="email_address" placeholder="name@example.com">
								<span class="validate_error"><?php echo isset($emailErr) ? $emailErr : ''; ?></span>
							</div>
						</div> <!-- form-group -->

						<div class="form-group row">
							<label for="telephone" class="vc_col-md-3 col-form-label"><?php echo __( 'Telephone Number', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="phone" class="form-control" value="<?php echo isset($telephone) ? $telephone : ''; ?>" name="telephone" id="telephone" placeholder="+316123456789">
								<span class="validate_error"><?php echo isset($phoneErr) ? $phoneErr : ''; ?></span>
							</div>
						</div><!-- form-group -->
					</div>
					<div id="visa_adres-information" class="form_seprationSection">
						<h3><?php echo __( 'Address', 'visachild' ); ?></h3>
						<p><?php echo __( 'Enter the address of one of the travelers. The travelers do not all have to live at this address.', 'visachild' ); ?></p>

						<div class="form-group row">
							<label for="countries" class="vc_col-md-3 col-form-label"><?php echo __( 'Country', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<select name="countries" id="countries">
									<option value="Belgium">Belgium</option>
									<option value="Denmark">Denmark</option>
									<option value="Germany">Germany</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="Netherlands">Netherlands</option>
									<option value="Norway">Norway</option>
									<option value="Austria">Austria</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Spain">Spain</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="United States">United States</option>
									<option value="Sweden">Sweden</option>
									<option value="---" disabled="">------------------------------------------</option>
									<?php
									if(!empty(get_list_countries())){
										foreach(get_list_countries() as $country){?>
										<option value="<?php echo $country->country_code;?>" <?php echo 'NL' == $country->country_code ? 'selected' : ''; ?>><?php echo $country->name;?></option>
									<?php } } ?>
								</select>
								<span class="validate_error"><?php echo isset($countryErr) ? $countryErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="street_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Street name', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($street_name) ? $street_name : ''; ?>" name="street_name" id="street_name" placeholder="<?php echo __( 'Straatnaam', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($streetErr) ? $streetErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="house_number" class="vc_col-md-3 col-form-label"><?php echo __( 'House number', 'visachild' ); ?></label>
							<div class="vc_col-md-9 house_section">
								<input type="text" class="form-control" value="<?php echo isset($house_number) ? $house_number : ''; ?>" name="house_number" id="house_number" placeholder="<?php echo __( 'Huisnummer', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($houseErr) ? $houseErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="town" class="vc_col-md-3 col-form-label"><?php echo __( 'Town', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($town) ? $town : ''; ?>" name="town" id="town" placeholder="<?php echo __( 'Town', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($townErr) ? $townErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="postcode" class="vc_col-md-3 col-form-label"><?php echo __( 'Postcode', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($postcode) ? $postcode : ''; ?>" name="postcode" id="postcode" placeholder="<?php echo __( '1234', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($postcodeErr) ? $postcodeErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="province_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Province', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($province_name) ? $province_name : ''; ?>" name="province_name" id="province_name" placeholder="<?php echo __( 'Province', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($provinceErr) ? $provinceErr : ''; ?></span>
							</div>
						</div><!-- form-group -->
					</div> <!-- visa_adres-information -->

					<div id="order_details" class="form_seprationSection">

						<h3><?php echo __( 'Order details', 'visachild' ); ?></h3>
						<p><?php echo __( 'Enter the general details of the application below. You enter this information only once and apply to all travelers in this application.' ); ?></p>

						<div class="form-group row">
							<label for="arrival_airport" class="vc_col-md-3 col-form-label"><?php echo __( 'Airport of Arrival', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($arrival_airport) ? $arrival_airport : ''; ?>" name="arrival_airport" id="arrival_airport">
								<span class="validate_error"><?php echo isset($arrival_airportErr) ? $arrival_airportErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="return_date" class="vc_col-md-3 col-form-label"><?php echo __( 'Return date', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="date" class="form-control" value="<?php echo isset($return_date) ? $return_date : ''; ?>" name="return_date" id="return_date" placeholder="<?php echo __( 'Return Date', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($returnErr) ? $returnlErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<h3><?php echo __( 'Residence', 'visachild' ); ?></h3>
						<p><?php echo __( 'Enter the details of your (first) place of residence below. You must enter the name of the hotel, the street and the place.' ); ?></p>
						<div class="form-group row">
							<label for="name_of_sponsor_in_indonesia" class="vc_col-md-3 col-form-label"><?php echo __( 'Name of Sponsor/Refrence in Indonesia', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($name_of_sponsor_in_indonesia) ? $name_of_sponsor_in_indonesia : ''; ?>" name="name_of_sponsor_in_indonesia" id="name_of_sponsor_in_indonesia">
							</div>
						</div>
						<div class="form-group row">
							<label for="address_of_sponsor_in_indonesia" class="vc_col-md-3 col-form-label"><?php echo __( 'Address Of Sponsor/Refrence in Indonesia', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($address_of_sponsor_in_indonesia) ? $address_of_sponsor_in_indonesia : ''; ?>" name="address_of_sponsor_in_indonesia" id="address_of_sponsor_in_indonesia">
							</div>
						</div>
						<div class="form-group row">
							<label for="telephone_number_of_sponsor_in_indonesia" class="vc_col-md-3 col-form-label"><?php echo __( 'Telephone number of Sponsor/Refrence in Indonesia', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($telephone_number_of_sponsor_in_indonesia) ? $telephone_number_of_sponsor_in_indonesia : ''; ?>" name="telephone_number_of_sponsor_in_indonesia" id="telephone_number_of_sponsor_in_indonesia"  placeholder="+316123456789">
							</div>
						</div>
						<div class="form-group row">
							<label for="point_of_entery_in_indonesia" class="vc_col-md-3 col-form-label"><?php echo __( 'Point of entery in Indonesia', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($point_of_entery_in_indonesia) ? $point_of_entery_in_indonesia : ''; ?>" name="point_of_entery_in_indonesia" id="point_of_entery_in_indonesia">
							</div>
						</div>
						<div class="form-group row">
							<label for="address_of_recendence_in_indonesia" class="vc_col-md-3 col-form-label"><?php echo __( 'Address of residence in Indonesia', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($address_of_recendence_in_indonesia) ? $address_of_recendence_in_indonesia : ''; ?>" name="address_of_recendence_in_indonesia" id="address_of_recendence_in_indonesia">
							</div>
						</div>
						<div class="form-group row">
							<label for="telephone_number_of_residence_in_indonesia" class="vc_col-md-3 col-form-label"><?php echo __( 'Telephone number of residence in Indonesia', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($telephone_number_of_residence_in_indonesia) ? $telephone_number_of_residence_in_indonesia : ''; ?>" name="telephone_number_of_residence_in_indonesia" id="telephone_number_of_residence_in_indonesia"  placeholder="+316123456789">
							</div>
						</div>

						<h3><?php echo __( 'Shipping Method', 'visachild' ); ?></h3>
						<p><?php echo __( 'Select the way in which you want to send the passport to us (shipping method) and how you want to receive the passport (return method).', 'visachild' ); ?></p>
						<div class="form-group row">
							<label for="shipping_method" class="vc_col-md-3 col-form-label"><?php echo __( 'Shipping Method', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<select name="shipping_method" id="shipping_method">
								    <option value="" <?php echo (isset($shipping_method) == '') ? 'selected' : ''; ?> data-price='0'>Select Send Method ...
								    </option>
									<option value="OC12"<?php echo (isset($shipping_method) == 'OC12') ? 'selected' : ''; ?> data-price='44.95'>Courier next business day before 12:00 (€ 44.95)</option>
									<option value="OC17"<?php echo (isset($shipping_method) == 'OC17') ? 'selected' : ''; ?> data-price='34.95'>Courier next business day before 5:00 PM (€ 34.95)</option>
									<option value="DROPOFF"<?php echo (isset($shipping_method) == 'DROPOFF') ? 'selected' : ''; ?>data-price='0'>Deliver yourself in Rotterdam</option>
									<option value="MAIL"<?php echo (isset($shipping_method) == 'MAIL') ? 'selected' : ''; ?> data-price='0'>Send yourself</option>
								</select>
								<span class="validate_error"><?php echo isset($ShippingErr) ? $ShippingErr : ''; ?></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="return_method" class="vc_col-md-3 col-form-label"><?php echo __( 'Return Method', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<select name="return_method" id="return_method">
								    <option value="" <?php echo (isset($Return_method) == '') ? 'selected' : ''; ?> data-price='0'>Select Return Method ...</option>
								    <option value="AVIA" <?php echo (isset($Return_method) == 'AVIA') ? 'selected' : ''; ?> data-price='69.95'>Avia partner desk (€ 69.95)</option>
								    <option value="REGISTERED_MAIL" <?php echo (isset($Return_method) == 'REGISTERED_MAIL') ? 'selected' : ''; ?> data-price='18.15'>Warranty post 2 working days (€ 18.15)
								    </option>
								    <option value="OC12" <?php echo (isset($Return_method) == 'OC12') ? 'selected' : ''; ?> data-price='44.95'>Courier next business day before 12:00 (€ 44.95)</option>
								    <option value="OC17" <?php echo (isset($Return_method) == 'OC17') ? 'selected' : ''; ?> data-price='34.95'>Courier next business day before 5:00 PM (€ 34.95)
								    </option>
								    <option value="PICKUP" <?php echo (isset($Return_method) == 'PICKUP') ? 'selected' : ''; ?> data-price='0'>Pick up yourself in Rotterdam</option>
								</select>
								<span class="validate_error"><?php echo isset($ReturnErr) ? $ReturnErr : ''; ?></span>
							</div>
						</div><!-- form-group -->
					</div>

					<div id="visa_travel_details-information" class="form_seprationSection">
						<h3><?php echo __( 'Traveler data', 'visachild' ); ?></h3>
						<p><?php echo __( 'Enter the general details of the traveler below. Click for explanation on the label / field or the i-tje. Pay particular attention to the "All first names" and "last name" fields.', 'visachild' ); ?></p>
						<?php
						if(isset($_POST['traverler'])){
							$cntTraveller = count($_POST['traverler']['nationality']);
						}

						for ($j = 0; $j < $cntTraveller; $j++)
						{
							?>
							<div class="travel_details_container" id="traveler_info_<?php echo $j; ?>">
								<h4 id="traveler_id_<?php echo $j; ?>">
									Traveler <?php echo $j + 1 ; ?>
									<?php if($j > 0): ?>
										<span onclick="removeTraverler(<?php echo $j; ?>)" > Remove Traveler <?php echo $j + 1 ; ?></span>
									<?php endif; ?>
								</h4>

								<div class="form-group row">
									<label for="traverler_nationality_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Nationality', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[nationality][]" id="traverler_nationality_<?php echo $j; ?>">
											<option value="" <?php echo (isset($_POST['traverler']['nationality'][$j]) == '') ? 'selected' : ''; ?>>Select Nationality</option>
											<option value="Belgium">Belgium</option>
											<option value="Denmark">Denmark</option>
											<option value="Germany">Germany</option>
											<option value="Finland">Finland</option>
											<option value="France">France</option>
											<option value="Netherlands">Netherlands</option>
											<option value="Norway">Norway</option>
											<option value="Austria">Austria</option>
											<option value="Slovakia">Slovakia</option>
											<option value="Spain">Spain</option>
											<option value="United Kingdom">United Kingdom</option>
											<option value="United States">United States</option>
											<option value="Sweden">Sweden</option>
											<option value="---" disabled="">------------------------------------------</option>
											<?php
											if(!empty(get_list_countries())){
												foreach(get_list_countries() as $country){?>
													<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['nationality'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
												<?php } } ?>
										</select>
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_first_name_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Full name', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" value="<?php echo isset($_POST['traverler']['full_name'][$j]) ? $_POST['traverler']['full_name'][$j] : ''; ?>" class="form-control" name="traverler[full_name][]" id="traverler_first_name_<?php echo $j; ?>" placeholder="<?php echo __( 'full name', 'visachild' ); ?>">
									</div>
								</div><!-- form-group -->

								<!-- <div class="form-group row">
									<label for="traverler_surname_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Surname', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['surname'][$j]) ? $_POST['traverler']['surname'][$j] : ''; ?>" name="traverler[surname][]" id="traverler_surname_<?php echo $j; ?>" placeholder="<?php echo __( 'Surname', 'visachild' ); ?>">
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_gender_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Sex', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[gender][]" id="traverler_gender_<?php echo $j; ?>">
											<option value="" <?php echo (isset($_POST['traverler']['gender'][$j]) == '') ? 'selected' : ''; ?>>Select gender</option>
											<option value="man" <?php echo (isset($_POST['traverler']['gender'][$j]) == 'male') ? 'selected' : ''; ?>>Male</option>
											<option value="woman" <?php echo (isset($_POST['traverler']['gender'][$j]) == 'female') ? 'selected' : ''; ?>>Female</option>
										</select>
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_marital_status_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Marital Status', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[marital_status][]" id="traverler_marital_status_<?php echo $j; ?>">
											<option value="" <?php echo (isset($_POST['traverler']['marital_status'][$j]) == '') ? 'selected' : ''; ?>>Select Marital Status</option>
											<option value="single" <?php echo (isset($_POST['traverler']['marital_status'][$j]) == 'single') ? 'selected' : ''; ?>>Single</option>
											<option value="married" <?php echo (isset($_POST['traverler']['marital_status'][$j]) == 'married') ? 'selected' : ''; ?>>Married</option>
											<option value="widowed " <?php echo (isset($_POST['traverler']['marital_status'][$j]) == 'widowed ') ? 'selected' : ''; ?>>Widowed</option>
										</select>
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_birth_place_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Place of Birth', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" value="<?php echo isset($_POST['traverler']['birth_place'][$j]) ? $_POST['traverler']['place_of_birth'][$j] : ''; ?>" class="form-control" name="traverler[place_of_birth][]" id="traverler_place_of_birth_<?php echo $j; ?>">
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_date_birth_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Date of birth', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['date_birth'][$j]) ? $_POST['traverler']['date_birth'][$j] : ''; ?>" name="traverler[date_birth][]" id="traverler_date_birth_<?php echo $j; ?>" placeholder="<?php echo __( 'Date of birth', 'visachild' ); ?>">
									</div>
								</div><!-- form-group -->


								<div id="passport_info_section" class="form_seprationSection">
									<h3><?php echo __( 'Passport Details', 'visachild' ); ?></h3>
									<p><?php echo __( 'Enter your passport information below. For Dutch people, the document number is nine characters long and starts with a letter (N, B, A, D). The Dutch passport number contains both numbers and letters. For Belgians, the passport number is eight characters long. This has the form: XX999999 (two letters, six numbers).', 'visachild' ); ?></p>

									<div class="form-group row">
										<label for="traverler_document_number_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Document Number', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['document_number'][$j]) ? $_POST['traverler']['document_number'][$j] : ''; ?>" class="form-control" name="traverler[document_number][]" id="traverler_document_number_<?php echo $j; ?>" placeholder="<?php echo __( 'Document Number', 'visachild' ); ?>">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_place_of_issue_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Place of Issue', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['place_of_issue'][$j]) ? $_POST['traverler']['place_of_issue'][$j] : ''; ?>" class="form-control" name="traverler[place_of_issue][]" id="traverler_place_of_issue_<?php echo $j; ?>" placeholder="<?php echo __( 'Place of Issue', 'visachild' ); ?>">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_release_date_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Release Date', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['release_date'][$j]) ? $_POST['traverler']['release_date'][$j] : ''; ?>" name="traverler[release_date][]" id="traverler_release_date_<?php echo $j; ?>" placeholder="<?php echo __( 'Release Date', 'visachild' ); ?>">
											<span class="validate_error"><?php echo isset($arrivalErr) ? $arrivalErr : ''; ?></span>
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_expiration_date_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Expiration Date', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['expiration_date'][$j]) ? $_POST['traverler']['expiration_date'][$j] : ''; ?>" name="traverler[expiration_date][]" id="traverler_expiration_date_<?php echo $j; ?>" placeholder="<?php echo __( 'Expiration Date', 'visachild' ); ?>">
											<span class="validate_error"><?php echo isset($arrivalErr) ? $arrivalErr : ''; ?></span>
										</div>
									</div><!-- form-group -->
								</div>

								<div id="work_info_section" class="form_seprationSection">
									<h3><?php echo __( 'Work', 'visachild' ); ?></h3>
									<p><?php echo __( 'Enter the details regarding your work or profession below. If you are a student or housewife / husband, select this by profession and then enter the details of your father or partner at the employer.' ); ?></p>

									<div class="form-group row">
										<label for="traverler_work_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Work', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[work][]" id="traverler_work">
												<option value="professional" <?php echo (isset($_POST['traverler']['work'][$j]) == 'professional') ? 'selected' : ''; ?>>Professional</option>
												<option value="professional" <?php echo (isset($_POST['traverler']['work'][$j]) == 'professional') ? 'selected' : ''; ?>>Professional</option>
												<option value="goverment" <?php echo (isset($_POST['traverler']['work'][$j]) == 'goverment') ? 'selected' : ''; ?>>Goverment</option>
												<option value="sale" <?php echo (isset($_POST['traverler']['work'][$j]) == 'sale') ? 'selected' : ''; ?>>Sale</option>
												<option value="student" <?php echo (isset($_POST['traverler']['work'][$j]) == 'student') ? 'selected' : ''; ?>>Student</option>
												<option value="housewife" <?php echo (isset($_POST['traverler']['work'][$j]) == 'housewife') ? 'selected' : ''; ?>>Housewife</option>
												<option value="retired" <?php echo (isset($_POST['traverler']['work'][$j]) == 'retired') ? 'selected' : ''; ?>>Retired</option>
												<option value="umemployed/no work" <?php echo (isset($_POST['traverler']['work'][$j]) == 'umemployed/no work') ? 'selected' : ''; ?>>Unemployed / No Work</option>
												<option value="other" <?php echo (isset($_POST['traverler']['work'][$j]) == 'other') ? 'selected' : ''; ?>>Other</option>
											</select>
										</div>
									</div><!-- form-group -->
									<div class="work-info">
										<div class="form-group row">
											<label for="traverler_name_of_employer_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Name of Employer' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['name_of_employer'][$j]) ? $_POST['traverler']['name_of_employer'][$j] : ''; ?>" class="form-control" name="traverler[name_of_employer][]" id="traverler_name_of_employer_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->
										<div class="form-group row">
											<label for="traverler_work_address<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Address', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['work_address'][$j]) ? $_POST['traverler']['work_address'][$j] : ''; ?>" class="form-control" name="traverler[work_address][]" id="traverler_work_address_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->
										<div class="form-group row">
											<label for="traverler_employer_zipcode<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Employer Zip Code', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['employer_zipcode'][$j]) ? $_POST['traverler']['employer_zipcode'][$j] : ''; ?>" class="form-control" name="traverler[employer_zipcode][]" id="traverler_employer_zipcode_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->
										<div class="form-group row">
											<label for="traverler_employer_place<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Place', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['employer_place'][$j]) ? $_POST['traverler']['employer_place'][$j] : ''; ?>" class="form-control" name="traverler[employer_place][]" id="traverler_employer_place_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->
										<div class="form-group row">
											<label for="traverler_employer_phone<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Phone', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['employer_phone'][$j]) ? $_POST['traverler']['employer_phone'][$j] : ''; ?>" class="form-control" name="traverler[employer_phone][]" id="traverler_employer_phone_<?php echo $j; ?>"  placeholder="+316123456789">
											</div>
										</div><!-- form-group -->

									</div>
								</div>

							</div> <!-- traveler_info -->

						<?php } ?>


						<div class="add_travelers-section" id="add_travelers-section">
							<span id="add_traverl_info_button" class="btn btn-full-width btn-primary" data-total="<?php echo $cntTraveller; ?>">
								<i class="fa fa-user-plus" aria-hidden="true"></i>  Add a traveler
							</span>
						</div> <!-- add_travelers-section -->
					</div> <!-- visa_travel_details-information -->

					<div id="visa_form_submit_section" class="visa_form_submit_section form_seprationSection">
						<button type="submit" class="btn btn-conv" data-nonce="<?php echo $indonesia_nonce; ?>">
							<span>Apply for visas</span><i class="fa fa-angle-right" aria-hidden="true"></i>
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-4 matlassidebar mequalheight">
			<div class="wrapper">
				<div class="flag-section">
					<img style="display: inline-block; width: 150px" src="<?php echo get_stylesheet_directory_uri().'/Flags/Indonesia-Flag-icon.png'; ?>">
					<h2 style="display: inline-block; font-size: 25px; ">Visum Indonesia</h2>
				</div>
				<div class="content">
					<div id="visum">
						<p><b>Visum: </b> Indonesia Tourism</p>
					</div>
					<div id="duration">
						<p><b>Duration: </b>31 to 60 Days </p>
					</div>
					<div id="price">
						<p><b>Price: </b> € 89.95</p>
					</div>
					<div id="FactSheet">
						<p><a href="<?php the_field('factsheet'); ?>" target="_blank">Download PDF</a></p>
					</div>
				</div>
				<div class="more-info">
					<p class="introduction">
						<font style="vertical-align: inherit;">
							Do you need help filling in a certain field?<br>
							For some fields there is alreay an explanation given.
							If you need further assistance, please <b>contact us</b>.
						</font>
					</p>
					<p><span><i class="fa fa-phone"></i> +31 (0) 23 - 221 00 04</span></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer();
?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var old_price = '';

		if ($('#purpose').val() == "Business") {
				$('#visum').html('<p><b>Visum: </b> Indonesia Business</p>');
				$('#duration').html('<p><b>Duration: </b> Maximum 60 days</p>');
				$('#price').html('<p><b>Price: </b> € 99,95</p>');
				$('.tourism_duration').hide();
				$('#duration_option').val('maximum 60 days');
				$('.duration-31-60').hide();
				$('#visa_modal').modal('show');

			}
			else {
				$('#visum').html('<p><b>Visum: </b> Indonesia Tourism</p>');
				$('#duration_option').val('31 to 60 days');
				$('.tourism_duration').show();
				if ($('#duration_option').val() ==  '1 to 30 days') {
					$('#duration').html('<p><b>Duration: </b> 1 to 30 days</p>');
					$('#price').html('<p><b>Price: </b> No visum required</p>');
					$('.duration-31-60').hide();

				}
				if ($('#duration_option').val() ==  '31 to 60 days'){
					$('#duration').html('<p><b>Duration: </b> 31 to 60 days</p>');
					$('#price').html('<p><b>Price: </b> € 89.95</p>');
					$('.duration-31-60').show();
				}
			}

		$('#purpose').change(function() {
			var purpose = $('#purpose').val();

			if (purpose == 'Tourism') {
				$('#purpose_modal .modal-title').html('<b>Are you sure to change to Tourism purpose?</b>');
			}

			else {
				$('#purpose_modal .modal-title').html('<b>Are you sure to change to Business purpose?</b>');
			}

			$('#purpose_modal').modal('show');
		});

		$('#change_purpose_btn').click(function() {
			if ($('#purpose').val() == "Business") {
				newselectedValue = "Business";
				$('#purpose').val( newselectedValue );
				$('#visum').html('<p><b>Visum: </b> Indonesia '+ newselectedValue +'</p>');
				$('#duration').html('<p><b>Duration: </b> Maximum 60 days</p>');
				$('#price').html('<p><b>Price: </b> No visum required</p>');
				$('.tourism_duration').hide();
				$('#duration_option').val('maximum 60 days');
				$('.duration-31-60').hide();
				$('#visa_modal').modal('show');

			}
			else {
				newselectedValue = "Tourism";
				$('#purpose').val( newselectedValue );
				$('#visum').html('<p><b>Visum: </b> Indonesia '+ newselectedValue +'</p>');
				$('#duration_option').val('31 to 60 days');
				$('.tourism_duration').show();
				if ($('#duration_option').val() ==  '1 to 30 days') {
					$('#duration').html('<p><b>Duration: </b> 1 to 30 days</p>');
					$('#price').html('<p><b>Price: </b> No visum required</p>');
					$('.duration-31-60').hide();

				}
				if ($('#duration_option').val() ==  '31 to 60 days'){
					$('#duration').html('<p><b>Duration: </b> 31 to 60 days</p>');
					$('#price').html('<p><b>Price: </b> € 89.95</p>');
					$('.duration-31-60').show();
				}
			}

			$('#purpose_modal').modal('hide');
			// $('.visa_form_submit')[0].reset();

		});

		$('#cancel_purpose_btn').click(function() {
			if ($('#purpose').val() == "Business") {
				$('#purpose').val('Tourism');
			}
			else{
				$('#purpose').val('Business');
			}
		});

		$("#duration_option").change(function(){
			if ($('#duration_option').val() ==  '1 to 30 days') {
				if ($('#purpose').val() == 'Tourism') {
					$('#duration').html('<p><b>Duration: </b> 1 to 30 days</p>');
					$('#price').html('<p><b>Price: </b> No visum required</p>');
					$('#visa_modal').modal('show');
					$('.duration-31-60').hide();
				}
			}
			if ($('#duration_option').val() ==  '31 to 60 days'){
				if ($('#purpose').val() == 'Tourism') {
					$('#duration').html('<p><b>Duration: </b> 31 to 60 days</p>');
					$('#price').html('<p><b>Price: </b> € 69.95</p>');
					$('.duration-31-60').show();

				}
			}
			old_price = $('#price').text().split('€');
		});

		$(document).on('change', '#shipping_method', function(event) {
			updatePrice();
		});

		$(document).on('change', '#return_method', function(event) {
			updatePrice();
		});

		function updatePrice(){
			var shipping_method = 0;
			var return_method = 0;
			var old_price = 89.95;
			var price = 0;

			shipping_method = $('#shipping_method'). children("option:selected").data('price');

			return_method = $('#return_method'). children("option:selected").data('price');
			price = parseFloat(old_price) + parseFloat(shipping_method) + parseFloat(return_method);

			$('#price').html('<p><b>Price: </b> € '+price.toFixed(2)+'</p>');
		}
	});
</script>
