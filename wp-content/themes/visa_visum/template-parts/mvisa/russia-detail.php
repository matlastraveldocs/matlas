<?php
$visa_id = $_GET['fid'];
$visa_destination = $_GET['dest'];

if ($visa_destination == 'Russia') {
	$main_table = $wpdb->prefix.'russia_visa_form_new';
	$traveral_table = $wpdb->prefix."russia_visa_traverler_data_new";
	$intended_table= $wpdb->prefix."russia_intended_data";
	$place_table= $wpdb->prefix."russia_place_visit_data";

	$sql = "select * from ".$main_table." where ID = ".$visa_id;

	$traveral_sql = "select * from ".$traveral_table." where russia_form_id = ".$visa_id;

	$intended_sql = "select * from ".$intended_table." where russia_id = ".$visa_id;

	$place_sql = "select * from ".$place_table." where russia_id = ".$visa_id;

	$main_results = $wpdb->get_results($sql,ARRAY_A);
	$wpdb->flush();

	$traveral_results = $wpdb->get_results($traveral_sql,ARRAY_A);
	$wpdb->flush();

	$intended_results = $wpdb->get_results($intended_sql,ARRAY_A);
	$wpdb->flush();

	$place_results = $wpdb->get_results($place_sql,ARRAY_A);
	$wpdb->flush();
	?>
	<?php if(!empty($main_results)){ ?>
	    <h3>General Information</h3>
	    <div class="visa_details_list">
	    <?php
	    for ($mr = 0; $mr < sizeof($main_results); $mr++){
	        unset($main_results[$mr]['ID']);
	        unset($main_results[$mr]['final_status']);
    		unset($main_results[$mr]['created_date']);
	        foreach ($main_results[$mr] as $key => $value){
	        if($value != ''){
	        ?>
	          <div class="visa_detailing">
	            <h4><?php echo ucfirst(str_replace('_',' ',$key)); ?></h4>
	            <h5><?php echo $value; ?></h5>
	          </div>
	      <?php
	        }
	      }
	    } ?>
	    </div>
	<?php }
	if(!empty($traveral_results)){ ?>
	    <h3>Traveral Information</h3>
	    <?php
	    for ($tr = 0; $tr < sizeof($traveral_results); $tr++){
	      ?>
	      <h4>Traveral - <?php echo $tr+1; ?></h4>
	      <div class="visa_details_list">
	        <?php
	            unset($traveral_results[$tr]['ID']);
	            unset($traveral_results[$tr]['russia_form_id']);
	            foreach ($traveral_results[$tr] as $key => $value){
	            if($value != ''){
	            ?>
	            <div class="visa_detailing">
	                <h4><?php echo ucfirst(str_replace('_',' ',$key)); ?></h4>
	                <h5><?php echo $value; ?></h5>
	            </div>
	        <?php } } ?>
	      </div>
	      <?php
	    } ?>
	<?php }
	if(!empty($intended_results)){ ?>
	    <h3>Intended Information</h3>
	    <?php
	    for ($ir = 0; $ir < sizeof($intended_results); $ir++){
	    ?>
	    <h4>Intended - <?php echo $ir+1; ?></h4>
	    <div class="visa_details_list">
	    <?php
	      foreach ($intended_results[$ir] as $key => $value){
	        if($value != ''){
	        ?>
	        <div class="visa_detailing">
	            <h4><?php echo ucfirst(str_replace('_',' ',$key)); ?></h4>
	            <h5><?php echo $value; ?></h5>
	        </div>
	      <?php
	        }
	      }?>
	    </div>
	    <?php } ?>
	<?php }
	if(!empty($place_results)){ ?>
	    <h3>Place to visit Information</h3>
	    <?php for ($pv = 0; $pv < sizeof($place_results); $pv++){ ?>
	    <div class="visa_details_list">
	    <h4>Place - <?php echo $pv+1; ?></h4>
	    <?php
	        unset($place_results[$pv]['ID']);
	        unset($place_results[$pv]['russia_id']);
	        foreach ($place_results[$pv] as $key => $value){
	        if($value != ''){
	        ?>
	        <div class="visa_detailing">
	            <h4><?php echo ucfirst(str_replace('_',' ',$key)); ?></h4>
	            <h5><?php echo $value; ?></h5>
	        </div>
	      <?php } } ?>
	    </div>
<?php }  }  } ?>