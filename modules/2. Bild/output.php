<?php

use redaxo_bootstrap\{ModuleManager};

//rex_article_content:: getContentAsQuery(true) -> SQL Queries erlauben
//rex_article_content::
$this->getContentAsQuery(true);
$slice = rex_article_slice::getArticleSliceById($this->getCurrentSlice()->getId());
if (null !== $slice) {
    $rex_values_content = json_decode($slice->getValue(2), true);
    if (isset($rex_values_content["bild"]) && $rex_values_content["bild"] != '') {
        $alt = $rex_values_content["bild"];
        $medium = rex_media::get($rex_values_content["bild"]);
        if ($medium != null) {
            $alt = $medium->getTitle() != "" ? trim($medium->getTitle()) : $medium->getFileName();
        }
        echo (new ModuleManager($this->getCurrentSlice()->getId()))->getOutput('<img class="img-fluid" src="/media/' . $rex_values_content["bild"] . '" alt="' . $alt . '">');
    }
}
