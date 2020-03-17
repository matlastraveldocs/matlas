<?php
/**
* Template Name: New zealand Visa Form
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/

$newzealand_nonce = wp_create_nonce('newzealand_form_nonce');
$formSubmit = '';
$cntTraveller = 1;
$redirectURL = 'http://traveldocs.developstaging.com/thank-you/';
$isError = false;
if (isset($_GET['purpose']) && $_GET['purpose'] != '') {
	$visa_purpose = ucfirst($_GET['purpose']);
}
if(!empty($_POST)) {
	$formSubmit = newzealand_form_submit_new($_POST);
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
	<div class="row backgrouddark">
		<div class="col-md-8 matlasform mequalheight"  id="matlascontent" >
			<form method="post" id="newzealand_visa_form" class="visa_form_submit" enctype="multipart/form-data">
				<div id="visa_travel-information" class="form_seprationSection">
					<h3><?php echo __( 'Travel details', 'visachild' ); ?></h3>

					<div class="form-group row">
						<label for="destination_country" class="vc_col-md-3 col-form-label"><?php echo __( 'Destination', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="text" class="form-control" value="New Zealand" name="destination_country" id="destination_country" readonly="true">
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
							<select name="purpose" id="purpose">
								<option value="Tourism" <?php echo (isset($visa_purpose) == 'Tourism') ? 'selected' : ''; ?>><?php echo __('Tourism', 'visachild') ?></option>
								<option value="Business" <?php echo (isset($visa_purpose) == 'Business') ? 'selected' : ''; ?>><?php echo __('Business', 'visachild') ?></option>
							</select>
							<span class="validate_error"><?php echo isset($purposeErr) ? $purposeErr : ''; ?></span>
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
					</div><!-- form-group -->
				</div> <!-- End travel info -->

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
						<label for="telephone_number" class="vc_col-md-3 col-form-label"><?php echo __( 'Telephone Number', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="phone" class="form-control" value="<?php echo isset($telephone) ? $telephone : ''; ?>" name="telephone_number" id="telephone_number"  placeholder="+316123456789">
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
						<label for="province" class="vc_col-md-3 col-form-label"><?php echo __( 'Province', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="text" class="form-control" value="<?php echo isset($province_name) ? $province_name : ''; ?>" name="province" id="province" placeholder="<?php echo __( 'Province', 'visachild' ); ?>">
							<span class="validate_error"><?php echo isset($provinceErr) ? $provinceErr : ''; ?></span>
						</div>
					</div><!-- form-group -->
				</div> <!-- visa_adres-information -->

				<div id="order_details" class="form_seprationSection">

					<h3><?php echo __( 'Order details', 'visachild' ); ?></h3>
					<p><?php echo __( 'Enter the general details of the application below. You enter this information only once and apply to all travelers in this application.' ); ?></p>
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
								<label for="traverler_gender_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Sex', 'visachild' ); ?></label>
								<div class="vc_col-md-9">
									<select name="traverler[gender][]" id="traverler_gender_<?php echo $j; ?>">
										<option value="" <?php echo (isset($_POST['traverler']['gender'][$j]) == '') ? 'selected' : ''; ?>>Select gender</option>
										<option value="man" <?php echo (isset($_POST['traverler']['gender'][$j]) == 'man') ? 'selected' : ''; ?>>Man</option>
										<option value="woman" <?php echo (isset($_POST['traverler']['gender'][$j]) == 'woman') ? 'selected' : ''; ?>>Woman</option>
										<option value="gender_diverse" <?php echo (isset($_POST['traverler']['gender'][$j]) == 'gender_diverse') ? 'selected' : ''; ?>>Gender Diverse</option>
									</select>
								</div>
							</div><!-- form-group -->

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
								<label for="traverler_first_name_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'First name', 'visachild' ); ?></label>
								<div class="vc_col-md-9">
									<input type="text" value="<?php echo isset($_POST['traverler']['first_name'][$j]) ? $_POST['traverler']['first_name'][$j] : ''; ?>" class="form-control" name="traverler[first_name][]" id="traverler_first_name_<?php echo $j; ?>" placeholder="<?php echo __( 'First name', 'visachild' ); ?>">
								</div>
							</div><!-- form-group -->

							<div class="form-group row">
								<label for="traverler_surname_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Surname', 'visachild' ); ?></label>
								<div class="vc_col-md-9">
									<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['surname'][$j]) ? $_POST['traverler']['surname'][$j] : ''; ?>" name="traverler[surname][]" id="traverler_surname_<?php echo $j; ?>" placeholder="<?php echo __( 'Surname', 'visachild' ); ?>">
								</div>
							</div><!-- form-group -->

							<div class="form-group row">
								<label for="traverler_country_of_birth_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Country Of Birth', 'visachild' ); ?></label>
								<div class="vc_col-md-9">
									<select name="traverler[country_of_birth][]" id="traverler_country_of_birth_<?php echo $j; ?>">
										<option value="" <?php echo (isset($_POST['traverler']['country_of_birth'][$j]) == '') ? 'selected' : ''; ?>>Select Country Of Birth</option>
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
											<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['country_of_birth'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
										<?php } } ?>
									</select>
								</div>
							</div><!-- form-group Country of Birth-->

							<div class="form-group row">
								<label for="traverler_place_of_birth_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Place Of Birth', 'visachild' ); ?></label>
								<div class="vc_col-md-9">
									<input type="text" value="<?php echo isset($_POST['traverler']['place_of_birth'][$j]) ? $_POST['traverler']['place_of_birth'][$j] : ''; ?>" class="form-control" name="traverler[place_of_birth][]" id="traverler_place_of_birth_<?php echo $j; ?>" placeholder="<?php echo __( 'Place of Birth', 'visachild' ); ?>">
								</div>
							</div><!-- form-group -->

							<div class="form-group row">
								<label for="traverler_date_birth_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Date of birth', 'visachild' ); ?></label>
								<div class="vc_col-md-9">
									<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['date_birth'][$j]) ? $_POST['traverler']['date_birth'][$j] : ''; ?>" name="traverler[date_birth][]" id="traverler_date_birth_<?php echo $j; ?>" placeholder="<?php echo __( 'Date of birth', 'visachild' ); ?>">
								</div>
							</div><!-- form-group -->

							<div id="official_alias_section" class="form_seprationSection" >
								<h3><?php echo __( 'Official Alias', 'visachild' ); ?></h3>
								<p><?php echo __( 'Indicate whether you are known by other names or aliases by selecting yes or no. Only official names must be entered. If you are known by an alternative name, enter both the alternative first and last name. If you do not have an alternate first name, but do have an alternate last name, enter FNU for the first name, which means unknown first name. You can enter up to two alternative first and last names. Do you have more than two official names? Please contact us.' ); ?>
								</p>
								<div class="form-group row">
									<label for="traverler_official_alias_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Official Alias', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[official_alias][]" id="traverler_alias">
											<option value="Yes" <?php echo (isset($_POST['traverler']['official_alias'][$j]) == 'Yes') ? 'selected' : ''; ?>>Yes</option>
											<option value="No" <?php echo (isset($_POST['traverler']['official_alias'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group -->
								<div class="official_alias_info">
									<div class="form-group row">
										<label for="traverler_official_alias_first_name" class="vc_col-md-3 col-form-label"><?php echo __( 'First Name', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['official_alias_first_name'][$j]) ? $_POST['traverler']['official_alias_first_name'][$j] : ''; ?>" name="traverler[official_alias_first_name][]" id="traverler_official_alias_first_name">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_official_alias_last_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Last Name', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['official_alias_last_name'][$j]) ? $_POST['traverler']['official_alias_last_name'][$j] : ''; ?>" name="traverler[official_alias_last_name][]" id="traverler_official_alias_last_name">
										</div>
									</div><!-- form-group -->
								</div>
							</div>

							<div id="passport_info_section" class="form_seprationSection">
								<h3><?php echo __( 'Passport details', 'visachild' ); ?></h3>
								<p><?php echo __( 'Enter your passport information below. For Dutch people, the document number is nine characters long and starts with a letter (N, B, A, D). The Dutch passport number contains both numbers and letters. For Belgians, the passport number is eight characters long. This has the form: XX999999 (two letters, six numbers).', 'visachild' ); ?></p>

								<div class="form-group row">
									<label for="traverler_delivery_country_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Delivery Country', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[delivery_country][]" id="traverler_delivery_country_<?php echo $j; ?>">
											<option value="" <?php echo (isset($_POST['traverler']['delivery_country'][$j]) == '') ? 'selected' : ''; ?>>Select Nationality</option>
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
													<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['delivery_country'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
											<?php } } ?>
										</select>
									</div>
								</div><!-- form-group Passport Delivery Country -->

								<div class="form-group row">
									<label for="traverler_document_number_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Document Number', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" value="<?php echo isset($_POST['traverler']['document_number'][$j]) ? $_POST['traverler']['document_number'][$j] : ''; ?>" class="form-control" name="traverler[document_number][]" id="traverler_document_number_<?php echo $j; ?>" placeholder="<?php echo __( 'Document Number', 'visachild' ); ?>">
									</div>
								</div><!-- form-group Document Number -->

								<div class="form-group row">
									<label for="traverler_release_date_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Release Date', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['release_date'][$j]) ? $_POST['traverler']['release_date'][$j] : ''; ?>" name="traverler[release_date][]" id="traverler_release_date_<?php echo $j; ?>" placeholder="<?php echo __( 'Release Date', 'visachild' ); ?>">
										<span class="validate_error"><?php echo isset($arrivalErr) ? $arrivalErr : ''; ?></span>
									</div>
								</div><!-- form-group Release Date -->

								<div class="form-group row">
									<label for="traverler_expiration_date_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Expiration Date', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['expiration_date'][$j]) ? $_POST['traverler']['expiration_date'][$j] : ''; ?>" name="traverler[expiration_date][]" id="traverler_expiration_date_<?php echo $j; ?>" placeholder="<?php echo __( 'Expiration Date', 'visachild' ); ?>">
										<span class="validate_error"><?php echo isset($arrivalErr) ? $arrivalErr : ''; ?></span>
									</div>
								</div><!-- form-group Expiration Date -->

								<div class="form-group row">
									<label for="traverler_citizen_service_number_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Citizen Service Number (Citizen Service Number)', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['citizen_service_number'][$j]) ? $_POST['traverler']['citizen_service_number'][$j] : ''; ?>" name="traverler[citizen_service_number][]" id="traverler_citizen_service_number_<?php echo $j; ?>">
										<span class="validate_error"><?php echo isset($csnErr) ? $csnErr : ''; ?></span>
									</div>
								</div><!-- form-group Expiration Date -->
							</div>

							<div id="question_section" class="form_seprationSection">
								<h3><?php echo __( 'Questions', 'visachild' ); ?></h3>
								<p><?php echo __( 'You must answer the questions below truthfully. Explanation for the fields:' ); ?>
									<ul>
										<li>Medical: state here whether you are traveling for medical reasons</li>
										<li>Plotted other: state here whether you have been plotted in any country other than New Zealand</li>
										<li>Expelled: indicate here whether you have ever been refused entry to New Zealand or whether you have ever been expelled</li>
										<li>Convicted: state here whether you have ever been convicted</li>
									</ul>
								</p>

								<div class="form-group row">
									<label for="traverler_medical_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Medical', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[medical][]" id="traverler_medical">
											<option value="" <?php echo (isset($_POST['traverler']['medical'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['medical'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Medical -->

								<div class="form-group row">
									<label for="traverler_plotted_other_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Plotted Other', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[plotted_other][]" id="traverler_plotted_other">
											<option value="" <?php echo (isset($_POST['traverler']['plotted_other'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['plotted_other'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Ploted Other -->

								<div class="form-group row">
									<label for="traverler_disabled_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Disabled', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[disabled][]" id="traverler_disabled">
											<option value="" <?php echo (isset($_POST['traverler']['disabled'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['disabled'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Disabled -->

								<div class="form-group row">
									<label for="traverler_convicted_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Convicted', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[convicted][]" id="traverler_convicted">
											<option value="" <?php echo (isset($_POST['traverler']['convicted'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['convicted'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Ploted Other -->
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
					<button type="submit" class="btn btn-conv" data-nonce="<?php echo $newzealand_nonce; ?>">
						<span>Apply for visas</span><i class="fa fa-angle-right" aria-hidden="true"></i>
					</button>
				</div>
			</form>
		</div>
		<div class="col-md-4 matlassidebar mequalheight">
			<div class="wrapper">
				<div class="flag-section">
					<img style="display: inline-block; width: 150px" src="<?php echo get_stylesheet_directory_uri().'/Flags/new-zealand-flag.png'; ?>">
					<h2 style="display: inline-block; font-size: 25px; ">Visum New Zealand</h2>
				</div>
				<div class="content">
					<div id="visum">
						<p><b>Visum: </b> New Zealand Tourism</p>
					</div>
					<div id="duration">
						<p><b>Duration: </b>90 days per visit </p>
					</div>
					<div id="price">
						<p><b>Price: </b> € 39.95</p>
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

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var old_price = '';

		if ($('#purpose').val() == "Business") {
				$('#visum').html('<p><b>Visum: </b> New Zealand Business</p>');
				$('#duration').html('<p><b>Duration: </b> 90 days per visit</p>');
				$('#price').html('<p><b>Price: </b> € 70.97</p>');

			}
			else {
				$('#visum').html('<p><b>Visum: </b> New Zealand Tourism</p>');
					$('#duration').html('<p><b>Duration: </b> 90 days per visit</p>');
					$('#price').html('<p><b>Price: </b> € 39.95</p>');
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
				$('#visum').html('<p><b>Visum: </b> New Zealand '+ newselectedValue +'</p>');
				$('#duration').html('<p><b>Duration: </b> 90 days per visit</p>');
				$('#price').html('<p><b>Price: </b> €  70.97</p>');

			}
			else {
				newselectedValue = "Tourism";
				$('#purpose').val( newselectedValue );
				$('#visum').html('<p><b>Visum: </b> New Zealand '+ newselectedValue +'</p>');
				$('#duration').html('<p><b>Duration: </b> 90 days per visit</p>');
				$('#price').html('<p><b>Price: </b> € 39.95</p>');
			}

			$('#purpose_modal').modal('hide');

		});

		$('#cancel_purpose_btn').click(function() {
			if ($('#purpose').val() == "Business") {
				$('#purpose').val('Tourism');
			}
			else{
				$('#purpose').val('Business');
			}
		});

		$(document).on('change','#traverler_alias',function(event) {
			$(this).parent().parent().siblings('.official_alias_info').toggleClass('hidden');
		});
	});
</script>
<?php get_footer();
?>
