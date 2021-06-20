<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
?>
<div class="form-group">
    <?php
    $media = new Bildauswahl(
        'Dokument',
        1,
        ['doc'],
        $slice
    );
    echo $media->getHTML();
    ?>
</div>
<div class="form-group">
    <?php
    $checkbox = new Checkbox(
        'Datei soll heruntergeladen werden bzw. nicht im Browser dargestellt werden',
        1,
        ['downloadonly'],
        $slice,
        '1',
        '0'
    );
    echo $checkbox->getHTML();
    ?>
</div>