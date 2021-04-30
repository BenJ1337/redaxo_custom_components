<div style="padding: 5px; background: #e8e8e8; border-radius: 4px;">
    <a style="color: #002acc;" target="_blank" href="https://highlightjs.org/">https://highlightjs.org/</a>
</div>
<div class="form-group">
    <?php
    $slice = rex_article_slice::getArticleSliceById($rex_slice_id);

    $dropdown = new DropDown(
        'Sprache',
        1,
        ['lang'],
        $slice,
        [
            'Ohne Hervorhebung' => 'nohighlight',
            'Text' => 'plaintext',
            'PHP' => 'php',
            'SQL' => 'sql',
            'CSS' => 'css',
            'Python' => 'python',
            'HTML' => 'html',
            'SCSS' => 'scss'
        ]
    );
    echo $dropdown->getHTML();
    $textarea = new Textarea(
        'Code',
        1,
        ['code'],
        $slice
    );
    echo $textarea->getHTML();
    ?>
</div>