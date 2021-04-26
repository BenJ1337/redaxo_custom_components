<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
for($i = 0; $i < 5; $i++) {
    $bildauswahl = new Bildauswahl(
        'Bildauswahl '.$i,
        1,
        ['bilder',$i],
        $slice
    );
    echo $bildauswahl->getHTML();
}
