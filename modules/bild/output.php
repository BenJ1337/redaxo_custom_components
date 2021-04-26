<?php
$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);
if ($rex_values_content != null) {
    foreach($rex_values_content["bilder"] as $img) {
        echo '<img src="/media/' . $img . '">';
    }
} else {
    echo 'null';
}
