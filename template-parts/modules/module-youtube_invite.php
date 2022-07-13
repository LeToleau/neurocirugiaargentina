<?php 
    $message = get_sub_field('invite_text');
    $cta = get_sub_field('youtube_cta');
    $image = get_sub_field('invite_featured_image');
?>

<section class="m-youtube-invite">
    <div class="m-youtube-invite__container container">
        <img class="m-youtube-invite__img" src="<?= esc_url($image['url']); ?>" alt="">
        <div class="m-youtube-invite__text-wrapper">
            <h2 class="m-youtube-invite__title"><?= esc_html($message); ?></h2>
            <a class="m-youtube-invite__cta button" href="<?= esc_url($cta['url']); ?>"><?= esc_html($cta['title']); ?></a>
            <script src="https://apis.google.com/js/plusone.js"></script>
            <div class="g-ytsubscribe" data-channelid="UCJ2bSwtZHCuA2XZmn-NLQyw" data-layout="full"  data-theme="light" data-count="hidden"></div>
        </div>
    </div>
</section>