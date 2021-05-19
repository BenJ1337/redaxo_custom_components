<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
for ($i = 0; $i < 100; $i++) {
    $bildauswahl = new redaxo_custom_components\Bildauswahl(
        'Bildauswahl ' . $i,
        1,
        ['bilder', $i],
        $slice
    );
    echo $bildauswahl->getHTML();
}
