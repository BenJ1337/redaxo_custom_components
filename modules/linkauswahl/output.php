<?php
$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);
if ($rex_values_content != null) {
    echo '<ol>';
    foreach ($rex_values_content["text"] as $artId) {
        echo '<li>';
        if (empty($artId)) {
            echo 'kein Verlinkung vorhanden.';
        } else {
            echo '<a href="' . rex_getUrl($artId) . '">' . rex_article::get($artId)->getName() . '</a>';
        }

        echo '</li>';
    }
    echo '</ol>';
} else {
    echo 'null';
}
