<?php
/**
 * The template for displaying archive pages - resources, news & events
 * Template Name: Archive Template
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HIGHLANDS
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main archive" data-barba="container" data-barba-namespace="page">

		<?php

		while ( have_posts('videos') ) :
			the_post();

			get_template_part('template-parts/modules/module', 'archive');

		endwhile; // End of the loop.

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
