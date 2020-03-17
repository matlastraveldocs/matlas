<?php
/**
* Template Name: China Visa Form
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/

$china_nonce = wp_create_nonce('china_form_nonce');
$formSubmit = '';
$cntTraveller = 1;
$redirectURL = 'http://traveldocs.developstaging.com/thank-you/';
$isError = false;

if(!empty($_POST)) {

  $email_address = $_POST['email_address'];
  $telephone = $_POST['telephone'];
  $type_address = $_POST['type_address'];
  $countries = $_POST['countries'];
  $postcode = $_POST['postcode'];
  $house_number = $_POST['house_number'];
  $appart_number = $_POST['appart_number'];
  $street_name = $_POST['street_name'];
  $place_name = $_POST['place_name'];
  $province_name = $_POST['province_name'];
  $departure_date = $_POST['departure_date'];
  $purpose_trip = $_POST['purpose_trip'];
  $number_entries = $_POST['number_entries'];
  $urgent_procedure = $_POST['urgent_procedure'];
  $return_shipment = $_POST['return_shipment'];

  // $postCodeExpression = '/\\A\\b[0-9]{5}(?:-[0-9]{4})?\\b\\z/i';

  if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
    $isError = true;
  }

  if (empty($telephone)) {
    $phoneErr = "Please Enter Phone Number";
    $isError = true;
  }

  if (empty($type_address)) {
    $typeAddErr = "Please select address type.";
    $isError = true;
  }

  if (empty($countries)) {
    $countryErr = "Please select country.";
    $isError = true;
  }

  if (empty($postcode)) {
    $postcodeErr = "Please enter postal code.";
    $isError = true;
  }
  if (!empty($postcode) && strlen($postcode) > 8) {
    $postcodeErr = "Please enter valid postal code.";
    $isError = true;
  }

  if (empty($house_number)) {
    $houseErr = "Please enter house number.";
    $isError = true;
  }

  if (empty($street_name)) {
    $streetErr = "Please enter street name.";
    $isError = true;
  }

  if (empty($departure_date)) {
    $departureErr = "Please enter departure date.";
    $isError = true;
  }

  if (empty($purpose_trip)) {
    $purposeErr = "Please select purpose trip.";
    $isError = true;
  }
  /* echo '<pre>';
    var_dump($_POST);
  echo '</pre>'; */

  if(!$isError) {
    $formSubmit = chine_form_submit($_POST);
    wp_redirect( $redirectURL );
    // die();
  }
}
get_header();
?>
<div class="container">

