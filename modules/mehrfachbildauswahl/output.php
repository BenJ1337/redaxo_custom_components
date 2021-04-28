<?php
$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);
if ($rex_values_content != null) {
    echo '<ol>';
    foreach ($rex_values_content["bilder"] as $imgArray) {
        echo '<li>';
        if (empty($imgArray)) {
            echo 'Kein Bild';
        } else {
            foreach (explode(',', $imgArray) as $img) {
                echo '<img src="/media/' . $img . '">';
            }
        }
        echo  '</li>';
    }
    echo '</ol>';
} else {
    echo 'null';
}
