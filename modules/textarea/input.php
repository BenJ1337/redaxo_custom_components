<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
for ($i = 0; $i < 100; $i++) {
    $textarea = new redaxo_custom_components\Textarea(
        'Text ' . $i,
        1,
        ['text', $i],
        $slice
    );
    echo $textarea->getHTML();
}
