<?php

use redaxo_bootstrap\{ModuleManager};

//rex_article_content:: getContentAsQuery(true) -> SQL Queries erlauben
//rex_article_content::
$this->getContentAsQuery(true);
$slice = rex_article_slice::getArticleSliceById($this->getCurrentSlice()->getId());
if (null !== $slice) {
    $rex_values_content = json_decode($slice->getValue(2), true);
    if (isset($rex_values_content["placeholder_height"]) && $rex_values_content["placeholder_height"] != '') {
        echo (new ModuleManager($this->getCurrentSlice()->getId()))->getOutput("<div style=\"height: " . $rex_values_content['placeholder_height'] . "px;\"></div>");
    }
}
