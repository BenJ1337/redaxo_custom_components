<?php

use redaxo_bootstrap\{CM_BootstrapFormBuilder};

$slice = rex_article_slice::getArticleSliceById($sliceId);
$bootstrapFormBuilder = new CM_BootstrapFormBuilder($slice);
echo $bootstrapFormBuilder->build();
