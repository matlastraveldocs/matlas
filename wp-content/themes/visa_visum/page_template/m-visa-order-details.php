<?php
/**
* Template Name: M visa order detail
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/
get_header();
$table = $wpdb->prefix."russia_visa_form_new";
?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

 <div class="dashboard_top">
    <div class="left_logo">
           <a href="#"><img src="/wp-content/uploads/2020/01/travel_image.png" alt="Travel Image"></a>
        </div><!-- end of left_logo-->
        <div class="top_bar">
            <div class="right_bar">
                <a href="#" class="notification"><img src="" alt=""></a>
                <a href="#" class="logout"><span><i class="fa fa-sign-out" aria-hidden="true"></i></span>logout</a>
            </div>
        </div><!-- end of top_bar-->
    </div><!-- end of dashboard_top-->

<div class="dashboard" data-fid="<?php echo $_GET['fid']; ?>" data-dest="<?php echo $_GET['dest']; ?>" data-table="<?php echo $table; ?>">

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
                <h3>ID <?php echo $_GET['fid']; ?> | <?php echo $_GET['dest']; ?> | <?php echo mtlasgetfield('ID',$_GET['fid'],$table,'email_address'); ?> </h3>
            </div>
        </div><!-- end of dash_menu-->
        <?php $final_status = mtlasgetfield('ID',$_GET['fid'],$table,'final_status'); ?>
        <div class="order_lists">
            <ul class="list-unstyled order_options">
                <li class="<?php if($final_status == 'Canceled'){ echo 'green'; } ?>"><a href="#" class="singleStatus" data-id="canceled">Canceled</a></li>
                <li class="<?php if($final_status == 'Received'){ echo 'green'; } ?>"><a href="#" class="singleStatus" data-id="received">Received</a></li>
                <li class="<?php if($final_status == 'Submitted'){ echo 'green'; } ?>"><a href="#" class="singleStatus" data-id="submitted">Submitted</a></li>
                <li class="<?php if($final_status == 'Processed'){ echo 'green'; } ?>"><a href="#" class="singleStatus" data-id="processed">Processed</a></li>
                <li class="<?php if($final_status == 'Send to client'){ echo 'green'; }?>"><a href="#" class="singleStatus" data-id="Send to Client">Send to client</a></li>
                <li class="<?php if($final_status == 'Completed'){ echo 'green'; } ?>"><a href="#" class="singleStatus" data-id="Completed">Completed</a></li>
                <li class="<?php if($final_status == 'Closed'){ echo 'green'; } ?>"><a href="#" class="singleStatus" data-id="Closed">Closed</a></li>
                <li class="red"><a href="#" id="deleteorder">Delete order</a></li>
                <?php if(isset($_GET['edit_visa']) && $_GET['edit_visa'] == 'yes'){ ?>
                    <li class="purple"><a href="<?php echo get_the_permalink(); ?>&fid=<?php echo $_GET['fid']; ?>&dest=<?php echo $_GET['dest']; ?>" id="edit_visa">Save visa</a></li>
                <?php } else { ?>
                    <li class="purple"><a href="<?php echo get_the_permalink(); ?>&fid=<?php echo $_GET['fid']; ?>&dest=<?php echo $_GET['dest']; ?>&edit_visa=yes" id="edit_visa">Edit visa</a></li>
                <?php } ?>
            </ul>
        </div>

        <div class="visa_comments">
        <?php if(isset($_GET['edit_visa']) && $_GET['edit_visa'] == 'yes'){ ?>
            <div class="visa_details full">
                <?php
                    if (isset($_GET['fid'])) {
                        $visa_id = $_GET['fid'];
                        $visa_destination = $_GET['dest'];

                        if ($visa_destination == 'Russia'){
                            get_template_part( 'template-parts/mvisa/russia', 'edit' );
                        }
                    }
                ?>
            </div>
        <?php } else{ ?>
            <div class="visa_details">
            <?php
                if (isset($_GET['fid'])) {
                $visa_id = $_GET['fid'];
                $visa_destination = $_GET['dest'];

                if($visa_destination == 'Russia'){
                    get_template_part( 'template-parts/mvisa/russia', 'detail' );
                }
              }
            ?>
            </div>
            <div class="comments">
                <h3>Comments</h3>
                <div class="comments_connect">
                    <div class="updated_system">
                    <div class="comment_image">
                        <img src="<?php echo get_stylesheet_directory_uri()?>/images/profile_logo.png" class="img-fluid">
                    </div>
                    <div class="system_details">
                        <h3>System <span>30-12-2019</span></h3>
                        <h2>Order was updated</h2>
                    </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.singleStatus').on('click', function(event) {
            event.preventDefault();
            var tmp = $(this).parent();
            let fid = $('.dashboard').data('fid');
            let dest = $('.dashboard').data('dest');
            let status = $(this).data('id');
            jQuery.ajax({
                type: "GET",
                url: myAjax.ajax_url,
                dataType : "json",
                data : {
                    action : 'mtlasupdatefield',
                    fid : fid,
                    dest : dest,
                    status : status
                },
                success: function(result){
                    if(result == 1){
                        $('.singleStatus').each(function(index, el) {
                            $(this).parent().removeClass('green');
                        });
                        tmp.addClass('green');
                    }else{
                        alert('Please try after some time');
                    }
                }
            });
        });
        $('#deleteorder').on('click', function(event){
            event.preventDefault();
            let fid = $('.dashboard').data('fid');
            let table = $('.dashboard').data('table');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Delete ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    jQuery.ajax({
                        type: "GET",
                        url: myAjax.ajax_url,
                        //dataType : "json",
                        data : {
                            action : 'mtlasdeleterow',
                            where : fid,
                            field : 'ID',
                            table : table
                        },
                        success: function(result){
                            if(result == 1){
                                Swal.fire({
                                    title: 'Detail is deleted!',
                                    type: 'success',
                                    timer: 2000,
                                    allowEscapeKey : false,
                                    allowOutsideClick: false,
                                    showConfirmButton: false
                                });
                                setTimeout(function(){ window.location.href = "<?php echo site_url('m-dashboard'); ?>";},1);
                            }else{
                                alert('Please try after some time');
                            }
                        }
                    });
                }
            });
        });
    });
</script>