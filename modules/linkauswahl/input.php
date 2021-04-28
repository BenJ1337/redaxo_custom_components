<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
for ($i = 0; $i < 100; $i++) {
    $linkauswahl = new Linkauswahl(
        'Text ' . $i,
        1,
        ['text', $i],
        $slice
    );
    echo $linkauswahl->getHTML();
}
