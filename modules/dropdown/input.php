<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
for ($i = 0; $i < 100; $i++) {
    $dropdown = new redaxo_custom_components\DropDown(
        'DropDown ' . $i,
        1,
        ['dropdown', $i],
        $slice,
        ['a1' => '1', 'a2' => '2']
    );
    echo $dropdown->getHTML();
}
