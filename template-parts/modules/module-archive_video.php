<?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array(
        'post_type' => 'videos',
        'post_status' => 'publish',
        'posts_per_page' => 9,
        'paged' => $paged
    );
?>

<section class="m-video-archive js-video-modal">
    <h2>Videos del Canal</h2>
    <div class="m-video-archive__container container">
        <?php
 
            $videoQuery = new WP_Query( $args );
            
            if ( $videoQuery->have_posts() ) :
                while ( $videoQuery->have_posts() ) :
                    $videoQuery->the_post(); 
                    $videoUrl = get_field('video_embed'); 
                    $videoDescription = get_field('video_description');
                    $placeholder = get_field('placeholder_image'); 

                    $videoID = get_ID_from_embed($videoUrl); //get ID from embed video
                    $thumbnailUrl = 'http://img.youtube.com/vi/'.$videoID.'/0.jpg'; //apply ID on thumbnail url
                    ?>


                    <div class="m-video-archive__card js-card" data-modal="<?php echo $videoID; ?>">
                        <div data-modal="<?php echo $videoID ?>" class="m-video-archive__card-img-container js-open-modal">
                            <img class="m-video-archive__card-placeholder placeholder" src="<?php echo $placeholder ? esc_url($placeholder['url']) : esc_url($thumbnailUrl); ?>" alt="Video Thumbnail">
                            <img class="m-video-archive__card-play-icon play-icon" src="<?= get_template_directory_uri(); ?>/assets/img/icons/youtube.svg" alt="Play Icon">
                        </div>
                        <div class="m-video-archive__card-info">
                            <h4><?= the_title(); ?></h4>
                            <p><?= esc_html($videoDescription); ?></p>
                        </div>

                    </div>
                    <div class="c-video-modal" id=<?php echo $videoID; ?> style="display: none;">
                        <div class="c-video-modal__wrapper">
                            <iframe width="850" height="478" src="https://www.youtube.com/embed/<?php echo $videoID ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                'total' => $videoQuery->max_num_pages,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;'
            ) );
        ?>
    </div> 
        <?php

        wp_reset_postdata();

        ?>
</section>