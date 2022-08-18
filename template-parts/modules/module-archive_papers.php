<?php
$title = get_sub_field('title');
?>

<div class="m-papers-archive js-papers-archive">

    <div class="container">

        <?php if ($title) : ?>
            <h2 class="m-papers-archive__title title-secondary"><?= is_tax() ? single_cat_title('Latest ') : esc_html($title) ?></h2>
        <?php endif; ?>

        <?php

        AdvancedPagination::print(
            array(
                'post_type' => 'papers',
                'posts_per_page' => 9,
                'component' => 'paper',
                'no_results_message' => 'No se encontraron resultados.',
                //'next_button' => get_svg('/assets/img/icons/arrow-lite-grey.svg'),
                //'prev_button' => get_svg('/assets/img/icons/arrow-lite-grey.svg'),
                'loader_color' => '#115FAC',
                'numbers_limit' => 3,
                'search' => true,
                'search_opt' => array(
                    'placeholder' => 'Buscar Paper...',
                    'append' => ''
                ),
                'filters' => true,
                'filters_opt' => array(
                    'preppend' => __('Sort by ', 'imago'),
                    //'append' => get_svg('/assets/img/icons/arrow-vector-blue.svg'),
                    'title' => false
                )
            )
        );

        ?>

    </div>

</div>
