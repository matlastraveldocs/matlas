<?php /* Template Name: Applicstion Template */ ?>

<?php get_header(); ?>

<?php
// Get List of country
global $wpdb;
$countries_table = $wpdb->prefix."countries"; 
$countries = $wpdb->get_results("SELECT * FROM $countries_table");

if(isset($_POST['submit'])){
	echo "<pre>REQUEST :: ";
	print_r($_REQUEST);
	echo "</pre>";exit;
}
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
		<div class="container">		
			<h1>Application form Turkey visa </h1>
			<h3>Apply for the official Turkey visa.</h3>
			<div class="message"><?php if(isset($message)) echo $message; ?></div>
			<ul id="signup-step">
				<li id="personal" class="active">Fill in</li>
				<li id="password">Control</li>
			</ul>
			<!--<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>-->
		<!--<form id="signupform" name="signupform">
			<input name="name" type="text" minlength="2" maxlength="26" required>
			<input type="email" name="email" required>			
			<input type="submit" value="submit">
		</form> 
		<script>
			jQuery('#signupform').validate();
		</script>-->
			<!--<form name="frmRegistration" id="signup-form" method="post">
				<div id="personal-field">
					<label>Name</label><span id="name-error" class="signup-error"></span>
					<div><input type="text" name="name" id="name" class="demoInputBox"/></div>
					<label>Email</label><span id="email-error" class="signup-error"></span>
					<div><input type="text" name="email" id="email" class="demoInputBox" /></div>
				</div>
				<div id="password-field" style="display:none;">
					<label>Enter Password</label><span id="password-error" class="signup-error"></span>
					<div><input type="password" name="password" id="user-password" class="demoInputBox" /></div>
					<label>Re-enter Password</label><span id="confirm-password-error" class="signup-error"></span>
					<div><input type="password" name="confirm-password" id="confirm-password" class="demoInputBox" /></div>
				</div>
				<div id="general-field" style="display:none;">
					
					<label>Gender</label>
					<div>
					<select name="gender" id="gender" class="demoInputBox">
					<option value="male">Male</option>
					<option value="female">Female</option>
					</select></div>
				</div>
				<div>
					<input class="btnAction" type="button" name="back" id="back" value="Back" style="display:none;">
					<input class="btnAction" type="button" name="next" id="next" value="Next" >
					<input class="btnAction" type="submit" name="finish" id="finish" value="Finish" style="display:none;">
				</div>
			</form>
			
			
			<form action="" name="application">

				<label for="firstname">First Name</label>
				<input type="text" name="firstname" id="firstname" placeholder=""/>

				<label for="lastname">Last Name</label>
				<input type="text" name="lastname" id="lastname" placeholder=""/>

				<label for="email">Email</label>
				<input type="email" name="email" id="email" placeholder=""/>

				<label for="password">Password</label>
				<input type="password" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;"/>

				<button type="submit">Register</button>
			<form>-->
			
			<form name="apply-visa" id="apply-visa" method="post">
			
				<h3>Conatct Information</h3>
				            
				<div class="form-group row"> 
					<div class="col-sm-4">
						<label for="email">Email address*</label>
					</div>
					<div class="col-sm-8">
						<input type="email" class="form-control" required name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
						<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4">
						<label for="remail">Repeat email address*</label>
					</div>
					<div class="col-sm-8">
						<input type="email" class="form-control" required name="remail"  id="remail" aria-describedby="remailHelp" placeholder="Enter email">
						<small id="remailHelp" class="form-text text-muted">Repeat your email address here.</small>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4">
						<label for="mobile">Mobile</label>
					</div>
					<div class="col-sm-8">
						<input type="tel" class="form-control" required name="mobile" id="mobile" placeholder="Mobile">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4">
						<label for="address">Address *</label>
					</div>
					<div class="col-sm-8">	
						<input type="text" class="form-control" required name="address" id="address" placeholder="Street and house number">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4">
						<label for="postal_code">Postal code *</label>
					</div>
					<div class="col-sm-8">	
						<input type="text" class="form-control" required name="postal_code" id="postal_code" placeholder="Postal code">
					</div>
				</div>				  
				<div class="form-group row">
					<div class="col-sm-4">
						<label for="city">City / Town *</label>
					</div>
					<div class="col-sm-8">	
						<input type="text" class="form-control" required name="city" id="city" placeholder="City / Town">
					</div>
				</div>				  
				<div class="form-group row">
					<div class="col-sm-4">
						<label for="country">Country *</label>					
					</div>
					<div class="col-sm-8">
						<select class="form-control" required name="country" id="country" >
							<option value="">Select Country</option>
							<?php 
							if(!empty($countries)){
								foreach($countries as $country){
									?><option value="<?php echo $country->country_code;?>"><?php echo $country->name;?></option><?php
								}
							}
							?>
						</select> 
					</div>
				</div>
				
				<h3>Travel information</h3>
				
				<div class="form-group row">
					<div class="col-sm-4">
						<label for="travel_start_date">Starting date visa *</label>
					</div>
					<div class="col-sm-8">	
						<input type="date" class="form-control" required name="travel_start_date" id="travel_start_date">
					</div>
				</div>					
				<div class="form-check row">
					<div class="col-sm-4">
						<label for="urgentapply">Urgent application</label>
					</div>
					<div class="col-sm-8">	
						<input class="form-check-input"  name="urgentapply" type="checkbox" value="" id="urgentapply">
						<label class="form-check-label" for="urgentapply">Yes (added fee: €17,50 per visa)</label>
					</div>
				</div>		
				<div class="form-check row">
					<div class="col-sm-12">
						<h3>Information of the travellers</h3>
				
						<p><strong>Below, fill in the information of all travellers, including yourself and travelling children.</strong> Don't have all of the information ready? It is also possible to submit individual applications per person.</p>
					</div>
				</div>
				<div id="travellers">
					<div id="traveller_section"></div>
					<div id="tr-1">
						<div class="form-check row">
							<div class="col-sm-12">
								<h3> Traveller 1</h3>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4">
								<label for="documenttype_1">Travel document *</label>											
							</div>
							<div class="col-sm-8">
								<select class="form-control" required name="documenttype_1" id="documenttype_1" >
									<option value="pasport">Passport - normal/regular</option>
									<option value="pasport-di">Passport - diplomatic</option>
									<option value="pasport-se">Passport - service</option>
									<option value="id">Identity card</option>
									<option value="verblijf">Residence permit</option>
								</select> 
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4">
								<label for="documentnumber_1">Passport Number *</label>
							</div>
							<div class="col-sm-8">	
								<input type="text" class="form-control" required name="documentnumber_1" aria-describedby="documentNumberHelp_1" id="documentnumber_1">
								<small id="documentNumberHelp_1" class="form-text text-muted_1">The visa is digitally linked to this document number. It will not be possible to check-in if the document number is filled in wrongly here. <strong>Check this field again.</strong></small>
							</div>
						</div>		
						<div class="form-group row">
							<div class="col-sm-4">
								<label for="doc_issue_date_1">Date of issue *</label>
							</div>
							<div class="col-sm-8">	
								<input type="date" class="form-control" required name="doc_issue_date_1" id="doc_issue_date_1">
							</div>
						</div>	
						
						<div class="form-group row">
							<div class="col-sm-4">
								<label for="doc_expiration_date_1">Expiration date *</label>
							</div>
							<div class="col-sm-8">	
								<input type="date" class="form-control" required name="doc_expiration_date_1" id="doc_expiration_date_1">
							</div>
						</div>	
						
						<div class="form-group row">
							<div class="col-sm-4">
								<label for="allfirstname_1">All first names *</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" required name="allfirstname_1" id="allfirstname_1" placeholder="">
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-4">
								<label for="lastname_1">Last name *</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" required name="lastname_1" id="lastname_1" placeholder="Last name">
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-4">
								<label for="birthdate_1">Birthdate date *</label>
							</div>
							<div class="col-sm-8">
								<input type="date" class="form-control" required aria-describedby="birthdateHelp_1" name="birthdate_1" id="birthdate_1">
								<small id="birthdateHelp_1" class="form-text text-muted">This traveller is a minor. Passports of minors are sometimes valid for a shorter time. Carefully check the expiration date of the passport of this traveller.</small>
							</div>
						</div>	
						
						<div class="form-group row">
							<div class="col-sm-4">
								<label for="birthplace_1">Place of birth *</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" required name="birthplace_1" id="birthplace_1" placeholder="">
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-4">
								<label for="firstnamemother_1">First name mother</label>
								</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="firstnamemother_1" id="firstnamemother_1" placeholder="">
							</div>
						</div>					
						<div class="form-group row">
							<div class="col-sm-4">
								<label for="firstnamefather_1">First name father</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="firstnamefather_1" id="firstnamefather_1" placeholder="">
							</div>
						</div>	
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-12">
						<h3>Add travellers to the form</h3>
						<p><strong>Each traveller needs their own visa, including travelling children.</strong> By adding your fellow travellers to this application form, you do not have to fill in the contact and travel details each time.</p>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<p>
							<button type="button" class="btn btn-primary" id="addMoreTraveller"> <i class="fa fa-user-plus" aria-hidden="true"></i><?php echo __('Add traveller','traveldocs'); ?></button>
							<input type="hidden" value="1" name="cntTraveller" id="cntTraveller">
							<input type="hidden" value="1" name="noOfTraveller" id="noOfTraveller">
						</p>						
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<button type="submit" class="btn btn-primary" name="submit">Submit</button>
					</div>
				</div>
				
			</form>			
			
		<!--<div class="input_fields_container">
          <div><input type="text" name="product_name[]">
               <button class="btn btn-sm btn-primary add_more_button">Add More Fields</button>
          </div>
        </div>
		
		
		<form  method="post">
		  <ul id="fieldList">
			<li>
			  <input name="name[]" type="text" placeholder="Name" />
			</li>
			<li>
			  <input name="phone[]" type="text" placeholder="Phone" />
			</li>
			<li>
			  <input name="email[]" type="text" placeholder="E-Mail">
			</li>
		  </ul>
		  <button id="addMore">Add more fields</button>
		  <br>
		  <br>
		<input type="submit">
		</form>

		
		<h2><a href="#" id="addScnt">Add Another Input Box</a></h2>

		<div id="p_scents">
			<p>
				<label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt" value="" placeholder="Input Value" /></label>
			</p>
		</div>-->
			
			
        </div>
 
    </main><!-- .site-main -->
   
 
