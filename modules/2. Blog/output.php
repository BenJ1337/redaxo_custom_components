<?php
    use redaxo_bootstrap\{ModuleManager};

    $this->getContentAsQuery(true);
    $sliceId = $this->getCurrentSlice()->getId();
    $slice = rex_article_slice::getArticleSliceById($sliceId);

$rex_values_settings = json_decode(rex_article_slice::getArticleSliceById($sliceId)->getValue(1), true);
$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($sliceId)->getValue(2), true);

$output = '';

$selectedArticle = rex_article::get($rex_values_content['link']);

$output = '';
if ($selectedArticle != null) {
    $categorieId = $selectedArticle->getCategoryId();

    $categorie = rex_category::get($categorieId);

    $articlesSubCat = $categorie->getArticles();

    foreach ($articlesSubCat as $article) {
        if ($article->isOnline()) {
            $timestamp = date('d.m.Y', $article->getCreateDate());

            $image = rex_var_article::getArticleValue($article->getId(), "art_blog_preview_image");
            $text = rex_var_article::getArticleValue($article->getId(), "art_blog_preview_text");

            $output .= '<div class="card blog">'
                . ($image !== null && !empty(trim($image)) ? '<img class="card-img-top" src="/media/' . $image . '" alt="Card image">' : '')
                . '<div class="card-body">'
                . '<h4 class="card-title">' . $article->getName() . ' <span class="badge badge-dark">' . $timestamp . '</span></h4>'
                . '<p class="card-text">' . $text . '</p>'
                . '<a href="' . rex_getUrl($article->getId()) . '" class="btn btn-primary stretched-link">Weiterlesen</a>'
                . '</div>'
                . '</div>';
        }
    }

}

echo $output;

/*
$articleIDSubCat = $articlesSubCat[0]->getId();
$slicesOfArticle = rex_article_slice::getSlicesForArticle($articleIDSubCat);
foreach($slicesOfArticle as $slice) { echo $slice->getSlice(); }
*/