<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
if ($slice != null) {
    $rex_value = rex_var::toArray($slice->getValue(1));
}

$itemsize = 2;
UmstrukturierungRexValue::changeItems($rex_value);
if (isset($rex_value['wrapper'])) {
    $itemsize = sizeof($rex_value['wrapper']);
}

for ($z = 0; $z < $itemsize; $z++) {
    echo '<div 
            style="border: 1px solid #222; 
            padding: 0 5px 5px; margin-bottom: 5px;">'
        . '<p 
            style="background: #222; color: #eee; padding: 2px; margin: 0 -5px; text-align: center;">Item #' . ($z + 1) . '</p>'
        . UmstrukturierungRexValue::getControls($z);
    for ($i = 0; $i < 2; $i++) {
        $inputfield = new Inputfield(
            ' Text ' . $i,
            1,
            ['wrapper', $z, 'text', $i],
            $slice
        );
        $inputfield->setRexValue($rex_value);
        echo $inputfield->getHTML();
    }
    echo '</div>';
}
