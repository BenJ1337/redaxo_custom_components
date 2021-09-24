<?php
$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(2), true);

$refName = 'artikel';
if (isset($rex_values_content['link']) && !empty($rex_values_content['link'])) {
    $art = rex_article::get($rex_values_content['link']);
    if($art != null) {
        $refName = str_replace(' ', '-', $art->getName());
    }
    $refName .= '-'. $rex_values_content['link'];
}




echo '<div class="container">
    <div class="row">
        <div class="col-md-12" style="padding: 40px 0;">
            <a class="link-btn" href="#'.$refName .'">Kontakt</a>
        </div>
    </div>
</div>';
