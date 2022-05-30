<?php $post = $newpost; ?>

<article class="c-post">
    <a href="<?= get_the_permalink($post); ?>">
        <?= get_the_title($post); ?>
    </a>
</article>