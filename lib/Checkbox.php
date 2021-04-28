<?php
class Checkbox extends ComponentBase
{
    private $checkbox_checked_value;
    private $checkbox_unchecked_value;

    function __construct($label, $rexValueId, $path2Value, $slice, $checkbox_checked_value, $checkbox_unchecked_value)
    {
        parent::__construct($label, $rexValueId, $path2Value, $slice);
        $this->checkbox_checked_value = $checkbox_checked_value;
        $this->checkbox_unchecked_value = $checkbox_unchecked_value;
    }

    public function getHTML()
    {
        $htmlOutput = '';
        $rex_value_1 = $this->getCurrentValue($this->rexValue, $this->path2Value);
        $checked = "";

        if ($rex_value_1 == $this->checkbox_checked_value) {
            $checked = "checked";
        } else {
            $rex_value_1 = $this->checkbox_unchecked_value;
        }

        $htmlOutput .= '<div class="checkbox">' .
            '<label for="c-' . join("-", $this->path2Value) . '">' .
            '<input 
                onchange="
                    this.nextSibling.nextSibling.value=(this.checked==true?\'' . $this->checkbox_checked_value . '\':\'' . $this->checkbox_unchecked_value . '\');"
                data-rex-item-id="c-' . join("-", $this->path2Value) . '" 
                type="checkbox" ' .
            'id="c-' . join("-", $this->path2Value) . '" 
                ' . $checked . '>' .
            $this->label . '
            <input type="hidden" 
                data-rex-item-id="hi-' . join("-", $this->path2Value) . '"
                name="REX_INPUT_VALUE[' . $this->rexValueId . '][' . join("][", $this->path2Value) . ']" 
                value="' . $rex_value_1 . '" /></label>' .
            '</div>';
        return $htmlOutput;
    }
}
