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
	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>