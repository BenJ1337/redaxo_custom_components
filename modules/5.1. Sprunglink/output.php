<?php

use redaxo_bootstrap\{ModuleManager};

$this->getContentAsQuery(true);
$slice = rex_article_slice::getArticleSliceById($this->getCurrentSlice()->getId());
if (null !== $slice) {
    $rex_values_content = json_decode($slice->getValue(2), true);
    if (isset($rex_values_content["link"]) && $rex_values_content["link"] != '') {
        $refName .= '-' . $rex_values_content['link'];
        $output = '<div class="container"><div class="row"><div class="col-md-12" style="padding: 40px 0;"><a class="link-btn" href="#' . $refName . '">Kontakt</a></div></div></div>';
        echo (new ModuleManager($this->getCurrentSlice()->getId()))->getOutput($rex_values_content["text"]);
    }
}
