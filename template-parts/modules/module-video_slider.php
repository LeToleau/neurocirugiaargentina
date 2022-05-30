<?php 
    $title = get_sub_field('video_slider_title');
    $description = get_sub_field('video_slider_description');

    $args = array(
        'post_type' => 'videos',
        'post_status' => 'publish',
        'posts_per_page' => 6
    );

    $video_query = new WP_Query( $args );

?>

<section class="m-video-slider">
    <div class="m-video-slider__container container">
        <?php
        if ( $video_query->have_posts() ) : ?>
            <div class="m-video-slider__slider">
                <?php
                while ( $video_query->have_posts() ) {
                    $video_query->the_post(); 
                    $videoData = get_field('video_embed'); ?>
                    <div class="m-video-slider__card">
                        <?php echo $videoData; ?>
                        <h4 class="m-video-slider__card-title"><?php echo esc_html(get_the_title()); ?></h4>
                        <h1><?php var_dump( $videoData ); ?></h1>
                        
                    </div>
                <?php
                } ?>

            </div>
            <?php
        endif;

        /* Restore original Post Data */
        wp_reset_postdata();
        ?>
    </div>
</section>