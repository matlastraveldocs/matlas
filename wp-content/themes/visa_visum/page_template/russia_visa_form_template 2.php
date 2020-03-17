<?php
/**
* Template Name: Russia Visa Form
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/

$russia_nonce = wp_create_nonce('russia_form_nonce');
$formSubmit = '';
$cntTraveller = 1;
$cntIntended = 1;
$cntplaces = 1;
$redirectURL = 'http://traveldocs.developstaging.com/thank-you/';
$isError = false;
if (isset($_GET['purpose']) && $_GET['purpose'] != '') {
	$visa_purpose = $_GET['purpose'];
}
if(!empty($_POST)) {
	if ($_POST['duration'] == '1 t/m 8 days') {
		$_POST['invitation_letter'] = '';
		$cntTraveller = count($_POST['traverler']['nationality']);

		for ($j = 0; $j < $cntTraveller; $j++) {

			$target_dir_passport_data = ABSPATH."wp-content/uploads/Russia/passport_data/";

			$target_dir_passport_photo = ABSPATH."wp-content/uploads/Russia/passport_photo/";

			$target_file_passport_data = $target_dir_passport_data . basename($_FILES['traverler']['name']['passport_data'][$j]);

			$target_file_passport_photo = $target_dir_passport_photo . basename($_FILES['traverler']['name']['passport_photo'][$j]);

			$passport_data_file_name = explode('.', $_FILES['traverler']['name']['passport_data'][$j]);

			$passport_photo_file_name = explode('.', $_FILES['traverler']['name']['passport_photo'][$j]);

			$uploadOk = 1;
			$imageFileType_passport_data = strtolower(pathinfo($target_file_passport_data,PATHINFO_EXTENSION));

			$imageFileType_passport_photo = strtolower(pathinfo($target_file_passport_photo,PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$passport_data_check = getimagesize($_FILES['traverler']['tmp_name']['passport_data'][$j]);

				$passport_photo_check = getimagesize($_FILES['traverler']['tmp_name']['passport_photo'][$j]);
				if($passport_data_check !== false && $passport_photo_check !== false) {
					$uploadOk = 1;
				} else {
					$error = "File is not an image.";
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file_passport_data)) {
				$error = "Sorry, Passport Data file already exists.";
				$uploadOk = 0;
			}
			if (file_exists($target_file_passport_photo)) {
				$error = "Sorry, Passport Photo file already exists.";
				$uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType_passport_data != "jpg" && $imageFileType_passport_data != "png" && $imageFileType_passport_data != "jpeg" && $imageFileType_passport_photo != "jpg" && $imageFileType_passport_photo != "png" && $imageFileType_passport_photo != "jpeg") {
				$error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$error = "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				$passport_data_new_name = $target_dir_passport_data .basename($_POST['traverler']['full_name'][$j]).basename($_POST['traverler']['document_number'][$j]).'.'.$passport_data_file_name[1];

				$passport_photo_new_name = $target_dir_passport_photo.basename($_POST['traverler']['full_name'][$j]).basename($_POST['traverler']['document_number'][$j]).'.'.$passport_data_file_name[1];

				if (move_uploaded_file($_FILES['traverler']['tmp_name']['passport_data'][$j], $passport_data_new_name)) {
					$_POST['traverler']['passport_data'][$j] =  get_home_url() .'/wp-content/uploads/Russia/passport_data/'.basename($_POST['traverler']['full_name'][$j].basename($_POST['traverler']['document_number'][$j]).'.'.$passport_data_file_name[1]);
				} else {
					$error = "Sorry, there was an error uploading your file.";
				}

				if (move_uploaded_file($_FILES['traverler']['tmp_name']['passport_photo'][$j], $passport_photo_new_name)) {
					$_POST['traverler']['passport_photo'][$j] =  get_home_url() .'/wp-content/uploads/Russia/passport_photo/'.basename($_POST['traverler']['full_name'][$j].basename($_POST['traverler']['document_number'][$j]).'.'.$passport_photo_file_name[1]);
				} else {
					$error = "Sorry, there was an error uploading your file.";
				}
			}
		}
	}
	else{
		$cntTraveller = count($_POST['traverler']['nationality']);

		for ($j = 0; $j < $cntTraveller; $j++) {
			$_POST['traverler']['passport_data'][$j] = '';
			$_POST['traverler']['passport_photo'][$j] = '';
		}
	}
	/*echo "<pre>";
	print_r($_POST['form_fees']);
	echo "</pre>";
	die();*/
	$formSubmit = russia_form_submit_new($_POST);
	//wp_redirect( $redirectURL );
	if(isset($_POST['form_fees']) && $_POST['form_fees'] != ''){
		matlaspayment($_POST['form_fees'],$redirectURL);
	}
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
			<form method="post" class="visa_form_submit" enctype="multipart/form-data">
				<div id="visa_travel-information" class="form_seprationSection">
					<h3><?php echo __( 'Travel details', 'visachild' ); ?></h3>

					<div class="form-group row">
						<label for="destination_country" class="vc_col-md-3 col-form-label"><?php echo __( 'Destination', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="text" class="form-control" value="Russia" name="destination_country" id="destination_country" readonly="true">
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
										<option value="<?php echo $country->country_code;?>" <?php echo 'NL' == $country->country_code ? 'selected' : ''; ?>><?php echo icl_t('visachild', $country->name, $country->name);?></option>
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
										<button type="button" class="btn btn-info" data-dismiss="modal" id="cancel_purpose_btn">Cancel</button>
										<button type="button" class="btn btn-success" id="change_purpose_btn">Yes proceed</button>
									</div>
								</div>
							</div>
						</div> <!-- Modal -->
					</div><!-- form-group -->

					<div class="form-group row">
						<label for="duration" class="vc_col-md-3 col-form-label"><?php echo __( 'Duration', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<select name="duration" id="duration_option">
								<option value="1 t/m 8 days" <?php echo (isset($duration) == '1 t/m 8 days') ? 'selected' : ''; ?>><?php echo __('1 t/m 8 days', 'visachild') ?></option>
								<option value="9 t/m 30 days" <?php echo (isset($duration) == '9 t/m 30 days') ? 'selected' : ''; ?>><?php echo __('9 t/m 30 days', 'visachild') ?></option>
							</select>
							<p><?php echo __( 'If you have a different destination, select 9 to 30 days alongside', 'visachild' ); ?></p>
							<span class="validate_error"><?php echo isset($durationErr) ? $durationErr : ''; ?></span>
						</div>
					</div><!-- form-group -->
				</div> <!-- End travel info -->


					<div class="tourism-form"></div>
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
								<input type="phone" class="form-control" value="<?php echo isset($telephone) ? $telephone : ''; ?>" name="telephone" id="telephone"  placeholder="+316123456789">
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
						<div class="duration-1-8">
							<p><?php echo __( 'Enter the details about your trip here.', 'visachild' ); ?></p>
						</div>
						<div class="duration-9-30 hidden">
							<p><?php echo __( 'Enter the date on which you are leaving from Russia below . This is therefore the date on which you leave Russia.', 'visachild' ); ?></p>
							<div class="form-group row">
								<label for="return_date" class="vc_col-md-3 col-form-label"><?php echo __( 'Return date', 'visachild' ); ?></label>
								<div class="vc_col-md-9">
									<input type="date" class="form-control" value="<?php echo isset($return_date) ? $return_date : ''; ?>" name="return_date" id="return_date" placeholder="<?php echo __( 'Return Date', 'visachild' ); ?>">
									<span class="validate_error"><?php echo isset($returnErr) ? $returnErr : ''; ?></span>
								</div>
							</div><!-- form-group -->
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
									    <option value="" <?php echo (isset($Return_method) == '') ? 'selected' : ''; ?>>
									        Select Return Method ...
									    </option>
										<option value="AVIA15" <?php echo (isset($Return_method) == 'AVIA15') ? 'selected' : ''; ?>>
									    	Avia partner desk before 3:00 PM (€ 47.50)
										</option>
										<option value="AVIA20" <?php echo (isset($Return_method) == 'AVIA20') ? 'selected' : ''; ?>>
										    Avia partner desk before 8:00 PM (€ 47.50)
										</option>
										<option value="DHL" <?php echo (isset($Return_method) == 'DHL') ? 'selected' : ''; ?>>
										    DHL guaranteed 2 days (€ 17.95)
										</option>
										<option value="DC" <?php echo (isset($Return_method) == 'DC') ? 'selected' : ''; ?>>
										    Direct courier (on request)
										</option>
										<option value="INTERNATIONAL" <?php echo (isset($Return_method) == 'INTERNATIONAL') ? 'selected' : ''; ?>>
										    International courier (on request)
										</option>
										<option value="OC12" <?php echo (isset($Return_method) == 'OC12') ? 'selected' : ''; ?>>
										    Courier next day before 12:00 (€ 50.00)
										</option>
										<option value="OC17" <?php echo (isset($Return_method) == 'OC17') ? 'selected' : ''; ?>>
										    Courier next day before 17:00 (€ 33.00)
										</option>
										<option value="PICKUP" <?php echo (isset($Return_method) == 'PICKUP') ? 'selected' : ''; ?>>
										    Pick up yourself in Hoofddorp
										</option>
									</select>
									<span class="validate_error"><?php echo isset($ReturnErr) ? $ReturnErr : ''; ?></span>
								</div>
							</div><!-- form-group -->
							<h3><?php echo __( 'Accomodation', 'visachild' ); ?></h3>
							<p><?php echo __( 'Enter the details below for your stay in Russia. You must enter the name of your hotel (if tourism) or the company you visit (business). You must also specify the relevant address and the places that you are going to visit in Russia.', 'visachild' ); ?></p>

							<div class="form-group row">
								<label for="hotel_company_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Name of Hotel / Company', 'visachild' ); ?></label>
								<div class="vc_col-md-9">
									<input type="text" class="form-control" value="<?php echo isset($hotel_name) ? $hotel_name : ''; ?>" name="hotel_company_name" id="hotel_company_name">
								</div>
							</div><!-- form-group -->

							<div class="form-group row">
								<label for="hotel_company_address" class="vc_col-md-3 col-form-label"><?php echo __( 'Hotel / Company Address', 'visachild' ); ?></label>
								<div class="vc_col-md-9">
									<input type="text" class="form-control" value="<?php echo isset($hotel_address) ? $hotel_name : ''; ?>" name="hotel_company_address" id="hotel_company_address">
								</div>
							</div><!-- form-group -->

							<div class="form-group row">
								<label for="hotel_company_place" class="vc_col-md-3 col-form-label"><?php echo __( 'place Hotel / Company', 'visachild' ); ?></label>
								<div class="vc_col-md-9">
									<input type="text" class="form-control" value="<?php echo isset($hotel_place) ? $hotel_place : ''; ?>" name="hotel_company_place" id="hotel_company_plalce">
								</div>
							</div><!-- form-group -->

							<h3><?php echo __( 'Places visit', 'visachild' ); ?></h3>
							<p><?php echo __( 'Enter the places you are going to visit below.', 'visachild' ); ?></p>
							<?php
							if(isset($_POST['place'])){
								$cntplaces = count($_POST['place']['place_name']);
							}

							for ($places_count = 0; $places_count < $cntplaces; $places_count++) {
								?>
								<div class="Places_visit_container travel_details_container" id="place_visit_<?php echo $places_count; ?>">
									<h4 id="place_id_<?php echo $places_count; ?>">
										Place <?php echo $places_count + 1 ; ?>
										<?php if($places_count > 0): ?>
											<span onclick="removePlace(<?php echo $j; ?>)" > Remove Place <?php echo $places_count + 1 ; ?></span>
										<?php endif; ?>
									</h4>
									<div class="form-group row">
										<label for="place_name_<?php echo $places_count; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Place Name', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['place']['place_name'][$places_count]) ? $_POST['place']['place_name'][$places_count] : ''; ?>" class="form-control" name="place[place_name][]" id="place_name_<?php echo $places_count; ?>">
										</div>
									</div><!-- form-group -->
								</div>
							<?php
							}
							?>
							<div class="add_place-section" id="add_place-section">
								<span id="add_place_info_button" class="btn btn-full-width btn-primary" data-total="<?php echo $cntplaces; ?>">
									<i class="fa fa-user-plus" aria-hidden="true"></i>  Add Place
								</span>
							</div> <!-- add_intended-section -->
						</div>
						<div class="duration-1-8">
							<h3><?php echo __( 'Area to visit', 'visachild' ); ?></h3>
							<p><?php echo __( 'Indicate here which area you are going to visit;Kaliningrad Oblast or St Petersburg and Leningrad Oblast.', 'visachild' ); ?></p>
							<div class="form-group row">
								<label for="area_1_to_8" class="vc_col-md-3 col-form-label"><?php echo __( 'Area', 'visachild' ); ?></label>
								<select name="area_1_to_8" id="area">
									<option value="" <?php echo (isset($area) == '') ? 'selected' : ''; ?>><?php echo __('', 'visachild') ?></option>
									<option value="Kaliningrad Oblast" <?php echo (isset($area) == 'Kaliningrad Oblast') ? 'selected' : ''; ?>><?php echo __('Kaliningrad Oblast', 'visachild') ?></option>
									<option value="St Petersburg and Leningrad Oblast" <?php echo (isset($area) == 'St Petersburg and Leningrad Oblast') ? 'selected' : ''; ?>><?php echo __('St Petersburg and Leningrad Oblast', 'visachild') ?></option>
								</select>
							</div>

							<h3><?php echo __( 'Intended residence (s) in the Russian Federation', 'visachild' ); ?></h3>
							<p><?php echo __( 'ndicate below where you are staying in Russia. You must specify each accommodation. Click on + to add an extra accommodation.', 'visachild' ); ?></p>

							<?php
							if(isset($_POST['intended_1_to_8'])){
								$cntIntended = count($_POST['intended_1_to_8']['name']);
							}

							for ($intended_count = 0; $intended_count < $cntIntended; $intended_count++) {
								?>
								<div class="Intended_residence_container travel_details_container" id="intended_info_<?php echo $intended_count; ?>">
									<h4 id="intended_id_<?php echo $intended_count; ?>">
										Intended <?php echo $intended_count + 1 ; ?>
										<?php if($intended_count > 0): ?>
											<span onclick="removeIntended(<?php echo $j; ?>)" > Remove Intended <?php echo $intended_count + 1 ; ?></span>
										<?php endif; ?>
									</h4>
									<div class="form-group row">
										<label for="intended_1_to_8_type_of_accomodation_<?php echo $intended_count; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Type of Accomodation', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="intended_1_to_8[type_of_accomodation][]" id="intended_type_of_accomodation_<?php echo $intended_count; ?>">
												<option value="" <?php echo (isset($_POST['intended_1_to_8']['type_of_accomodation'][$intended_count]) == '') ? 'selected' : ''; ?>>Select Type of Accomodation</option>
												<option value="Family member / Friends" <?php echo (isset($_POST['intended_1_to_8']['type_of_accomodation'][$intended_count]) == 'Family member / Friends') ? 'selected' : ''; ?>>Family member / Friends</option>
												<option value="Hotel" <?php echo (isset($_POST['intended_1_to_8']['type_of_accomodation'][$intended_count]) == 'Hotel') ? 'selected' : ''; ?>>Hotel</option>
											</select>
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="intended_1_to_8_name_<?php echo $intended_count; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Name', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['intended']['name'][$intended_count]) ? $_POST['intended']['name'][$intended_count] : ''; ?>" class="form-control" name="intended_1_to_8[name][]" id="intended_name_<?php echo $intended_count; ?>" placeholder="<?php echo __( 'Name', 'visachild' ); ?>">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="intended_1_to_8_address_<?php echo $intended_count; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Address', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['intended']['address'][$intended_count]) ? $_POST['intended']['address'][$intended_count] : ''; ?>" class="form-control" name="intended_1_to_8[address][]" id="intended_address_<?php echo $intended_count; ?>" placeholder="<?php echo __( 'Address', 'visachild' ); ?>">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="intended_1_to_8_number_<?php echo $intended_count; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Telephone Number', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['intended']['number'][$intended_count]) ? $_POST['intended_1_to_8']['number'][$intended_count] : ''; ?>" class="form-control" name="intended_1_to_8[number][]" id="intended_number_<?php echo $intended_count; ?>"  placeholder="+316123456789">
										</div>
									</div><!-- form-group -->


								</div> <!-- intended_info -->

							<?php } ?>
							<div class="add_intended-section" id="add_intended-section">
								<span id="add_intended_info_button" class="btn btn-full-width btn-primary" data-total="<?php echo $cntIntended; ?>">
									<i class="fa fa-user-plus" aria-hidden="true"></i>  Add Intended
								</span>
							</div> <!-- add_intended-section -->
						</div>
					</div>
					<div id="invitation_letter" class="form_seprationSection duration-9-30 hidden">
						<h3><?php echo __( 'Invitation letter', 'visachild' ); ?></h3>
						<p><?php echo __( 'An invitation letter is required for Russia. If you wish us to arrange this for you, then check the box below. The costs of the invitation letter are € 55 excluding VAT per person.', 'visachild' ); ?></p>

						<label for="invitation_letter" class="checkboxLabeled">
						  <input type="checkbox" name="invitation_letter" id="invitation_letter" style="display: inline-block;width: auto;height: auto;" value="Yes" class="visuallyhidden" <?php isset($invitation_letter) ? 'checked': ''; ?>>
						  <!-- <span class="fa fa-check check-mark"></span> -->
						  <span class="text"><?php echo __( 'Invitation Letter', 'visachild' ); ?></span>
						</label>
					</div>
					<div id="visa_travel_details-information" class="form_seprationSection">
						<h3><?php echo __( 'Traveler data', 'visachild' ); ?></h3>
						<p><?php echo __( 'Enter the details of all travelers, including yourself and accompanying children. Do you not have the details of all travelers at hand? It is also possible to submit individual applications per person.', 'visachild' ); ?></p>
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
									<label for="traverler_full_name_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Full name', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" value="<?php echo isset($_POST['traverler']['full_name'][$j]) ? $_POST['traverler']['full_name'][$j] : ''; ?>" class="form-control" name="traverler[full_name][]" id="traverler_full_name_<?php echo $j; ?>" placeholder="<?php echo __( 'Full name', 'visachild' ); ?>">
									</div>
								</div><!-- form-group -->

								<!-- <div class="form-group row">
									<label for="traverler_surname_<?php //echo $j; ?>" class="vc_col-md-3 col-form-label"><?php// echo __( 'Surname', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" class="form-control" value="<?php //echo isset($_POST['traverler']['surname'][$j]) ? $_POST['traverler']['surname'][$j] : ''; ?>" name="traverler[surname][]" id="traverler_surname_<?php //echo $j; ?>" placeholder="<?php// echo __( 'Surname', 'visachild' ); ?>">
									</div>
								</div> -->

								<div class="form-group row">
									<label for="traverler_birth_country_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Country Of Birth', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[birth_country][]" id="traverler_birth_country_<?php echo $j; ?>">
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
											<option value="" <?php echo (isset($_POST['traverler']['birth_country'][$j]) == '') ? 'selected' : ''; ?>>Select Birth country</option>
											<?php
											if(!empty(get_list_countries())){
												foreach(get_list_countries() as $country){?>
													<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['birth_country'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
											<?php } } ?>
										</select>
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_birth_place_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Birth Place', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" value="<?php echo isset($_POST['traverler']['birth_place'][$j]) ? $_POST['traverler']['birth_place'][$j] : ''; ?>" class="form-control" name="traverler[birth_place][]" id="traverler_birth_place_<?php echo $j; ?>" placeholder="<?php echo __( 'Birth Place', 'visachild' ); ?>">
									</div>
								</div><!-- form-group -->


								<div class="form-group row">
									<label for="traverler_date_birth_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Date of birth', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['date_birth'][$j]) ? $_POST['traverler']['date_birth'][$j] : ''; ?>" name="traverler[date_birth][]" id="traverler_date_birth_<?php echo $j; ?>" placeholder="<?php echo __( 'Date of birth', 'visachild' ); ?>">
									</div>
								</div><!-- form-group -->
								<div id="russian_nationality" class="duration-9-30 hidden">
									<h3><?php echo __( 'Russian nationality', 'visachild' ); ?></h3>
									<p><?php echo __( 'If you have ever had Russian nationality, answer yes to this question and complete the other fields.', 'visachild' ); ?></p>
									<div class="form-group row">
										<label for="traverler_russian_nationality_<?php echo $j;?>" class="vc_col-md-3 col-form-label"><?php echo __( 'RUSSIAN NATIONALITY', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[russian_nationality][]" id="traverler_russian_nationality">
												<option value="" <?php echo (isset($_POST['traverler']['russian_nationality'][$j]) == '') ? 'selected' : ''; ?>></option>
												<option value="yes" <?php echo (isset($_POST['traverler']['russian_nationality'][$j]) == 'yes') ? 'selected' : ''; ?>>Yes</option>
											    <option value="no" <?php echo (isset($_POST['traverler']['russian_nationality'][$j]) == 'no') ? 'selected' : ''; ?>>No</option>
											</select>
										</div>
									</div>
									<div class="nationality_info">
										<div class="form-group row">
											<label for="traverler_lost_nationality_date_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Date of Loss of Nationality', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['lost_nationality_date'][$j]) ? $_POST['traverler']['lost_nationality_date'][$j] : ''; ?>" name="traverler[lost_nationality_date][]" id="traverler_lost_nationality_date_<?php echo $j; ?>">
												<span class="validate_error">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_reason_for_nationality_loss_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Reason for Loss of Nationality', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['reason_for_nationality_loss'][$j]) ? $_POST['traverler']['reason_for_nationality_loss'][$j] : ''; ?>" class="form-control" name="traverler[reason_for_nationality_loss][]" id="traverler_reason_for_nationality_loss_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->
									</div>

									<h3><?php echo __( 'Born in Russia', 'visachild' ); ?></h3>
									<p><?php echo __( 'Indicate here whether you were born in Russia. If you were born in Russia, you must indicate when you left Russia and to which country you left.', 'visachild' ); ?></p>

									<div class="form-group row">
										<label for="traverler_born_in_russia_<?php echo $j;?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Born In RUSSIA', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[born_in_russia][]" id="traverler_born_in_russia">
												<option value="" <?php echo (isset($_POST['traverler']['born_in_russia'][$j]) == '') ? 'selected' : ''; ?>></option>
												<option value="yes" <?php echo (isset($_POST['traverler']['born_in_russia'][$j]) == 'yes') ? 'selected' : ''; ?>>Yes</option>
											    <option value="no" <?php echo (isset($_POST['traverler']['born_in_russia'][$j]) == 'no') ? 'selected' : ''; ?>>No</option>
											</select>
										</div>
									</div>

									<div class="born_russia_info">
										<div class="form-group row">
											<label for="traverler_immigration_date_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Date when you immigrated', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['immigration_date'][$j]) ? $_POST['traverler']['immigration_date'][$j] : ''; ?>" name="traverler[immigration_date][]" id="traverler_immigration_date_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_immigration_country_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Country', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<select name="traverler[immigration_country][]" id="traverler_immmigration_country_<?php echo $j; ?>">
													<option value="" <?php echo (isset($_POST['traverler']['immigration_country'][$j]) == '') ? 'selected' : ''; ?>>Select immigration country</option>
													<?php
													if(!empty(get_list_countries())){
														foreach(get_list_countries() as $country){?>
															<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['immigration_country'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
													<?php } } ?>
												</select>
											</div>
										</div><!-- form-group -->
									</div>
								</div>
								<h3><?php echo __( 'Alternative Names', 'visachild' ); ?></h3>
								<p><?php echo __( 'Indicate below whether you are now known or have ever been known under a different name or alias.', 'visachild' ); ?></p>

								<div class="form-group row">
									<label for="traverler_alt_name_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Alternative Names', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[alt_name][]" id="traverler_alt_name">
											<option value="yes" <?php echo (isset($_POST['traverler']['alt_name'][$j]) == 'yes') ? 'selected' : ''; ?>>Yes</option>
											<option value="no" <?php echo (isset($_POST['traverler']['alt_name'][$j]) == 'no') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group -->
								<div class="alternative_name_info">
									<div class="form-group row">
										<label for="traverler_Alternative_name_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Alternative Name', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['alternative_name'][$j]) ? $_POST['traverler']['alternative_name'][$j] : ''; ?>" class="form-control" name="traverler[alternative_name][]" id="traverler_alternative_name_<?php echo $j; ?>" placeholder="<?php echo __( 'Alternative Name (First Middle and Last Name)', 'visachild' ); ?>">
										</div>
									</div><!-- form-group -->
								</div>
								<h3><?php echo __( 'Passport Details', 'visachild' ); ?></h3>
								<p><?php echo __( 'Enter your passport information below. For Dutch people, the document number is nine characters long and starts with a letter (N, B, A, D). The Dutch passport number contains both numbers and letters. For Belgians, the passport number is eight characters long. This has the form: XX999999 (two letters, six numbers).', 'visachild' ); ?></p>

								<div class="form-group row">
									<label for="traverler_document_number_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Document Number', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" value="<?php echo isset($_POST['traverler']['document_number'][$j]) ? $_POST['traverler']['document_number'][$j] : ''; ?>" class="form-control" name="traverler[document_number][]" id="traverler_document_number_<?php echo $j; ?>" placeholder="<?php echo __( 'Document Number', 'visachild' ); ?>">
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

								<div id="passport-details-duration-1-8" class="duration-1-8">
									<div class="form-group row">
										<label for="traverler_delivery_location_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Delivery Location', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['delivery_location'][$j]) ? $_POST['traverler']['delivery_location'][$j] : ''; ?>" class="form-control" name="traverler[delivery_location][]" id="traverler_delivery_location_<?php echo $j; ?>" placeholder="<?php echo __( 'Delivery Location', 'visachild' ); ?>">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_passport_data_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Scan Passport Data', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="file" class="form-control" name="traverler[passport_data][]" id="passport_data_<?php echo $j; ?>">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_passport_photo_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Passport Photograph', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="file" class="form-control" name="traverler[passport_photo][]" id="traverler_passport_photo_<?php echo $j; ?>">
										</div>
									</div><!-- form-group -->
								</div>
								<div id="passport-details-duration-9-30" class="duration-9-30 hidden">
									<div class="form-group row">
										<label for="traverler_afgifteland_passport_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Afgifteland Passport', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[afgifteland_passport][]" id="traverler_afgifteland_passport_<?php echo $j; ?>">
												<option value="" <?php echo (isset($_POST['traverler']['afgifteland_passport'][$j]) == '') ? 'selected' : ''; ?>>Select afgifteland passport</option>
												<?php
												if(!empty(get_list_countries())){
													foreach(get_list_countries() as $country){?>
														<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['afgifteland_passport'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
												<?php } } ?>
											</select>
										</div>
									</div><!-- form-group -->
								</div>

								<div id="insurance_section" class="duration-9-30 hidden">
									<h3><?php echo __( 'Insurance', 'visachild' ); ?></h3>
									<p><?php echo __( 'Enter the name of your insurance company below. This must provide demonstrable coverage for Russia. Please contact us for questions.', 'visachild' ); ?></p>

									<div class="form-group row">
										<label for="traverler_insurer_name_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Name of Insurer', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['insurer_name'][$j]) ? $_POST['traverler']['insurer_name'][$j] : ''; ?>" class="form-control" name="traverler[insurer_name][]" id="traverler_insurer_name_<?php echo $j; ?>">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_insurance_number_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Insurance Number', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['insurance_number'][$j]) ? $_POST['traverler']['insurance_number'][$j] : ''; ?>" class="form-control" name="traverler[insurance_number][]" id="traverler_insurance_number_<?php echo $j; ?>">
										</div>
									</div><!-- form-group -->
								</div>
								<div class="duration-1-8">
									<h3><?php echo __( 'Are you working or studying at the moment?', 'visachild' ); ?></h3>
									<div class="form-group row">
										<label for="traverler_study_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Answer', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[study][]" id="traverler_study">
												<option value="yes" <?php echo (isset($_POST['traverler']['study'][$j]) == 'yes') ? 'selected' : ''; ?>>Yes</option>
												<option value="no" <?php echo (isset($_POST['traverler']['study'][$j]) == 'no') ? 'selected' : ''; ?>>No</option>
											</select>
										</div>
									</div><!-- form-group -->

									<div class="job-info">
										<div class="form-group row">
											<label for="traverler_employer_name_1_to_8<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Employer Name', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['employer_name_1_to_8'][$j]) ? $_POST['traverler']['employer_name_1_to_8'][$j] : ''; ?>" class="form-control" name="traverler[employer_name_1_to_8][]" id="traverler_employer_name_1_to_8_<?php echo $j; ?>" placeholder="<?php echo __( 'Employer Name', 'visachild' ); ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_job_title_1_to_8<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Job Title', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['job_title_1_to_8'][$j]) ? $_POST['traverler']['job_title_1_to_8'][$j] : ''; ?>" class="form-control" name="traverler[job_title_1_to_8][]" id="traverler_job_title_1_to_8_<?php echo $j; ?>" placeholder="<?php echo __( 'Job Title', 'visachild' ); ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_job_address_1_to_8<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Address', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['job_address_1_to_8'][$j]) ? $_POST['traverler']['job_address_1_to_8'][$j] : ''; ?>" class="form-control" name="traverler[job_address_1_to_8][]" id="traverler_job_address_1_to_8<?php echo $j; ?>" placeholder="<?php echo __( 'Address', 'visachild' ); ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_job_telephone_1_to_8<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Telephone', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['job_telephone_1_to_8'][$j]) ? $_POST['traverler']['job_telephone_1_to_8'][$j] : ''; ?>" class="form-control" name="traverler[job_telephone_1_to_8][]" id="traverler_job_telephone_1_to_8<?php echo $j; ?>" placeholder="+316123456789">
											</div>
										</div><!-- form-group -->
									</div>
								</div>
								<div class="duration-9-30 hidden">
									<h3><?php echo __( 'Employer', 'visachild' ); ?></h3>
									<p><?php echo __( 'Select here whether you have a former or current employer. You select yes if you have an employer, are self-employed, student, child, housewife, stay-at-home parent etc. Any name of your work situation is allowed. Read the information in the fields below for exactly what you need to enter. Fill in the fields in English.' ); ?></p>

									<div class="form-group row">
										<label for="traverler_employer_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Employer', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[employer][]" id="traverler_employer">
												<option value="" <?php echo (isset($_POST['traverler']['employer'][$j]) == '') ? 'selected' : ''; ?>></option>
												<option value="yes" <?php echo (isset($_POST['traverler']['employer'][$j]) == 'yes') ? 'selected' : ''; ?>>Yes</option>
												<option value="no" <?php echo (isset($_POST['traverler']['employer'][$j]) == 'no') ? 'selected' : ''; ?>>No</option>
											</select>
										</div>
									</div><!-- form-group -->
									<div class="employer-info hidden">
										<div class="form-group row">
											<label for="traverler_employer_name_9_to_30<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Name of Employer', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['employer_name_9_to_30'][$j]) ? $_POST['traverler']['employer_name_9_to_30'][$j] : ''; ?>" class="form-control" name="traverler[employer_name_9_to_30][]" id="traverler_employer_name_9_to_30_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_employer_email_9_to_30<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'E-mail address of Employer', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['employer_email_9_to_30'][$j]) ? $_POST['traverler']['employer_email_9_to_30'][$j] : ''; ?>" class="form-control" name="traverler[employer_email_9_to_30][]" id="traverler_employer_email_9_to_30_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_employer_street_name_house_no_9_to_30<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Street name + house Number' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['employer_street_name_house_no_9_to_30'][$j]) ? $_POST['traverler']['employer_street_name_house_no_9_to_30'][$j] : ''; ?>" class="form-control" name="traverler[employer_street_name_house_no_9_to_30][]" id="traverler_employer_street_name_house_no_9_to_30_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_employer_town_9_to_30<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Town', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['employer_town_9_to_30'][$j]) ? $_POST['traverler']['employer_town_9_to_30'][$j] : ''; ?>" class="form-control" name="traverler[employer_town_9_to_30][]" id="traverler_employer_town_9_to_30_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_employer_postal_code_9_to_30<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Postal Code', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['employer_postal_code_9_to_30'][$j]) ? $_POST['traverler']['employer_postal_code_9_to_30'][$j] : ''; ?>" class="form-control" name="traverler[employer_postal_code_9_to_30][]" id="traverler_employer_postal_code_9_to_30_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_employer_country_9_to_30_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Country', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<select name="traverler[employer_country_9_to_30][]" id="traverler_employer_country_9_to_30_<?php echo $j; ?>">
													<option value="" <?php echo (isset($_POST['traverler']['employer_country_9_to_30'][$j]) == '') ? 'selected' : ''; ?>>Select Country</option>
													<?php
													if(!empty(get_list_countries())){
														foreach(get_list_countries() as $country){?>
															<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['employer_country_9_to_30'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
													<?php } } ?>
												</select>
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_employer_job_title_9_to_30<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Job Title', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['employer_job_title_9_to_30'][$j]) ? $_POST['traverler']['employer_job_title_9_to_30'][$j] : ''; ?>" class="form-control" name="traverler[employer_job_title_9_to_30][]" id="traverler_employer_job_title_9_to_30_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_employer_telephone_9_to_30<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Telephone', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['employer_telephone_9_to_30'][$j]) ? $_POST['traverler']['employer_telephone_9_to_30'][$j] : ''; ?>" class="form-control" name="traverler[employer_telephone_9_to_30][]" id="traverler_employer_telephone_9_to_30<?php echo $j; ?>" placeholder="+316123456789">
											</div>
										</div><!-- form-group -->
									</div>
								</div>
								<h3>Family Member</h3>
								<div class="duration-9-30 hidden">
									<p><?php echo __( 'If you have family in Russia, please enter the details of the family member that is closest to you below. Indicate in "relationship type" what the relationship with this family member is (for example: father, niece, aunt). You must also enter the address and date of birth of the family member.' ); ?></p>
								</div>
								<label><?php echo __( 'Do you currently haver family members in Russia?', 'visachild' ); ?></label>
								<div class="form-group row">
									<label for="traverler_family_member_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Answer', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[family_member][]" id="traverler_family_member">
											<option value="Yes" <?php echo (isset($_POST['traverler']['family_member'][$j]) == 'Yes') ? 'selected' : ''; ?>>Yes</option>
											<option value="No" <?php echo (isset($_POST['traverler']['family_member'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group -->
								<div class="family_info">
									<div class="form-group row">
										<label for="traverler_family_relationship_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Relationship', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[family_relationship][]" id="traverler_family_relationship_<?php echo $j; ?>">
												<option value=" " <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == ' ') ? 'selected' : ''; ?>> </option>
												<option value="husband" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'husband') ? 'selected' : ''; ?>>husband</option>
												<option value="wife" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'wife') ? 'selected' : ''; ?>>wife</option>
												<option value="father" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'father') ? 'selected' : ''; ?>>father</option>
												<option value="mother" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'mother') ? 'selected' : ''; ?>>mother</option>
												<option value="son" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'son') ? 'selected' : ''; ?>>son</option>
												<option value="daughter" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'daughter') ? 'selected' : ''; ?>>daughter</option>
												<option value="grand mother" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'grand mother') ? 'selected' : ''; ?>>grand mother</option>
												<option value="grand father" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'grand father') ? 'selected' : ''; ?>>grand father</option>
												<option value="grand son" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'grand son') ? 'selected' : ''; ?>>grand son</option>
												<option value="grand daughter" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'grand daughter') ? 'selected' : ''; ?>>grand daughter</option>
												<option value="brother" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'brother') ? 'selected' : ''; ?>>brother</option>
												<option value="sister" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'sister') ? 'selected' : ''; ?>>sister</option>
												<option value="step father" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'step father') ? 'selected' : ''; ?>>step father</option>
												<option value="step mother" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'step mother') ? 'selected' : ''; ?>>step mother</option>
												<option value="step son" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'step son') ? 'selected' : ''; ?>>step son</option>
												<option value="step daughter" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'step daughter') ? 'selected' : ''; ?>>step daughter</option>
												<option value="father in law" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'father in law') ? 'selected' : ''; ?>>father in law</option>
												<option value="mother in law" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'mother in law') ? 'selected' : ''; ?>>mother in law</option>
												<option value="son in law" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'son in law') ? 'selected' : ''; ?>>son in law</option>
												<option value="daughter in law" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'daughter in law') ? 'selected' : ''; ?>>daughter in law</option>
												<option value="great-grandfather" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'great-grandfather') ? 'selected' : ''; ?>>great-grandfather</option>
												<option value="great-grandmother" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'great-grandmother') ? 'selected' : ''; ?>>great-grandmother</option>
												<option value="great-grandson" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'great-grandson') ? 'selected' : ''; ?>>great-grandson</option>
												<option value="great-grandaughter" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'great-granddaughter') ? 'selected' : ''; ?>>great-grandaughter</option>
												<option value="uncle" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'uncle') ? 'selected' : ''; ?>>uncle</option>
												<option value="aunt" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'aunt') ? 'selected' : ''; ?>>aunt</option>
												<option value="nephew" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'nephew') ? 'selected' : ''; ?>>nephew</option>
												<option value="niece" <?php echo (isset($_POST['traverler']['family_relationship'][$j]) == 'niece') ? 'selected' : ''; ?>>niece</option>
											</select>
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_famiy_last_name_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Last Name', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['family_last_name'][$j]) ? $_POST['traverler']['family_last_name'][$j] : ''; ?>" class="form-control" name="traverler[family_last_name][]" id="traverler_family_last_name_<?php echo $j; ?>" placeholder="<?php echo __( 'Last Name', 'visachild' ); ?>">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_family_first_name_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'First Name', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['family_first_name'][$j]) ? $_POST['traverler']['fmily_first_name'][$j] : ''; ?>" class="form-control" name="traverler[family_first_name][]" id="traverler_family_first_name_<?php echo $j; ?>" placeholder="<?php echo __( 'First Name', 'visachild' ); ?>">
										</div>
									</div><!-- form-group -->
									<div class="duration-1-8">
										<div class="form-group row">
											<label for="traverler_family_address_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Address', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['family_address'][$j]) ? $_POST['traverler']['family_address'][$j] : ''; ?>" class="form-control" name="traverler[family_address][]" id="traverler_family_address_<?php echo $j; ?>" placeholder="<?php echo __( 'Address', 'visachild' ); ?>">
											</div>
										</div><!-- form-group -->
									</div>
									<div class="duration-9-30 hidden">
										<div class="form-group row">
											<label for="traverler_street_name_house_no_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Street Name + House Number', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['family_street_name_house_no'][$j]) ? $_POST['traverler']['family_street_name_house_no'][$j] : ''; ?>" class="form-control" name="traverler[family_street_name_house_no][]" id="traverler_family_street_name_house_no_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_town_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Town', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['family_town'][$j]) ? $_POST['traverler']['family_town'][$j] : ''; ?>" class="form-control" name="traverler[family_town][]" id="traverler_family_town_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->
									</div>

									<div class="form-group row">
										<label for="traverler_family_birth_date" class="vc_col-md-3 col-form-label"><?php echo __( 'Date of Birth', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['family_birth_date'][$j]) ? $_POST['traverler']['family_birth_date'][$j] : ''; ?>" name="traverler[family_birth_date][]" id="traverler_family_birth_date" placeholder="<?php echo __( 'Date of Birth', 'visachild' ); ?>">
										</div>
									</div><!-- form-group -->
								</div>
								<h3><?php echo __( 'Previous visit', 'visachild' ); ?></h3>
								<p><?php echo __( 'Please indicate here whether you have been to Russia before. If this is the case, you must provide the details of your last trip.', 'visachild' ); ?></p>
								<label><?php echo __( 'Have you been to Russia before?', 'visachild' ); ?></label>
								<div class="form-group row">
									<label for="traverler_russia_visit_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Answer', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[russia_visit][]" id="traverler_russia_visit">
											<option value="Yes" <?php echo (isset($_POST['traverler']['russia_visit'][$j]) == 'Yes') ? 'selected' : ''; ?>>Yes</option>
											<option value="No" <?php echo (isset($_POST['traverler']['russia_visit'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group -->
								<div class="previous_visit_info">
									<div class="form-group row">
										<label for="traverler_no_of_visits_russia_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Number of visits to Russia', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['no_of_visits_russia_'][$j]) ? $_POST['traverler']['traverler_no_of_visits_russia_'][$j] : ''; ?>" class="form-control" name="traverler[no_of_visits_russia_][]" id="traverler_no_of_visits_to_russia_<?php echo $j; ?>" placeholder="<?php echo __( '', 'visachild' ); ?>">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_last_trip_date" class="vc_col-md-3 col-form-label"><?php echo __( 'Date of Last Trip to Russia', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['last_trip_date'][$j]) ? $_POST['traverler']['last_trip_date'][$j] : ''; ?>" name="traverler[last_trip_date][]" id="traverler_last_trip_date">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_last_trip_return_date" class="vc_col-md-3 col-form-label"><?php echo __( 'Until', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['last_trip_return_date'][$j]) ? $_POST['traverler']['last_trip_return_date'][$j]: ''; ?>" name="traverler[last_trip_return_date][]"
											id="traverler_last_trip_return_date">
										</div>
									</div><!-- form-group -->
								</div>

								<h3><?php echo __( 'Disclaimer', 'visachild' ); ?></h3>
								<p>
									<ul>
										<li>I agree with the automatic processing, transfer and storage of the data in the application for e-visa purposes.</li>
										<li>I confirm that the information provided in the application is complete and accurate. I am aware that incorrect information can lead to a visa being refused or a visa being canceled at the border crossing of the Russian Federation.</li>
										<li>I am aware of the conditions for entry to the Russian Federation, residence in the territory of the Russian Federation and leaving the Russian Federation with an e-visa.</li>
										<li>I am aware that an e-Visa does not guarantee the right of access to the territory of the Russian Federation and access can be denied to me in cases provided for by Russian law. In the event of a denied access, I cannot claim compensation for any losses.</li>
									</ul>
								</p>

								<div class="form-group row">
									<label for="traverler_terms_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'I HAVE READ AND AGREE TO THE ABOVE CONDITIONS *', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[terms][]" id="traverler_terms_<?php echo $j; ?>">
											<option value="Yes" <?php echo (isset($_POST['traverler']['terms'][$j]) == 'Yes') ? 'selected' : ''; ?>>Yes</option>
										</select>
									</div>
								</div>

							</div> <!-- traveler_info -->

						<?php } ?>


						<div class="add_travelers-section" id="add_travelers-section">
							<h3><?php echo __( 'Add travelers to the form', 'visachild' ); ?></h3>
							<p><?php echo __( 'Every traveler needs their own visa, including accompanying children. By adding your fellow travelers to this application form, you do not have to re-enter the contact and travel details each time.', 'visachild' ); ?></p>
							<span id="add_traverl_info_button" class="btn btn-full-width btn-primary" data-total="<?php echo $cntTraveller; ?>">
								<i class="fa fa-user-plus" aria-hidden="true"></i>  Add a traveler
							</span>
						</div> <!-- add_travelers-section -->
					</div> <!-- visa_travel_details-information -->

					<div class="visa_form_submit_section">
						<button type="submit" class="btn btn-conv" data-nonce="<?php echo $russia_nonce; ?>">
							<span>Apply for visas</span><i class="fa fa-angle-right" aria-hidden="true"></i>
						</button>
					</div>
					<input type="hidden" name="form_fees" value="104">
			</form>
		</div>
		<div class="col-md-4 matlassidebar mequalheight">
			<div class="wrapper">
				<div class="flag-section">
					<img style="display: inline-block; width: 150px" src="<?php echo get_stylesheet_directory_uri().'/Flags/Russia-Flag-PNG-Pic.png'; ?>">
					<h2 style="display: inline-block; font-size: 25px; ">Visum Russia</h2>
				</div>
				<div class="content">
					<div id="visum">
						<p><b>Visum: </b> Russia Tourism</p>
					</div>
					<div id="duration">
						<p><b>Duration: </b> 1 t/m 8 days</p>
					</div>
					<div id="price">
						<p><b>Price: </b> € 39.95</p>
					</div>
					<div id="FactSheet">
						<p><a href="<?php the_field('factsheet'); ?>" target="_blank">Download PDF</a></p>
					</div>
					<div id="notes">
						<p><b>Please Note:</b>the e-Visa for Russia is only valid for Kaliningrad Oblast, the Far Eastern Federal District or St Petersburg and Leningrad Oblast.</p>

						<p style="color: red"><b>If you have a different destination, select 9 to 30 days alongside.</b></p>
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
				$('#visum').html('<p><b>Visum: </b> Russia '+ newselectedValue +'</p>');
				if ($('#duration_option').val() ==  '1 t/m 8 days') {
					$('#duration').html('<p><b>Duration: </b> 1 t/m 8 days</p>');
					$('#price').html('<p><b>Price: </b> € 39.95</p>');
				}
				if ($('#duration_option').val() ==  '9 t/m 30 days'){
					$('#duration').html('<p><b>Duration: </b> 9 t/m 30 days</p>');
					$('#price').html('<p><b>Price: </b> € 104.95</p>');
				}
			}
			else {
				newselectedValue = "Tourism";
				$('#purpose').val( newselectedValue );
				$('#visum').html('<p><b>Visum: </b> Russia '+ newselectedValue +'</p>');
				if ($('#duration_option').val() ==  '1 t/m 8 days') {
					$('#duration').html('<p><b>Duration: </b> 1 t/m 8 days</p>');
					$('#price').html('<p><b>Price: </b> € 39.95</p>');
				}
				if ($('#duration_option').val() ==  '9 t/m 30 days'){
					$('#duration').html('<p><b>Duration: </b> 9 t/m 30 days</p>');
					$('#price').html('<p><b>Price: </b> € 104.95</p>');
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
			if ($('#duration_option').val() ==  '1 t/m 8 days') {
				if ($('#purpose').val() == 'Tourism') {
					$('#duration').html('<p><b>Duration: </b> 1 t/m 8 days</p>');
					$('#price').html('<p><b>Price: </b> € 39.95</p>');

					$('.duration-9-30').addClass('hidden');
					$('.duration-1-8').removeClass('hidden');
				}
				if ($('#purpose').val() == 'Business'){
					$('#duration').html('<p><b>Duration: </b> 1 t/m 8 days</p>');
					$('#price').html('<p><b>Price: </b> € 39.95</p>');
					$('.duration-9-30').addClass('hidden');
					$('.duration-1-8').removeClass('hidden');
				}
			}
			if ($('#duration_option').val() ==  '9 t/m 30 days'){
				if ($('#purpose').val() == 'Tourism') {
					$('#duration').html('<p><b>Duration: </b> 9 t/m 30 days</p>');
					$('#price').html('<p><b>Price: </b> € 104.95</p>');

					$('.duration-1-8').addClass('hidden');
					$('.duration-9-30').removeClass('hidden');
				}
				if ($('#purpose').val() == 'Business'){
					$('#duration').html('<p><b>Duration: </b> 9 t/m 30 days</p>');
					$('#price').html('<p><b>Price: </b> € 104.95</p>');
					$('.duration-1-8').addClass('hidden');
					$('.duration-9-30').removeClass('hidden');
				}
			}
		});

		$(document).on('change','#traverler_alt_name',function(event) {
			console.log('change');
			$(this).parent().parent().siblings('.alternative_name_info').toggleClass('hidden');
		});

		$(document).on('change','#traverler_study',function(event) {
			console.log('change');
			$(this).parent().parent().siblings('.job-info').toggleClass('hidden');
		});

		$(document).on('change','#traverler_employer',function(event) {
			console.log('change');
			$(this).parent().parent().siblings('.employer-info').toggleClass('hidden');
		});

		$(document).on('change','#traverler_family_member',function(event) {
			console.log('change');
			$(this).parent().parent().siblings('.family_info').toggleClass('hidden');
		});

		$(document).on('change','#traverler_russia_visit',function(event) {
			console.log('change');
			$(this).parent().parent().siblings('.previous_visit_info').toggleClass('hidden');
		});

		$(document).on('change','#traverler_russian_nationality',function(event) {
			console.log('change');
			$(this).parent().parent().siblings('.nationality_info').toggleClass('hidden');
		});

		$(document).on('change','#traverler_born_in_russia',function(event) {
			console.log('change');
			$(this).parent().parent().siblings('.born_russia_info').toggleClass('hidden');
		});

		$(document).on('change', '#invitation_letter', function(event) {
			updatePrice();
		});

		$(document).on('change', '#shipping_method', function(event) {
			updatePrice();
		});

		$(document).on('change', '#return_method', function(event) {
			updatePrice();
		});

		function updatePrice(){
			var invitation_letter = 0;
			var shipping_method = 0;
			var return_method = 0;
			var old_price = 104.95;
			var price = 0;
			if($('#invitation_letter'). prop("checked") == true){
				console.log('check');
				invitation_letter = $('#invitation_letter').data('price');
			}
			if($('#invitation_letter'). prop("checked") == false){
				console.log('uncheck');
				invitation_letter = 0;
			}
			shipping_method = $('#shipping_method'). children("option:selected").data('price');

			return_method = $('#return_method'). children("option:selected").data('price');
			price = parseFloat(old_price) + parseFloat(invitation_letter) + parseFloat(shipping_method) + parseFloat(return_method);

			$('#price').html('<p><b>Price: </b> € '+price.toFixed(2)+'</p>');
		}
	});
</script>
