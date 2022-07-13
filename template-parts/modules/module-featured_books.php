<?php 
    $title = get_sub_field('f_books_title');
    $copy = get_sub_field('f_books_copy');
    $featBooks = get_sub_field('featured_books');
?>

<section class="m-featured-books">
    <div class="m-featured-books__container container">
        <div class="m-featured-books__heading">
            <h2 class="m-featured-books__title"><?= esc_html($title); ?></h2>
            <p class="m-featured-books__copy"><?= esc_html($copy); ?></p>
        </div>
        <div class="m-featured-books__books">
            <?php
                foreach($featBooks as $book) : 
                $bookId = $book->ID;
                $bookImage = get_field('book_preview_image', $bookId);
                $bookAuthor = get_field('book_author', $bookId);
                $bookDownload = get_field('book_download_link', $bookId);
                $bookPreview = get_field('book_online_view_link', $bookId);

                ?>
                    <div class="m-featured-books__card">
                        <div class="m-featured-books__image-wrapper">
                            <img src="<?php echo esc_url($bookImage['url']); ?>" alt="">
                        </div>
                        <div class="m-featured-books__text-container">
                            <div class="m-featured-books__card-title">
                                <h4><?php echo $book->post_title; ?></h4>
                                <p><?php echo esc_html($bookAuthor); ?></p>
                            </div>
                            <div class="m-featured-books__buttons">
                                <a href="<?php echo esc_url($bookDownload['url']); ?>" class="button"><?php echo esc_html($bookDownload['title']); ?></a>
                                <a href="<?php echo esc_url($bookPreview['url']); ?>" class="button"><?php echo esc_html($bookPreview['title']); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            ?>
        </div>

        <div class="m-featured-books__cta-container">
            <a class="m-featured-books__cta button" href="<?php echo get_template_directory_uri(); ?>/libros">Explorar Todos</a>
        </div>

    </div>
</section>