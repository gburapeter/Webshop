<?php

require_once '../app/models/Menu.php';

class BasicController
{
    private $URI_PARTS;

    public function __construct($URI_PARTS) {
        $this->URI_PARTS = $URI_PARTS;
    }

    public function show($__CONTENT) {
        $menu = new Menu($this->URI_PARTS);
        $menu = $menu->getMenuItems();

        include '../view/menu.php';
        include '../view/header.php';
        include '../view/footer.php';
        include '../view/main.php';
    }
}