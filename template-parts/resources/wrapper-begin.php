<?php 
$category = isset( $_GET['category'] )? $_GET['category'] : '';
$role = isset( $_GET['role'] )? $_GET['role'] : '';
$type = isset( $_GET['type'] )? $_GET['type'] : '';
$post_tag = isset( $_GET['post_tag'] )? $_GET['post_tag'] : '';

?>
	<div class="container" id="ResourceArchive">
	<div class="line"></div>

	<div class="row filters">
		<div class="col">
			<div style="text-align: center">

				<form method="get"
					data-target='.js-archive-target'
					data-ajax="<?php echo admin_url( 'admin-ajax.php?action=order/advanced-archive-post' ); ?>"
					data-archive="<?php echo get_the_ID(); ?>"
					class="js-ajax js-autosubmit"
				>
					<input class="js-input-archive" type="hidden" name="category" value="<?php echo esc_attr( $category ); ?>">

					<div class="resource-archive__filters m-blog-filter__inputs-container">
						<div class="resource-archive__selects m-blog-filter__input-container">

						<?php
						foreach( $args['filters'] as $taxonomy => $filter ):
								$html = AdvancedArchive()->taxonomy_filter( $filter );
								if( '' !== $html ):
						?>
								<div class="resource-archive__filter-container <?php echo $taxonomy ?>">
									<?php echo $html; ?>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
						</div>

							<div class="resource-archive__search-container m-blog-filter__input-container">
								<?php echo AdvancedArchive()->search_filter(); ?>
								<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="10" cy="10" r="9.25" stroke="#101010" stroke-width="1.5"/>
									<line x1="15.5303" y1="16.4697" x2="23.5303" y2="24.4697" stroke="#101010" stroke-width="1.5"/>
								</svg>
								<button type="submit"><?php _e( 'Submit', 'order' ); ?></button>
							</div>

					</div>

					<input type="hidden" name="rpage" value="1">

				</form>

			</div>
		</div>
	</div>

<div class="js-archive-target">
