<?php
    $videos = get_sub_field('recommended_videos_slider');
    $headingTitle = get_sub_field('recomennded_videos_heading_title');
    $headingCopy = get_sub_field('recomennded_videos_heading_copy');
    $headingCTA = get_sub_field('recomennded_videos_heading_button');
?>

<div class="m-recommended-videos js-video-modal">
    <div class="m-recommended-videos__container container">
        <div class="m-recommended-videos__heading">
            <h2 class="m-recommended-videos__heading-title"><?= esc_html($headingTitle); ?></h2>
            <p class="m-recommended-videos__heading-copy"><?= esc_html($headingCopy); ?></p>
            <a href="<?= esc_url($headingCTA['url']); ?>" class="m-recommended-videos__heading-cta button"><?= esc_html($headingCTA['title']); ?></a>
        </div>
        <?php
            if( $videos ): ?>
                <div class="m-recommended-videos__wrapper js-my-swiper swiper">
                    <div class="swiper-wrapper">
                        <?php
                            foreach( $videos as $video ): 
                                $videoTitle = get_the_title($video);
                                $placeholder = get_field('placeholder_image', $video);
                                $videoUrl = get_field('video_embed', $video);
                                $videoID = get_ID_from_embed($videoUrl);
                                $thumbnailUrl = 'http://img.youtube.com/vi/'.$videoID.'/0.jpg'; ?>
                                <div class="js-card swiper-slide" data-modal="<?php echo $videoID; ?>">
                                    <div class="m-recommended-videos__video">
                                        <p class="m-recommended-videos__video-title"><?php echo esc_html($videoTitle); ?></p>
                                        <img class="m-recommended-videos__video-thumbnail" src="<?php echo $placeholder ? esc_url($placeholder['url']) : esc_url($thumbnailUrl); ?>">
                                        <img class="m-recommended-videos__video-play-icon play-icon" src="<?= get_template_directory_uri(); ?>/assets/img/icons/youtube.svg" alt="Play Icon">
                                    </div>
    
                                </div>
                                <?php endforeach;
                        wp_reset_postdata(); ?>
                    </div>
                    
                </div>
                <div class='swiper-pagination js-video-swiper-pagination'></div>
                <?php
            endif; 
            ?>
    </div>
    <div class="c-video-modal" style="display: none;">
        <div class="c-video-modal__wrapper">
            
        </div>
    </div>
</div>