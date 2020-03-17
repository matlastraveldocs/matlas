<?php
/**
* Template Name: Turkey Visa Form
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/

$china_nonce = wp_create_nonce('turkey_form_nonce');
$formSubmit = '';
$cntTraveller = 1;
$redirectURL = 'http://traveldocs.developstaging.com/thank-you/';
$isError = false;
if(!empty($_POST)) {

  $email_address = $_POST['email_address'];
  $telephone = $_POST['telephone'];
  $countries = $_POST['countries'];
  $postcode = $_POST['postcode'];
  $address = $_POST['street_name'];
  $city = $_POST['place_name'];
  $departure_date = $_POST['departure_date'];
  $yes_added = $_POST['yes-added'];
  // $postCodeExpression = '/\\A\\b[0-9]{5}(?:-[0-9]{4})?\\b\\z/i';

  if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
    $isError = true;
  }

  if (empty($telephone)) {
    $phoneErr = "Please Enter Phone Number";
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

  if (empty($address)) {
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
        <label for="address" class="vc_col-md-3 col-form-label"><?php echo __( 'Address', 'visachild' ); ?></label>
        <div class="vc_col-md-9">
          <input type="text" class="form-control" value="<?php echo isset($address) ? $address : ''; ?>" name="address" id="address" placeholder="<?php echo __( 'Straatnaam', 'visachild' ); ?>">
          <span class="validate_error"><?php echo isset($streetErr) ? $streetErr : ''; ?></span>
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
        <label for="city" class="vc_col-md-3 col-form-label"><?php echo __( 'City', 'visachild' ); ?></label>
        <div class="vc_col-md-9">
          <input type="text" class="form-control" value="<?php echo isset($city) ? $city : ''; ?>" name="city" id="city" placeholder="<?php echo __( 'Place', 'visachild' ); ?>">
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









    </div> <!-- visa_adres-information -->

    <div id="visa_travel-information" class="form_seprationSection">
      <h3><?php echo __( 'Travel information', 'visachild' ); ?></h3>

      <div class="form-group row">
        <label for="departure_date" class="vc_col-md-3 col-form-label"><?php echo __( 'Starting date visa', 'visachild' ); ?></label>
        <div class="vc_col-md-9">
          <input type="date" class="form-control" value="<?php echo isset($departure_date) ? $departure_date : ''; ?>" name="departure_date" id="departure_date" placeholder="<?php echo __( 'Province', 'visachild' ); ?>">
          <span class="validate_error"><?php echo isset($departureErr) ? $departureErr : ''; ?></span>
        </div>
      </div><!-- form-group -->


      <div class="form-group row">
        <label for="Starting date visa" class="vc_col-md-3 col-form-label"><?php echo __( 'Urgent application', 'visachild' ); ?></label>
        <div class="vc_col-md-9">

        <label for="yes-added" class="checkboxLabeled">
          <input type="checkbox" name="yes-added" id="yes-added" value="Yes" class="visuallyhidden" <?php isset($yes_added) ? 'checked': ''; ?>>
          <span class="fa fa-check check-mark"></span>
          <span class="text"><?php echo __( 'Yes (added fee: £17,50 per visa)', 'visachild' ); ?></span>
        </label>
        </div>
      </div><!-- form-group -->

    </div> <!-- visa_travel-information -->



    <div id="visa_travel_details-information" class="form_seprationSection">
      <h3><?php echo __( 'Travel data', 'visachild' ); ?></h3>
      <p><?php echo __( 'Enter the details of all travelers, including yourself and accompanying children. Do you not have the details of all travelers at hand? It is also possible to submit individual applications per person.', 'visachild' ); ?></p>
       <?php
       if(isset($_POST['traverler'])){
          $cntTraveller = count($_POST['traverler']);
       }

       for($i=1; $i<=$cntTraveller; $i++){
         $arrayNumber = $i -1;
       ?>
      <div class="travel_details_container" id="traveler_info_<?php echo $arrayNumber; ?>">
        <h4 id="traveler_id_<?php echo $arrayNumber; ?>">Traveler <?php echo $i ; ?></h4>


        <div class="form-group row">
          <label for="traverler_document_<?php echo $arrayNumber; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Travel document', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <select name="traverler[<?php echo $arrayNumber; ?>][traverler_document]" id="traverler_document_<?php echo $arrayNumber; ?>">
            <option value="Passport" <?php echo (isset($_POST['traverler'][$arrayNumber]['traverler_document']) == 'Passport') ? 'selected' : ''; ?>><?php echo __('Passport - normal/regular', 'visachild') ?></option>
            <option value="Passport-diplomatic" <?php echo (isset($_POST['traverler'][$arrayNumber]['traverler_document']) == 'Passport-diplomatic') ? 'selected' : ''; ?>><?php echo __('Passport - diplomatic', 'visachild') ?></option>
            <option value="Passport-service" <?php echo (isset($_POST['traverler'][$arrayNumber]['traverler_document']) == 'Passport-service') ? 'selected' : ''; ?>><?php echo __('Passport - service', 'visachild') ?></option>
            <option value="Identity_card" <?php echo (isset($_POST['traverler'][$arrayNumber]['traverler_document']) == 'Identity_card') ? 'selected' : ''; ?>><?php echo __('Identity card', 'visachild') ?></option>
            <option value="Residence_permit" <?php echo (isset($_POST['traverler'][$arrayNumber]['traverler_document']) == 'Residence_permit') ? 'selected' : ''; ?>><?php echo __('Residence permit', 'visachild') ?></option>
            </select>
          </div>
        </div><!-- form-group -->

        <div class="form-group row">
          <label for="traverler_nationality_<?php echo $arrayNumber; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Nationality', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <select name="traverler[<?php echo $arrayNumber; ?>][nationality]" id="traverler_nationality_<?php echo $arrayNumber; ?>">
              <?php
                if(!empty(get_list_countries())){
                  foreach(get_list_countries() as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler'][$arrayNumber]['nationality']) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
              <?php } } ?>
            </select>
          </div>
        </div><!-- form-group -->

        <div class="form-group row">
          <label for="Passport_Number_<?php echo $arrayNumber; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Passport Number', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <input type="text" value="<?php echo isset($_POST['traverler'][$arrayNumber]['Passport_Number']) ? $_POST['traverler'][$arrayNumber]['Passport_Number'] : ''; ?>" class="form-control" name="traverler[<?php echo $arrayNumber; ?>][Passport_Number]" id="Passport_Number_<?php echo $arrayNumber; ?>" placeholder="<?php echo __( 'Passport Number', 'visachild' ); ?>">
          </div>
        </div><!-- form-group -->

        <div class="form-group row">
          <label for="date_issue_<?php echo $arrayNumber; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Date of issue', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <input type="date" value="<?php echo isset($_POST['traverler'][$arrayNumber]['date_issue']) ? $_POST['traverler'][$arrayNumber]['date_issue'] : ''; ?>" class="form-control" name="traverler[<?php echo $arrayNumber; ?>][date_issue]" id="date_issue_<?php echo $arrayNumber; ?>" placeholder="<?php echo __( 'Date of issue', 'visachild' ); ?>">
          </div>
        </div><!-- form-group -->

        <div class="form-group row">
          <label for="expiration_issue_<?php echo $arrayNumber; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Expiration date', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <input type="date" value="<?php echo isset($_POST['traverler'][$arrayNumber]['expiration_issue']) ? $_POST['traverler'][$arrayNumber]['expiration_issue'] : ''; ?>" class="form-control" name="traverler[<?php echo $arrayNumber; ?>][expiration_issue]" id="expiration_issue_<?php echo $arrayNumber; ?>" placeholder="<?php echo __( 'Expiration date', 'visachild' ); ?>">
          </div>
        </div><!-- form-group -->




        <div class="form-group row">
          <label for="traverler_first_name_<?php echo $arrayNumber; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'First name', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <input type="text" value="<?php echo isset($_POST['traverler'][$arrayNumber]['first_name']) ? $_POST['traverler'][$arrayNumber]['first_name'] : ''; ?>" class="form-control" name="traverler[<?php echo $arrayNumber; ?>][first_name]" id="traverler_first_name_<?php echo $arrayNumber; ?>" placeholder="<?php echo __( 'First name', 'visachild' ); ?>">
          </div>
        </div><!-- form-group -->

        <div class="form-group row">
          <label for="traverler_surname_<?php echo $arrayNumber; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Surname', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <input type="text" class="form-control" value="<?php echo isset($_POST['traverler'][$arrayNumber]['surname']) ? $_POST['traverler'][$arrayNumber]['surname'] : ''; ?>" name="traverler[<?php echo $arrayNumber; ?>][surname]" id="traverler_surname_<?php echo $arrayNumber; ?>" placeholder="<?php echo __( 'Surname', 'visachild' ); ?>">
          </div>
        </div><!-- form-group -->

        <div class="form-group row">
          <label for="traverler_date_birth_<?php echo $arrayNumber; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Date of birth', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <input type="date" class="form-control" value="<?php echo isset($_POST['traverler'][$arrayNumber]['date_birth']) ? $_POST['traverler'][$arrayNumber]['date_birth'] : ''; ?>" name="traverler[<?php echo $arrayNumber; ?>][date_birth]" id="traverler_date_birth_<?php echo $arrayNumber; ?>" placeholder="<?php echo __( 'Date of birth', 'visachild' ); ?>">
          </div>
        </div><!-- form-group -->


        <div class="form-group row">
          <label for="first_name_mother_<?php echo $arrayNumber; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'First name mother', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <input type="text" value="<?php echo isset($_POST['traverler'][$arrayNumber]['first_name_mother']) ? $_POST['traverler'][$arrayNumber]['first_name_mother'] : ''; ?>" class="form-control" name="traverler[<?php echo $arrayNumber; ?>][first_name_mother]" id="first_name_mother_<?php echo $arrayNumber; ?>" placeholder="<?php echo __( 'First name mother', 'visachild' ); ?>">
          </div>
        </div><!-- form-group -->

        <div class="form-group row">
          <label for="first_name_father_<?php echo $arrayNumber; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'First name father', 'visachild' ); ?></label>
          <div class="vc_col-md-9">
            <input type="text" class="form-control" value="<?php echo isset($_POST['traverler'][$arrayNumber]['first_name_father']) ? $_POST['traverler'][$arrayNumber]['first_name_father'] : ''; ?>" name="traverler[<?php echo $arrayNumber; ?>][first_name_father]" id="first_name_father_<?php echo $arrayNumber; ?>" placeholder="<?php echo __( 'First name father', 'visachild' ); ?>">
          </div>
        </div><!-- form-group -->

      </div> <!-- traveler_info -->

      <?php } ?>

      <div class="add_travelers-section" id="add_travelers-section">
        <h3><?php echo __( 'Add travelers to the form', 'visachild' ); ?></h3>
        <p><?php echo __( 'Every traveler needs their own visa, including accompanying children. By adding your fellow travelers to this application form, you do not have to re-enter the contact and travel details each time.', 'visachild' ); ?></p>
        <span id="add_traverl_info_button" class="btn btn-full-width btn-primary">
          <i class="fa fa-user-plus" aria-hidden="true"></i>  Add a traveler
        </span>

      </div> <!-- add_travelers-section -->
    </div> <!-- visa_travel_details-information -->

    <div class="visa_form_submit_section">
      <button type="submit" class="btn btn-conv" data-nonce="<?php echo $china_nonce; ?>">
        <span>Apply for visas</span><i class="fa fa-angle-right" aria-hidden="true"></i>
      </button>
    </div>
</form>
</div>
<?php get_footer();
?>

