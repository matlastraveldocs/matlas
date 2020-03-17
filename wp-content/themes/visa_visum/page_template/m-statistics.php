<?php
/**
* Template Name: M statistics
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/
get_header(); ?>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
    </div><!-- end of left_dash-->
    <div class="right_dash">

        <div class="dash_menu">
            <div class="menu_title">
                <h3>Statistics</h3>
            </div><!-- end of menu_title-->
            <div class="menu-list">
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Statistics</a></li>
                </ul>
            </div><!-- end of menu_list-->
        </div><!-- end of dash_menu-->

        <div class="stats_container">
            <ul class="date_filter">
                <li>
                    <p>date 1</p> <input type="text" id="datepicker" placeholder="08/21/2018">
                </li>
                <li>
                    <p><span>date 2</p> <input type="text" id="datepicker1" placeholder="08/21/2018">
                </li>
                <li>
                    <p>destinations</p>
                    <div class="dropdown drop_buttons">
                        <button class="dropbtn">All destinations</button>
                        <div class="dropdown-content">
                        <a href="#">Link 1</a>
                        <a href="#">Link 2</a>
                        <a href="#">Link 3</a>
                        </div>
                    </div>

                </li>
                <li>
                    <p>Source</p>
                    <div class="dropdown drop_buttons">
                        <button class="dropbtn">Everything</button>
                        <div class="dropdown-content">
                        <a href="#">Link 1</a>
                        <a href="#">Link 2</a>
                        <a href="#">Link 3</a>
                        </div>
                    </div>

                </li>
            </ul><!-- end of date_filter-->

            <div class="revenue_content">
                <div class="revenue_marking">
                    <ul class="list-unstyled list-inline">
                        <li>
                            <h2>Partner revenue</h2>
                            <h3>45,320</h3>
                            <h5 class="gain"><i class="fa fa-arrow-up" aria-hidden="true"></i>5.25%</h5>
                            <h6>Since last month</h6>
                        </li>
                        <li>
                            <h2>Total orders</h2>
                            <h3>45,320</h3>
                            <h5 class="loss"><i class="fa fa-arrow-down" aria-hidden="true"></i>1.23%</h5>
                            <h6>Since last month</h6>
                        </li>
                        <li>
                            <h2>Total earnings</h2>
                            <h3>$7,524</h3>
                            <h5 class="loss"><i class="fa fa-arrow-down" aria-hidden="true"></i>7.85%</h5>
                            <h6>Since last month</h6>
                        </li>
                        <li>
                            <h2>Growth</h2>
                            <h3>+ 35.52%</h3>
                            <h5 class="gain"><i class="fa fa-arrow-up" aria-hidden="true"></i> 3.72%</h5>
                            <h6>Since last month</h6>
                        </li>
                    </ul>
                </div><!-- revenue_marking-->
                <div class="revenue_graph">
                    <h2>Total revenue</h2>
                    <div class="weekly_report">
                       <ul class="weeked">
                           <li>
                               <p>Current Week</p>
                               <h1>45,320</h1>
                           </li>
                           <li>
                               <p>Previous Week</p>
                               <h1>58,610</h1>
                           </li>
                       </ul>
                    </div><!-- end of weekly_report-->
                     <img src="<?php echo get_stylesheet_directory_uri()?>/images/revenue_graph.jpg" class="img-fluid">
                </div><!-- end of revenue_graph-->
            </div><!-- end of revenue_content-->

            <div class="top_partners">
                <div class="top_partners_table">
                    <div class="top_partners_heading">
                        <h2>Top Selling Partners</h2>
                        <a href="#">Export <i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                        </div><!-- end of top_partners_heading-->
                        <div class="table-responsive">
        <table id="example1" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>PRODUCT NAME</th>
                    <th>DATE TIME</th>
                    <th>PRICE</th>
                    <th>QUANTITY</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Pocket Drone 2.4G</td>
                    <td>07 April 2018</td>
                    <td>$129.99</td>
                    <td>32</td>
                    <td>$6089.58</td>
                </tr>
                <tr>
                    <td>Macro Lightweight Shirt</td>
                    <td>15 March 2018</td>
                    <td>$55.99</td>
                    <td>47</td>
                    <td>$3689.73</td>
                </tr>
                <tr>
                    <td>Lightweight Jacket</td>
                    <td>10 March 2018</td>
                    <td>$73.99</td>
                    <td>53</td>
                    <td>$1689.57</td>
                </tr>
                <tr>
                    <td>DJI Phantom 4 PRO</td>
                    <td>07 March 2018</td>
                    <td>$499.99</td>
                    <td>25</td>
                    <td>$8489.05</td>
                </tr>
                <tr>
                    <td>ST SwellPro Drone</td>
                    <td>02 March 2018</td>
                    <td>$219.99</td>
                    <td>12</td>
                    <td>$2689.58</td>
                </tr>
                <tr>
                    <td>Leather Mobile Phone Case</td>
                    <td>01 March 2018</td>
                    <td>$19.99</td>
                    <td>25</td>
                    <td>$389.05</td>
                </tr>
                <tr>
                    <td>Mobile Phone LCDs</td>
                    <td>01 March 2018</td>
                    <td>$199.99</td>
                    <td>25</td>
                    <td>$2489.05</td>
                </tr>
            </tbody>
        </table>
</div><!-- end of table_responsive-->

                </div><!-- end of top_partners_table-->

                <div class="total_sales_graph">
                   <div class="sales_header">
                        <h2>Total Sales</h2>
                        <div class="open_bar">
                            <img src="<?php echo get_stylesheet_directory_uri()?>/images/dots.png" class="img-fluid">
                        </div><!-- end of open_bar-->
                   </div><!-- end of sales_header-->

                   <div class="sales_graph_making">
                     <img src="<?php echo get_stylesheet_directory_uri()?>/images/sales_graph.jpg" class="img-fluid">
                   </div><!-- end of sales_graph_making-->
                   <div class="graph_readings">
                        <ul class="list-unstyled">
                            <li>
                                <p>TravelDocs</p>
                                <span>$300.75</span>
                            </li>
                            <li>
                                <p>Partners</p>
                                <span>$834.35</span>
                            </li>
                        </ul>
                   </div><!-- end of graph_readings-->
                </div><!-- end of total_sales_graph-->
            </div><!-- end of top_partners-->
        </div><!-- end of stats_container-->
    </div><!-- end of right_dash-->
</div><!-- end of dashboard-->


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript">
// Material Design example
jQuery(document).ready(function($) {
    $( function() {
    $( "#datepicker" ).datepicker();
    $( "#datepicker1" ).datepicker();
  } );

  jQuery(document).ready(function($) {
    $('#example1').DataTable();
} );
} );
</script>


<?php get_footer(); ?>