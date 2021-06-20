<?php
$slice = rex_article_slice::getArticleSliceById($rex_slice_id);
if ($slice != null) {
    $rex_value = rex_var::toArray($slice->getValue(1));
}
$itemsize = 3;
if (isset($_POST['REX_INPUT_VALUE'][1])) {
    $rex_value = $_POST['REX_INPUT_VALUE'][1];
}
redaxo_custom_components\UmstrukturierungRexValue::changeItems($rex_value, 'wrapper');
if (isset($rex_value['wrapper'])) {
    $itemsize = sizeof($rex_value['wrapper']);
}

for ($z = 0; $z < $itemsize; $z++) {
    echo '<div 
            style="border: 1px solid #222; 
            padding: 0 5px 5px; margin-bottom: 5px;">'
        . '<p 
            style="background: #222; color: #eee; padding: 2px; margin: 0 -5px; text-align: center;">Item #' . ($z + 1) . '</p>'
        . redaxo_custom_components\UmstrukturierungRexValue::getControls($z);
    $inputfield = new redaxo_custom_components\Inputfield(
        'Tab Titel:',
        1,
        ['wrapper', $z, 'titel'],
        $slice
    );
    $inputfield->setRexValue($rex_value);
    echo $inputfield->getHTML();
    $textarea = new redaxo_custom_components\Textarea(
        'Tab Text:',
        1,
        ['wrapper', $z, 'text'],
        $slice
    );
    $textarea->setRexValue($rex_value);
    echo $textarea->getHTML();
    echo '</div>';
}
