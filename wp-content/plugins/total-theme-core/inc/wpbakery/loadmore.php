<?php
/**
 * Load More functions for Total VC grid modules.
 *
 * @package Total Theme Core
 * @subpackage WPBakery
 * @version 1.0.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load More Scripts.
 */
function vcex_loadmore_scripts() {

	$dependencies = array( 'jquery' );

	if ( defined( 'WPEX_THEME_JS_HANDLE' ) ) {
		$dependencies[] = WPEX_THEME_JS_HANDLE;
	}

	wp_enqueue_script( 'imagesloaded' );

	$dependencies[] = 'imagesloaded';

	if ( apply_filters( 'vcex_loadmore_enqueue_mediaelement', false ) ) {
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'wp-mediaelement' );
	}

	wp_enqueue_script(
		'vcex-loadmore',
		vcex_asset_url( 'js/vcex-loadmore.min.js' ),
		$dependencies,
		TTC_VERSION,
		true
	);
}

/**
 * Load More Button.
 */
function vcex_get_loadmore_button( $shortcode_tag, $atts, $query ) {

	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return '<div class="vcex-loadmore"><span class="vcex-disabled">* ' . esc_html__( 'Load more disabled in editor.', 'total-theme-core' ) . '</span></div>';
	}

	$page      = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$max_pages = $query->max_num_pages;

	if ( $page >= $max_pages ) {
		return;
	}

	unset( $atts['wrap_css'] ); // important we don't want useless attributes
	unset( $atts['show_categories_tax'] );

	if ( ! in_array( $shortcode_tag, array( 'vcex_post_type_archive', 'vcex_post_type_grid', 'vcex_recent_news' ) ) ) {
		unset( $atts['post_type'] );
		unset( $atts['taxonomy'] );
	}

	$params = '';
	foreach ( $atts  as $k => $v ) {
		if ( $v ) {
			$params .= $k . '="' . esc_attr( $v ) . '" ';
		}
	}
	$shortcode = trim( $params );

	$load_more_text = '';

	if ( function_exists( 'wpex_get_translated_theme_mod' ) ) {
		$load_more_text = wpex_get_translated_theme_mod( 'loadmore_text', $load_more_text );
	}

	$settings = apply_filters( 'vcex_get_loadmore_button_settings', array(
		'class'        => 'theme-button',
		'text'         => $load_more_text ? $load_more_text : esc_html__( 'Load More', 'total-theme-core' ),
		'loading_text' => esc_html__( 'Loading...', 'total-theme-core' ),
		'failed_text'  => esc_html__( 'Failed to load posts.', 'total-theme-core' ),
		'gif'          => includes_url( 'images/spinner-2x.gif' ),
	), $shortcode_tag, $atts );

	extract( $settings );

	return '<div class="vcex-loadmore"><a class="' . esc_attr( $class ) . '" href="#" data-page="' . esc_attr( $page ) . '" data-max-pages="' . esc_attr( $max_pages ) . '" data-text="'. esc_attr( $text ) .'" data-loading-text="' . esc_attr( $loading_text ) . '" data-failed-text="' . esc_attr( $failed_text ) . '" data-nonce="' . esc_attr( wp_create_nonce( 'vcex-ajax-pagination-nonce' ) ) .'" data-shortcode-tag="' . esc_attr( $shortcode_tag ) . '" data-shortcode-params="' . htmlspecialchars( $shortcode ) . '"><span class="vcex-txt">' . wp_kses_post( $text ) . '</span></a><img src="' . esc_url( $gif ) . '" class="vcex-spinner" alt="' . esc_attr( $loading_text ) . '" /><span class="ticon ticon-spinner"></span></div>';

}

/**
 *  Load More AJAX.
 */
function vcex_loadmore_ajax_render() {

	check_ajax_referer( 'vcex-ajax-pagination-nonce', 'nonce' );

	if ( empty( $_POST[ 'shortcodeParams' ] ) ) {
		wp_die();
	}

	$allowed_shortcodes = array(
		'vcex_blog_grid',
		'vcex_image_grid',
		'vcex_portfolio_grid',
		'vcex_post_type_archive',
		'vcex_post_type_grid',
		'vcex_recent_news',
		'vcex_staff_grid',
		'vcex_testimonials_grid',
	);

	if ( empty( $_POST[ 'shortcodeTag' ] ) || ! in_array( $_POST[ 'shortcodeTag' ], $allowed_shortcodes ) ) {
		wp_die();
	}

	$tag    = wp_strip_all_tags( $_POST[ 'shortcodeTag' ] );
	$params = stripslashes( $_POST[ 'shortcodeParams' ] );

	$data = do_shortcode( '[' . $tag . ' ' . $params . ']' );

	wp_send_json_success( $data );

	wp_die();

}
add_action( 'wp_ajax_vcex_loadmore_ajax_render', 'vcex_loadmore_ajax_render' );
add_action( 'wp_ajax_nopriv_vcex_loadmore_ajax_render', 'vcex_loadmore_ajax_render' );