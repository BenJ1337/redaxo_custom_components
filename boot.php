<?php

function neuOrdnenOderLöschen(&$rv)
{
    if ($rv == null) {
        return;
    }
    $index = -1;
    $direction = 0;

    if (isset($_POST['item-remove'])) {
        $index = $_POST['item-remove'];
        $newArray = array();
        $newIndex = 0;
        for ($i = 0; $i < sizeof($rv['wrapper']); $i++) {
            if ($i != $index) {
                $newArray[$newIndex++] = $rv['wrapper'][$i];
            }
        }
        $rv['wrapper'] = $newArray;
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