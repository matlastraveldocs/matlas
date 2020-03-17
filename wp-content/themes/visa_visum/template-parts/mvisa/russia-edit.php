<?php
$visa_id = $_GET['fid'];
$main_table = $wpdb->prefix.'russia_visa_form_new';
$traveral_table = $wpdb->prefix."russia_visa_traverler_data_new";
$intended_table= $wpdb->prefix."russia_intended_data";
$place_table= $wpdb->prefix."russia_place_visit_data";

if(isset($_POST) && isset($_POST['general'])){
	unset($_POST['general']);
	$data = $_POST;
	$where = array('ID' => $visa_id);
	$wpdb->update($main_table,$data,$where);
}
if(isset($_POST) && isset($_POST['travel'])){
	$where = array('ID' => $_POST['ID'], 'russia_form_id' => $_POST['russia_form_id']);
	unset($_POST['ID']);
	unset($_POST['russia_form_id']);
	unset($_POST['travel']);
	$data = $_POST;
	$wpdb->update($traveral_table,$data,$where);
}
if(isset($_POST) && isset($_POST['places'])){
	$where = array('ID' => $_POST['ID'], 'russia_id' => $_POST['russia_id']);
	unset($_POST['ID']);
	unset($_POST['russia_id']);
	unset($_POST['places']);
	$data = $_POST;
	$wpdb->update($place_table,$data,$where);
}

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
	<form action="" method="post">
    <?php
    for ($mr = 0; $mr < sizeof($main_results); $mr++){
    	unset($main_results[$mr]['ID']);
    	unset($main_results[$mr]['final_status']);
    	unset($main_results[$mr]['created_date']);
        unset($main_results[$mr]['form_fees']);
        unset($main_results[$mr]['payment_mod']);
        unset($main_results[$mr]['payment_status']);
        unset($main_results[$mr]['transaction_id']);
        foreach ($main_results[$mr] as $key => $value){
        if($value != ''){
        ?>
          <div class="visa_detailing">
            <h4><?php echo ucfirst(str_replace('_',' ',$key)); ?></h4>
            <input name="<?=$key; ?>" value="<?php echo $value; ?>" >
          </div>
      <?php
        }
      }
    } ?>
    <input type="submit" name="general" value="Update">
    </form>
    </div>
<?php }
if(!empty($traveral_results)){ ?>
    <h3>Traveral Information</h3>
    <?php
    for ($tr = 0; $tr < sizeof($traveral_results); $tr++){
      ?>
      <h4>Traveral - <?php echo $tr+1; ?></h4>
      <div class="visa_details_list">
    	<form action="" method="post">
        <?php
            foreach ($traveral_results[$tr] as $key => $value){
        	if($value != ''){
            ?>
            <div class="visa_detailing">
            	<?php if($key != 'ID' && $key != 'russia_form_id'){ ?>
	                <h4><?php echo ucfirst(str_replace('_',' ',$key)); ?></h4>
	            <?php } ?>
                <input <?php if($key == 'ID' || $key == 'russia_form_id'){ echo 'type="hidden"'; } ?> name="<?=$key; ?>" value="<?php echo $value; ?>" >
            </div>
        <?php } } ?>
	    <input type="submit" name="travel" value="Update">
		</form>
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
    <form action="" method="post">
    <?php
      foreach ($intended_results[$ir] as $key => $value){
        if($value != ''){
        ?>
        <div class="visa_detailing">
            <h4><?php echo ucfirst(str_replace('_',' ',$key)); ?></h4>
            <input name="<?=$key; ?>" value="<?php echo $value; ?>" >
        </div>
      <?php
        }
      }?>
      <input type="submit" name="intended" value="Update">
	</form>
    </div>
    <?php } ?>
<?php }
if(!empty($place_results)){ ?>
    <h3>Place to visit Information</h3>
    <?php for ($pv = 0; $pv < sizeof($place_results); $pv++){ ?>
    <div class="visa_details_list">
    <h4>Place - <?php echo $pv+1; ?></h4>
    <form action="" method="post">
    <?php
        foreach ($place_results[$pv] as $key => $value){
        if($value != ''){
        ?>
        <?php if($key != 'ID' && $key != 'russia_id'){ ?>
        <div class="visa_detailing">
            <h4><?php echo ucfirst(str_replace('_',' ',$key)); ?></h4>
            <input name="<?=$key; ?>" value="<?php echo $value; ?>" >
        </div>
    	<?php } else { ?>
        	<input <?php if($key == 'ID' || $key == 'russia_id'){ echo 'type="hidden"'; } ?> name="<?=$key; ?>" value="<?php echo $value; ?>" >
    	<?php } ?>
      <?php } } ?>
      <input type="submit" name="places" value="Update">
	</form>
    </div>
<?php }  } ?>