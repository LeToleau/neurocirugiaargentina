<?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array(
        'post_type' => 'libros',
        'post_status' => 'publish',
        'posts_per_page' => 9,
        'paged' => $paged
    );
?>

<section class="m-book-archive js-book-archive">
    <h2>Libros del Canal</h2>
    <div class="m-book-archive__container container">

        <?php AdvancedPagination::print(
            array(
                'post_type' => 'libros',
                'posts_per_page' => 9,
                'component' => 'book',
                'no_results_message' => 'No se encontraron resultados.',
                //'next_button' => get_svg('/assets/img/icons/arrow-lite-grey.svg'),
                //'prev_button' => get_svg('/assets/img/icons/arrow-lite-grey.svg'),
                'loader_color' => '#115FAC',
                'numbers_limit' => 3,
                'search' => true,
                'search_opt' => array(
                    'placeholder' => 'Buscar libro...',
                    'append' => ''
                ),
                'filters' => true,
                'filters_opt' => array(
                    'preppend' => __('Sort by ', 'imago'),
                    //'append' => get_svg('/assets/img/icons/arrow-vector-blue.svg'),
                    'title' => false
                )
            )
        ); ?>
    </div>
</section>