<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wcanvas_Boilerplate
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php 

			get_template_part( 'template-parts/modules/module-archive_video' );

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
