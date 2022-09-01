<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NEUROCIRUGIA_ARGENTINA
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="container-lg">
			<div class="row">
				<div class="col">
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;

					if ( 'post' === get_post_type() ) :
						?>
						<div class="entry-meta">
						</div><!-- .entry-meta -->
					<?php endif; ?>
				</div>
			</div>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="container-lg">
			<div class="row">
				<div class="col">

					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'neurocirugia-argentina' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
							)
						);

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'neurocirugia-argentina' ),
								'after'  => '</div>',
							)
						);
						?>
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="container-lg">
			<div class="row">
				<div class="col">
				</div>
			</div>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
