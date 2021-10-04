<?php

require_once "../app/models/Products.php";
require_once "../app/models/Product.php";


class Basket
{
    private $content;
    /** A kosár reprezentációja egy tömb, ami a következőképpen néz ki:
     * Ezt kell majd a session-ben tárolni, és az alábbi metódusokkal módosítgatni

     [
        "arvizturo" => [                // a tömbelem kulcsa a termékkód
            "prod" => object(Product)   // az árvíztűrő termék objektumpéldánya
            "pcs"  => 5                 // hány darab ilyen termék van a kosárban
        ],
        "reszelo" => [
            "prod" => object(Product)
            "pcs"  => 2
        ]
     ]

     */

    public function __construct() {
        // Ha nincs még kosár, akkor létrehozzuk azt üres tömbként
        if(!array_key_exists("basket", $_SESSION)) {
            $_SESSION["basket"] = [];
        }
        $this->content = [];
    }

    public function load() {

        $this->content = $_SESSION["basket"];


    }

    public function save() {

        $_SESSION["basket"] =  $this->content;
    }

    public function empty() {
        $this->content = [];
    }

    public function add(Product $product, $pcs) {
        // A termék objektum hozzáadása a kosárhoz $pcs darabszámban.
        if(array_key_exists($product->getId(), $this->content)) {
            $this->content[$product->getId()]["pcs"] += $pcs;
        } else {
            $this->content[$product->getId()] = [
                "prod" => $product,
                "pcs" => $pcs
                ];
        }

    }

    public function getContents() {
        // Kosár tartalmát leíró tömb visszaadása
        return $this->content;
    }

}