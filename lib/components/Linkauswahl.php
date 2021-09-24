<?php

class Linkauswahl
{

    private $rid;
    private $storedValue;
    private $itemId;
    private $label;

    function __construct($label, $rid, $itemId, $storedValue)
    {
        $this->rid = $rid;
        $this->itemId = $itemId;
        $this->storedValue = $storedValue;
        $this->label = $label;
    }



    public function getHTML()
    {
        $rex_value_1 = '';
        if (isset($this->storedValue) && $this->storedValue != null) {
            foreach ($this->itemId as $value) {
                if (isset($this->storedValue[$value]) || isset($rex_value_1[$value])) {
                    if ($rex_value_1 == '') {
                        $rex_value_1 = $this->storedValue[$value];
                    } else {
                        $rex_value_1 = $rex_value_1[$value];
                    }
                }
            }
        }
        $name = '';
        if ($rex_value_1 !== '') {
            $art = $selectedArticle = rex_article::get($rex_value_1);
            if ($art !== null) {
                $name .= $art->getName() . ' [' . $rex_value_1 . ']';
            }
        }
        echo
        '<label style="width: 100%;">' . $this->label . ':</label>
        <div class="input-group">
            <input class="form-control" type="text" name="REX_INPUT_VALUE[' . $this->rid . '][' . join("][", $this->itemId) . ']" value="' . $name . '" id="REX_LINK_' . $this->rid . '_' . join("_", $this->itemId) . '_NAME" readonly="readonly">
            <input type="hidden" name="REX_INPUT_VALUE[' . $this->rid . '][' . join("][", $this->itemId) . ']" id="REX_LINK_' . $this->rid . '_' . join("_", $this->itemId) . '" value="' . $rex_value_1 . '">
            <span class="input-group-btn">
                <a href="#" class="btn btn-popup" onclick="openLinkMap(\'REX_LINK_' . $this->rid . '_' . join("_", $this->itemId) . '\', \'\');return false;" title="Link auswählen">
                    <i class="rex-icon rex-icon-open-linkmap"></i>
                </a>
                <a href="#" class="btn btn-popup" onclick="deleteREXLink(\'' . $this->rid . '_' . join("_", $this->itemId) . '\');return false;" title="Ausgewählten Link löschen">
                    <i class="rex-icon rex-icon-delete-link"></i>
                </a>
            </span>
        </div>';
    }
}
