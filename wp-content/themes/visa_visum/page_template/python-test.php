<?php
/**
 * Template Name: Python Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>
<?php
    $command = escapeshellcmd('python /var/www/html/test.py');
    $output = shell_exec($command);
    var_dump($output);
?>
<?php get_footer(); ?>