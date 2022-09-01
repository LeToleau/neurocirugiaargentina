<?php
    $post = $newpost;

    $videoUrl = get_field('video_embed', $post->ID); 
    $videoDescription = get_field('video_description', $post->ID);
    $placeholder = get_field('placeholder_image', $post->ID); 

    $videoID = get_ID_from_embed($videoUrl); //get ID from embed video
    $thumbnailUrl = 'http://img.youtube.com/vi/'.$videoID.'/0.jpg'; //apply ID on thumbnail url
?>



<div class="c-video js-card" data-modal="<?php echo $videoID; ?>">
    <div data-modal="<?php echo $videoID ?>" class="c-video-img-container js-open-modal">
        <img class="c-video-placeholder placeholder" src="<?php echo $placeholder ? esc_url($placeholder['url']) : esc_url($thumbnailUrl); ?>" alt="Video Thumbnail">
        <img class="c-video-play-icon play-icon" src="<?= get_template_directory_uri(); ?>/assets/img/icons/youtube.svg" alt="Play Icon">
    </div>
    <div class="c-video-info">
        <h4><?= get_the_title($post->ID); ?></h4>
        <p><?= esc_html($videoDescription); ?></p>
    </div>

</div>
<!-- <div class="c-video-modal" id=<?php #echo $videoID; ?> style="display: none;">
    <div class="c-video-modal__wrapper">
        <iframe width="850" height="478" src="https://www.youtube.com/embed/<?php #echo $videoID ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div> -->