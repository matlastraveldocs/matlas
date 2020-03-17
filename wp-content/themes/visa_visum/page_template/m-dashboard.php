<?php
/**
* Template Name: M Dashbord
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/
get_header();?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

 <div class="dashboard_top">
    <div class="left_logo">
           <a href="#"><img src="/wp-content/uploads/2020/01/travel_image.png" alt="Travel Image"></a>
        </div><!-- end of left_logo-->
        <div class="top_bar">
            <div class="left_bar"></div>
            <div class="right_bar">
                <a href="<?php echo wp_logout_url( home_url() ); ?>" class="logout"><span><i class="fa fa-sign-out" aria-hidden="true"></i></span> logout</a>
            </div>
        </div><!-- end of top_bar-->
    </div><!-- end of dashboard_top-->

<div class="dashboard">

    <div class="left_dash">
        <h5>Navigation</h5>
        <div class="dashboard_menu">
            <a href="<?php echo site_url('m-dashboard'); ?>" class="active"><span><i class="fa fa-shopping-cart"></i> </span>Orders</a>
            <a href="<?php echo site_url('m-statistics'); ?>"><span><i class="fa fa-th-large" aria-hidden="true"></i> </span> Statistics</a>
        </div>
    </div>
    <div class="right_dash">

        <div class="dash_menu">
            <div class="menu_title">
                <h3>Visum aanvragen:</h3>
            </div>
        </div>

        <?php
            global $wpdb;
            $russia_table = $wpdb->prefix.'russia_visa_form_new';
            $russia_sql = "select * from ".$russia_table;
            $russia_results = $wpdb->get_results($russia_sql);
            $rowcount = $wpdb->num_rows;
        ?>
        <div class="total">
            <p>total aanvragen:<span class="count"><?php echo $rowcount; ?></span></p>
        </div>
        <br/>
        <div class="table-responsive">
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>Country</th>
                        <th>Date created</th>
                        <th>Purpose</th>
                        <th>Duration</th>
                        <th>Arrival date</th>
                        <th></th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th></th>
                        <th>Status</th>
                        <th>Country</th>
                        <th></th>
                        <th>Purpose</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($russia_results != 0) {
                      foreach($russia_results as $russia_result){
                            switch ($russia_result->final_status) {
                                case 'Received':
                                    $class = 'grey';
                                    break;
                                case 'Submitted':
                                    $class = 'orange';
                                    break;
                                case 'Action required':
                                    $class = 'red';
                                    break;
                                case 'Send to client':
                                    $class = 'purple';
                                    break;
                                case 'Processed':
                                    $class = 'orange';
                                    break;
                                case 'Completed':
                                    $class = 'green';
                                    break;
                                case 'Closed':
                                    $class = 'green';
                                    break;
                                default:
                                    $class = 'grey';
                                    break;
                            }

                        ?>
                        <tr>
                            <td><?php echo $russia_result->ID; ?></td>
                            <td><span class="status <?php echo $class; ?>"><?php echo $russia_result->final_status; ?></span></td>
                            <td><?php echo $russia_result->country; ?></td>
                            <td><?php echo $russia_result->created_date; ?></td>
                            <td><?php echo $russia_result->purpose; ?></td>
                            <td><?php echo $russia_result->duration; ?></td>
                            <td><?php echo $russia_result->arrival_date; ?></td>
                            <td><a href="<?php echo site_url('m-visa-order-details/?fid=').$russia_result->ID.'&dest='.$russia_result->destination_country; ?>" class="view">View<i class="fa fa-eye" aria-hidden="true"></i></a></td>
                        </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript">
// Material Design example
jQuery(document).ready(function($) {
    var table = $('#example').DataTable({
        "columnDefs": [
          { "searchable": false, "targets": [0, 5, 6] }  // Disable search on first and last columns
        ]
    });    
    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        if(i != 0 && i != 3 && i != 5 && i != 6 && i != 7){
            $(this).html( '<input class="mwidth" type="text" placeholder="Search '+title+'" />' );
             $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        }
    } );
} );
</script>
<style type="text/css">input.mwidth{ max-width: 160px; }</style>
<?php get_footer(); ?>