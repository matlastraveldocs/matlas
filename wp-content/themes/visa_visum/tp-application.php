<?php /* Template Name: Applicstion Template */ ?>

<?php get_header(); ?>

<?php
// Get List of country
global $wpdb;
$countries_table = $wpdb->prefix."countries"; 
$countries = $wpdb->get_results("SELECT * FROM $countries_table");
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$email = "";
$remail = "";
$mobile  = "";
$address  = "";
$postal_code = "";
$city = "";
$country_code = "";
$travel_start_date = "";
$urgentapply = "";

$documenttype[1] = '';
$documentnumber[1] = '';
$doc_issue_date[1] = '';
$doc_expiration_date[1]= '';
$allfirstname[1] = '';
$lastname[1] = '';
$birthdate[1] = '';
$birthplace[1] = '';
$firstnamemother[1] = '';
$firstnamefather[1] = '';

if(isset($_POST['submit'])){
	/* echo "<pre>REQUEST :: ";
	print_r($_REQUEST);
	echo "</pre>"; */
	
	// Checking first page values for empty,If it finds any blank field then redirected to first page.
	/* $email = "";
	$remail = "";
	$mobile  = "";
	$address  = "";
	$postal_code = "";
	$city = "";
	$country_code = "";
	$travel_start_date = "";
	$urgentapply = ""; */
	// Email
	if(empty($_POST['email'])){
		$_SESSION['errors']['email'] = __('This field is required.','traveldocs');
	}
	else {
		$_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 		
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 
			$_SESSION['errors']['email'] = __('Please enter a valid email address.','traveldocs');
		}
		$email = test_input($_POST["email"]);
	}
	
	// Confirm email
	if(empty($_POST['remail'])){
		$_SESSION['errors']['remail'] = __('This field is required.','traveldocs');
	}
	else {
		$_POST['remail'] = filter_var($_POST['remail'], FILTER_SANITIZE_EMAIL); 		
		if (!filter_var($_POST['remail'], FILTER_VALIDATE_EMAIL)){ 
			$_SESSION['errors']['remail'] = __('Please enter a valid confirm email address.','traveldocs');
		}	
		$remail = test_input($_POST["remail"]);
	}	
	
	// Mobile
	if(empty($_POST['mobile'])){
		$_SESSION['errors']['mobile'] = __('This field is required.','traveldocs');
	}
	else {
		$mobile = test_input($_POST["mobile"]);
	}
	
	// Address
	if(empty($_POST['address'])){
		$_SESSION['errors']['address'] = __('This field is required.','traveldocs');
	}
	else {
		$address = test_input($_POST["address"]);
	}	
	
	// Postal Code
	if(empty($_POST['postal_code'])){
		$_SESSION['errors']['postal_code'] = __('This field is required.','traveldocs');
	}
	else {
		$postal_code = test_input($_POST["postal_code"]);
	}
	
	// City
	if(empty($_POST['city'])){
		$_SESSION['errors']['city'] = __('This field is required.','traveldocs');
	}
	else {
		$city = test_input($_POST["city"]);
	}
	
	// Country	
	if(empty($_POST['country'])){
		$_SESSION['errors']['country'] = __('This field is required.','traveldocs');
	}
	else {
		$country_code = test_input($_POST["country"]);
	}
	
	// Travel Start Date
	if(empty($_POST['travel_start_date'])){
		$_SESSION['errors']['travel_start_date'] = __('This field is required.','traveldocs');
	}
	else {
		$travel_start_date = test_input($_POST["travel_start_date"]);
	}	
	
	// Urgent Apply 
	if(!empty($_POST['urgentapply'])){
		$urgentapply = $_POST['urgentapply'] ;
	}
	
	
	// Validate Travellers
	if(!empty($_POST['traveller'])){
		foreach($_POST['traveller'] as $key => $traveller_detail){						
			$documenttype[$key] = "";
			$documentnumber[$key] = "";
			$doc_issue_date[$key] = "";
			$doc_expiration_date[$key] = "";
			$allfirstname[$key] = "";
			$lastname[$key] = "";
			$birthdate[$key] = "";
			$birthplace[$key] = "";
			$firstnamemother[$key] = "";
			$firstnamefather[$key] = "";
			
			// Document Type
			if(empty($_POST[$key]['documenttype'])){
				$_SESSION['errors'][$key]['documenttype'] = __('This field is required.','traveldocs');
			}
			else {
				$documenttype[$key] = test_input($traveller_detail["documenttype"]);
			}
			
			// Document Number 
			if(empty($_POST[$key]['documentnumber'])){
				$_SESSION['errors'][$key]['documentnumber'] = __('This field is required.','traveldocs');
			}
			else {
				$documentnumber[$key] = test_input($traveller_detail["documentnumber"]);
			}			
			
			// Document issue date
			if(empty($_POST[$key]['doc_issue_date'])){
				$_SESSION['errors'][$key]['doc_issue_date'] = __('This field is required.','traveldocs');
			}
			else {
				$doc_issue_date[$key] = test_input($traveller_detail["doc_issue_date"]);
			}

			// Document expire date
			if(empty($_POST[$key]['doc_expiration_date'])){
				$_SESSION['errors'][$key]['doc_expiration_date'] = __('This field is required.','traveldocs');
			}
			else {
				$doc_expiration_date[$key] = test_input($traveller_detail["doc_expiration_date"]);
			}			
			
			// All first name
			if(empty($_POST[$key]['allfirstname'])){
				$_SESSION['errors'][$key]['allfirstname'] = __('This field is required.','traveldocs');
			}
			else {
				$allfirstname[$key] = test_input($traveller_detail["allfirstname"]);
			}
			
			// All Last Name
			if(empty($_POST[$key]['lastname'])){
				$_SESSION['errors'][$key]['lastname'] = __('This field is required.','traveldocs');
			}
			else {
				$lastname[$key] = test_input($traveller_detail["lastname"]);
			}
			
			// Birthdate
			if(empty($_POST[$key]['birthdate'])){
				$_SESSION['errors'][$key]['birthdate'] = __('This field is required.','traveldocs');
			}
			else {
				$birthdate[$key] = test_input($traveller_detail["birthdate"]);
			}
			
			// Birth Place
			if(empty($_POST[$key]['birthplace'])){
				$_SESSION['errors'][$key]['birthplace'] = __('This field is required.','traveldocs');
			}
			else {
				$birthplace[$key] = test_input($traveller_detail["birthplace"]);
			}
			
			// First name of mother
			if(!empty($_POST[$key]['firstnamemother'])){
				$firstnamemother[$key] = test_input($traveller_detail["firstnamemother"]);
			}
			
			// First name of father
			if(!empty($_POST[$key]['firstnamefather'])){
				$firstnamefather[$key] = test_input($traveller_detail["firstnamefather"]);
			}
		}
	}
	/* 
	
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>"; */
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
			<form>
			
			<form name="apply-visa1" id="apply-visa1" method="post">		
				<input type="text" name="input[1][fmname]">
				<input type="text" name="input[1][lname]">
				<br />
				<br />
				<input type="text" name="input[2][fmname]">
				<input type="text" name="input[2][lname]">
				<br />
				<br />
				<input type="text" name="input[3][fmname]">
				<input type="text" name="input[3][lname]">
				<br />				<br />				
				<button type="submit" class="btn btn-primary" name="submit1">Submit</button>
			</form>-->
			
			<form name="apply-visa" id="apply-visa" method="post" class="visa_form_submit">						
			
				<h3>Conatct Information</h3>
				<?php
				if(isset($_SESSION['error_1'])){
					echo $_SESSION['error_1'];
				}				            
				?><div class="form-group row"> 
					<div class="vc_col-md-4">
						<label for="email">Email address*</label>
					</div>
					<div class="vc_col-md-8">
						<input type="email" class="form-control" required name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $email; ?>"><?php
						if(isset($_SESSION['errors']['email'])){											
							?><label for="email" class="error"><?php echo $_SESSION['errors']['email']; ?></label><?php
						}
						?><small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div>
				</div>
				<div class="form-group row">
					<div class="vc_col-md-4">
						<label for="remail">Repeat email address*</label>
					</div>
					<div class="vc_col-md-8">
						<input type="email" class="form-control" required name="remail" value="<?php echo $remail; ?>" id="remail" aria-describedby="remailHelp" placeholder="Enter email">
						<?php
						if(isset($_SESSION['errors']['remail'])){											
							?><label for="remail" class="error"><?php echo $_SESSION['errors']['remail']; ?></label><?php
						}
						?>
						<small id="remailHelp" class="form-text text-muted">Repeat your email address here.</small>
					</div>
				</div>
				<div class="form-group row">
					<div class="vc_col-md-4">
						<label for="mobile">Mobile</label>
					</div>
					<div class="vc_col-md-8">
						<input type="tel" class="form-control" required name="mobile" value="<?php echo $mobile; ?>" id="mobile" placeholder="Mobile"><?php
						if(isset($_SESSION['errors']['mobile'])){											
							?><label for="mobile" class="error"><?php echo $_SESSION['errors']['mobile']; ?></label><?php
						}
					?></div>
				</div>
				<div class="form-group row">
					<div class="vc_col-md-4">
						<label for="address">Address *</label>
					</div>
					<div class="vc_col-md-8">	
						<input type="text" class="form-control" required name="address" value="<?php echo $address; ?>" id="address" placeholder="Street and house number">
						<?php
						if(isset($_SESSION['errors']['address'])){											
							?><label for="address" class="error"><?php echo $_SESSION['errors']['address']; ?></label><?php
						}
						?>
					</div>
				</div>
				<div class="form-group row">
					<div class="vc_col-md-4">
						<label for="postal_code">Postal code *</label>
					</div>
					<div class="vc_col-md-8">	
						<input type="text" class="form-control" required name="postal_code" value="<?php echo $postal_code; ?>" id="postal_code" placeholder="Postal code">
						<?php
						if(isset($_SESSION['errors']['postal_code'])){											
							?><label for="postal_code" class="error"><?php echo $_SESSION['errors']['postal_code']; ?></label><?php
						}
						?>
					</div>
				</div>				  
				<div class="form-group row">
					<div class="vc_col-md-4">
						<label for="city"><?php echo __('City / Town','traveldocs'); ?> *</label>
					</div>
					<div class="vc_col-md-8">	
						<input type="text" class="form-control" required name="city" id="city" value="<?php echo $city; ?>" placeholder="<?php echo __('City / Town','traveldocs'); ?>">
						<?php
						if(isset($_SESSION['errors']['city'])){											
							?><label for="city" class="error"><?php echo $_SESSION['errors']['city']; ?></label><?php
						}
						?>
					</div>
				</div>				  
				<div class="form-group row">
					<div class="vc_col-md-4">
						<label for="country">Country *</label>					
					</div>
					<div class="vc_col-md-8">
						<select class="form-control" required name="country" id="country" >
							<option value="">Select Country</option>
							<?php 
							if(!empty($countries)){
								foreach($countries as $country){
									?><option value="<?php echo $country->country_code;?>" <?php if ($country_code == $country->country_code ) echo 'selected' ; ?> ><?php echo $country->name;?></option><?php
								}
							}
							?>
						</select> 
						<?php
						if(isset($_SESSION['errors']['country'])){											
							?><label for="country" class="error"><?php echo $_SESSION['errors']['country']; ?></label><?php
						}
						?>
					</div>
				</div>
				
				<h3>Travel information</h3>
				
				<div class="form-group row">
					<div class="vc_col-md-4">
						<label for="travel_start_date">Starting date visa *</label>
					</div>
					<div class="vc_col-md-8">	
						<input type="date" class="form-control" required value="<?php echo $travel_start_date; ?>" name="travel_start_date" id="travel_start_date">
						<?php
						if(isset($_SESSION['errors']['travel_start_date'])){											
							?><label for="travel_start_date" class="error"><?php echo $_SESSION['errors']['travel_start_date']; ?></label><?php
						}
						?>
					</div>
				</div>					
				<div class="form-check row">
					<div class="vc_col-md-4">
						<label for="urgentapply">Urgent application</label>
					</div>
					<div class="vc_col-md-8 urgent">	
						<input class="form-check-input"  name="urgentapply" <?php if($urgentapply == 1){ echo 'checked'; } ?> type="checkbox" value="1" id="urgentapply">
						<label class="form-check-label" for="urgentapply">Yes (added fee: €17,50 per visa)</label>
					</div>
				</div>		
				<div class="form-check row">
					<div class="vc_col-md-12">
						<h3>Information of the travellers</h3>
				
						<p><strong>Below, fill in the information of all travellers, including yourself and travelling children.</strong> Don't have all of the information ready? It is also possible to submit individual applications per person.</p>
					</div>
				</div><?php
				$cntTraveller = 1;
				if(isset($_POST['traveller'])){
					$cntTraveller = count($_POST['traveller']);
				}				
				?><div id="travellers">
					<?php
					for($i=1; $i<=$cntTraveller;$i++){
						?><div id="tr-<?php echo $i;?>">
							<div class="form-check row">
								<div class="vc_col-md-12">
									<h3><?php echo __('Traveller','traveldocs'); ?> <?php echo $i;?></h3>
								</div>
							</div>
							<div class="form-group row">
								<div class="vc_col-md-4">
									<label for="traveller[<?php echo $i;?>][documenttype]">Travel document *</label>											
								</div>
								<div class="vc_col-md-8">
									<select class="form-control" required name="traveller[<?php echo $i;?>][documenttype]" id="documenttype_<?php echo $i;?>" >
										<option value="pasport" <?php if ($documenttype[$i] == 'pasport' ) echo 'selected' ; ?> >Passport - normal/regular</option>
										<option value="pasport-di" <?php if ($documenttype[$i] == 'pasport-di' ) echo 'selected' ; ?>>Passport - diplomatic</option>
										<option value="pasport-se" <?php if ($documenttype[$i] == 'pasport-se' ) echo 'selected' ; ?>>Passport - service</option>
										<option value="id" <?php if ($documenttype[$i] == 'id' ) echo 'selected' ; ?>>Identity card</option>
										<option value="verblijf" <?php if ($documenttype[$i] == 'verblijf' ) echo 'selected' ; ?>>Residence permit</option>
									</select> 
									<?php
									if(isset($_SESSION['errors'][$i]['documenttype'])){											
										?><label for="documenttype_<?php echo $i;?>" class="error"><?php echo $_SESSION['errors'][$i]['documenttype']; ?></label><?php
									}
									?>
								</div>
							</div>
							<div class="form-group row">
								<div class="vc_col-md-4">
									<label for="documentnumber_<?php echo $i;?>">Passport Number *</label>
								</div>
								<div class="vc_col-md-8">	
									<input type="text" class="form-control" required name="traveller[<?php echo $i;?>][documentnumber]" value="<?php echo $documentnumber[$i]; ?>" aria-describedby="documentNumberHelp_<?php echo $i;?>" id="documentnumber_<?php echo $i;?>">
									<?php
									if(isset($_SESSION['errors'][$i]['documentnumber'])){											
										?><label for="documentnumber_<?php echo $i;?>" class="error"><?php echo $_SESSION['errors'][$i]['documentnumber']; ?></label><?php
									}
									?>
									<small id="documentNumberHelp_<?php echo $i;?>" class="form-text text-muted">The visa is digitally linked to this document number. It will not be possible to check-in if the document number is filled in wrongly here. <strong>Check this field again.</strong></small>
								</div>
							</div>		
							<div class="form-group row">
								<div class="vc_col-md-4">
									<label for="doc_issue_date_<?php echo $i;?>">Date of issue *</label>
								</div>
								<div class="vc_col-md-8">	
									<input type="date" class="form-control" required name="traveller[<?php echo $i;?>][doc_issue_date]" value="<?php echo $doc_issue_date[$i]; ?>" id="doc_issue_date_<?php echo $i;?>">
									<?php
									if(isset($_SESSION['errors'][$i]['doc_issue_date'])){											
										?><label for="doc_issue_date_<?php echo $i;?>" class="error"><?php echo $_SESSION['errors'][$i]['doc_issue_date']; ?></label><?php
									}
									?>
								</div>
							</div>	
							
							<div class="form-group row">
								<div class="vc_col-md-4">
									<label for="doc_expiration_date_<?php echo $i;?>">Expiration date *</label>
								</div>
								<div class="vc_col-md-8">	
									<input type="date" class="form-control" required name="traveller[<?php echo $i;?>][doc_expiration_date]" value="<?php echo $doc_expiration_date[$i]; ?>" id="doc_expiration_date_<?php echo $i;?>">
									<?php
									if(isset($_SESSION['errors'][$i]['doc_expiration_date'])){											
										?><label for="doc_expiration_date_<?php echo $i;?>" class="error"><?php echo $_SESSION['errors'][$i]['doc_expiration_date']; ?></label><?php
									}
									?>
								</div>
							</div>	
							
							<div class="form-group row">
								<div class="vc_col-md-4">
									<label for="allfirstname_<?php echo $i;?>">All first names *</label>
								</div>
								<div class="vc_col-md-8">
									<input type="text" class="form-control" required name="traveller[<?php echo $i;?>][allfirstname]" id="allfirstname_<?php echo $i;?>" value="<?php echo $allfirstname[$i]; ?>" placeholder="">
									<?php
									if(isset($_SESSION['errors'][$i]['allfirstname'])){											
										?><label for="allfirstname_<?php echo $i;?>" class="error"><?php echo $_SESSION['errors'][$i]['allfirstname']; ?></label><?php
									}
									?>
								</div>
							</div>
							
							<div class="form-group row">
								<div class="vc_col-md-4">
									<label for="lastname_<?php echo $i;?>">Last name *</label>
								</div>
								<div class="vc_col-md-8">
									<input type="text" class="form-control" required name="traveller[<?php echo $i;?>][lastname]" id="lastname_<?php echo $i;?>" value="<?php echo $lastname[$i]; ?>" placeholder="Last name">
									<?php
									if(isset($_SESSION['errors'][$i]['lastname'])){											
										?><label for="lastname_<?php echo $i;?>" class="error"><?php echo $_SESSION['errors'][$i]['lastname']; ?></label><?php
									}
									?>
								</div>
							</div>
							
							<div class="form-group row">
								<div class="vc_col-md-4">
									<label for="birthdate_<?php echo $i;?>">Birthdate date *</label>
								</div>
								<div class="vc_col-md-8">
									<input type="date" class="form-control" required aria-describedby="birthdateHelp_<?php echo $i;?>" name="traveller[<?php echo $i;?>][birthdate]" value="<?php echo $birthdate[$i]; ?>" id="birthdate_<?php echo $i;?>">
									<?php
									if(isset($_SESSION['errors'][$i]['birthdate'])){											
										?><label for="birthdate_<?php echo $i;?>" class="error"><?php echo $_SESSION['errors'][$i]['birthdate']; ?></label><?php
									}
									?>
									<small id="birthdateHelp_<?php echo $i;?>" class="form-text text-muted">This traveller is a minor. Passports of minors are sometimes valid for a shorter time. Carefully check the expiration date of the passport of this traveller.</small>
								</div>
							</div>	
							
							<div class="form-group row">
								<div class="vc_col-md-4">
									<label for="birthplace_<?php echo $i;?>">Place of birth *</label>
								</div>
								<div class="vc_col-md-8">
									<input type="text" class="form-control" required name="traveller[<?php echo $i;?>][birthplace]" value="<?php echo $birthplace[$i]; ?>" id="birthplace_<?php echo $i;?>" placeholder="">
									<?php
									if(isset($_SESSION['errors'][$i]['birthplace'])){											
										?><label for="birthplace_<?php echo $i;?>" class="error"><?php echo $_SESSION['errors'][$i]['birthplace']; ?></label><?php
									}
									?>
								</div>
							</div>
							
							<div class="form-group row">
								<div class="vc_col-md-4">
									<label for="firstnamemother_<?php echo $i;?>" >First name mother</label>
									</div>
								<div class="vc_col-md-8">
									<input type="text" class="form-control" name="traveller[<?php echo $i;?>][firstnamemother]" value="<?php echo $firstnamemother[$i];?>" id="firstnamemother_<?php echo $i;?>" placeholder="">
								</div>
							</div>
							<div class="form-group row">
								<div class="vc_col-md-4">
									<label for="firstnamefather_<?php echo $i;?>">First name father</label>
								</div>
								<div class="vc_col-md-8">
									<input type="text" class="form-control" name="traveller[<?php echo $i;?>][firstnamefather]" value="<?php echo $firstnamefather[$i];?>" id="firstnamefather_<?php echo $i;?>" placeholder="">
								</div>
							</div>	
						</div><?php
					}	
					?>
				</div>
				
				<div class="form-group row">
					<div class="vc_col-md-12">
						<h3><?php echo __('Add travellers to the form','traveldocs'); ?></h3>
						<p><strong>Each traveller needs their own visa, including travelling children.</strong> By adding your fellow travellers to this application form, you do not have to fill in the contact and travel details each time.</p>
					</div>
				</div>
				<div class="form-group row">
					<div class="vc_col-md-12">
						<p>
							<button type="button" class="btn btn-primary" id="addMoreTraveller"> <i class="fa fa-user-plus" aria-hidden="true"></i><?php echo __('Add traveller','traveldocs'); ?></button>
							<input type="hidden" value="<?php echo $cntTraveller; ?>" name="cntTraveller" id="cntTraveller">
							<input type="hidden" value="<?php echo $cntTraveller; ?>" name="noOfTraveller" id="noOfTraveller">
						</p>						
					</div>
				</div>
				<div class="form-group row">
					<div class="vc_col-md-12">
						<button type="submit" class="btn btn-primary" name="submit"><?php echo __('Request a visa','traveldocs'); ?></button>
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
		traveller_form += '<div class="form-check row"><div class="vc_col-md-12"><h3> Traveller '+ cntTraveller +'</h3><a href="#" class="remove_traveller">Remove traveller</a></p></div></div>';
		
		// Document Type 
		traveller_form += '<div class="form-group row"><div class="vc_col-md-4"><label for="documenttype_'+cntTraveller+'">Travel document *</label></div><div class="vc_col-md-8"><select class="form-control" required name="traveller['+cntTraveller+'][documenttype]" id="documenttype_'+cntTraveller+'" ><option value="pasport">Passport - normal/regular</option><option value="pasport-di">Passport - diplomatic</option><option value="pasport-se">Passport - service</option><option value="id">Identity card</option><option value="verblijf">Residence permit</option></select> </div></div>';	
		
		// Document Number
		traveller_form += '<div class="form-group row"><div class="vc_col-md-4"><label for="documentnumber_'+cntTraveller+'">Passport Number *</label></div><div class="vc_col-md-8"><input type="text" class="form-control" required name="traveller['+cntTraveller+'][documentnumber]" aria-describedby="documentNumberHelp_'+cntTraveller+'" id="documentnumber_'+cntTraveller+'"><small id="documentNumberHelp_'+cntTraveller+'" class="form-text text-muted">The visa is digitally linked to this document number. It will not be possible to check-in if the document number is filled in wrongly here. <strong>Check this field again.</strong></small></div></div>';
		
		// Date of issue
		traveller_form += '<div class="form-group row"><div class="vc_col-md-4"><label for="doc_issue_date_'+cntTraveller+'">Date of issue *</label></div><div class="vc_col-md-8"><input type="date" class="form-control" required name="traveller['+cntTraveller+'][doc_issue_date]" id="doc_issue_date_'+cntTraveller+'"></div></div>';
		
		// Expiration date
		traveller_form += '<div class="form-group row"><div class="vc_col-md-4"><label for="doc_expiration_date_'+cntTraveller+'">Expiration date *</label></div><div class="vc_col-md-8"><input type="date" class="form-control" required name="traveller['+cntTraveller+'][doc_expiration_date]" id="doc_expiration_date_'+cntTraveller+'"></div></div>';
		
		
		// All first names
		traveller_form += '<div class="form-group row"><div class="vc_col-md-4"><label for="allfirstname_'+cntTraveller+'">All first names *</label></div><div class="vc_col-md-8"><input type="text" class="form-control" required name="traveller['+cntTraveller+'][allfirstname]" id="allfirstname_'+cntTraveller+'" placeholder=""></div></div>';
		
		// Last name
		traveller_form += '<div class="form-group row"><div class="vc_col-md-4"><label for="lastname_'+cntTraveller+'">Last name *</label></div><div class="vc_col-md-8"><input type="text" class="form-control" required name="traveller['+cntTraveller+'][lastname]" id="lastname_'+cntTraveller+'" placeholder="Last name"></div></div>';
		
		// Birthdate date
		traveller_form += '<div class="form-group row"><div class="vc_col-md-4"><label for="birthdate_'+cntTraveller+'">Birthdate date *</label></div><div class="vc_col-md-8"><input type="date" class="form-control" required aria-describedby="'+cntTraveller+'" name="traveller['+cntTraveller+'][birthdate]" id="birthdate_'+cntTraveller+'"><small id="birthdateHelp_'+cntTraveller+'" class="form-text text-muted">This traveller is a minor. Passports of minors are sometimes valid for a shorter time. Carefully check the expiration date of the passport of this traveller.</small></div></div>';
			
		// Place of birth
		traveller_form += '<div class="form-group row"><div class="vc_col-md-4"><label for="birthplace_'+cntTraveller+'">Place of birth *</label></div><div class="vc_col-md-8"><input type="text" class="form-control" required name="traveller['+cntTraveller+'][birthplace]" id="birthplace_'+cntTraveller+'" placeholder=""></div></div>';	
		
		// First name mother
		traveller_form += '<div class="form-group row"><div class="vc_col-md-4"><label for="firstnamemother_'+cntTraveller+'">First name mother</label></div><div class="vc_col-md-8"><input type="text" class="form-control" name="traveller['+cntTraveller+'][firstnamemother]" id="firstnamemother_'+cntTraveller+'" placeholder=""></div></div>';
		
		// First name father
		traveller_form += '<div class="form-group row"><div class="vc_col-md-4"><label for="firstnamefather_'+cntTraveller+'">First name father</label></div><div class="vc_col-md-8"><input type="text" class="form-control" name="traveller['+cntTraveller+'][firstnamefather]" id="firstnamefather_'+cntTraveller+'" placeholder=""></div></div>';
		
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

