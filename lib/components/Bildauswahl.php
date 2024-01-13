<?php

class Bildauswahl extends AbstractEingabekomponente
{

    function __construct($label,  $itemId, $sliceId, $redaxoValue)
    {
        parent::__construct($label, $itemId, $sliceId, $redaxoValue);
    }

    public function getHTML()
    {
        return '<label>' . $this->label . '<br>' . rex_var_media::getWidget(
            "REX_MEDIA_ID_" . $this->redaxoValueId,
            'REX_INPUT_VALUE[' . $this->redaxoValueId . '][' . join("][", $this->itemId) . ']',
            $this->getValue(),
            []
        ) . '</label>';
    }
}
