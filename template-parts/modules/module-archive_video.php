<section class="m-video-archive js-video-modal">
    <h2>Videos del Canal</h2>
    <?php get_template_part('template-parts/cards/card', 'alphabetic'); ?>
    <div class="m-video-archive__container container">
        <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            if(isset($_POST['abc-filter']) && $_POST['abc-filter'] != 'Todos' && $paged > 0) {
                $letter = $_POST['abc-filter'];
        
                $letterQuery = new WP_Query( array(
                    'post_type' => 'videos',
                    'starts_with' => $letter,
                    'posts_per_page' => 9,
                    'paged' => $paged
                ) );
            } elseif($paged > 0) { 
                $letterQuery = new WP_Query( array(
                    'post_type' => 'videos',
                    'posts_per_page' => 9,
                    'paged' => $paged
                ) );
            }
            
            if ( $letterQuery->have_posts() ) :
                while ( $letterQuery->have_posts() ) :
                    $letterQuery->the_post(); 
                    $videoUrl = get_field('video_embed'); 
                    $videoDescription = get_field('video_description');
                    $placeholder = get_field('placeholder_image'); 

                    $videoID = get_ID_from_embed($videoUrl); //get ID from embed video
                    $thumbnailUrl = 'http://img.youtube.com/vi/'.$videoID.'/0.jpg'; //apply ID on thumbnail url

                    $my_title = get_the_title();
                    // Get the first character using substr.
                    $firstCharacter = substr($my_title, 0, 1);
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
            endif;
                wp_reset_postdata();
            ?>
    </div>
    <div class="pagination">
        <?php
            $big = 999999999;
            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $letterQuery->max_num_pages,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;'
            ) );
        ?>
    </div> 
</section>