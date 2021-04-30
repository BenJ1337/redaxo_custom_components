<?php
$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);
?>
<?php
echo '<pre><code class="' .
    (isset($rex_values_content['lang']) ? $rex_values_content['lang'] : 'nohighlight') .
    '">' .
    htmlspecialchars($rex_values_content['code']) .
    '</code></pre>';


/*
    <link rel="stylesheet" href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.7.2/build/styles/default.min.css">
    <script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.7.2/build/highlight.min.js"></script>

    !!! Achtung !!! > nach der Referenzierung von highlight.min.js die Highlightfunktionalität ausführen:
    <script>hljs.highlightAll();</script>
*/
?>
