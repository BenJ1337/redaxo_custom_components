<?php

namespace redaxo_custom_components;

class Linkauswahl extends ComponentBase
{

    function __construct($label, $rexValueId, $path2Value, $slice)
    {
        parent::__construct($label, $rexValueId, $path2Value, $slice);
    }

    public function getHTML()
    {
        $rex_value_1 = $this->getCurrentValue($this->rexValue, $this->path2Value);
        $name = '';
        if ($rex_value_1 !== '') {
            $selectedArticle = rex_article::get($rex_value_1);
            if ($selectedArticle !== null) {
                $name .= $selectedArticle->getName() . ' [' . $rex_value_1 . ']';
            }
        }
        echo
        '<label style="width: 100%;">' . $this->label . ':</label>
        <div class="input-group">
            <input class="form-control" 
                type="text" name="REX_INPUT_VALUE[' . $this->rexValueId . '][' . join("][", $this->path2Value) . ']" 
                value="' . $name . '" id="REX_LINK_' . $this->rexValueId . '_' . join("_", $this->path2Value) . '_NAME" 
                readonly>
            <input type="hidden" 
                name="REX_INPUT_VALUE[' . $this->rexValueId . '][' . join("][", $this->path2Value) . ']" 
                id="REX_LINK_' . $this->rexValueId . '_' . join("_", $this->path2Value) . '" 
                value="' . $rex_value_1 . '">
            <span class="input-group-btn">
                <a href="#" 
                    class="btn btn-popup" 
                    onclick="openLinkMap(\'REX_LINK_' . $this->rexValueId . '_' . join("_", $this->path2Value) . '\', \'\');return false;" 
                    title="Link auswählen">
                    <i class="rex-icon rex-icon-open-linkmap"></i>
                </a>
                <a href="#" 
                    class="btn btn-popup" 
                    onclick="deleteREXLink(\'' . $this->rexValueId . '_' . join("_", $this->path2Value) . '\');return false;" 
                    title="Ausgewählten Link löschen">
                    <i class="rex-icon rex-icon-delete-link"></i>
                </a>
            </span>
        </div>';
    }
}
