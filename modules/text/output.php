<?php
//rex_article_content:: getContentAsQuery(true) -> SQL Queries erlauben
//rex_article_content::
$this->getContentAsQuery(true);
$slice = rex_article_slice::getArticleSliceById($this->getCurrentSlice()->getId());
if (null !== $slice) {
    $rex_values_content = json_decode($slice->getValue(2), true);
    if (isset($rex_values_content["text"]) && $rex_values_content["text"] != '') {
        echo (new ModuleManager($this->getCurrentSlice()->getId()))->getOutput($rex_values_content["text"]);
    }
}
