<?php 
    $letters = array(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'w', 'v', 'w', 'x', 'y', 'z'
    )
?>

<div class="c-alphabetic">
    <ul class="c-alphabetic__list">
        <li class="c-alphabetic__list-letter">
            <form method="post">
                <input type="submit" name="abc-filter" value="Todos">
            </form>
        </li>
        <?php foreach($letters as $letter) {
            echo '<li class="c-alphabetic__list-letter">
                    <form method="post">
                        <input type="submit" name="abc-filter" value="' . $letter. '">
                    </form>
                  </li>';
        } ?>

    </ul>
</div>