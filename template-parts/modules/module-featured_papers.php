<?php 
    $title = get_sub_field('featured_papers_title');
    $copy = get_sub_field('featured_papers_copy');
    $papers = get_sub_field('featured_papers_papers');
?>

<div class="m-featured-papers">
    <div class="m-featured-papers__container container">
        <?php foreach ($papers as $paper) {
            get_template_part('template-parts/components/component', 'paper');
        }?>
    </div>
</div>