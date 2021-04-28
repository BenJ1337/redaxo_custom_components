<?php
$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);
if ($rex_values_content != null) {
    echo '<ol>';
    foreach ($rex_values_content["links"] as $linkArray) {
        echo '<li>';
        if (empty($linkArray)) {
            echo 'kein Verlinkung vorhanden';
        } else {
            echo '<ol>';
            foreach (explode(',', $linkArray) as $artId) {
                echo '<li>';
                if (empty($artId)) {
                    echo 'Kein Artikel ausgewählt.';
                } else {
                    echo '<a href="' . rex_getUrl($artId) . '">' . rex_article::get($artId)->getName() . '</a>';
                }
                echo '</li>';
            }
            echo '</ol>';
        }
        echo  '</li>';
    }
    echo '</ol>';
} else {
    echo 'null';
}
