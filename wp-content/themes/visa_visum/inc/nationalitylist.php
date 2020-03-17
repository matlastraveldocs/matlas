<?php
add_action( 'admin_menu', 'my_admin_menu' );
function my_admin_menu() {
  $parent_slug = 'nationality-list';
  add_menu_page( __( 'Visa Form Setting', 'visachild' ), __( 'Visa Form', 'visachild' ), 'manage_options', $parent_slug, 'nationality_list', 'dashicons-schedule', 3 );
  add_submenu_page( $parent_slug, 'Nationality', 'Nationality', 'manage_options', $parent_slug, 'nationality_list' );
  add_submenu_page( $parent_slug, 'Travel Purpose', 'Travel Purpose', 'manage_options', 'travel-purpose', 'travel_purpose' );
  add_submenu_page( $parent_slug, 'Destination', 'Destination', 'manage_options', 'destination-travel', 'destination_menu' );
}


function nationality_list() {
  add_thickbox();
  global $wpdb;
  $national_table = $wpdb->prefix."user_nationality";
  
  $nonce = wp_create_nonce("user_nationality_table_edit_nonce");
  $nonce_delete = wp_create_nonce("user_nationality_table_delete_nonce");

  if ($_POST) {
    $nationalit_name = $_POST['nationalit_name'];
    $abbriviation = $_POST['abbriviation'];
    $data = array('country' => $nationalit_name, 'country_abbr' => $abbriviation);    
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
    <div class="modalForm" id="titlewrap">
      <label class="screen-reader-text" id="name" for="title">Name</label>
      <input type="text" name="nationalit_name" size="30" value="" id="title" spellcheck="true" required placeholder="Name" autocomplete="off">
    </div>

    <div class="modalForm" id="abbrwrap">
      <label class="screen-reader-text" id="name" for="abbriviation">Abbriviation</label>
      <input type="text" name="abbriviation" size="30" value="" id="abbriviation" required placeholder="Abbriviation" spellcheck="true" autocomplete="off">
    </div>
    <input name="save" type="submit" class="button button-primary button-large" id="save" value="Save">
	<input name="post-id" type="hidden" id="hidden-id" value="">
  </form>
</div>


  <div class="wrap">
    <h1 class="wp-heading-inline">
      <?php esc_html_e( 'Welcome to nationality.', 'visachild' ); ?>
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
      <th scope="col" id="categories" class="manage-column column-abbr">
        Abbriviation
      </th>

    </tr>
  </thead>
<?php


global $wpdb;
$national_table = $wpdb->prefix."user_nationality";
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
        class="title column-title nationality-column has-row-actions column-primary page-title"
        data-colname="Title" >
        <strong><?php echo $record->country; ?></strong>


        <div class="row-actions">
			 <span class="edit"><a
            class="editPoll thickbox"
              href="#TB_inline?&width=300&height=200&inlineId=nationalityListModel&editid=<?php echo $record->id; ?>"
			  data-nonce="<?php echo $nonce ?>"
              data-id="<?php echo $record->id; ?>"
              aria-label="Edit <?php echo $record->country; ?>"
              ><?php echo __( 'Edit', 'visachild' ); ?></a>
            | </span>			  
			  <span class="trash"><a
              href="javascript:void(0)"
              data-id="<?php echo $record->id; ?>"
              data-nonce="<?php echo $nonce_delete; ?>"
              class="submitdelete"
              aria-label="Move <?php echo $record->country; ?> to the Trash"
              >Trash</a></span>
        </div>
        <button type="button" class="toggle-row">
          <span class="screen-reader-text">Show more details</span>
        </button>
      </td>
      <td class="abbrivation column-abbr has-row-actions column-primary page-abbr"
        data-colname="Abbriviation">
        <?php echo $record->country_abbr; ?>
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
      <th scope="col" id="categories" class="manage-column column-aabr">
        Abbriviation
      </th>
    </tr>
  </tfoot>
</table>
</div>
  <?php }