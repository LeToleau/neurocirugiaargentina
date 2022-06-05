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

			while (have_rows('flexible_content')) :

				the_row();
				$module = get_row_layout();
				include(get_template_directory() . '/template-parts/components/component-module_begin.php');
				get_template_part('template-parts/modules/module', $module);
				include(get_template_directory() . '/template-parts/components/component-module_end.php');

			endwhile;

			get_template_part( 'template-parts/modules/module-archive_video' );

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
