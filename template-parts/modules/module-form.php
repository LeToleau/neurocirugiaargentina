<?php
$form = get_sub_field('form');
?>
<div class="m-form">
    <div class="container">
        <?php echo do_shortcode('[gravityform id="' . $form . '" title="false" description="false" ajax="true" tabindex="49"]'); ?>
    </div>
</div>