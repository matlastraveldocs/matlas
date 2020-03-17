<?php
// add_action( 'admin_menu', 'purpose_sub_menu' );
// function purpose_sub_menu() {
//   $parent_slug = 'nationality-list';
//   add_submenu_page( $parent_slug, 'Travel Purpose', 'Travel Purpose', 'manage_options', 'travel-purpose', 'travel_purpose' );
// }

function travel_purpose() {
  add_thickbox();
  global $wpdb;
  $national_table = $wpdb->prefix."travel_purpose";
  
  $nonce = wp_create_nonce("travel_purpose_table_edit_nonce");
  $nonce_delete = wp_create_nonce("travel_purpose_table_delete_nonce");

  if ($_POST) {
    $purpose_name = $_POST['purpose'];
    $data = array('purpose' => $purpose_name);
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
      <label class="screen-reader-text" id="name" for="title">Purpose Name</label>
      <input type="text" name="purpose" size="30" value="" id="title" spellcheck="true" required placeholder="Purpose Name" autocomplete="off">
    </div>

    <input name="save" type="submit" class="button button-primary button-large" id="save" value="Save">
	<input name="post-id" type="hidden" id="hidden-id" value="">
  </form>
</div>


  <div class="wrap">
    <h1 class="wp-heading-inline">
      <?php esc_html_e( 'Welcome to travel Purpsoe.', 'visachild' ); ?>
    </h1>

    <a class="edit thickbox btn-border page-title-action" href="#TB_inline?&width=300&height=200&inlineId=nationalityListModel"><?php echo __( 'Add Record', 'visachild' ); ?></a>

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
        Name
      </th>

    </tr>
  </thead>
<?php


global $wpdb;
$national_table = $wpdb->prefix."travel_purpose";
$selectQuery = $wpdb->get_results( "SELECT * FROM $national_table" );
// var_dump($selectQuery);

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
        class="title column-title travel-purpose-column has-row-actions column-primary page-title"
        data-colname="Title" >
        <strong><?php echo $record->purpose; ?></strong>


        <div class="row-actions">
          <span class="edit"><a
            class="editPoll thickbox"
              href="#TB_inline?&width=300&height=200&inlineId=nationalityListModel&editid=<?php echo $record->id; ?>"
			  data-nonce="<?php echo $nonce ?>"
              data-id="<?php echo $record->id; ?>"
              aria-label="Edit <?php echo $record->purpose; ?>"
              ><?php echo __( 'Edit', 'visachild' ); ?></a>
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
        Name
      </th>
    </tr>
  </tfoot>
</table>
</div>
  <?php }
