<?php
//ACF
$titleSection = get_sub_field('title_section_text');
$description = get_sub_field('description');

//Media Content
$image = get_sub_field('image');

//Option
$reverseOrder = get_sub_field('content_order');
?>
<div class="m-left-right">

	<div class="container">

		<div class="m-left-right__container<?= $reverseOrder ? ' m-left-right__container--reverse-order' : ''; ?>">

			<?php //Text Container 
			?>
			<div class="m-left-right__text-content">

				<?php if ($titleSection) : ?>

					<h4 class="m-left-right__text-content-title"><?= esc_html($titleSection); ?></h4>

				<?php endif; ?>

				<?php if ($description) : ?>

					<div class="m-left-right__text-content-description"><?php echo $description; ?></div>

				<?php endif; ?>

			</div>

			<?php //Media Container 
			?>
			<div class="m-left-right__media-content">

				<?php if ($image) : ?>

					<img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']) ?>">

				<?php endif; ?>

			</div>

		</div>

	</div>

</div>