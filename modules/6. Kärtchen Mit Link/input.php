<?php

use redaxo_custom_components\{IconPicker, Inputfield, Textarea, Linkauswahl};
use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;
if (null !== $this->sliceSql && $this->function === 'edit') {
    $sliceId = $this->getCurrentSlice()->getId();
}

$output = '';
$iconPicker = new IconPicker(
    "Icon",
    ['icon'],
    $sliceId,
    2
);
$output .= $iconPicker->getHTML();

$title = new Inputfield(
    "title",
    ['title'],
    $sliceId,
    2
);
$output .= $title->getHTML();

$slice = rex_article_slice::getArticleSliceById($sliceId);
$text = new Textarea(
    "text",
    ['text'],
    $sliceId,
    2
);
$output .= $text->getHTML();

$linkauswahl = new Linkauswahl(
    "Verlinkter Artikel",
    ['link'],
    $sliceId,
    2
);
$output .= $linkauswahl->getHTML();

echo (new ModuleManager($sliceId))->getInput($output);
