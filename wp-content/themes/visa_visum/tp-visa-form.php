<?php /* Template Name: VISA Form */ ?>

<?php get_header(); ?>
 
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        // Get the list of Nationality
		global $wpdb;
		$national_table = $wpdb->prefix."user_destination";
		$user_nationality = $wpdb->prefix."user_nationality";
		$travel_purpose = $wpdb->prefix."travel_purpose";

		$nationalityQuery = $wpdb->get_results( "SELECT * FROM $user_nationality" );
		//$nationalityQuery = $wpdb->get_results( "SELECT * FROM $national_table" );
		//$nationalityQuery = $wpdb->get_results( "SELECT * FROM $national_table" );
        ?>
		<br />
		<br />
		<label>I hold a passport from</label>
		<select name="nationality">
			<option>Select Nationality</option>
			<?php if(!empty($nationalityQuery)){
				foreach($nationalityQuery as $record){
				echo '<option value="'.$record->id.'">'.$record->country.' ( '.$record->country_abbr.' )</option>';
				}
			} ?>
		</select>
		<br />
		<br />
		<label>I am travelling to</label>
		<select name="destination" id="destination">
			<option>Select Destination</option>
			<?php if(!empty($nationalityQuery)){
				foreach($nationalityQuery as $record){
				echo '<option value="'.$record->id.'">'.$record->country.' ( '.$record->country_abbr.' )</option>';
				}
			} ?>
		</select>
		<br />
		<br />
		<label>My purpose of trip is</label>
		<select name="purpose" id="purpose">
			<option>Select Purpose</option>
			<?php 
			/* if(!empty($nationalityQuery)){
				foreach($nationalityQuery as $record){
				echo '<option value="'.$record->id.'">'.$record->country.' ( '.$record->country_abbr.' )</option>';
				}
			}  */
			?>
		</select>
		
		<br />
		<br />
		<br />
		<input type="submit" id="search" value="search">
		
		<div id="result">
		
		</div>
		
 
    </main><!-- .site-main -->
   
 
</div><!-- .content-area -->

<?php get_footer(); ?>

