
    <?php

    use redaxo_bootstrap\{ModuleManager};

    $output = '';
    //rex_article_content:: getContentAsQuery(true) -> SQL Queries erlauben
    //rex_article_content::
    $this->getContentAsQuery(true);
    $slice = rex_article_slice::getArticleSliceById($this->getCurrentSlice()->getId());
    if (null !== $slice) {
        $rex_values_content = json_decode($slice->getValue(2), true);
        if (isset($rex_values_content["text"]) && $rex_values_content["text"] != '') {
            if (!rex::isBackend() && isset($rex_values_content["hintergrund"]) && isset($rex_values_content["deckkraft"])) {
                list($r, $g, $b) = sscanf($rex_values_content["hintergrund"], "#%02x%02x%02x");
                $styles = '';
                $styles .= 'background: rgba(' . $r . ',' . $g . ',' . $b . ',' . $rex_values_content["deckkraft"] / 100 . ');';
                if (!rex::isBackend() && isset($rex_values_content["borderRadius"]) && isset($rex_values_content["borderRadius"])) {
                    $styles .=  'border-radius: ' . $rex_values_content["borderRadius"] . '%; padding: 20px;';
                }
                $output .= '<div style="' . $styles . '">';
            }
            $output .= (new ModuleManager($this->getCurrentSlice()->getId()))->getOutput($rex_values_content["text"]);
            if (!rex::isBackend() && isset($rex_values_content["hintergrund"]) && isset($rex_values_content["deckkraft"]))
                $output .= '</div>';
        }
    }
    echo $output;
    ?>
