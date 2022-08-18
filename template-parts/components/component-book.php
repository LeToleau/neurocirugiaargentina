<?php 
$post = $newpost;

$title = get_the_title($post);
$image = get_field('book_preview_image', $post->ID);
$author = get_field('book_author', $post->ID);
$downloadLink = get_field('book_download_link', $post->ID);
$previewLink = get_field('book_online_view_link', $post->ID);
?>

<div class="c-book">
    <div class="c-book-img-container">
        <img src="<?= esc_url($image['url']); ?>" alt="">
    </div>
    <div class="c-book-info">
        <div>
            <h4><?= $title ?></h4>
            <p><?= esc_html($author); ?></p>
        </div>
        <div>
            <a class="c-book-cta button" href="<?= esc_url($downloadLink['url']); ?>"><?= esc_html($downloadLink['title']); ?></a>
            <a class="c-book-cta button" href="<?= esc_url($previewLink['url']); ?>"><?= esc_html($previewLink['title']); ?></a>
        </div>
    </div>

</div>