<?php

class CM_Global_Request_Settings
{
    private static $globalSettings = null;
    private $slickslider = false;
    private $photoswipe = false;
    private $fontawesome = false;
    private $highlightjs = false;

    function __construct()
    {
    }

    public function setFontawesome($value)
    {
        $this->fontawesome = $value;
    }

    public function isFontawesome()
    {
        return $this->fontawesome;
    }

    public function setPhotoswipe($value)
    {
        $this->photoswipe = $value;
    }

    public function isPhotoswipe()
    {
        return $this->photoswipe;
    }

    public function setSlickslider($value)
    {
        $this->slickslider = $value;
    }

    public function isSlickslider()
    {
        return $this->slickslider;
    }

    public function setHighlightjs($value)
    {
        $this->highlightjs = $value;
    }

    public function isHighlightjs()
    {
        return $this->highlightjs;
    }

    static function getInstance()
    {
        if (CM_Global_Request_Settings::$globalSettings == null) {
            CM_Global_Request_Settings::$globalSettings = new CM_Global_Request_Settings();
        }
        return CM_Global_Request_Settings::$globalSettings;
    }
}
