<?php

class MehrfachBildauswahl extends ComponentBase
{
    private static $id = 0;

    function __construct($label, $rexValueId, $path2Value, $slice)
    {
        parent::__construct($label, $rexValueId, $path2Value, $slice);
    }

    public function getHTML()
    {
        $htmlOutput = '';
        $rex_value_1 = $this->getCurrentValue($this->rexValue, $this->path2Value);
        $htmlOutput .=
            '<div class="rex-js-widget rex-js-widget-medialist">
            <label style="width: 100%;">' . $this->label . ':</label>
            <div class="input-group">
                <select class="form-control" name="REX_MEDIALIST_SELECT[1]" id="REX_MEDIALIST_SELECT_' . self::$id . '" size="10">';
        if (!empty($rex_value_1)) {
            foreach (explode(',', $rex_value_1) as $img) {
                $htmlOutput .= '<option value="' . $img . '">' . $img . '</option> ';
            }
        }
        $htmlOutput .= '</select>
                <input type="hidden" name="REX_INPUT_VALUE[' . $this->rexValueId . '][' . join("][", $this->path2Value) . ']" id="REX_MEDIALIST_' . self::$id . '" value="' . $rex_value_1 . '">
                <span class="input-group-addon">
                    <div class="btn-group-vertical">
                        <a href="#" 
                            class="btn btn-popup" onclick="moveREXMedialist(' . self::$id . ',\'top\');return false;" 
                            title="Ausgewähltes Medium an den Anfang verschieben">
                                <i class="rex-icon rex-icon-top"></i></a>
                        <a href="#" 
                            class="btn btn-popup" onclick="moveREXMedialist(' . self::$id . ',\'up\');return false;" 
                            title="Ausgewähltes Medium nach oben verschieben">
                                <i class="rex-icon rex-icon-up"></i></a>
                        <a href="#" 
                            class="btn btn-popup" onclick="moveREXMedialist(' . self::$id . ',\'down\');return false;" 
                            title="Ausgewähltes Medium nach unten verschieben">
                                <i class="rex-icon rex-icon-down"></i></a>
                        <a href="#" 
                            class="btn btn-popup" onclick="moveREXMedialist(' . self::$id . ',\'bottom\');return false;" 
                            title="Ausgewähltes Medium an das Ende verschieben">
                                <i class="rex-icon rex-icon-bottom"></i></a>
                    </div>
                    <div class="btn-group-vertical">
                        <a href="#" class="btn btn-popup" onclick="openREXMedialist(' . self::$id . ',\'\');return false;" 
                            title="Medium auswählen">
                                <i class="rex-icon rex-icon-open-mediapool"></i></a>
                        <a href="#" class="btn btn-popup" onclick="addREXMedialist(' . self::$id . ',\'\');return false;" 
                            title="Neues Medium hinzufügen">
                                <i class="rex-icon rex-icon-add-media"></i></a>
                        <a href="#" class="btn btn-popup" onclick="deleteREXMedialist(' . self::$id . ');return false;" 
                            title="Ausgewähltes Medium löschen">
                                <i class="rex-icon rex-icon-delete-media"></i></a>
                        <a href="#" class="btn btn-popup" onclick="viewREXMedialist(' . self::$id . ',\'\');return false;" 
                            title="Ausgewähltes Medium anzeigen">
                                <i class="rex-icon rex-icon-view-media"></i></a>
                    </div>
                </span>
            </div>
        </div>';
        self::$id++;

        return $htmlOutput;
    }
}
