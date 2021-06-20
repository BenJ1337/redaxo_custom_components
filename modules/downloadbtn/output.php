<?php
$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);

if (isset($rex_values_content["doc"])) {
    $doc = $rex_values_content["doc"];
    if (!empty($doc)) {
        $media = rex_media::get($doc);

        $output = '';
        $download = '';
        if (isset($rex_values_content["downloadonly"]) && $rex_values_content["downloadonly"] = '1') {
            $download = 'download';
        }

        $output .= '<a ' . $download . ' href="' . $media->getUrl() . '">' . $media->getTitle() . '</a>';
        echo $output;
    }
}
