<?php
/**
 * Template Name: Thank you
 * The template for displaying pages
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 * @version 4.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header(); ?>
	<div id="content-wrap" class="container clr">
		<div id="primary" class="content-area clr">
			<div id="content" class="site-content clr">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php wpex_get_template_part( 'page_single_blocks' ); ?>
				<?php endwhile; ?>
				<?php
					matlas($_GET);
					/*if(isset($_GET['session_id'])){

					}*/
					$id = $_GET['session_id'];
					matlaspaymentchecker($id);
				?>
			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- .container -->
<?php get_footer(); ?>