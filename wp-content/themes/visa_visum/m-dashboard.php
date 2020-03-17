<?php
/**
* Template Name: M Dashbord
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/
get_header(); ?>


<div class="dashboard">
    <div class="left_dash">
        <div class="left_logo">
           <a href="#"><img src="/wp-content/uploads/2020/01/travel_image.png" alt="Travel Image"></a>
        </div>
        <span>navigation</span>
    </div>
    <div class="right_dash">
        <div class="top_bar">
            <div class="searchbar"><i class="fa fa-search" aria-hidden="true"></i><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search ..."></div>
            <div class="right_bar">
                <a href="#" class="notification"><img src="" alt=""></a>
                <a href="#" class="logout">logout</a>
            </div>
        </div>
        <div class="dash_menu">
            <div class="menu_title">
                <h3>Visum aanvragen:</h3>
            </div>
            <div class="menu-list">
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Orders</a></li>
                </ul>
            </div>
        </div>
        <div class="total">
            <p>total aanvragen:<span class="count">2478</span></p>
        </div>

        <div class="bottom_menu">
            <div class="navbar">
                <div class="left_navbar">
                    <ul>
                        <li><a href="#"><span>country<span class="nav-arrow top-level ticon ticon-angle-down" aria-hidden="true"></span></span></a>
                        <li><a href="#"><span>status<span class="nav-arrow top-level ticon ticon-angle-down" aria-hidden="true"></span></span></a>
                        <li><a href="#"><span>company<span class="nav-arrow top-level ticon ticon-angle-down" aria-hidden="true"></span></span></a>
                    </ul>
                </div>
                <div class="searchbar"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search"><i class="fa fa-search" aria-hidden="true"></i></div>
            </div>
        </div>



        <table id="example" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Country</th>
                    <th>Date created</th>
                    <th>Visa Type</th>
                    <th>Company</th>
                    <th>Arrival date</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>01</td>
                    <td><a href="#" class="status">Completed</a></td>
                    <td>Rusland</td>
                    <td>26 nov. 2019 19:14</td>
                    <td>E-visa</td>
                    <td>Traveldocs</td>
                    <td>26 nov. 2019 19:14</td>
                    <td><a href="view">View</a></td>
                </tr>
                <tr>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011/07/25</td>
                    <td>$170,750</td>
                </tr>
                <tr>
                    <td>Ashton Cox</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009/01/12</td>
                    <td>$86,000</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



<?php get_footer(); ?>
<script type="text/javascript">
// Material Design example
$(document).ready(function() {
    $('#example').DataTable( {
        ajax:           "../data/2500.txt",
        deferRender:    true,
        scrollY:        200,
        scrollCollapse: true,
        scroller:       true
    } );
} );