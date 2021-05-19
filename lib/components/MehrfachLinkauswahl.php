<?php

namespace redaxo_custom_components;

class MehrfachLinkauswahl extends ComponentBase
{
    private static $id = 1;

    function __construct($label, $rexValueId, $path2Value, $slice)
    {
        parent::__construct($label, $rexValueId, $path2Value, $slice);
    }

    public function getHTML()
    {
        $htmlOutput = '';
        $rex_value_1 = $this->getCurrentValue($this->rexValue, $this->path2Value);
        $htmlOutput .= '
            <label style="width: 100%;">' . $this->label . ':</label>
            <div class="input-group">
            <select class="form-control" 
                name="REX_LINKLIST_SELECT[' . self::$id . ']" 
                id="REX_LINKLIST_SELECT_' . self::$id . '" 
                size="10">';
        if (!empty($rex_value_1)) {
            foreach (explode(',', $rex_value_1) as $artId) {
                $htmlOutput .= '<option value="' . $artId . '">' . $artId . '</option> ';
            }
        }
        $htmlOutput .= '</select>
            <input type="hidden" 
                name="REX_INPUT_VALUE[' . $this->rexValueId . '][' . join("][", $this->path2Value) . ']" 
                id="REX_LINKLIST_' . self::$id . '"
                value="' . $rex_value_1 . '">
                <span class="input-group-addon">
                    <div class="btn-group-vertical">
                        <a href="#" 
                            class="btn btn-popup" 
                            onclick="moveREXLinklist(' . self::$id . ',\'top\');return false;" 
                            title="Ausgewählten Link an den Anfang verschieben">
                                <i class="rex-icon rex-icon-top"></i></a>
                        <a href="#" 
                            class="btn btn-popup" 
                            onclick="moveREXLinklist(' . self::$id . ',\'up\');return false;" 
                            title="Ausgewählten Link nach oben verschieben">
                                <i class="rex-icon rex-icon-up"></i></a>
                        <a href="#"
                            class="btn btn-popup" 
                            onclick="moveREXLinklist(' . self::$id . ',\'down\');return false;" 
                            title="Ausgewählten Link nach unten verschieben">
                                <i class="rex-icon rex-icon-down"></i></a>
                        <a href="#" 
                            class="btn btn-popup" 
                            onclick="moveREXLinklist(' . self::$id . ',\'bottom\');return false;" 
                            title="Ausgewählten Link an das Ende verschieben">
                                <i class="rex-icon rex-icon-bottom"></i></a>
                    </div>
                    <div class="btn-group-vertical">
                        <a href="#" class="btn btn-popup" onclick="openREXLinklist(' . self::$id . ', \'&amp;clang=1&amp;category_id=1\');return false;" 
                            title="Link auswählen">
                                <i class="rex-icon rex-icon-open-linkmap"></i></a>
                        <a href="#" class="btn btn-popup" onclick="deleteREXLinklist(' . self::$id . ');return false;" 
                            title="Ausgewählten Link löschen">
                                <i class="rex-icon rex-icon-delete-link"></i></a>
                    </div>
                </span>
            </div>';
        self::$id++;
        return $htmlOutput;
    }
}
