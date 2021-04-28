<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
for ($i = 0; $i < 100; $i++) {
    $mehrfachbildauswahl = new MehrfachBildauswahl(
        'Bildauswahl ' . $i,
        1,
        ['bilder', $i],
        $slice
    );
    echo $mehrfachbildauswahl->getHTML();
}
