<?php
$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);

if ($rex_values_content != null) {
    echo '<ol>';
    foreach ($rex_values_content["wrapper"] as $item) {
        echo '<li><ol>';
        foreach ($item['text'] as $txt) {
            echo '<li>' . $txt . '</li>';
        }
        echo '</ol></li>';
    }
    echo '</ol>';
} else {
    echo 'null';
}
