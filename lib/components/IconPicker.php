<?php

namespace redaxo_custom_components;

class IconPicker extends ComponentBase
{

    function __construct($label, $rexValueId, $path2Value, $slice)
    {
        parent::__construct($label, $rexValueId, $path2Value, $slice);
    }

    public function getHTML()
    {
        $output = '';
        $rex_value_1 = $this->getCurrentValue($this->rexValue, $this->path2Value);

        $output .= '<label style="width: 100%;" for="c-' . join("-", $this->path2Value) . '">' . $this->label . ':</label>' .
            '<div class="btn-group">
                    <button type="button" class="btn btn-primary iconpicker-component">
                        <i class="' . (!empty($rex_value_1) ? $rex_value_1 : 'fas fa-haykal') . ' iconpicker-component"></i>
                    </button>
                    <button id="c-' . join("-", $this->path2Value) . '" type="button" class="icp icp-dd-' . join("-", $this->path2Value) . ' btn btn-primary dropdown-toggle " data-selected="fa-car" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div id="rex-icon-picker" class="dropdown-menu iconpicker-container"></div>
                </div>
                <input style="display:none;" type="text" value="' .
            (!empty($rex_value_1) ? $rex_value_1 : 'fas fa-haykal') .
            '" name="REX_INPUT_VALUE[' . $this->rexValueId . '][' . join("][", $this->path2Value) . ']"" id="REX_INPUT_VALUE-' . join("-", $this->path2Value) . '">
                <script>
                    $(".icp-dd-' . join("-", $this->path2Value) . '").iconpicker({});
                    $(".icp-dd-' . join("-", $this->path2Value) . '").on("iconpickerSelected", function(event) {
                        console.log(event.iconpickerValue);
                        document.getElementById("REX_INPUT_VALUE-' . join("-", $this->path2Value) . '").value = event.iconpickerValue;
                    });
                </script>';
        return $output;
    }
}
