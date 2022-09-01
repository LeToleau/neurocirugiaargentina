<?php 
    $post = $newpost; 
    $title = get_the_title($post);
    $otherTitle = get_field('featured_papers_title', $post->ID);
    $author = get_field('papers_author', $post->ID);
    $description = get_field('papers_description', $post->ID);
    $downloadLink = get_field('papers_download_link', $post->ID);
    $onlineViewLink = get_field('papers_online_view_link', $post->ID);
?>

<article class="c-paper">
    <div class="c-paper__img-container">
        <a class="c-paper__link" href="<?= esc_url($onlineViewLink['url']) ?>">
            <span>Ver Online</span>
            <img class="online-view" src="<?= get_template_directory_uri(); ?>/assets/img/icons/pdf-icon.png" alt="">
        </a>
        <a class="c-paper__link" href="<?= esc_url($downloadLink['url']) ?>">
            <img class="download" src="<?= get_template_directory_uri(); ?>/assets/img/icons/download-icon.png" alt="">
            <span>Descargar</span>
        </a>
    </div>
    <div class="c-paper__info-container">
        <span>
            <h2 class="c-paper__title">
                <?= $title; ?>
            </h2>
            <p class="c-paper__author">
                <?= $author; ?>
            </p>
        </span>
        <p class="c-paper__description">
            <?= wp_trim_words( $description, 50 ); ?>
        </p>
    </div>
</article>