</div><!-- .content-area -->
<script>

jQuery('#apply-visa').validate();
	
jQuery(document).ready(function() {
	
	jQuery("#addMoreTraveller").click(function(e) {		
		e.preventDefault();
		var cntTraveller = jQuery('#cntTraveller').val();	
		cntTraveller = parseInt(cntTraveller) + 1;			
		jQuery('#cntTraveller').val(cntTraveller);	
		var noOfTraveller = jQuery('#noOfTraveller').val();	
		noOfTraveller = parseInt(noOfTraveller) + 1;			
		jQuery('#noOfTraveller').val(noOfTraveller);	
		
		var traveller_form = '<div id="tr-'+cntTraveller+'" class="traveller-group">';		
		
		// Traveller number heading
		traveller_form += '<div class="form-check row"><div class="col-sm-12"><h3> Traveller '+ cntTraveller +'</h3><a href="#" class="remove_traveller">Remove traveller</a></p></div></div>';
		
		// Document Type 
		traveller_form += '<div class="form-group row"><div class="col-sm-4"><label for="documenttype_'+cntTraveller+'">Travel document *</label></div><div class="col-sm-8"><select class="form-control" required name="documenttype_'+cntTraveller+'" id="documenttype_'+cntTraveller+'" ><option value="pasport">Passport - normal/regular</option><option value="pasport-di">Passport - diplomatic</option><option value="pasport-se">Passport - service</option><option value="id">Identity card</option><option value="verblijf">Residence permit</option></select> </div></div>';	
		
		// Document Number
		traveller_form += '<div class="form-group row"><div class="col-sm-4"><label for="documentnumber_'+cntTraveller+'">Passport Number *</label></div><div class="col-sm-8"><input type="text" class="form-control" required name="documentnumber_'+cntTraveller+'" aria-describedby="documentNumberHelp_'+cntTraveller+'" id="documentnumber_'+cntTraveller+'"><small id="'+cntTraveller+'" class="form-text text-muted_'+cntTraveller+'">The visa is digitally linked to this document number. It will not be possible to check-in if the document number is filled in wrongly here. <strong>Check this field again.</strong></small></div></div>';
		
		// Date of issue
		traveller_form += '<div class="form-group row"><div class="col-sm-4"><label for="doc_issue_date_'+cntTraveller+'">Date of issue *</label></div><div class="col-sm-8"><input type="date" class="form-control" required name="doc_issue_date_'+cntTraveller+'" id="doc_issue_date_'+cntTraveller+'"></div></div>';
		
		// Expiration date
		traveller_form += '<div class="form-group row"><div class="col-sm-4"><label for="doc_expiration_date_'+cntTraveller+'">Expiration date *</label></div><div class="col-sm-8"><input type="date" class="form-control" required name="doc_expiration_date_'+cntTraveller+'" id="doc_expiration_date_'+cntTraveller+'"></div></div>';
		
		
		// All first names
		traveller_form += '<div class="form-group row"><div class="col-sm-4"><label for="allfirstname_'+cntTraveller+'">All first names *</label></div><div class="col-sm-8"><input type="text" class="form-control" required name="allfirstname_'+cntTraveller+'" id="allfirstname_'+cntTraveller+'" placeholder=""></div></div>';
		
		// Last name
		traveller_form += '<div class="form-group row"><div class="col-sm-4"><label for="lastname_'+cntTraveller+'">Last name *</label></div><div class="col-sm-8"><input type="text" class="form-control" required name="lastname_'+cntTraveller+'" id="lastname_'+cntTraveller+'" placeholder="Last name"></div></div>';
		
		// Birthdate date
		traveller_form += '<div class="form-group row"><div class="col-sm-4"><label for="birthdate_'+cntTraveller+'">Birthdate date *</label></div><div class="col-sm-8"><input type="date" class="form-control" required aria-describedby="'+cntTraveller+'" name="birthdate_'+cntTraveller+'" id="birthdate_'+cntTraveller+'"><small id="birthdateHelp_'+cntTraveller+'" class="form-text text-muted">This traveller is a minor. Passports of minors are sometimes valid for a shorter time. Carefully check the expiration date of the passport of this traveller.</small></div></div>';
			
		// Place of birth
		traveller_form += '<div class="form-group row"><div class="col-sm-4"><label for="birthplace_'+cntTraveller+'">Place of birth *</label></div><div class="col-sm-8"><input type="text" class="form-control" required name="birthplace_'+cntTraveller+'" id="birthplace_'+cntTraveller+'" placeholder=""></div></div>';	
		
		// First name mother
		traveller_form += '<div class="form-group row"><div class="col-sm-4"><label for="firstnamemother_'+cntTraveller+'">First name mother</label></div><div class="col-sm-8"><input type="text" class="form-control" name="firstnamemother_'+cntTraveller+'" id="firstnamemother_'+cntTraveller+'" placeholder=""></div></div>';
		
		// First name father
		traveller_form += '<div class="form-group row"><div class="col-sm-4"><label for="firstnamefather_'+cntTraveller+'">First name father</label></div><div class="col-sm-8"><input type="text" class="form-control" name="firstnamefather_'+cntTraveller+'" id="firstnamefather_'+cntTraveller+'" placeholder=""></div></div>';
		
		traveller_form += '</div>';	
		
		jQuery("#travellers").append(traveller_form);	
		
	});	
	
	jQuery("body").on( "click", ".remove_traveller", function (event) {		
		event.preventDefault();		
		var result = confirm("Are you sure you wish to remove this traveller?");
		if (result) {			
			jQuery(this).closest('.traveller-group').remove();
			return false;
		}
	});
	
    /* var max_fields_limit      = 10; //set limit for maximum input fields
    var x = 1; //initialize counter for text box
    jQuery('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
        e.preventDefault();
        if(x < max_fields_limit){ //check conditions
            x++; //counter increment
            $('.input_fields_container').append('<div><input type="text" name="product_name[]"/><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div>'); //add input field
        }
    });  
    jQuery('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })	
	
	jQuery("#addMore").click(function(e) {
		e.preventDefault();
		jQuery("#fieldList").append("<li>&nbsp;</li>");
		jQuery("#fieldList").append("<li><input type='text' name='name[]' placeholder='Name' /></li>");
		jQuery("#fieldList").append("<li><input type='text' name='phone[]' placeholder='Phone' /></li>");
		jQuery("#fieldList").append("<li><input type='text' name='email[]' placeholder='E-Mail' /></li>");
	});   
	
	// 3rd try
	var scntDiv = $('#p_scents');
	var i = jQuery('#p_scents p').length + 1;
	
	jQuery('#addScnt').on('click', function() {
		jQuery('<p><label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt_' + i +'" value="" placeholder="Input Value" /></label> <a href="#" class="remScnt" id="remScnt">Remove</a></p>').appendTo(scntDiv);
		i++;
		return false;
	});
	jQuery("body").on( "click", ".remScnt", function (event) {
	//jQuery('.remScnt').on('click', function(event) { 
		event.preventDefault();
		//if( i > 2 ) {
				jQuery(this).parents('p').remove();
			//	i--;
		//}
		return false;
	}); */
});
</script>
<?php get_footer(); ?>

