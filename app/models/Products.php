<?php

require_once '../app/models/Product.php';
require_once '../app/models/DB.php';
class Products
{
    private $product_list;

    public function __construct() {

        $db = DB::getInstance();
        $stat = $db->conn->prepare("SELECT * FROM products");
        $stat->execute();
        /*
        $tmp = file_get_contents('../data/products.json');
        $tmp = json_decode($tmp);
        */

       // foreach ($tmp as $item) {
        while($item = $stat->fetch(PDO::FETCH_OBJ)){
            $product = new Product($item->id, $item->name, $item->promo, $item->price, $item->stock, $item->lead, $item->description);
            $this->product_list[] = $product;
        }
    }

    public function getAll() {
        return $this->product_list;
    }

    public function getPromo() {
        $promo_products = array_filter($this->product_list, function($a) {
            return $a->getPromo();
        });

        return $promo_products;
    }

    public function getNormal() {
        $normal_products = array_filter($this->product_list, function($a) {
            return !$a->getPromo();
        });

        return $normal_products;
    }

    public function getProductById($id) {
        $the_product = array_filter($this->product_list, function($a) use ($id) {
            return $a->getId() == $id;
        });

        if(count($the_product)) {
            return array_values($the_product)[0];
        } else {
            return null;
        }
    }

    public function getRandom() {
        $rand_product = $this->product_list[array_rand($this->product_list, 1)];

        return $rand_product;
    }

}




