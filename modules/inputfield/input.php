<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
for ($i = 0; $i < 100; $i++) {
    $inputfield = new redaxo_custom_components\Inputfield(
        'Text ' . $i,
        1,
        ['text', $i],
        $slice
    );
    echo $inputfield->getHTML();
}
