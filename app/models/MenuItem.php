<?php


class MenuItem
{
    private $path;
    private $caption;
    private $URI_PARTS;

    public function __construct($path, $caption, $URI_PARTS = null) {

        $this->path = $path;
        $this->caption = $caption;
        $this->URI_PARTS = $URI_PARTS;

    }

    public function isActive($URI_PARTS = null) {
        if(is_null($URI_PARTS)) {
            return $this->URI_PARTS[0] == $this->path;
        }

        return $URI_PARTS[0] == $this->path;
    }

    public function getPath()
    {
        return $this->path;
    }


    public function getCaption()
    {
        return $this->caption;
    }
}