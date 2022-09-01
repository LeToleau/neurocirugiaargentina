<?php
    $headingTitle = get_sub_field('heading_title');
    $headingCopy = get_sub_field('heading_copy');
?>

<div class="m-three-cards">
    <div class="m-three-cards__container container">
        <div class="m-three-cards__heading">
            <h2 class="m-three-cards__title"><?= esc_html($headingTitle); ?></h2>
            <p class="m-three-cards__copy"><?= esc_html($headingCopy); ?></p>
        </div>

        <div class="m-three-cards__cards-repeater">
            <?php
            if (have_rows('three_cards')) : 
                while (have_rows('three_cards')) : the_row();
                    $icon = get_sub_field('card_icon');
                    $title = get_sub_field('card_title');
                    $copy = get_sub_field('card_copy');
                    $link = get_sub_field('card_button');
                    $bgdColor = get_sub_field('card_background_color'); ?>

                    <div class="m-three-cards__card">
                        <img src="<?= esc_url($icon['url']) ?>" alt="Medical Icon" class="m-three-cards__card-icon">
                        <h4 class="m-three-cards__card-title"><?= esc_html($title); ?></h4>
                        <p class="m-three-cards__card-copy"><?= esc_html($copy); ?></p>
                        <a href="<?= esc_url($link['url']); ?>" class="m-three-cards__button button"><?= esc_html($link['title']); ?></a>
                    </div>

                    <style>
                        .m-three-cards__card:hover {
                            background-color: <?php echo esc_attr($bgdColor); ?>;
                        }
                    </style>

                    <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
</div>