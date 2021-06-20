<?php

class Bildauswahl extends ComponentBase
{
    // Id für das Bildauswahl innerhalb eines Modules, wird für die Interaktion mit dem Medienpool benötigt.
    private static $mediaId = 0;

    function __construct($label, $rexValueId, $path2Value, $slice)
    {
        parent::__construct($label, $rexValueId, $path2Value, $slice);
    }

    public function getHTML()
    {
        $htmlOutput = '';
        $rex_value_1 = $this->getCurrentValue($this->rexValue, $this->path2Value);

        // JavaScript und CSS einmalig der Page hinzufügen
        if (Bildauswahl::$mediaId == 0) {
            $htmlOutput .= '<script>
                function setPicture(id) {
                    var picture = document.getElementById(\'REX_MEDIA_\'+id).value;
                    if(picture !== undefined && picture !== "" 
                        && (picture.includes("png")
                            || picture.includes("jpg")
                            || picture.includes("jpeg"))) {
                        console.log("Bild ausgewählt: " + picture);
                        document.getElementById(\'REX_MEDIA_\'+id+\'_PREVIEW\').src = \'/media/\'  + picture
                    } else {
                        console.log("Kein Bild ausgewählt");
                        document.getElementById(\'REX_MEDIA_\'+id+\'_PREVIEW\').src = "";
                    }
                }
            </script>';
            $htmlOutput .= '<style>
                    .rex-slice .input-wrapper:hover img {
                        z-index: 4;
                        object-fit: initial;
                        max-width: 300px;
                    }
                    .input-wrapper:hover {
                        overflow: initial;
                    }
                    .input-wrapper {
                        width: 36px;
                        height: 36px;
                        background-color: #e9ecf2;
                        border: 1px solid #9fcce1;
                        float: left;
                        overflow: hidden;
                    }
                    .bildauswahl .input-group .form-control {
                        width: calc(100% - 36px);
                    }
                    .rex-slice .input-wrapper img {
                        object-fit: contain;
                        position: relative;
                        z-index: 3;
                        display: block;
                    }
                </style>';
        }
        $htmlOutput .= '
            <label style="width: 100%;">' . $this->label . ':</label>
            <div class="rex-js-widget rex-js-widget-media bildauswahl">
                <div class="input-group">
                    <div class="input-wrapper">
                        <img id="REX_MEDIA_' . Bildauswahl::$mediaId . '_PREVIEW" src="" />
                    </div>
                    <input class="form-control" 
                        onchange="setPicture(' . Bildauswahl::$mediaId . ');"
                        type="text" name="REX_INPUT_VALUE[' . $this->rexValueId . '][' . join("][", $this->path2Value) . ']" 
                        value="' . $rex_value_1 . '" 
                        id="REX_MEDIA_' . Bildauswahl::$mediaId . '" 
                        readonly>
                    <script>   
                        setPicture(' . Bildauswahl::$mediaId . ');
                    </script>
                    <span class="input-group-btn">
                        <a href="#" class="btn btn-popup" 
                            onclick="openREXMedia(' . Bildauswahl::$mediaId . ',\'\');return false;" 
                            title="Medium auswählen">
                                <i class="rex-icon rex-icon-open-mediapool"></i>
                        </a>
                        <a href="#" class="btn btn-popup" 
                            onclick="addREXMedia(' . Bildauswahl::$mediaId . ',\'\');return false;" 
                            title="Neues Medium hinzufügen">
                                <i class="rex-icon rex-icon-add-media"></i>
                        </a>
                        <a href="#" class="btn btn-popup" 
                            onclick="deleteREXMedia(' . Bildauswahl::$mediaId . ');return false;" 
                            title="Ausgewähltes Medium löschen">
                                <i class="rex-icon rex-icon-delete-media"></i>
                        </a>
                        <a href="#" class="btn btn-popup" 
                            onclick="viewREXMedia(' . Bildauswahl::$mediaId . ',\'\');return false;" 
                            title="Ausgewähltes Medium anzeigen">
                                <i class="rex-icon rex-icon-view-media"></i>
                        </a>
                    </span>
                </div>
                <div class="rex-js-media-preview"></div>
            </div>';
        Bildauswahl::$mediaId++;
        return $htmlOutput;
    }
}
