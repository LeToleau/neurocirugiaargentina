<section class="m-video-archive js-video-modal">
    <h2>Videos del Canal</h2>
    <div class="m-video-archive__container container">
        <?php AdvancedPagination::print(
            array(
                'post_type' => 'videos',
                'posts_per_page' => 9,
                'component' => 'video',
                'no_results_message' => 'No se encontraron resultados.',
                //'next_button' => get_svg('/assets/img/icons/arrow-lite-grey.svg'),
                //'prev_button' => get_svg('/assets/img/icons/arrow-lite-grey.svg'),
                'loader_color' => '#115FAC',
                'numbers_limit' => 3,
                'search' => true,
                'search_opt' => array(
                    'placeholder' => 'Buscar video...',
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