<?php
/**
 * The template for editing templatera templates via the front-end editor.
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 * @version 4.9
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// This file is only used for the front-end editor.
get_header(); ?>
	<div id="content-wrap" class="container clr">
		<div id="primary" class="content-area clr">
			<div id="content" class="site-content clr">
				<div class="single-page-content entry clr">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
				</div>
			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- .container -->
<?php get_footer(); ?>