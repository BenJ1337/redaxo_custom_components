<?php

abstract class ComponentBase
{

    protected ?string $label;
    protected int $rexValueId;
    protected array $path2Value;
    protected ?array $rexValue = null;

    public function __construct($label, $rexValueId, $path2Value, $slice)
    {
        $this->rexValueId = $rexValueId;
        $this->path2Value = $path2Value;
        if ($slice !== null) {
            $this->rexValue = rex_var::toArray($slice->getValue($this->rexValueId));
        }
        if ($label == null) {
            throw new RuntimeException("Es muss eine Text für das Label gesetzt werden!");
        }
        $this->label = $label;
    }

    public function setRexValue($rexValue)
    {
        $this->rexValue = $rexValue;
    }

    abstract public function getHTML();

    protected function getCurrentValue($rexValue, $path2Value)
    {
        $rex_value_1 = '';
        if ($rexValue != null) {
            $curNode = null;
            foreach ($path2Value as $NodeName) {
                if ($curNode == null) {
                    // Besuch des ersten Knoten von der Wurzel aus
                    if (isset($rexValue[$NodeName]) && $rexValue[$NodeName] != null) {
                        // Durchlaufe die Knoten des Baumes bis zum Blatt.
                        $curNode = $rexValue[$NodeName];
                    }
                } else {
                    // Besuche Kind vom aktuellen Knoten ($curNode)
                    if (isset($curNode[$NodeName]) && $curNode[$NodeName] != null) {
                        // Wert vorhanden.
                        $curNode = $curNode[$NodeName];
                    } else {
                        // Modul initial hinzugefügt oder kein Wert im Bildauswahl gesetzt.
                        // $htmlOutput .= '<script>console.log(">?");</script>';
                        $curNode = null;
                        break;
                    }
                }
            }
            if ($curNode != null) {
                $rex_value_1 = $curNode;
            }
        }
        return $rex_value_1;
    }
}
