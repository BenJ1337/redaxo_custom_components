<?php

namespace redaxo_custom_components;

class DropDown extends ComponentBase
{
    private $options;
    private $defaultValue;

    function __construct($label, $rexValueId, $path2Value, $slice, $options)
    {
        parent::__construct($label, $rexValueId, $path2Value, $slice);
        $this->options = $options;
    }

    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
    }

    public function getHTML()
    {
        $htmlOutput = '';
        $rex_value_1 = $this->getCurrentValue($this->rexValue, $this->path2Value);
        if (empty($rex_value_1) && $this->defaultValue != null) {
            $rex_value_1 = $this->defaultValue;
        }

        $htmlOutput .= '<label for="c-' . join("-", $this->path2Value) . '">' . 
            $this->label . 
            ':</label>
                <select 
                    class="rex-custom-input 
                    form-control" 
                    data-rex-item-id="' . join(",", $this->path2Value) . '" 
                    name="REX_INPUT_VALUE[' . $this->rexValueId . '][' . join("][", $this->path2Value) . ']" 
                    id="c-' . join("-", $this->path2Value) . '">';
        foreach ($this->options as $key => $value) {
            $selected = '';
            if (isset($rex_value_1) && $value == $rex_value_1) {
                $selected = 'selected';
            }
            $htmlOutput .= '<option value="' . $value . '"' . $selected . '>' . $key . '</option>';
        }
        $htmlOutput .= '</select>';
        return $htmlOutput;
    }
}
