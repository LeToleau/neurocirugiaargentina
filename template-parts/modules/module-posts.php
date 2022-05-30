<?php //Example pagination 
?>

<div class="m-posts js-posts-pagination">

    <div class="container">

        <?php

        AdvancedPagination::print(
            array(
                'post_type' => 'post',
                'posts_per_page' => 4,
                'component' => 'post',
                'no_results_message' => 'Nothing Found...',
                'next_button' => 'Next >',
                'prev_button' => '< Prev',
                'loader_color' => '#444',
                'numbers_limit' => 3,
                'search' => true,
                'search_opt' => array(
                    'placeholder' => __('Search...', 'wcanvas-boilerplate'),
                    'append' => ''
                ),
                'filters' => true,
                'filters_opt' => array(
                    'preppend' => 'Sort by ',
                    'append' => '  v',
                    'title' => false
                )
            )
        );

        ?>

    </div>

</div>