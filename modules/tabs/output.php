<?php
$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);
?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <?php for ($i = 0; $i < sizeof($rex_values_content["wrapper"]); $i++) {
        echo '<li class="nav-item">
                <a class="nav-link' . ($i == 0 ? ' active' : '') . '"
                    id="tab-' . $i . '" 
                    data-toggle="tab" href="#tab-content-' . $i . '" role="tab" aria-controls="tab-content-' . $i . '"
                    aria-selected="true">' . $rex_values_content["wrapper"][$i]['titel'] . '</a>
            </li>';
    }
    ?>
</ul>
<div class="tab-content" id="myTabContent">
    <?php
    for ($i = 0; $i < sizeof($rex_values_content["wrapper"]); $i++) {
        echo '<div class="tab-pane fade show ' . ($i == 0 ? ' active' : '') . '" 
                    id="tab-content-' . $i . '" 
                    role="tabpanel" 
                    aria-labelledby="tab-' . $i . '">' .
            $rex_values_content["wrapper"][$i]['text'] .
            '</div>';
    }
    echo  '';
    ?>
</div>