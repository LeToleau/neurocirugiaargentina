<?php 
    $title = get_sub_field('intro_title');
    $copy = get_sub_field('intro_copy');
    $image = get_sub_field('intro_image');
?>

<section class="m-intro">
    <div class="m-intro__container container">
        <div class="m-intro__img-wrapper">
            <img src="<?= esc_url($image['url']); ?>" alt="" class="m-intro__img">
        </div>
        <div class="m-intro__text-wrapper">
            <h2 class="m-intro__title"><?= esc_html($title); ?></h2>
            <span class="m-intro__copy"><?= $copy; ?></span>
        </div>
    </div>
</section>