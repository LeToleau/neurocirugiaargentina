<?php 
    $title = get_sub_field('featured_papers_title');
    $copy = get_sub_field('featured_papers_copy');
    $papers = get_sub_field('featured_papers_papers');
?>

<div class="m-featured-papers">
    <div class="m-featured-papers__container container">
        <div class="m-featured-papers__heading">
            <h2 class="m-featured-papers__title"><?= esc_html($title); ?></h2>
            <p class="m-featured-papers__copy"><?= esc_html($copy); ?></p>
        </div>
        <div class="m-featured-papers__posts">
            <?php if(have_posts($papers)) :
                foreach($papers as $paper) :
                    $download = get_field('papers_download_link', $paper->ID); 
                    $paperTitle = get_the_title($paper->ID);
                    $author = get_field('papers_author', $paper->ID);
                    $description = get_field('papers_description', $paper->ID);
                    $onlineView = get_field('papers_online_view_link', $paper->ID);
                    ?>
                    <article class="c-paper">
                        <div class="c-paper__img-container">
                            <a class="c-paper__link" href="<?= esc_url($onlineView['url']) ?>">
                                <span>Ver Online</span>
                                <img class="online-view" src="<?= get_template_directory_uri(); ?>/assets/img/icons/pdf-icon.png" alt="">
                            </a>
                            <a class="c-paper__link" href="<?= esc_url($download['url']) ?>">
                                <img class="download" src="<?= get_template_directory_uri(); ?>/assets/img/icons/download-icon.png" alt="">
                                <span>Descargar</span>
                            </a>
                        </div>
                        <div class="c-paper__info-container">
                            <span>
                                <h2 class="c-paper__title">
                                    <?= $paperTitle; ?>
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
                <?php endforeach; 
            endif; ?>
        </div>
    </div>
</div>