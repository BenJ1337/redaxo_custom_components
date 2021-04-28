<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
for ($i = 0; $i < 100; $i++) {
    $checkbox = new Checkbox(
        'Checkbox ' . $i,
        1,
        ['checkbox', $i],
        $slice,
        '1',
        '0'
    );
    echo $checkbox->getHTML();
}
