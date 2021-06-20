<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
for ($i = 0; $i < 100; $i++) {
    $mehrfachlinkauswahl = new redaxo_custom_components\MehrfachLinkauswahl(
        'Linkauswahl ' . $i,
        1,
        ['links', $i],
        $slice
    );
    echo $mehrfachlinkauswahl->getHTML();
}
