<?php
// add_action( 'admin_menu', 'purpose_sub_menu' );
// function purpose_sub_menu() {
//   $parent_slug = 'nationality-list';
//   add_submenu_page( $parent_slug, 'Destination', 'Destination', 'manage_options', 'destination-travel', 'destination_menu' );
// }

function destination_menu() {
  add_thickbox();
  global $wpdb;
  $nonce = wp_create_nonce("destination_table_edit_nonce");
  $nonce_delete = wp_create_nonce("destination_table_delete_nonce");

  $national_table = $wpdb->prefix."user_destination";
  $user_nationality = $wpdb->prefix."user_nationality";
  $travel_purpose = $wpdb->prefix."travel_purpose";

  $nationalityQuery = $wpdb->get_results( "SELECT * FROM $user_nationality" );
  $travelQuery = $wpdb->get_results( "SELECT * FROM $travel_purpose" );
  $destinationQuery = array();
  $args = array(
    'post_type' => 'page',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
  );

  $loop = new WP_Query( $args );

  while ( $loop->have_posts() ) : $loop->the_post();
    $destinationQuery[get_the_ID()] = get_the_title();
  endwhile;

  wp_reset_postdata();

  if ($_POST) {
    $title = $_POST['title'];
    $nationality_name = $_POST['nationality'];
    $purpose_name = $_POST['purpose'];
    $destination_name = $_POST['destination'];
    $data = array('title' => $title,'nationality_id' => $nationality_name, 'purpose_id' => $purpose_name, 'destination_id' => $destination_name );
    if($_POST['post-id']) {
      $where = [ 'id' => $_POST['post-id'] ];
      $wpdb->update( $national_table, $data, $where );
    }else {
      $wpdb->insert($national_table, $data);
    }
    $my_id = $wpdb->insert_id;
  }
  ?>

<div id="nationalityListModel" style="display:none;">
  <form method="post">

  <div class="modalForm" id="titleWraper">
      <label class="modelLabel" id="title" for="title">Title</label>
      <input type="text" name="title" size="30" value="" id="title" spellcheck="true" required placeholder="Title" autocomplete="off">

      </div>
    <div class="modalForm" id="nationalitywraper">
      <label class="modelLabel" id="nationality" for="title">Nationality</label>
      <select name="nationality" required>
        <option value="">Select Nationality</option>
          <?php if(!empty($nationalityQuery)){
            foreach($nationalityQuery as $record){
              echo '<option value="'.$record->id.'">'.$record->country.' ( '.$record->country_abbr.' )</option>';
            }
          } ?>
      </select>
      </div>
      <div class="modalForm" id="purposeWraper">
        <label class="modelLabel" id="purpose" for="title">Purpose</label>
      <select name="purpose" required>
        <option value="">Purpose</option>
        <?php if(!empty($travelQuery)){
          foreach($travelQuery as $record){
            echo '<option value="'.$record->id.'">'.$record->purpose.'</option>';
          }
         } ?>
      </select>
      </div>
      <div class="modalForm" id="destinationwraper">
        <label class="modelLabel" id="destination" for="title">Destination</label>
      <select name="destination" required>
        <option value="">Destination</option>
        <?php if(!empty($destinationQuery)){
          foreach($destinationQuery as $key => $record){
            echo '<option value="'.$key.'">'.$record.'</option>';
          }
         } ?>
      </select>
    </div>

    <input name="save" type="submit" class="button button-primary button-large" id="save" value="Save">
    <input name="post-id" type="hidden" id="hidden-id" value="">
  </form>
</div>


  <div class="wrap">
    <h1 class="wp-heading-inline">
      <?php esc_html_e( 'Welcome to travel Purpsoe.', 'visachild' ); ?>
    </h1>

    <a class="edit thickbox btn-border page-title-action" href="#TB_inline?&width=300&height=300&inlineId=nationalityListModel"><?php echo __( 'Add Record', 'visachild' ); ?></a>
    <table class="wp-list-table widefat fixed striped posts">
  <thead>
    <tr>
      <th
        scope="col"
        id="title"
        class="manage-column column-id column-primary desc" >
      <span>ID</span>
      </th>
      <th scope="col" id="author" class="manage-column column-name">
        Title
      </th>
      <th scope="col" id="author" class="manage-column column-name">
        Nationality
      </th>

      <th scope="col" id="author" class="manage-column column-name">
        Purpose
      </th>

      <th scope="col" id="author" class="manage-column column-name">
        Destination
      </th>
    </tr>
  </thead>
<?php

global $wpdb;
$destination_table = $wpdb->prefix."user_destination";
$user_nationality = $wpdb->prefix."user_nationality";
$travel_purpose = $wpdb->prefix."travel_purpose";


    $selectQuery = $wpdb->get_results("SELECT destination.id, nationality.country, travel.purpose, destination.destination_id, destination.title FROM $destination_table as destination INNER JOIN $user_nationality as nationality ON destination.nationality_id =  nationality.id INNER JOIN $travel_purpose as travel on destination.purpose_id = travel.id");

if(!empty($selectQuery)){
  echo '<tbody id="the-list">';
  foreach($selectQuery as $record){?>
    <tr
      id="post-<?php echo $record->id; ?>"
      class="edit author-self level-0 post-<?php echo $record->id; ?> type-post status-publish format-standard hentry no-media"
    >
    <td class="national-id column-id has-row-actions column-primary page-id"
        data-colname="ID">
        <?php echo $record->id; ?>
      </td>

      <td
        class="title column-title destination-column-title has-row-actions column-primary page-title"
        data-colname="Title" >
        <strong><?php echo $record->title; ?></strong>


        <div class="row-actions">
          <span class="edit">
          <a class="editPoll thickbox " href="#TB_inline?&width=300&height=300&inlineId=nationalityListModel&editid=<?php echo $record->id; ?>" data-nonce="<?php echo $nonce ?>" data-id="<?php echo $record->id; ?>" aria-label="Edit <?php echo $record->title; ?>"><?php echo __( 'Edit', 'visachild' ); ?></a>
            | </span>
            <span class="trash"><a
              href="javascript:void(0)"
              data-id="<?php echo $record->id; ?>"
              data-nonce="<?php echo $nonce_delete; ?>"
              class="submitdelete"
              aria-label="Move <?php echo $record->purpose; ?> to the Trash"
              >Trash</a></span>
        </div>
        <button type="button" class="toggle-row">
          <span class="screen-reader-text">Show more details</span>
        </button>
      </td>
      <td
        class="title column-title has-row-actions column-primary page-title"
        data-colname="Destination" >
        <strong><?php echo get_the_title($record->destination_id); ?></strong>

      </td>

      <td
        class="country column-country has-row-actions column-primary page-country"
        data-colname="Country" >
        <strong><?php echo $record->country; ?></strong>
      </td>

      <td
        class="purpose column-purpose has-row-actions column-primary page-purpose"
        data-colname="Purpose" >
        <strong><?php echo $record->purpose; ?></strong>
      </td>


    </tr>
  <?php }
  echo '</tbody>';
}
?>

  <tfoot>
    <tr>
      <th
        scope="col"
        id="title"
        class="manage-column column-id column-primary desc"
      >
      <span>ID</span>
      </th>
      <th scope="col" id="author" class="manage-column column-name">
        Title
      </th>
      <th scope="col" id="author" class="manage-column column-name">
        Nationality
      </th>

      <th scope="col" id="author" class="manage-column column-name">
        Purpose
      </th>

      <th scope="col" id="author" class="manage-column column-name">
        Destination
      </th>
    </tr>
  </tfoot>
</table>
</div>
  <?php }
