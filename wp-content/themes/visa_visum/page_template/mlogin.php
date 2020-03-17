<?php
/**
* Template Name: M Login
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/
get_header(); ?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<?php //if( is_user_logged_in() ){ wp_redirect(site_url(), 301 ); } ?>
<div class="container">
    <div class="login_form">
        <div class="left_logo">
            <a href="#"><img src="/wp-content/uploads/2020/01/travel_image.png" alt="Travel Image"></a>
        </div>
        <div class="right_part">
            <div class="main">
                <p class="sign">Sign in</p>
                <form class="form1" id="mlogin" action="login" method="post">
                    <p class="status"></p>
                    <div class="email_add">
                        <input class="em" id="username" align="center" placeholder="Email Address/ User name" required>
                    </div>
                    <div class="pwd">
                        <input class="pass" id="password" type="password" align="center" placeholder="Password" required>
                    </div>
                    <a class="submit submit_button" align="center">continue <span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                    <p class="forgot" align="left"><a href="<?php echo wp_lostpassword_url(); ?>">Forgot your password?</p>
                    <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>