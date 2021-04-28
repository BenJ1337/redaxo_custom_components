<?php
class UmstrukturierungRexValue
{
    public static function getControls($itemId)
    {
        return
            '
            <script>
                function dontSave() {
                    document.getElementsByName(\'save\')[0].value=0;
                }
            </script>
            <div 
            style="background: #555; padding: 5px; margin: 0 -5px 10px; display: inline-block; width: calc(100% + 10px);">'
            . '<div style="width: 33.3%; float: left;">'
            . '<button class="controle-btn"
            type="submit" 
            name="item-up" 
            title="UP"
            onclick="dontSave();"
            value="' . $itemId . '">
                <i style="color: #fff" class="glyphicon glyphicon-chevron-up"></i>
            </button>'
            . '<button class="controle-btn"
            type="submit" 
            name="item-down" 
            title="DOWN"
            onclick="dontSave();"
            value="' . $itemId . '">
                <i style="color: #fff" class="glyphicon glyphicon-chevron-down"></i>
            </button>'
            . '</div>'
            . '<div style="width: 33.3%; float: left;">'
            . '<button class="controle-btn"
                type="submit" 
                title="REMOVE"
                onclick="dontSave();"
                name="item-remove" 
                value="' . $itemId . '">
                    <i style="color: #fff" class="glyphicon glyphicon-trash"></i>
                </button>'
            . '</div>'
            . '<div style="width: 33.3%; float: left;">'
            . '<button class="controle-btn"
                type="submit" 
                title="New item before"
                name="item-new-before" 
                onclick="dontSave();"
                value="' . $itemId . '">
                    <i style="color: #fff" class="glyphicon glyphicon-plus"></i> Before
                </button>'
            . '<button class="controle-btn"
                type="submit" 
                title="New item after"
                name="item-new-after" 
                onclick="dontSave();"
                value="' . $itemId . '">
                    <i style="color: #fff" class="glyphicon glyphicon-plus"></i> After
                </button>'
            . '</div></div>'
            . '<style>
            .controle-btn {
                background: #222;
                color: #eee;
                border: none;
                padding: 3px 5px;
                margin-right: 5px;
            }
            .controle-btn:hover {
                background: #444;
                color: #fff;
            }
    </style>';
    }

    public static function changeItems(&$rv)
    {
        if ($rv == null) {
            return;
        }
        $index = -1;
        $direction = 0;

        if (isset($_POST['item-remove'])) {
            if (sizeof($rv['wrapper']) > 1) {
                $index = $_POST['item-remove'];
                $newArray = array();
                $newIndex = 0;
                for ($i = 0; $i < sizeof($rv['wrapper']); $i++) {
                    if ($i != $index) {
                        $newArray[$newIndex++] = $rv['wrapper'][$i];
                    }
                }
                $rv['wrapper'] = $newArray;
            } else {
                echo '<div class="alert alert-danger">Mindestens ein Eintrag muss erhalen bleiben!</div>';
            }
            return;
        }
        if (isset($_POST['item-new-before'])) {
            $index = $_POST['item-new-before'];
            $newArray = array();
            $newIndex = 0;
            for ($i = 0; $i < sizeof($rv['wrapper']); $i++) {
                if ($i != $index) {
                    $newArray[$newIndex] = $rv['wrapper'][$i];
                } else {
                    $newArray[$newIndex] = null;
                    $newArray[++$newIndex] = $rv['wrapper'][$i];
                }
                $newIndex++;
            }
            $rv['wrapper'] = $newArray;
            return;
        }
        if (isset($_POST['item-new-after'])) {
            $index = $_POST['item-new-after'];
            $newArray = array();
            $newIndex = 0;
            for ($i = 0; $i < sizeof($rv['wrapper']); $i++) {
                if ($i != $index) {
                    $newArray[$newIndex] = $rv['wrapper'][$i];
                } else {
                    $newArray[$newIndex] = $rv['wrapper'][$i];
                    $newArray[++$newIndex] = null;
                }
                $newIndex++;
            }
            $rv['wrapper'] = $newArray;
            return;
        }
        if (isset($_POST['item-up'])) {
            $index = $_POST['item-up'];
            $direction = -1;
        }
        if (isset($_POST['item-down'])) {
            $index = $_POST['item-down'];
            $direction = 1;
        }
        if ($index == 0 && $direction == -1) {
            echo '<div class="alert alert-danger">Verschieben nach oben nicht möglich</div>';
            return;
        }
        if ($index == sizeof($rv['wrapper']) - 1 && $direction == 1) {
            echo '<div class="alert alert-danger">Verschieben nach unten nicht möglich</div>';
            return;
        }
        if ($index == -1 || $direction == 0) {
            return;
        }

        $tmp = $rv['wrapper'][$index];
        $rv['wrapper'][$index] = $rv['wrapper'][$index + $direction];
        $rv['wrapper'][$index + $direction] = $tmp;
    }
}
