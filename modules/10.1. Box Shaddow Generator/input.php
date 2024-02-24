<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
$bootstrapFormBuilder = new CM_BootstrapFormBuilder($slice);
echo $bootstrapFormBuilder->build();