<?php
$outHtml = '';
$outHtml .= '<div class="recordaddedMessage"> <p> '. __( 'Form Submitted Successfully', 'visachild' ) .' </p> </div>';
if ($formSubmit) {
  echo $outHtml;
}
?>
<form method="post" class="visa_form_submit">

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
        <input type="phone" class="form-control" value="<?php echo isset($telephone) ? $telephone : ''; ?>" name="telephone" id="telephone" placeholder="123456790">
        <span class="validate_error"><?php echo isset($phoneErr) ? $phoneErr : ''; ?></span>
      </div>
    </div><!-- form-group -->

    <div id="visa_adres-information" class="form_seprationSection">
      <h3><?php echo __( 'Address data', 'visachild' ); ?></h3>
      <p><?php echo __( 'Enter the address details on which you wish to receive all visas.', 'visachild' ); ?></p>

      <div class="form-group row">
        <label for="type_address" class="vc_col-md-3 col-form-label"><?php echo __( 'Type of address', 'visachild' ); ?></label>
        <div class="vc_col-md-9">
          <select name="type_address" id="type_address">
            <option value="Private address" <?php echo (isset($type_address) == 'Private address') ? 'selected' : ''; ?>><?php echo __('Private address', 'visachild') ?></option>
            <option value="Business address" <?php echo (isset($type_address) == 'Business address') ? 'selected' : ''; ?>><?php echo __('Business address', 'visachild') ?></option>
          </select>
          <span class="validate_error"><?php echo isset($typeAddErr) ? $typeAddErr : ''; ?></span>
        </div>
      </div><!-- form-group -->

      <div class="form-group row">
        <label for="countries" class="vc_col-md-3 col-form-label"><?php echo __( 'Country', 'visachild' ); ?></label>
        <div class="vc_col-md-9">
          <select name="countries" id="countries">
            <?php
              if(!empty(get_list_countries())){
                foreach(get_list_countries() as $country){?>
                <option value="<?php echo $country->country_code;?>" <?php echo (isset($countries) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
            <?php } } ?>
          </select>
          <span class="validate_error"><?php echo isset($countryErr) ? $countryErr : ''; ?></span>
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
        <label for="house_number" class="vc_col-md-3 col-form-label"><?php echo __( 'House number', 'visachild' ); ?></label>
        <div class="vc_col-md-9 house_section">
          <input type="text" class="form-control" value="<?php echo isset($house_number) ? $house_number : ''; ?>" name="house_number" id="house_number" placeholder="<?php echo __( 'Huisnummer', 'visachild' ); ?>">
          <input type="text" class="form-control" value="<?php echo (isset($appart_number)) ? $appart_number : ''; ?>" name="appart_number" id="appart_number" placeholder="<?php echo __( 'Toev.', 'visachild' ); ?>">
          <span class="validate_error"><?php echo isset($houseErr) ? $houseErr : ''; ?></span>
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
        <label for="place_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Place', 'visachild' ); ?></label>
        <div class="vc_col-md-9">
          <input type="text" class="form-control" value="<?php echo isset($place_name) ? $place_name : ''; ?>" name="place_name" id="place_name" placeholder="<?php echo __( 'Place', 'visachild' ); ?>">
        </div>
      </div><!-- form-group -->

      <div class="form-group row">
        <label for="province_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Province', 'visachild' ); ?></label>
        <div class="vc_col-md-9">
          <input type="text" class="form-control" value="<?php echo isset($province_name) ? $province_name : ''; ?>" name="province_name" id="province_name" placeholder="<?php echo __( 'Province', 'visachild' ); ?>">
        </div>
      </div><!-- form-group -->

    </div> <!-- visa_adres-information -->


    <div id="visa_travel-information" class="form_seprationSection">
      <h3><?php echo __( 'Travel data', 'visachild' ); ?></h3>
      <p><?php echo __( 'Enter the Travel data on which you wish to receive all visas.', 'visachild' ); ?></p>


      <div class="form-group row">
        <label for="departure_date" class="vc_col-md-3 col-form-label"><?php echo __( 'Departure date', 'visachild' ); ?></label>
        <div class="vc_col-md-9">
          <input type="date" class="form-control" value="<?php echo isset($departure_date) ? $departure_date : ''; ?>" name="departure_date" id="departure_date" placeholder="<?php echo __( 'Province', 'visachild' ); ?>">
          <span class="validate_error"><?php echo isset($departureErr) ? $departureErr : ''; ?></span>
        </div>
      </div><!-- form-group -->

      <div class="form-group row">
        <label for="purpose_trip" class="vc_col-md-3 col-form-label"><?php echo __( 'Purpose of trip', 'visachild' ); ?></label>
        <div class="vc_col-md-9">
          <select name="purpose_trip" id="purpose_trip">
            <option value="Tourism" <?php echo (isset($purpose_trip) == 'Tourism') ? 'selected' : ''; ?>><?php echo __('Tourism', 'visachild') ?></option>
            <option value="For business" <?php echo (isset($purpose_trip) == 'For business') ? 'selected' : ''; ?>><?php echo __('For business', 'visachild') ?></option>
            <option value="Different" <?php echo (isset($purpose_trip) == 'Different') ? 'selected' : ''; ?>><?php echo __('Different', 'visachild') ?></option>
          </select>
          <span class="validate_error"><?php echo isset($purposeErr) ? $purposeErr : ''; ?></span>
        </div>
      </div><!-- form-group -->

      <div class="form-group row">
        <label for="number_entries" class="vc_col-md-3 col-form-label"><?php echo __( 'Number of entries', 'visachild' ); ?></label>
        <div class="vc_col-md-9">
          <select name="number_entries" id="number_entries">
            <option value="Once in, 3 months validity" <?php echo (isset($number_entries) == 'Once in, 3 months validity') ? 'selected' : ''; ?>><?php echo __('Once in, 3 months validity', 'visachild') ?></option>
            <option value="Travel twice, 3 months validity" <?php echo (isset($number_entries) == 'Travel twice, 3 months validity') ? 'selected' : ''; ?>><?php echo __('Travel twice, 3 months validity', 'visachild') ?></option>
            <option value="Travel twice, 6 months validity" <?php echo (isset($number_entries) == 'Travel twice, 6 months validity') ? 'selected' : ''; ?>><?php echo __('Travel twice, 6 months validity', 'visachild') ?></option>
            <option value="Unlimited travel, valid for 12 months" <?php echo (isset($number_entries) == 'Unlimited travel, valid for 12 months') ? 'selected' : ''; ?>><?php echo __('Unlimited travel, valid for 12 months', 'visachild') ?></option>
          </select>
        </div>
      </div><!-- form-group -->

    </div> <!-- visa_travel-information -->


    <div id="visa_travel_details-information" class="form_seprationSection">
      <h3><?php echo __( 'Travel data', 'visachild' ); ?></h3>
      <p><?php echo __( 'Enter the details of all travelers, including yourself and accompanying children. Do you not have the details of all travelers at hand? It is also possible to submit individual applications per person.', 'visachild' ); ?></p>
       <?php
       if(isset($_POST['traverler'])){
          $cntTraveller = count($_POST['traverler']['nationality']);
       }

       for ($j = 0; $j < $cntTraveller; $j++) {
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
          <label for="traverler_date_birth_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Date of birth', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['date_birth'][$j]) ? $_POST['traverler']['date_birth'][$j] : ''; ?>" name="traverler[date_birth][]" id="traverler_date_birth_<?php echo $j; ?>" placeholder="<?php echo __( 'Date of birth', 'visachild' ); ?>">
          </div>
        </div><!-- form-group -->

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

    <div class="return_shipment-section" id="return_shipment-section">
        <h3><?php echo __( 'Delivery and return shipment', 'visachild' ); ?></h3>
        <p><?php echo __( 'After completing this form you will receive a personal e-mail with instructions on how to submit / send the required documents, including the passport of each traveler. Please note: do not send documents until you have read this email carefully.', 'visachild' ); ?></p>
        <p><?php echo __( 'The visa for China is usually granted on the 7th working day after we have received all necessary information and documents. If desired, this can be accelerated through an emergency procedure.', 'visachild' ); ?></p>
        <div class="form-group row">
          <label for="urgent_procedure" class="vc_col-md-3 col-form-label"><?php echo __( 'Urgent procedure', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <select name="urgent_procedure" id="urgent_procedure">
              <option value="No emergency procedure"><?php echo __('No emergency procedure', 'visachild') ?></option>
              <option value="4 working days (+ € 14.50 per visa)" <?php echo (isset($urgent_procedure) == '4 working days (+ € 14.50 per visa)') ? 'selected' : ''; ?>><?php echo __('4 working days (+ € 14.50 per visa)', 'visachild') ?></option>
              <option value="3 working days (+ € 78.50 per visa)" <?php echo (isset($urgent_procedure) == '3 working days (+ € 78.50 per visa)') ? 'selected' : ''; ?>><?php echo __('3 working days (+ € 78.50 per visa)', 'visachild') ?></option>
              <option value="2 working days (+ € 118.50 per visa)" <?php echo (isset($urgent_procedure) == '2 working days (+ € 118.50 per visa)') ? 'selected' : ''; ?>><?php echo __('2 working days (+ € 118.50 per visa)', 'visachild') ?></option>
            </select>
          </div>
        </div><!-- form-group -->

        <p><?php echo __( 'On the day of granting, the passport with the visa applied can be collected in Hoofddorp or at Schiphol. Delivery on the next working day after allocation is also possible; that can be registered or by courier.', 'visachild' ); ?></p>

        <div class="form-group row">
          <label for="return_shipment" class="vc_col-md-3 col-form-label"><?php echo __( 'Return shipment', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <select name="return_shipment" id="return_shipment">
              <option value="Registered shipping (+ € 17.09)" <?php echo (isset($return_shipment) == 'Registered shipping (+ € 17.09)') ? 'selected' : ''; ?>><?php echo __('Registered shipping (+ € 17.09)', 'visachild') ?></option>
              <option value="Shipping by courier (+ € 39.95)" <?php echo (isset($return_shipment) == 'Shipping by courier (+ € 39.95)') ? 'selected' : ''; ?>><?php echo __('Shipping by courier (+ € 39.95)', 'visachild') ?></option>
              <option value="Pick up at Schiphol (+ € 44.95)" <?php echo (isset($return_shipment) == 'Pick up at Schiphol (+ € 44.95)') ? 'selected' : ''; ?>><?php echo __('Pick up at Schiphol (+ € 44.95)', 'visachild') ?></option>
              <option value="Pick up in Hoofddorp (+ € 0.00)" <?php echo (isset($return_shipment) == 'Pick up in Hoofddorp (+ € 0.00)') ? 'selected' : ''; ?>><?php echo __('Pick up in Hoofddorp (+ € 0.00)', 'visachild') ?></option>
            </select>
          </div>

      </div> <!-- return_shipment-section -->

    <div class="visa_form_submit_section">
      <button type="submit" class="btn btn-conv" data-nonce="<?php echo $china_nonce; ?>">
        <span>Apply for visas</span><i class="fa fa-angle-right" aria-hidden="true"></i>
      </button>
    </div>
</form>
</div>
<?php get_footer();
?>

