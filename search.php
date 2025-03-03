<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package NEUROCIRUGIA_ARGENTINA
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<div class="container-lg">
					<div class="row">
						<div class="col">
							<h1 class="page-title">
								<?php
								/* translators: %s: search query. */
								printf( esc_html__( 'Search Results for: %s', 'neurocirugia-argentina' ), '<span>' . get_search_query() . '</span>' );
								?>
							</h1>
						</div>
					</div>
				</div>
			</header><!-- .page-header -->

			<?php

			get_template_part( 'template-parts/loops/loop' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
