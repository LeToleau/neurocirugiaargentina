<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NEUROCIRUGIA_ARGENTINA
 */

get_header();
?>

<main id="main" class="site-main">

	<?php

	while (have_rows('flexible_content')) :

		the_row();
		$module = get_row_layout();
		include(get_template_directory() . '/template-parts/components/component-module_begin.php');
		get_template_part('template-parts/modules/module', $module);
		include(get_template_directory() . '/template-parts/components/component-module_end.php');

	endwhile;
	?>

</main><!-- #main -->

<?php
get_footer();
