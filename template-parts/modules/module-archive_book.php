<?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array(
        'post_type' => 'libros',
        'post_status' => 'publish',
        'posts_per_page' => 9,
        'paged' => $paged
    );
?>

<section class="m-book-archive">
    <h2>Libros del Canal</h2>
    <div class="m-book-archive__container container">
        <?php
 
            $bookQuery = new WP_Query( $args );
            
            if ( $bookQuery->have_posts() ) :
                while ( $bookQuery->have_posts() ) :
                    $bookQuery->the_post(); 
                    $image = get_field('book_preview_image');
                    $author = get_field('book_author');
                    $downloadLink = get_field('book_download_link');
                    $previewLink = get_field('book_online_view_link');
                    ?>


                    <div class="m-book-archive__card">
                        <div class="m-book-archive__card-img-container">
                            <img src="<?= esc_url($image['url']); ?>" alt="">
                        </div>
                        <div class="m-book-archive__card-info">
                            <div>
                                <h4><?= the_title(); ?></h4>
                                <p><?= esc_html($author); ?></p>
                            </div>
                            <div>
                                <a class="m-book-archive__card-cta button" href="<?= esc_url($downloadLink['url']); ?>"><?= esc_html($downloadLink['title']); ?></a>
                                <a class="m-book-archive__card-cta button" href="<?= esc_url($previewLink['url']); ?>"><?= esc_html($previewLink['title']); ?></a>
                            </div>
                        </div>

                    </div>
                <?php
                endwhile;
            else :
                // no posts found
            endif; ?>
    </div>
    <div class="pagination">
        <?php
            $big = 999999999;
            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $bookQuery->max_num_pages,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;'
            ) );
        ?>
    </div> 
        <?php

        wp_reset_postdata();

        ?>
</section>