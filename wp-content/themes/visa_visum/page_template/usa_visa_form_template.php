<?php
/**
* Template Name: USA Visa Form
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/

$usa_nonce = wp_create_nonce('usa_form_nonce');
$formSubmit = '';
$cntTraveller = 1;
$redirectURL = 'http://traveldocs.developstaging.com/thank-you/';
$isError = false;
if (isset($_GET['purpose']) && $_GET['purpose'] != '') {
	$visa_purpose = ucfirst($_GET['purpose']);
}
if(!empty($_POST)) {
	$formSubmit = usa_form_submit_new($_POST);
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
			<form method="post" id="usa_visa_form" class="visa_form_submit" enctype="multipart/form-data">
				<div id="visa_travel-information" class="form_seprationSection">
					<h3><?php echo __( 'Travel details', 'visachild' ); ?></h3>

					<div class="form-group row">
						<label for="destination_country" class="vc_col-md-3 col-form-label"><?php echo __( 'Destination', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="text" class="form-control" value="USA" name="destination_country" id="destination_country" readonly="true">
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
					<p><?php echo __( "Enter all your details below. Copy this carefully from your passport. You must apply for a visa for all travelers (including children included in their parents' passport). You can do this in one go by pressing 'add traveler' at the bottom. You only need to fill in the general information once (all visas are sent to the same address). It is not necessary that all travelers reside at the entered address. The address is only used for sending visas, if desired.", 'visachild' ); ?></p>


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
						<label for="phone_number" class="vc_col-md-3 col-form-label"><?php echo __( 'Phone Number', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="phone" class="form-control" value="<?php echo isset($phone) ? $phone : ''; ?>" name="phone_number" id="phone_number"  placeholder="+316123456789">
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
						<label for="city" class="vc_col-md-3 col-form-label"><?php echo __( 'City', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="text" class="form-control" value="<?php echo isset($city) ? $city : ''; ?>" name="city" id="city" placeholder="<?php echo __( 'City', 'visachild' ); ?>">
							<span class="validate_error"><?php echo isset($cityErr) ? $cityErr : ''; ?></span>
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

				<div id="emergemcy_contact" class="form_seprationSection">

					<h3><?php echo __( 'Emergemcy Contact', 'visachild' ); ?></h3>
					<p><?php echo __( 'For the application it is necessary to provide an emergency contact person, who will be contacted in case of emergency. This can be a family member, friend, or business associate.' ); ?></p>

					<div class="form-group row">
						<label for="emergency_contact_first_name" class="vc_col-md-3 col-form-label"><?php echo __( 'First Name', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="text" class="form-control" value="<?php echo isset($emergency_contact_first_name) ? $emergency_contact_first_name : ''; ?>" name="emergency_contact_first_name" id="emergency_contact_first_name" placeholder="<?php echo __( 'First Name', 'visachild' ); ?>">
							<span class="validate_error"><?php echo isset($emergency_contact_first_nameErr) ? $emergency_contact_first_nameErr : ''; ?></span>
						</div>
					</div><!-- form-group -->

					<div class="form-group row">
						<label for="emergency_contact_last_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Last Name', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="text" class="form-control" value="<?php echo isset($emergency_contact_last_name) ? $emergency_contact_last_name : ''; ?>" name="emergency_contact_last_name" id="emergency_contact_last_name" placeholder="<?php echo __( 'Last name', 'visachild' ); ?>">
							<span class="validate_error"><?php echo isset($emergency_contact_last_nameErr) ? $emergency_contact_last_nameErr : ''; ?></span>
						</div>
					</div><!-- form-group -->

					<div class="form-group row">
						<label for="emergency_contact_phone_number" class="vc_col-md-3 col-form-label"><?php echo __( 'Phone Number', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="phone" class="form-control" value="<?php echo isset($emergency_contact_phone_number) ? $emergency_contact_phone_number : ''; ?>" name="emergency_contact_phone_number" id="emergency_contact_phone_number" placeholder="<?php echo __( 'Phone Number', 'visachild' ); ?>">
							<span class="validate_error"><?php echo isset($emergency_contact_phone_numberErr) ? $emergency_contact_phone_numberErr : ''; ?></span>
						</div>
					</div><!-- form-group -->

					<div class="form-group row">
						<label for="emergency_contact_email" class="vc_col-md-3 col-form-label"><?php echo __( 'E-mail Address', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="text" class="form-control" value="<?php echo isset($emergency_contact_email) ? $emergency_contact_email : ''; ?>" name="emergency_contact_email" id="emergency_contact_email" placeholder="<?php echo __( 'E-mail Address', 'visachild' ); ?>">
							<span class="validate_error"><?php echo isset($emergency_contact_emailErr) ? $emergency_contact_emailErr : ''; ?></span>
						</div>
					</div><!-- form-group -->
				</div>

				<div id="transitt" class="form_seprationSection">

					<h3><?php echo __( 'Transit (transit)', 'visachild' ); ?></h3>
					<p><?php echo __( 'If you are passing through and do not actually enter the country, select Yes here. If you actually enter the country, select No.' ); ?></p>

					<div class="form-group row">
						<label for="transit" class="vc_col-md-3 col-form-label"><?php echo __( 'Transit(Transit)', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<select name="transit" id="transit">
								<option value="No" <?php echo (isset($_POST['transit']) == 'No') ? 'selected' : ''; ?>>No</option>
								<option value="Yes" <?php echo (isset($_POST['transit']) == 'Yes') ? 'selected' : ''; ?>>Yes</option>
							</select>
						</div>
					</div><!-- form-group -->
					<div id="transit-info" class="transit-info">
						<h3><?php echo __( 'Contact point United States', 'visachild' ); ?></h3>
						<p><?php echo __( 'A point of contact in the United States may be a friend, family member, or business associate. If you do not have a point of contact in the United States, enter the name, address, and phone number of the location where you are staying (for example, a hotel name). You can also enter UNKNOWN.' ); ?></p>

						<div class="form-group row">
							<label for="contact_us_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Name', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($contact_us_name) ? $contact_us_name : ''; ?>" name="contact_us_name" id="contact_us_name" placeholder="<?php echo __( 'Name', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($contact_us_nameErr) ? $contact_us_nameErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="contact_us_street_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Street Name', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($contact_us_street_name) ? $contact_us_street_name : ''; ?>" name="contact_us_street_name" id="contact_us_street_name" placeholder="<?php echo __( 'Name', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($contact_us_street_nameErr) ? $contact_us_street_nameErr : ''; ?></span>
							</div>
						</div><!-- form-group -->
						<div class="form-group row">
							<label for="contact_us_state" class="vc_col-md-3 col-form-label"><?php echo __( 'State', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<select id="contact_us_state" name="contact_us_state">
									<option value="" <?php echo (isset($_POST['contact_us_state']) == '') ? 'selected' : ''; ?>>Select State ...</option>
									<option value="AL" <?php echo (isset($_POST['contact_us_state']) == 'AL') ? 'selected' : ''; ?>>Alabama</option>
									<option value="AK" <?php echo (isset($_POST['contact_us_state']) == 'AK') ? 'selected' : ''; ?>>Alaska</option>
									<option value="AQ" <?php echo (isset($_POST['contact_us_state']) == 'AQ') ? 'selected' : ''; ?>>American samoa</option>
									<option value="AZ" <?php echo (isset($_POST['contact_us_state']) == 'AZ') ? 'selected' : ''; ?>>Arizona</option>
									<option value="AR" <?php echo (isset($_POST['contact_us_state']) == 'AR') ? 'selected' : ''; ?>>Arkansas</option>
									<option value="CA" <?php echo (isset($_POST['contact_us_state']) == 'CA') ? 'selected' : ''; ?>>California</option>
									<option value="EQ" <?php echo (isset($_POST['contact_us_state']) == 'EQ') ? 'selected' : ''; ?>>Canton &amp; enderbury isl</option>
									<option value="CO" <?php echo (isset($_POST['contact_us_state']) == 'CO') ? 'selected' : ''; ?>>Colorado</option>
									<option value="CT" <?php echo (isset($_POST['contact_us_state']) == 'CT') ? 'selected' : ''; ?>>Connecticut</option>
									<option value="DE" <?php echo (isset($_POST['contact_us_state']) == 'DE') ? 'selected' : ''; ?>>Delaware</option>
									<option value="DC" <?php echo (isset($_POST['contact_us_state']) == 'DC') ? 'selected' : ''; ?>>District of Columbia</option>
									<option value="FL" <?php echo (isset($_POST['contact_us_state']) == 'FL') ? 'selected' : ''; ?>>Florida</option>
									<option value="GA" <?php echo (isset($_POST['contact_us_state']) == 'GA') ? 'selected' : ''; ?>>Georgia</option>
									<option value="GU" <?php echo (isset($_POST['contact_us_state']) == 'GU') ? 'selected' : ''; ?>>Guam</option>
									<option value="HI" <?php echo (isset($_POST['contact_us_state']) == 'HI') ? 'selected' : ''; ?>>Hawaii</option>
									<option value="ID" <?php echo (isset($_POST['contact_us_state']) == 'ID') ? 'selected' : ''; ?>>Idaho</option>
									<option value="IL" <?php echo (isset($_POST['contact_us_state']) == 'IL') ? 'selected' : ''; ?>>Illinois</option>
									<option value="IN" <?php echo (isset($_POST['contact_us_state']) == 'IN') ? 'selected' : ''; ?>>Indiana</option>
									<option value="IA" <?php echo (isset($_POST['contact_us_state']) == 'IA') ? 'selected' : ''; ?>>Iowa</option>
									<option value="KS" <?php echo (isset($_POST['contact_us_state']) == 'KS') ? 'selected' : ''; ?>>Kansas</option>
									<option value="KY" <?php echo (isset($_POST['contact_us_state']) == 'KY') ? 'selected' : ''; ?>>Kentucky</option>
									<option value="LA" <?php echo (isset($_POST['contact_us_state']) == 'LA') ? 'selected' : ''; ?>>Louisiana</option>
									<option value="ME" <?php echo (isset($_POST['contact_us_state']) == 'ME') ? 'selected' : ''; ?>>Maine</option>
									<option value="MD" <?php echo (isset($_POST['contact_us_state']) == 'MD') ? 'selected' : ''; ?>>Maryland</option>
									<option value="MA" <?php echo (isset($_POST['contact_us_state']) == 'MA') ? 'selected' : ''; ?>>Massachusetts</option>
									<option value="MI" <?php echo (isset($_POST['contact_us_state']) == 'MI') ? 'selected' : ''; ?>>Michigan</option>
									<option value="MN" <?php echo (isset($_POST['contact_us_state']) == 'MN') ? 'selected' : ''; ?>>Minnesota</option>
									<option value="MS" <?php echo (isset($_POST['contact_us_state']) == 'MS') ? 'selected' : ''; ?>>Mississippi</option>
									<option value="MO" <?php echo (isset($_POST['contact_us_state']) == 'MO') ? 'selected' : ''; ?>>Missouri</option>
									<option value="MT" <?php echo (isset($_POST['contact_us_state']) == 'MT') ? 'selected' : ''; ?>>Montana</option>
									<option value="NE" <?php echo (isset($_POST['contact_us_state']) == 'NE') ? 'selected' : ''; ?>>Nebraska</option>
									<option value="NV" <?php echo (isset($_POST['contact_us_state']) == 'NV') ? 'selected' : ''; ?>>Nevada</option>
									<option value="NH" <?php echo (isset($_POST['contact_us_state']) == 'NH') ? 'selected' : ''; ?>>New Hampshire</option>
									<option value="NJ" <?php echo (isset($_POST['contact_us_state']) == 'NJ') ? 'selected' : ''; ?>>New Jersey</option>
									<option value="NM" <?php echo (isset($_POST['contact_us_state']) == 'NM') ? 'selected' : ''; ?>>New Mexico</option>
									<option value="NY" <?php echo (isset($_POST['contact_us_state']) == 'NY') ? 'selected' : ''; ?>>New York</option>
									<option value="NC" <?php echo (isset($_POST['contact_us_state']) == 'NC') ? 'selected' : ''; ?>>North Carolina</option>
									<option value="ND" <?php echo (isset($_POST['contact_us_state']) == 'ND') ? 'selected' : ''; ?>>North Dakota</option>
									<option value="CQ" <?php echo (isset($_POST['contact_us_state']) == 'CQ') ? 'selected' : ''; ?>>North mariana isl</option>
									<option value="OH" <?php echo (isset($_POST['contact_us_state']) == 'OH') ? 'selected' : ''; ?>>Ohio</option>
									<option value="OK" <?php echo (isset($_POST['contact_us_state']) == 'OK') ? 'selected' : ''; ?>>Oklahoma</option>
									<option value="OR" <?php echo (isset($_POST['contact_us_state']) == 'OR') ? 'selected' : ''; ?>>Oregon</option>
									<option value="PA" <?php echo (isset($_POST['contact_us_state']) == 'PA') ? 'selected' : ''; ?>>Pennsylvania</option>
									<option value="PR" <?php echo (isset($_POST['contact_us_state']) == 'PR') ? 'selected' : ''; ?>>Puerto rico</option>
									<option value="RI" <?php echo (isset($_POST['contact_us_state']) == 'RI') ? 'selected' : ''; ?>>Rhode island</option>
									<option value="SC" <?php echo (isset($_POST['contact_us_state']) == 'SC') ? 'selected' : ''; ?>>South Carolina</option>
									<option value="SD" <?php echo (isset($_POST['contact_us_state']) == 'SD') ? 'selected' : ''; ?>>South Dakota</option>
									<option value="TN" <?php echo (isset($_POST['contact_us_state']) == 'TN') ? 'selected' : ''; ?>>Tennessee</option>
									<option value="TX" <?php echo (isset($_POST['contact_us_state']) == 'TX') ? 'selected' : ''; ?>>Texas</option>
									<option value="XX" <?php echo (isset($_POST['contact_us_state']) == 'XX') ? 'selected' : ''; ?>>Unknown</option>
									<option value="UT" <?php echo (isset($_POST['contact_us_state']) == 'UT') ? 'selected' : ''; ?>>Utah</option>
									<option value="VT" <?php echo (isset($_POST['contact_us_state']) == 'VT') ? 'selected' : ''; ?>>Vermont</option>
									<option value="VI" <?php echo (isset($_POST['contact_us_state']) == 'VI') ? 'selected' : ''; ?>>Virgin islands</option>
									<option value="VA" <?php echo (isset($_POST['contact_us_state']) == 'VA') ? 'selected' : ''; ?>>Virginia</option>
									<option value="WA" <?php echo (isset($_POST['contact_us_state']) == 'WA') ? 'selected' : ''; ?>>Washington</option>
									<option value="WV" <?php echo (isset($_POST['contact_us_state']) == 'WV') ? 'selected' : ''; ?>>West Virginia</option>
									<option value="WI" <?php echo (isset($_POST['contact_us_state']) == 'WI') ? 'selected' : ''; ?>>Wisconsin</option>
									<option value="WY" <?php echo (isset($_POST['contact_us_state']) == 'WY') ? 'selected' : ''; ?>>Wyoming</option>
								</select>
								<span class="validate_error"><?php echo isset($contact_us_street_nameErr) ? $contact_us_street_nameErr : ''; ?></span>
							</div>
						</div><!-- form-group -->
						<div class="form-group row">
							<label for="contact_us_phone_number" class="vc_col-md-3 col-form-label"><?php echo __( 'Phone Number', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="phone" class="form-control" value="<?php echo isset($contact_us_phone_number) ? $contact_us_phone_number : ''; ?>" name="contact_us_phone_number" id="contact_us_phone_number" placeholder="<?php echo __( 'Phone Number', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($contact_us_phone_numberErr) ? $contact_us_phone_numberErr : ''; ?></span>
							</div>
						</div><!-- form-group -->
					</div>
				</div>

				<div id="waiver_right" class="form_seprationSection">
					<h3><?php echo __( 'Waiver of Rights', 'visachild' ); ?></h3>
					<p><?php echo __( 'U.S. Customs requires that you waive your rights to review or appeal to a U.S. Customs and Border Guard officer decision regarding your right of admission.', 'visachild' ); ?></p>
					<label for="waiver_of_rights_section" class="checkboxLabeled">
						  <input type="checkbox" name="waiver_of_rights" id="waiver_of_rights" style="display: inline-block;width: auto;height: auto;" value="Yes" class="visuallyhidden" <?php isset($waiver_of_rights) ? 'checked': ''; ?>>
						  <!-- <span class="fa fa-check check-mark"></span> -->
						  <span class="text"><?php echo __( 'Waiver Of Rights', 'visachild' ); ?></span>
						</label>
				</div>

				<div id="urgent_request_section" class="form_seprationSection">
					<h3><?php echo __( 'Urgent request', 'visachild' ); ?></h3>
					<p><?php echo __( 'If desired, we can process your request urgently. Your visa will then be requested by us within 15 minutes. For most countries, this means that you will receive the visa within one hour. The costs for an urgent application are € 9.95 per person.' ); ?></p>
					<label for="urgent_request" class="checkboxLabeled">
						  <input type="checkbox" name="urgent_request" id="urgent_request" style="display: inline-block;width: auto;height: auto;" value="Yes" data-price="9.95" class="visuallyhidden" <?php isset($urgent_request) ? 'checked': ''; ?>>
						  <!-- <span class="fa fa-check check-mark"></span> -->
						  <span class="text"><?php echo __( 'Urgent', 'visachild' ); ?></span>
						</label>
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

							<div id="parents_info_section" class="form_seprationSection" >
								<h3><?php echo __( 'Name of Parents', 'visachild' ); ?></h3>
								<p><?php echo __( "Enter the names of your parents. These are mandatory for processing the application. If you don't know the name of a parent, enter UNKNOWN for this parent. You can enter the names of your biological, adoptive, step or foster parents in this field." ); ?>
								</p>
								<div class="form-group row">
									<label for="traverler_father_first_name" class="vc_col-md-3 col-form-label"><?php echo __( "Father's First Name", 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['father_first_name'][$j]) ? $_POST['traverler']['father_first_name'][$j] : ''; ?>" name="traverler[father_first_name][]" id="traverler_father_first_name">
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_father_surname" class="vc_col-md-3 col-form-label"><?php echo __( "Father's Surname", 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['father_surname'][$j]) ? $_POST['traverler']['father_surname'][$j] : ''; ?>" name="traverler[father_surname][]" id="traverler_father_surname">
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_mother_first_name" class="vc_col-md-3 col-form-label"><?php echo __( "mother's First Name", 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['mother_first_name'][$j]) ? $_POST['traverler']['mother_first_name'][$j] : ''; ?>" name="traverler[mother_first_name][]" id="traverler_mother_first_name">
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_mother_surname" class="vc_col-md-3 col-form-label"><?php echo __( "mother's Surname", 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['mother_surname'][$j]) ? $_POST['traverler']['mother_surname'][$j] : ''; ?>" name="traverler[mother_surname][]" id="traverler_mother_surname">
									</div>
								</div><!-- form-group -->
							</div>

							<div id="passport_info_section" class="form_seprationSection">
								<h3><?php echo __( 'Passport Information', 'visachild' ); ?></h3>
								<p><?php echo __( 'Please enter the information of your passport below. For Dutch people, the document number is nine characters long and starts with a letter (N, B, A, D). The Dutch passport number contains both numbers and letters. For Belgians, the passport number is eight characters long. It has the form: XX999999 (two letters, six numbers).', 'visachild' ); ?></p>

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
									<label for="traverler_citizen_service_number_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Citizen Service Number (BSN)', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['citizen_service_number'][$j]) ? $_POST['traverler']['citizen_service_number'][$j] : ''; ?>" name="traverler[citizen_service_number][]" id="traverler_citizen_service_number_<?php echo $j; ?>">
										<span class="validate_error"><?php echo isset($csnErr) ? $csnErr : ''; ?></span>
									</div>
								</div><!-- form-group BSN -->

								<div class="form-group row">
									<label for="traverler_issue_date_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Issue Date', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['issue_date'][$j]) ? $_POST['traverler']['issue_date'][$j] : ''; ?>" name="traverler[issue_date][]" id="traverler_issue_date_<?php echo $j; ?>" placeholder="<?php echo __( 'Issue Date', 'visachild' ); ?>">
										<span class="validate_error"><?php echo isset($arrivalErr) ? $arrivalErr : ''; ?></span>
									</div>
								</div><!-- form-group Issue Date -->

								<div class="form-group row">
									<label for="traverler_expiry_date_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Expiry Date', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['expiry_date'][$j]) ? $_POST['traverler']['expiry_date'][$j] : ''; ?>" name="traverler[expiry_date][]" id="traverler_expiry_date_<?php echo $j; ?>" placeholder="<?php echo __( 'Expiry Date', 'visachild' ); ?>">
										<span class="validate_error"><?php echo isset($arrivalErr) ? $arrivalErr : ''; ?></span>
									</div>
								</div><!-- form-group Expiry Date -->
							</div>
							<div id="alternative_passport_section" class="form_seprationSection">

								<h3><?php echo __( 'Alternative passport', 'visachild' ); ?></h3>
								<p><?php echo __( 'If you have had an alternative passport now or in the past (of a nationality other than your current one), please enter the details of this or these passports below. Please note: you do not have to fill in your previous passports with the same nationality.' ); ?></p>

								<div class="form-group row">
									<label for="traverler_alternative_passport_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Alternative passport', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[alternative_passport][]" id="alternative_passport">
											<option value="Yes" <?php echo (isset($_POST['traverler']['alternative_passport'][$j]) == 'Yes') ? 'selected' : ''; ?>>Yes</option>
											<option value="No" <?php echo (isset($_POST['traverler']['alternative_passport'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group -->
								<div id="alternative_passport_info" class="alternative_passport_info">
									<div class="form-group row">
										<label for="traverler_alt_delivery_country_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Country of Delivery', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[alt_delivery_country][]" id="traverler_alt_delivery_country_<?php echo $j; ?>">
												<option value="" <?php echo (isset($_POST['traverler']['alt_delivery_country'][$j]) == '') ? 'selected' : ''; ?>>Select Nationality</option>
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
														<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['alt_delivery_country'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
												<?php } } ?>
											</select>
										</div>
									</div><!-- form-group Passport Delivery Country -->

									<div class="form-group row">
										<label for="traverler_alt_document_number_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Document Number', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['alt_document_number'][$j]) ? $_POST['traverler']['alt_document_number'][$j] : ''; ?>" class="form-control" name="traverler[alt_document_number][]" id="traverler_alt_document_number_<?php echo $j; ?>" placeholder="<?php echo __( 'Document Number', 'visachild' ); ?>">
										</div>
									</div><!-- form-group  Alt Document Number -->

									<div class="form-group row">
										<label for="traverler_alt_expiry_year_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Expiry Year', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['alt_expiry_year'][$j]) ? $_POST['traverler']['alt_expiry_year'][$j] : ''; ?>" class="form-control" name="traverler[alt_expiry_year][]" id="traverler_alt_expiry_year_<?php echo $j; ?>" placeholder="<?php echo __( 'Expiry Year', 'visachild' ); ?>">
										</div>
									</div><!-- form-group  Alt Expiry Year -->
								</div>
							</div>

							<div id="alternative_citizenship_current_section" class="form_seprationSection">

								<h3><?php echo __( 'Alternative citizenship (current)', 'visachild' ); ?></h3>
								<p><?php echo __( 'Are you currently a citizen or resident of any country (other than the country of your passport)? Then select Yes below and fill in the required fields. If you do not know what to enter here, please enter No.' ); ?></p>

								<div class="form-group row">
									<label for="traverler_alternative_citizenship_current_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'alternative citizenship (current)', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[alternative_citizenship_current][]" id="alternative_citizenship_current">
											<option value="Yes" <?php echo (isset($_POST['traverler']['alternative_citizenship_current'][$j]) == 'Yes') ? 'selected' : ''; ?>>Yes</option>
											<option value="No" <?php echo (isset($_POST['traverler']['alternative_citizenship_current'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group -->
								<div id="alternative_citizenship_current_info" class="alternative_citizenship_current_info">
									<div class="form-group row">
										<label for="traverler_alt_current_citizen_country_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Country of Delivery', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[alt_current_citizen_country][]" id="traverler_alt_current_citizen_country_<?php echo $j; ?>">
												<option value="" <?php echo (isset($_POST['traverler']['alt_current_citizen_country'][$j]) == '') ? 'selected' : ''; ?>>Select Delivery Country</option>
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
														<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['alt_current_citizen_country'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
												<?php } } ?>
											</select>
										</div>
									</div><!-- form-citizenship Delivery Country -->

									<div class="form-group row">
										<label for="traverler_alt_current_citizen_obtain_by_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Obtained by', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[alt_current_citizen_obtain_by][]" id="traverler_alt_current_citizen_obtain_by_<?php echo $j; ?>">
												<option value="" <?php echo (isset($_POST['traverler']['alt_current_citizen_obtain_by'][$j]) == '') ? 'selected' : ''; ?>>Select Obtained By</option>
												<option value="birth" <?php echo (isset($_POST['traverler']['alt_current_citizen_obtain_by'][$j]) == 'birth') ? 'selected' : ''; ?>>Birth</option>
												<option value="naturalization" <?php echo (isset($_POST['traverler']['alt_current_citizen_obtain_by'][$j]) == 'naturalization') ? 'selected' : ''; ?>>Naturalization</option>
												<option value="via_parents" <?php echo (isset($_POST['traverler']['alt_current_citizen_obtain_by'][$j]) == 'via_parents') ? 'selected' : ''; ?>>Via Parents</option>
											</select>
										</div>
									</div><!-- form-citizenship Obtained By -->
								</div>
							</div>

							<div id="alternative_citizenship_past_section" class="form_seprationSection">

								<h3><?php echo __( 'Alternative citizenship (Past)', 'visachild' ); ?></h3>
								<p><?php echo __( 'Have you been a citizen or resident of any country (other than the country of your passport) in the past? Then select Yes below and fill in the required fields. If you do not know what to enter here, please enter No.' ); ?></p>

								<div class="form-group row">
									<label for="traverler_alternative_citizenship_past_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'alternative citizenship (past)', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[alternative_citizenship_past][]" id="alternative_citizenship_past">
											<option value="Yes" <?php echo (isset($_POST['traverler']['alternative_citizenship_past'][$j]) == 'Yes') ? 'selected' : ''; ?>>Yes</option>
											<option value="No" <?php echo (isset($_POST['traverler']['alternative_citizenship_past'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group -->
								<div id="alternative_citizenship_past_info" class="alternative_citizenship_past_info">
									<div class="form-group row">
										<label for="traverler_alt_past_citizen_country_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Country of Delivery', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[alt_past_citizen_country][]" id="traverler_alt_past_citizen_country_<?php echo $j; ?>">
												<option value="" <?php echo (isset($_POST['traverler']['alt_past_citizen_country'][$j]) == '') ? 'selected' : ''; ?>>Select Delivery Country</option>
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
														<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['alt_past_citizen_country'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
												<?php } } ?>
											</select>
										</div>
									</div><!-- form-citizenship Delivery Country -->
								</div>
							</div>

							<div id="employer_section" class="form_seprationSection">

								<h3><?php echo __( 'Employer', 'visachild' ); ?></h3>
								<p><?php echo __( 'Select here whether you have a former or current employer. You select yes if you have an employer, self-employed person, student, child, house husband / wife, stay-at-home parent, etc. Any description of your work situation is permitted. Read the information in the fields below for exactly what you need to fill in. Fill in the fields in English.' ); ?></p>

								<div class="form-group row">
									<label for="traverler_employer_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Official Alias', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[employer][]" id="employer">
											<option value="Yes" <?php echo (isset($_POST['traverler']['employer'][$j]) == 'Yes') ? 'selected' : ''; ?>>Yes</option>
											<option value="No" <?php echo (isset($_POST['traverler']['employer'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group -->
								<div id="employer_info" class="employer_info">

									<div class="form-group row">
										<label for="traverler_employer_name_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Name Of Employer', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['employer_name'][$j]) ? $_POST['traverler']['employer_name'][$j] : ''; ?>" name="traverler[employer_name][]" id="traverler_employer_name_<?php echo $j; ?>">
											<span class="validate_error"><?php echo isset($EmployerNameErr) ? $EmployerNameErr : ''; ?></span>
										</div>
									</div><!-- form-group Name Of Employer -->

									<div class="form-group row">
										<label for="traverler_employer_street_name_house_no_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Street Name + House Number', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['employer_street_name_house_no'][$j]) ? $_POST['traverler']['employer_street_name_house_no'][$j] : ''; ?>" name="traverler[employer_street_name_house_no][]" id="traverler_employer_street_name_house_no_<?php echo $j; ?>">
											<span class="validate_error"><?php echo isset($EmployerStreetNameErr) ? $EmployerStreetNameErr : ''; ?></span>
										</div>
									</div><!-- form-group Employer Street Name -->

									<div class="form-group row">
										<label for="traverler_employer_city_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'City', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['employer_city'][$j]) ? $_POST['traverler']['employer_city'][$j] : ''; ?>" name="traverler[employer_city][]" id="traverler_employer_city_<?php echo $j; ?>">
											<span class="validate_error"><?php echo isset($EmployerCityErr) ? $EmployerCityErr : ''; ?></span>
										</div>
									</div><!-- form-group Employer City -->

									<div class="form-group row">
										<label for="traverler_employer_district_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'District', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['employer_district'][$j]) ? $_POST['traverler']['employer_district'][$j] : ''; ?>" name="traverler[employer_district][]" id="traverler_employer_district_<?php echo $j; ?>">
											<span class="validate_error"><?php echo isset($EmployerDistrictErr) ? $EmployerDistrictErr : ''; ?></span>
										</div>
									</div><!-- form-group Employer District -->

									<div class="form-group row">
										<label for="traverler_employer_country_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Country', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[employer_country][]" id="traverler_employer_country_<?php echo $j; ?>">
												<option value="" <?php echo (isset($_POST['traverler']['employer_country'][$j]) == '') ? 'selected' : ''; ?>>Select Country</option>
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
														<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['employer_country'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
												<?php } } ?>
											</select>
										</div>
									</div><!-- form-employer Country -->

									<div class="form-group row">
										<label for="traverler_employer_phone_no_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Phone Number', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="phone" class="form-control" value="<?php echo isset($_POST['traverler']['employer_phone_no'][$j]) ? $_POST['traverler']['employer_phone_no'][$j] : ''; ?>" name="traverler[employer_phone_no][]" id="traverler_employer_phone_no_<?php echo $j; ?>" placeholder="+31455889977">
											<span class="validate_error"><?php echo isset($EmployerPhoneErr) ? $EmployerPhoneErr : ''; ?></span>
										</div>
									</div><!-- form-group Employer Phone -->
								</div>
							</div>

							<div id="question_section" class="form_seprationSection">
								<h3><?php echo __( 'Questions', 'visachild' ); ?></h3>
								<p><?php echo __( 'Below are eight questions related to your health or past. If you answer "Yes" to one of these questions, we are unfortunately unable to process your ESTA application. A brief explanation of each question:' ); ?>
									<ul>
										<li>Health problem: Do you have a physical or mental disorder;or are you a drug user or addict;or if you currently have any of the following diseases (Chancroid, Gonorrhea, Granuloma inguinale, Leprosy, contagious, Lymphogranuloma venereum, Syphilis, contagious, Active tuberculosis), enter "yes" in this question.</li>
										<li>Arrested: If you have ever been arrested or convicted of a crime resulting in serious property damage, or serious harm to another person or government, please enter "yes" to this question.</li>
										<li>Drugs: If you have ever broken a law regarding the possession, use, or distribution of illegal drugs, enter "yes" to this question.</li>
										<li>Terrorism: If you intend or have ever been involved in terrorist activities, espionage, sabotage, or genocide, please enter "yes" to this question.</li>
										<li>Fraud: If you have ever committed fraud or misrepresented yourself or others to obtain a visa or entry into the United States for yourself or others, please answer "yes" to this question.</li>
										<li>Job seeker: Are you currently looking for a job in the United States, or have you previously worked in the United States without prior permission from the United States government, please enter "yes" in this question.</li>
										<li>Visa Rejection: Visa Rejected: Have you ever been denied a US visa that you applied for with your current or a previous passport, or have you ever been refused entry to the United States or have you revoked your application for entry at an access point to the US? please enter "yes" to this question.</li>
										<li>Deadline exceeded: If you have ever stayed in the United States longer than the period of stay allowed by the United States government, enter "yes" to this question.</li>
										<li>Iraq, Syria, Iran, Sudan, Libya, Somalia, North Korea or Yemen: Have you visited Iraq, Syria, Iran, Sudan, Libya, Somalia, North Korea or Yemen on or after 1 March 2011, enter "yes" for this question.</li>
									</ul>
								</p>

								<div class="form-group row">
									<label for="traverler_medical_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Health Problem', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[health_problem][]" id="traverler_health_problem">
											<option value="" <?php echo (isset($_POST['traverler']['health_problem'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['health_problem'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Health problem -->

								<div class="form-group row">
									<label for="traverler_arrested_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Arrested', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[arrested][]" id="traverler_arrested">
											<option value="" <?php echo (isset($_POST['traverler']['arrested'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['arrested'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Arrested -->

								<div class="form-group row">
									<label for="traverler_drugs_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Drugs', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[drugs][]" id="traverler_drugs">
											<option value="" <?php echo (isset($_POST['traverler']['drugs'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['drugs'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Drugs -->

								<div class="form-group row">
									<label for="traverler_terrorism_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Terrorism', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[terrorism][]" id="traverler_terrorism">
											<option value="" <?php echo (isset($_POST['traverler']['terrorism'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['terrorism'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Terrorism -->

								<div class="form-group row">
									<label for="traverler_fraud_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Fraud', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[fraud][]" id="traverler_fraud">
											<option value="" <?php echo (isset($_POST['traverler']['fraud'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['fraud'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Fraud -->

								<div class="form-group row">
									<label for="traverler_jobseeker_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Jobseeker', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[jobseeker][]" id="traverler_jobseeker">
											<option value="" <?php echo (isset($_POST['traverler']['jobseeker'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['jobseeker'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Jobseeker -->

								<div class="form-group row">
									<label for="traverler_visa_rejection_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Visa Rejection', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[visa_rejection][]" id="traverler_visa_rejection">
											<option value="" <?php echo (isset($_POST['traverler']['visa_rejection'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['visa_rejection'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Visa Rejection -->

								<div class="form-group row">
									<label for="traverler_deadline_exceeded_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Deadline Exceeded', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[deadline_exceeded][]" id="traverler_deadline_exceeded">
											<option value="" <?php echo (isset($_POST['traverler']['deadline_exceeded'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['deadline_exceeded'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group Deadline Exceeded -->

								<div class="form-group row">
									<label for="traverler_risky_countries_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'IRAQ, SYRIA, IRAN, SUDAN, LIBYA, SOMALIA, NORTH KOREA OR YEMEN', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[risky_countries][]" id="traverler_risky_countries">
											<option value="" <?php echo (isset($_POST['traverler']['risky_countries'][$j]) == '') ? 'selected' : ''; ?>>Select Answer</option>
											<option value="No" <?php echo (isset($_POST['traverler']['risky_countries'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
										</select>
									</div>
								</div><!-- form-group risky_countries -->
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
					<button type="submit" class="btn btn-conv" data-nonce="<?php echo $usa_nonce; ?>">
						<span>Apply for visas</span><i class="fa fa-angle-right" aria-hidden="true"></i>
					</button>
				</div>
			</form>
		</div>
		<div class="col-md-4 matlassidebar mequalheight">
			<div class="wrapper">
				<div class="flag-section">
					<img style="display: inline-block; width: 150px" src="<?php echo get_stylesheet_directory_uri().'/Flags/united-states-of-america-flag.png'; ?>">
					<h2 style="display: inline-block; font-size: 25px; ">Visum USA</h2>
				</div>
				<div class="content">
					<div id="visum">
						<p><b>Visum: </b> USA Tourism</p>
					</div>
					<div id="duration">
						<p><b>Duration: </b>90 days per visit </p>
					</div>
					<div id="price">
						<p><b>Price: </b> € 29.95</p>
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
				$('#visum').html('<p><b>Visum: </b> USA Business</p>');
				$('#duration').html('<p><b>Duration: </b> 90 days per visit</p>');
				$('#price').html('<p><b>Price: </b> € 29.95</p>');

			}
			else {
				$('#visum').html('<p><b>Visum: </b> USA Tourism</p>');
					$('#duration').html('<p><b>Duration: </b> 90 days per visit</p>');
					$('#price').html('<p><b>Price: </b> € 29.95</p>');
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
				$('#visum').html('<p><b>Visum: </b> USA '+ newselectedValue +'</p>');
				$('#duration').html('<p><b>Duration: </b> 90 days per visit</p>');
				$('#price').html('<p><b>Price: </b> €  29.95</p>');

			}
			else {
				newselectedValue = "Tourism";
				$('#purpose').val( newselectedValue );
				$('#visum').html('<p><b>Visum: </b> USA '+ newselectedValue +'</p>');
				$('#duration').html('<p><b>Duration: </b> 90 days per visit</p>');
				$('#price').html('<p><b>Price: </b> € 29.95</p>');
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

		$(document).on('change','#transit',function(event) {

			$(this).parent().parent().siblings('.transit-info').toggleClass('hidden');
		});

		$(document).on('change','#traverler_alias',function(event) {
			$(this).parent().parent().siblings('.official_alias_info').toggleClass('hidden');
		});

		$(document).on('change','#alternative_passport',function(event) {
			$(this).parent().parent().siblings('.alternative_passport_info').toggleClass('hidden');
		});

		$(document).on('change','#alternative_citizenship_current',function(event) {
			$(this).parent().parent().siblings('.alternative_citizenship_current_info').toggleClass('hidden');
		});

		$(document).on('change','#alternative_citizenship_past',function(event) {
			$(this).parent().parent().siblings('.alternative_citizenship_past_info').toggleClass('hidden');
		});

		$(document).on('change','#employer',function(event) {
			$(this).parent().parent().siblings('.employer_info').toggleClass('hidden');
		});

		$(document).on('change', '#urgent_request', function(event) {
			updatePrice();
		});

		function updatePrice(){
			var urgent_request = 0;
			var old_price = 29.95;
			var price = 0;
			if($('#urgent_request'). prop("checked") == true){
				console.log('check');
				urgent_request = $('#urgent_request').data('price');
			}
			if($('#urgent_request'). prop("checked") == false){
				console.log('uncheck');
				urgent_request = 0;
			}
			price = parseFloat(old_price) + parseFloat(urgent_request);

			$('#price').html('<p><b>Price: </b> € '+price.toFixed(2)+'</p>');
		}
	});
</script>
<?php get_footer();
?>
