<?php

require_once '../app/models/MenuItem.php';

class Menu
{
    private $menu_items;

    public function __construct($URI_PARTS = null) {

        $db = DB::getInstance();
        $stat = $db->conn->prepare("SELECT * FROM menu");
        $stat->execute();
        /*
        $tmp = file_get_contents('../data/products.json');
        $tmp = json_decode($tmp);
        */

        // foreach ($tmp as $item) {
        while($item = $stat->fetch(PDO::FETCH_OBJ)){
            $menu_item = new MenuItem($item->path, $item->caption, $URI_PARTS);
            $this->menu_items[] = $menu_item;
        }

    }

    /**
     * @return MenuItem[]
     */
    public function getMenuItems()
    {
        return $this->menu_items;
    }

}