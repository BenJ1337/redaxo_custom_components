<?php

$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($this->slice_id)->getValue(2), true);
if (isset($rex_values_content["bild"]) && $rex_values_content["bild"] != '') {
    $alt = $rex_values_content["bild"];
    $medium = rex_media::get($rex_values_content["bild"]);
    if ($medium != null) {
        $alt = $medium->getTitle() != "" ? trim($medium->getTitle()) : $medium->getFileName();
    }
    echo (new ModuleManager($this->slice_id))->getOutput('<img class="img-fluid" src="/media/' . $rex_values_content["bild"] . '" alt="' . $alt . '">');
}
