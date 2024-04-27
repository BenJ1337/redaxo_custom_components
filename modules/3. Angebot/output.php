    <?php

    use redaxo_bootstrap\{ModuleManager};

    if (!function_exists('addText')) {
        function addText($output, $slice)
        {
            $rex_values_content = json_decode($slice->getValue(2), true);
            if (isset($rex_values_content["text"]) && $rex_values_content["text"] != '') {
                $output .= '<div class="col-md-6">';
                $output .= $rex_values_content["text"];
                $output .= '</div>';
            }
            return $output;
        }
    }

    if (!function_exists('addImage')) {
        function addImage($output, $slice)
        {
            $rex_values_content = json_decode($slice->getValue(2), true);
            if (isset($rex_values_content["bild"]) && $rex_values_content["bild"] != '') {
                $alt = $rex_values_content["bild"];
                $medium = rex_media::get($rex_values_content["bild"]);
                if ($medium != null) {
                    $alt = $medium->getTitle() != "" ? trim($medium->getTitle()) : $medium->getFileName();
                }
                $output .= '<div class="col-md-6">';
                $root = rex::getServer();
                if (str_ends_with($root, '/')) {
                    $root = substr($root, 0, strlen($root) - 1);
                }
                $output .= '<img style="width: 100%" class="img-fluid" src="'
                    . $root . '/media/' . $rex_values_content["bild"] . '" alt="' . $alt . '">';
                $output .= '</div>';
            }
            return $output;
        }
    }

    if (!function_exists('addContent')) {
        function addContent($slice)
        {
            $output = '';
            $rex_values_content = json_decode($slice->getValue(2), true);
            if (isset($rex_values_content["text"]) && $rex_values_content["text"] != '') {
                $styles = '';
                if (!rex::isBackend() && isset($rex_values_content["borderRadius"]) && isset($rex_values_content["borderRadius"])) {
                    $styles .=  'border-radius: ' . $rex_values_content["borderRadius"] . 'px; padding: 20px 10px; margin: 0 0 10px; ';
                }
                if (!rex::isBackend() && isset($rex_values_content["hintergrund"]) && isset($rex_values_content["deckkraft"])) {
                    list($r, $g, $b) = sscanf($rex_values_content["hintergrund"], "#%02x%02x%02x");
                    $styles .= 'background: rgba(' . $r . ',' . $g . ',' . $b . ',' . $rex_values_content["deckkraft"] / 100 . ');';
                    $output .= '<div class="row">';
                }

                $output .= '<div class="col">';
                $output .= '<div class="row" style="' . $styles . '">';
                $output = addImage($output, $slice);
                $output = addText($output, $slice);
                $output .= '</div></div>';

                if (!rex::isBackend() && isset($rex_values_content["hintergrund"]) && isset($rex_values_content["deckkraft"])) {
                    $output .= '</div>';
                }
            }
            return (new ModuleManager($slice->getId()))->getOutput($output);
        }
    }

    //rex_article_content:: getContentAsQuery(true) -> SQL Queries erlauben
    //rex_article_content::
    $this->getContentAsQuery(true);
    $slice = rex_article_slice::getArticleSliceById($this->getCurrentSlice()->getId());
    if (null !== $slice) {
        echo addContent($slice);
    }
    ?>