<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
for($i = 0; $i < 5; $i++) {
    $bildauswahl = new Bildauswahl(
        'Bildauswahl '.$i,
        1,
        ['bilder',$i],
        $slice != null ? rex_var::toArray($slice->getValue(1)) : null
    );
    echo $bildauswahl->getHTML();
}
