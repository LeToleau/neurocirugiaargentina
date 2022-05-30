<?php
//ACF
$title = get_sub_field('title');
$slides = get_sub_field('images');
?>

<div class="m-image-gallery js-image-gallery" has-js="true">

    <div class="container">

        <?php if ($title) : ?>

            <h3 class="m-image-gallery__title"><?= esc_html($title); ?></h3>

        <?php endif; ?>

        <div class="m-image-gallery__slider" slider-container>

            <?php foreach ($slides as $slide) : ?>
                <div class="m-image-gallery__slide">
                    <img src="<?php echo esc_url($slide['sizes']['large']); ?>" alt="">
                    <h4><?php echo esc_html($slide['title']) ?></h4>
                    <p><?php echo esc_html($slide['caption']) ?></p>
                    <p><?php echo esc_html($slide['alt']) ?></p>
                    <p><?php echo esc_html($slide['description']) ?></p>
                </div>

            <?php endforeach; ?>

        </div>

    </div>

</div>